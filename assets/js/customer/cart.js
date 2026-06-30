document.addEventListener('DOMContentLoaded', async () =>
{
    await loadCart();
});

let cartData = null;

async function loadCart()
{
    const content = document.getElementById('cartContent');
    const empty = document.getElementById('cartEmpty');

    const userId = localStorage.getItem('customer_user');

    if (!userId)
    {
        renderLoginPrompt(content);
        return;
    }

    try
    {
        cartData = await apiGet(`cart?user_id=${userId}`);

        if (!cartData || !cartData.items || cartData.items.length === 0)
        {
            content.style.display = 'none';
            empty.style.display = 'block';
            return;
        }

        renderCart(cartData);
    }
    catch (error)
    {
        console.error('[CART ERROR]', error);
        showError(content, 'Gagal memuat keranjang. Silakan refresh halaman.');
    }
}

// Reload cart when page becomes visible (for when user navigates back from catalog)
document.addEventListener('visibilitychange', () => {
    if (!document.hidden) {
        loadCart();
    }
});

function renderLoginPrompt(content)
{
    content.innerHTML = `
        <div class="cart-login-prompt" style="grid-column: 1 / -1; text-align: center; padding: 60px 20px;">
            <i class="bi bi-person-lock" style="font-size: 48px; color: #C8A97E; margin-bottom: 20px; display: block;"></i>
            <h3 style="font-family: 'Cormorant Garamond', serif; font-size: 28px; color: #4B4035; margin: 0 0 12px;">Login Diperlukan</h3>
            <p style="color: #8D8278; margin-bottom: 24px;">Silakan login untuk melihat keranjang belanja Anda</p>
            <a href="${BASE_URL}login" style="display: inline-flex; padding: 12px 28px; border-radius: 999px; background: #C8A97E; color: #fff; text-decoration: none; font-weight: 600; transition: all 0.3s ease;">Login Sekarang</a>
        </div>
    `;
}

function renderCart(cart)
{
    const content = document.getElementById('cartContent');
    const empty = document.getElementById('cartEmpty');

    if (!cart || !cart.items || cart.items.length === 0)
    {
        content.innerHTML = '';
        content.style.display = 'none';
        empty.style.display = 'block';
        return;
    }

    content.style.display = 'grid';
    empty.style.display = 'none';

    const subtotal = cart.items.reduce((sum, item) => sum + (item.price * item.qty), 0);

    content.innerHTML = `
        <div class="cart-items">
            <div class="cart-items-header">
                <h3>Item Keranjang</h3>
                <span class="cart-items-count">${cart.items.length} item</span>
            </div>
            ${cart.items.map(item => renderCartItem(item)).join('')}
        </div>
        <div class="cart-summary">
            <h3>Ringkasan Pesanan</h3>
            <div class="summary-row">
                <span class="summary-row-label">Subtotal</span>
                <span class="summary-row-value">${formatRupiah(subtotal)}</span>
            </div>
            <div class="summary-row">
                <span class="summary-row-label">Pajak (11%)</span>
                <span class="summary-row-value">${formatRupiah(subtotal * 0.11)}</span>
            </div>
            <div class="summary-row total">
                <span class="summary-row-label">Total</span>
                <span class="summary-row-value">${formatRupiah(subtotal * 1.11)}</span>
            </div>
            <button class="checkout-btn" onclick="checkout()">Checkout</button>
        </div>
    `;
}

function renderCartItem(item)
{
    const imageUrl = item.product_image
        ? uploadUrl('products', item.product_image)
        : `https://ui-avatars.com/api/?name=${encodeURIComponent(item.product_name)}&background=FAF6F0&color=4B4035&size=200`;

    const qty = parseInt(item.qty) || 1;

    return `
        <div class="cart-item">
            <div class="cart-item-image">
                <img src="${imageUrl}" alt="${escapeHtml(item.product_name)}" loading="lazy">
            </div>
            <div class="cart-item-details">
                <div class="cart-item-brand">${escapeHtml(item.brand_name || 'Brand')}</div>
                <h4 class="cart-item-name">${escapeHtml(item.product_name)}</h4>
                <div class="cart-item-price">${formatRupiah(item.price)}</div>
                <div class="cart-item-quantity">
                    <button class="quantity-btn" onclick="updateQuantity(${item.id}, ${qty - 1})">
                        <i class="bi bi-dash"></i>
                    </button>
                    <span class="quantity-value">${qty}</span>
                    <button class="quantity-btn" onclick="updateQuantity(${item.id}, ${qty + 1})">
                        <i class="bi bi-plus"></i>
                    </button>
                </div>
            </div>
            <div class="cart-item-actions">
                <button class="remove-item-btn" onclick="removeItem(${item.id})" title="Hapus item">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        </div>
    `;
}

async function updateQuantity(itemId, newQty)
{
    if (newQty < 1)
    {
        Swal.fire({
            icon: 'question',
            title: 'Hapus Item?',
            text: 'Apakah Anda ingin menghapus item ini dari keranjang?',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Batal'
        }).then((result) =>
        {
            if (result.isConfirmed)
            {
                removeItem(itemId);
            }
        });
        return;
    }

    try
    {
        await apiPut(`cart/${itemId}`, {
            qty: newQty
        });

        await loadCart();
        updateCartBadge();
    }
    catch (error)
    {
        console.error('[UPDATE QUANTITY ERROR]', error);
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: 'Gagal mengupdate jumlah item'
        });
    }
}

async function removeItem(itemId)
{
    try
    {
        await apiDelete(`cart/${itemId}`);
        await loadCart();
        updateCartBadge();

        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: 'Item dihapus dari keranjang',
            timer: 1500,
            showConfirmButton: false
        });
    }
    catch (error)
    {
        console.error('[REMOVE ITEM ERROR]', error);
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: 'Gagal menghapus item'
        });
    }
}

function checkout()
{
    const userId = localStorage.getItem('customer_user');

    if (!userId)
    {
        Swal.fire({
            icon: 'warning',
            title: 'Login Diperlukan',
            text: 'Silakan login untuk melakukan checkout',
            confirmButtonText: 'Login',
            showCancelButton: true,
            cancelButtonText: 'Batal'
        }).then((result) =>
        {
            if (result.isConfirmed)
            {
                window.location.href = `${BASE_URL}login`;
            }
        });
        return;
    }

    window.location.href = `${BASE_URL}checkout`;
}

function updateCartBadge()
{
    const badge = document.getElementById('cartBadge');
    const mobileBadge = document.getElementById('mobileCartBadge');
    if (!badge) return;

    const userId = localStorage.getItem('customer_user');
    if (!userId)
    {
        badge.textContent = '';
        badge.style.display = 'none';
        if (mobileBadge)
        {
            mobileBadge.textContent = '0';
        }
        return;
    }

    apiGet(`cart?user_id=${userId}`)
        .then(cart =>
        {
            const totalItems = cart && cart.items ? cart.items.reduce((sum, item) => sum + (parseInt(item.qty) || 0), 0) : 0;
            badge.textContent = totalItems > 0 ? totalItems.toString() : '';
            badge.style.display = totalItems > 0 ? 'flex' : 'none';
            if (mobileBadge)
            {
                mobileBadge.textContent = totalItems.toString();
            }
        })
        .catch(err => console.error('[CART BADGE ERROR]', err));
}
