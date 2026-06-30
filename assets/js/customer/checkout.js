document.addEventListener('DOMContentLoaded', async () =>
{
    await loadCheckout();
});

let cartData = null;
let paymentMethods = [];
let selectedPaymentMethod = null;
let userData = null;

async function loadCheckout()
{
    const content = document.getElementById('checkoutContent');

    const userId = localStorage.getItem('customer_user');

    if (!userId)
    {
        renderLoginPrompt(content);
        return;
    }

    try
    {
        const [cart, payments, user] = await Promise.all([
            apiGet(`cart?user_id=${userId}`),
            apiGet('payment-methods'),
            apiGet(`users/${userId}`)
        ]);

        cartData = cart;
        paymentMethods = payments;
        userData = user;

        if (!cartData || !cartData.items || cartData.items.length === 0)
        {
            renderEmptyState(content);
            return;
        }

        if (!paymentMethods || paymentMethods.length === 0)
        {
            renderNoPaymentMethods(content);
            return;
        }

        renderCheckout();
    }
    catch (error)
    {
        console.error('[CHECKOUT ERROR]', error);
        showError(content, 'Gagal memuat data checkout. Silakan refresh halaman.');
    }
}

function renderCheckout()
{
    const content = document.getElementById('checkoutContent');

    const subtotal = cartData.items.reduce((sum, item) => sum + (item.price * item.qty), 0);
    const tax = subtotal * 0.11;
    const total = subtotal + tax;
    const userAddress = userData?.address || '';

    content.innerHTML = `
        <div class="checkout-grid">
            <div class="checkout-left" data-aos="fade-up">
                <div class="shipping-address">
                    <div class="payment-methods-header">
                        <h2 class="payment-methods-title">Alamat Pengiriman</h2>
                        <p class="payment-methods-subtitle">Masukkan alamat lengkap untuk pengiriman pesanan</p>
                    </div>
                    <div class="address-input-group">
                        <label for="shippingAddress" class="address-label">Alamat Lengkap</label>
                        <textarea
                            id="shippingAddress"
                            class="address-textarea"
                            placeholder="Masukkan alamat lengkap Anda (nama jalan, nomor rumah, kelurahan, kecamatan, kota, kode pos)"
                            rows="3">${escapeHtml(userAddress)}</textarea>
                    </div>
                </div>
                <div class="payment-methods">
                    <div class="payment-methods-header">
                        <h2 class="payment-methods-title">Pilih Metode Pembayaran</h2>
                        <p class="payment-methods-subtitle">Pilih metode pembayaran yang Anda inginkan</p>
                    </div>
                    <div class="payment-method-list">
                        ${paymentMethods.map((method, index) => `
                            <label class="payment-method-option">
                                <input type="radio" name="payment_method" value="${method.id}" ${index === 0 ? 'checked' : ''}>
                                <div class="payment-method-card">
                                    <div class="payment-method-logo">
                                        ${method.logo
                                            ? `<img src="${uploadUrl('payments', method.logo)}" alt="${escapeHtml(method.name)}">`
                                            : `<span class="payment-method-logo-placeholder">${escapeHtml(method.name.charAt(0))}</span>`
                                        }
                                    </div>
                                    <div class="payment-method-info">
                                        <div class="payment-method-name">${escapeHtml(method.name)}</div>
                                        <div class="payment-method-account">${escapeHtml(method.account_name)} - ${escapeHtml(method.account_number)}</div>
                                    </div>
                                    <div class="payment-method-radio"></div>
                                </div>
                            </label>
                        `).join('')}
                    </div>
                    <button class="checkout-btn" onclick="processCheckout()">
                        Bayar Sekarang - ${formatRupiah(total)}
                    </button>
                </div>
            </div>
            <div class="order-summary" data-aos="fade-up" data-aos-delay="100">
                <div class="order-summary-header">
                    <h3 class="order-summary-title">Ringkasan Pesanan</h3>
                    <span class="order-summary-count">${cartData.items.length} item</span>
                </div>
                <div class="order-items">
                    ${cartData.items.map(item => `
                        <div class="order-item">
                            <div class="order-item-image">
                                <img src="${item.product_image ? uploadUrl('products', item.product_image) : `https://ui-avatars.com/api/?name=${encodeURIComponent(item.product_name)}&background=FAF6F0&color=4B4035&size=100`}" alt="${escapeHtml(item.product_name)}">
                            </div>
                            <div class="order-item-details">
                                <div class="order-item-name">${escapeHtml(item.product_name)}</div>
                                <div class="order-item-brand">${escapeHtml(item.brand_name || 'Brand')}</div>
                                <div class="order-item-qty-price">
                                    <span class="order-item-qty">x${item.qty}</span>
                                    <span class="order-item-price">${formatRupiah(item.price)}</span>
                                </div>
                            </div>
                        </div>
                    `).join('')}
                </div>
                <div class="order-summary-totals">
                    <div class="summary-row">
                        <span class="summary-row-label">Subtotal</span>
                        <span class="summary-row-value">${formatRupiah(subtotal)}</span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-row-label">Pajak (11%)</span>
                        <span class="summary-row-value">${formatRupiah(tax)}</span>
                    </div>
                    <div class="summary-row total">
                        <span class="summary-row-label">Total</span>
                        <span class="summary-row-value">${formatRupiah(total)}</span>
                    </div>
                </div>
            </div>
        </div>
    `;

    // Add event listeners for payment method selection
    document.querySelectorAll('input[name="payment_method"]').forEach(radio =>
    {
        radio.addEventListener('change', (e) =>
        {
            selectedPaymentMethod = parseInt(e.target.value);
        });
    });

    // Set initial selected payment method
    selectedPaymentMethod = paymentMethods[0]?.id;
}

