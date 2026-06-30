document.addEventListener('DOMContentLoaded', async () =>
{
    const orderId = window.location.pathname.split('/').pop();
    await loadOrderSuccess(orderId);
});

async function loadOrderSuccess(orderId)
{
    const content = document.getElementById('checkoutSuccessContent');

    if (!orderId || isNaN(orderId))
    {
        renderError(content);
        return;
    }

    try
    {
        const order = await apiGet(`orders/${orderId}`);

        if (!order)
        {
            renderError(content);
            return;
        }

        renderSuccess(order);
    }
    catch (error)
    {
        console.error('[ORDER SUCCESS ERROR]', error);
        renderError(content);
    }
}

function renderSuccess(order)
{
    const content = document.getElementById('checkoutSuccessContent');

    content.innerHTML = `
        <div class="success-card" data-aos="fade-up">
            <div class="success-icon">
                <i class="bi bi-check-lg"></i>
            </div>
            <h1 class="success-title">Pesanan Berhasil!</h1>
            <p class="success-subtitle">Terima kasih telah berbelanja di toko kami</p>
            
            <div class="order-details">
                <div class="order-detail-row">
                    <span class="order-detail-label">Nomor Pesanan</span>
                    <span class="order-detail-value highlight">${escapeHtml(order.order_number)}</span>
                </div>
                <div class="order-detail-row">
                    <span class="order-detail-label">Tanggal</span>
                    <span class="order-detail-value">${formatDate(order.created_at)}</span>
                </div>
                <div class="order-detail-row">
                    <span class="order-detail-label">Status Pembayaran</span>
                    <span class="order-detail-value">${formatPaymentStatus(order.payment_status)}</span>
                </div>
                <div class="order-detail-row">
                    <span class="order-detail-label">Total</span>
                    <span class="order-detail-value highlight">${formatRupiah(order.grand_total)}</span>
                </div>
                
                ${order.items && order.items.length > 0 ? `
                    <div class="order-items-preview">
                        <div class="order-items-preview-title">Item Pesanan</div>
                        ${order.items.slice(0, 3).map(item => `
                            <div class="order-item-preview">
                                <div class="order-item-preview-image">
                                    <img src="https://ui-avatars.com/api/?name=${encodeURIComponent(item.product_name)}&background=FAF6F0&color=4B4035&size=100" alt="${escapeHtml(item.product_name)}">
                                </div>
                                <div class="order-item-preview-name">${escapeHtml(item.product_name)}</div>
                                <div class="order-item-preview-qty">x${item.qty}</div>
                            </div>
                        `).join('')}
                        ${order.items.length > 3 ? `
                            <div class="order-item-preview">
                                <div class="order-item-preview-name">+${order.items.length - 3} item lainnya</div>
                            </div>
                        ` : ''}
                    </div>
                ` : ''}
            </div>
            
            <div class="success-actions">
                <a href="${BASE_URL}katalog" class="success-btn success-btn-secondary">
                    <i class="bi bi-arrow-left"></i> Lanjut Belanja
                </a>
                <a href="${BASE_URL}cart" class="success-btn success-btn-primary">
                    Lihat Pesanan Saya
                </a>
            </div>
        </div>
    `;
}

function renderError(content)
{
    content.innerHTML = `
        <div class="error-card" data-aos="fade-up">
            <div class="error-icon">
                <i class="bi bi-exclamation-triangle"></i>
            </div>
            <h1 class="error-title">Pesanan Tidak Ditemukan</h1>
            <p class="error-subtitle">Maaf, pesanan yang Anda cari tidak ditemukan atau telah kadaluarsa.</p>
            <div class="success-actions">
                <a href="${BASE_URL}katalog" class="success-btn success-btn-primary">
                    <i class="bi bi-arrow-left"></i> Kembali ke Katalog
                </a>
            </div>
        </div>
    `;
}

function formatDate(dateString)
{
    if (!dateString) return '-';
    
    const date = new Date(dateString);
    return date.toLocaleDateString('id-ID', {
        day: 'numeric',
        month: 'long',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
}

function formatPaymentStatus(status)
{
    const statusMap = {
        'pending': 'Menunggu Pembayaran',
        'paid': 'Sudah Dibayar',
        'cancelled': 'Dibatalkan',
        'refunded': 'Dikembalikan'
    };
    
    return statusMap[status] || status;
}
