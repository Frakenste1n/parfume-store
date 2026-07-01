document.addEventListener('DOMContentLoaded', async () => {
    await loadOrders();
});

async function loadOrders() {
    const content = document.getElementById('ordersContent');
    const userId = localStorage.getItem('customer_user');

    if (!userId) {
        renderLoginPrompt(content);
        return;
    }

    try {
        const orders = await apiGet(`orders?user_id=${userId}`);

        if (!orders || orders.length === 0) {
            renderEmptyState(content);
            return;
        }

        renderOrders(orders);
    } catch (error) {
        console.error('[ORDERS ERROR]', error);
        renderError(content, 'Gagal memuat riwayat pesanan. Silakan refresh halaman.');
    }
}

function renderOrders(orders) {
    const content = document.getElementById('ordersContent');
    
    let html = '<div class="orders-list">';
    
    orders.forEach(order => {
        const statusClass = order.payment_status || 'pending';
        const canCancel = ['pending', 'processing', 'shipped'].includes(order.status);
        
        html += `
            <div class="order-card">
                <div class="order-card-header">
                    <div>
                        <div class="order-number">${order.order_number || '#' + order.id}</div>
                        <div class="order-date">${formatDate(order.created_at)}</div>
                    </div>
                    <span class="order-status ${statusClass}">${statusClass}</span>
                </div>
                <div class="order-items">
                    <div class="order-item">
                        <div class="order-item-info">
                            <div class="order-item-name">Order #${order.id}</div>
                            <div class="order-item-qty">${order.notes ? order.notes.substring(0, 50) + '...' : 'Tanpa catatan'}</div>
                        </div>
                        <div class="order-item-price">${formatRupiah(order.grand_total || order.subtotal || 0)}</div>
                    </div>
                </div>
                <div class="order-card-footer">
                    <div class="order-total">Total: ${formatRupiah(order.grand_total || order.subtotal || 0)}</div>
                    <div class="order-actions">
                        <button type="button" class="btn btn-view" onclick="viewOrderDetail(${order.id})">Detail</button>
                        ${canCancel ? `<button type="button" class="btn btn-cancel" onclick="cancelOrder(${order.id})">Batalkan</button>` : ''}
                    </div>
                </div>
            </div>
        `;
    });
    
    html += '</div>';
    content.innerHTML = html;
}

function renderEmptyState(content) {
    content.innerHTML = `
        <div class="empty-state">
            <i class="bi bi-receipt"></i>
            <h3>Belum Ada Pesanan</h3>
            <p>Anda belum memiliki riwayat pesanan. Mulai belanja sekarang!</p>
            <a href="${BASE_URL}katalog" class="btn">Ke Katalog</a>
        </div>
    `;
}

function renderLoginPrompt(content) {
    content.innerHTML = `
        <div class="empty-state">
            <i class="bi bi-person-lock"></i>
            <h3>Login Diperlukan</h3>
            <p>Silakan login untuk melihat riwayat pesanan Anda</p>
            <a href="${BASE_URL}login" class="btn">Login Sekarang</a>
        </div>
    `;
}

function renderError(content, message) {
    content.innerHTML = `
        <div class="empty-state">
            <i class="bi bi-exclamation-circle"></i>
            <h3>Terjadi Kesalahan</h3>
            <p>${message}</p>
            <button onclick="loadOrders()" class="btn">Coba Lagi</button>
        </div>
    `;
}

async function viewOrderDetail(orderId) {
    try {
        const order = await apiGet(`orders/${orderId}`);

        if (!order) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Gagal memuat detail pesanan'
            });
            return;
        }
        
        let itemsHtml = '';
        if (order.items && order.items.length) {
            order.items.forEach(item => {
                itemsHtml += `
                    <div class="order-item">
                        <div class="order-item-info">
                            <div class="order-item-name">${item.product_name}</div>
                            <div class="order-item-qty">${item.qty} x ${formatRupiah(item.price)}</div>
                        </div>
                        <div class="order-item-price">${formatRupiah(item.subtotal)}</div>
                    </div>
                `;
            });
        } else {
            itemsHtml = '<p class="text-muted">Tidak ada item pesanan.</p>';
        }

        Swal.fire({
            title: order.order_number || 'Order #' + order.id,
            html: `
                <div style="text-align: left; padding: 10px;">
                    <p><strong>Status Pembayaran:</strong> <span class="badge ${order.payment_status}">${order.payment_status}</span></p>
                    <p><strong>Status Order:</strong> ${order.status || '-'}</p>
                    <p><strong>Tanggal:</strong> ${formatDate(order.created_at)}</p>
                    <p><strong>Subtotal:</strong> ${formatRupiah(order.subtotal)}</p>
                    <p><strong>Total:</strong> ${formatRupiah(order.grand_total || order.subtotal)}</p>
                    ${order.notes ? `<p><strong>Catatan:</strong> ${order.notes}</p>` : ''}
                    <hr>
                    <h6>Item Pesanan:</h6>
                    <div>${itemsHtml}</div>
                </div>
            `,
            width: '500px',
            confirmButtonText: 'Tutup'
        });
    } catch (error) {
        console.error('[ORDER DETAIL ERROR]', error);
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: 'Gagal memuat detail pesanan'
        });
    }
}

async function cancelOrder(orderId) {
    const result = await Swal.fire({
        title: 'Batalkan Pesanan?',
        text: 'Apakah Anda yakin ingin membatalkan pesanan ini? Stock akan dikembalikan.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Batalkan',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#dc3545'
    });

    if (!result.isConfirmed) return;

    try {
        const response = await fetch(`${BASE_URL}api/orders/${orderId}/cancel`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            }
        });

        const data = await response.json();

        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Pesanan berhasil dibatalkan',
                timer: 2000,
                showConfirmButton: false
            }).then(() => {
                loadOrders();
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: data.message || 'Gagal membatalkan pesanan'
            });
        }
    } catch (error) {
        console.error('[CANCEL ERROR]', error);
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: 'Terjadi kesalahan saat membatalkan pesanan'
        });
    }
}

function formatDate(dateString) {
    if (!dateString) return '-';
    const date = new Date(dateString.replace(' ', 'T'));
    if (isNaN(date.getTime())) return dateString;
    return date.toLocaleDateString('id-ID', {
        day: '2-digit',
        month: 'short',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
}

function formatRupiah(amount) {
    return 'Rp ' + Number(amount || 0).toLocaleString('id-ID');
}