async function processCheckout()
{
    const userId = localStorage.getItem('customer_user');

    if (!selectedPaymentMethod)
    {
        Swal.fire({
            icon: 'warning',
            title: 'Pilih Metode Pembayaran',
            text: 'Silakan pilih metode pembayaran terlebih dahulu'
        });
        return;
    }

    const shippingAddress = document.getElementById('shippingAddress')?.value?.trim() || '';

    if (!shippingAddress)
    {
        Swal.fire({
            icon: 'warning',
            title: 'Alamat Diperlukan',
            text: 'Silakan masukkan alamat pengiriman lengkap'
        });
        return;
    }

    const btn = document.querySelector('.checkout-btn');
    const originalText = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Memproses...';

    try
    {
        const result = await apiPost('orders', {
            user_id: userId,
            payment_method_id: selectedPaymentMethod,
            shipping_address: shippingAddress
        });

        if (result && result.order_id)
        {
            Swal.fire({
                icon: 'success',
                title: 'Checkout Berhasil',
                text: 'Pesanan Anda telah dibuat',
                timer: 2000,
                showConfirmButton: false
            }).then(() =>
            {
                window.location.href = `${BASE_URL}checkout/success/${result.order_id}`;
            });
        }
    }
    catch (error)
    {
        console.error('[CHECKOUT ERROR]', error);
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: 'Gagal memproses checkout. Silakan coba lagi.'
        });
    }
    finally
    {
        btn.disabled = false;
        btn.innerHTML = originalText;
    }
}

function renderLoginPrompt(content)
{
    content.innerHTML = `
        <div class="checkout-empty">
            <div class="empty-state-card">
                <i class="bi bi-person-lock"></i>
                <h3>Login Diperlukan</h3>
                <p>Silakan login untuk melakukan checkout</p>
                <a href="${BASE_URL}login" class="back-cart-btn">Login Sekarang</a>
            </div>
        </div>
    `;
}

function renderEmptyState(content)
{
    content.innerHTML = `
        <div class="checkout-empty">
            <div class="empty-state-card">
                <i class="bi bi-cart-x"></i>
                <h3>Keranjang Kosong</h3>
                <p>Keranjang belanja Anda kosong. Silakan tambahkan produk terlebih dahulu.</p>
                <a href="${BASE_URL}katalog" class="back-cart-btn">Ke Katalog</a>
            </div>
        </div>
    `;
}

function renderNoPaymentMethods(content)
{
    content.innerHTML = `
        <div class="checkout-empty">
            <div class="empty-state-card">
                <i class="bi bi-credit-card"></i>
                <h3>Metode Pembayaran Tidak Tersedia</h3>
                <p>Metode pembayaran belum tersedia. Silakan hubungi admin.</p>
                <a href="${BASE_URL}cart" class="back-cart-btn">Kembali ke Keranjang</a>
            </div>
        </div>
    `;
}
