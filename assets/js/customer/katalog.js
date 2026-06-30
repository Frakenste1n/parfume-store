document.addEventListener('DOMContentLoaded', async () =>
{
    await loadCatalog();
    initCatalogFilters();
});

let allProducts = [];
let currentFilter = 'all';
let searchQuery = '';

async function loadCatalog()
{
    const grid = document.getElementById('catalogGrid');
    const empty = document.getElementById('catalogEmpty');

    try
    {
        allProducts = await apiGet('products');

        if (!allProducts || allProducts.length === 0)
        {
            grid.style.display = 'none';
            empty.style.display = 'block';
            return;
        }

        renderCatalog(allProducts);
    }
    catch (error)
    {
        console.error('[CATALOG ERROR]', error);
        showError(grid, 'Gagal memuat produk. Silakan refresh halaman.');
    }
}

function renderCatalog(products)
{
    const grid = document.getElementById('catalogGrid');
    const empty = document.getElementById('catalogEmpty');

    if (!products || products.length === 0)
    {
        grid.innerHTML = '';
        grid.style.display = 'none';
        empty.style.display = 'block';
        return;
    }

    grid.style.display = 'grid';
    empty.style.display = 'none';

    grid.innerHTML = products.map((product, index) =>
    {
        const imageUrl = product.primary_image
            ? uploadUrl('products', product.primary_image)
            : `https://ui-avatars.com/api/?name=${encodeURIComponent(product.name)}&background=FAF6F0&color=4B4035&size=400`;

        const isFeatured = product.is_featured === 1;

        return `
            <div class="product-card" data-aos="fade-up" data-aos-delay="${index * 50}" onclick="viewProduct(${product.id})">
                <div class="product-card-image">
                    <img src="${imageUrl}" alt="${escapeHtml(product.name)}" loading="lazy">
                    ${isFeatured ? '<span class="product-badge">Featured</span>' : ''}
                </div>
                <div class="product-card-content">
                    <div class="product-card-brand">${escapeHtml(product.brand_name || 'Brand')}</div>
                    <h3 class="product-card-name">${escapeHtml(product.name)}</h3>
                    <div class="product-card-footer">
                        <span class="product-card-price">${formatRupiah(product.price)}</span>
                        <button class="product-card-action" onclick="event.stopPropagation(); addToCart(${product.id})">
                            <i class="bi bi-bag-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        `;
    }).join('');
}

function initCatalogFilters()
{
    const tabs = document.querySelectorAll('.filter-tab');
    const searchInput = document.getElementById('catalogSearch');

    tabs.forEach(tab =>
    {
        tab.addEventListener('click', () =>
        {
            tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
            currentFilter = tab.dataset.filter;
            applyFilters();
        });
    });

    if (searchInput)
    {
        searchInput.addEventListener('input', debounce((e) =>
        {
            searchQuery = e.target.value.trim().toLowerCase();
            applyFilters();
        }, 300));
    }
}

function applyFilters()
{
    let filtered = [...allProducts];

    if (currentFilter === 'featured')
    {
        filtered = filtered.filter(p => p.is_featured === 1);
    }
    else if (currentFilter === 'new')
    {
        filtered = filtered.slice(0, 12);
    }

    if (searchQuery)
    {
        filtered = filtered.filter(p =>
            p.name.toLowerCase().includes(searchQuery) ||
            (p.brand_name && p.brand_name.toLowerCase().includes(searchQuery)) ||
            (p.category_name && p.category_name.toLowerCase().includes(searchQuery))
        );
    }

    renderCatalog(filtered);
}

function resetCatalogFilters()
{
    currentFilter = 'all';
    searchQuery = '';

    const tabs = document.querySelectorAll('.filter-tab');
    tabs.forEach(t => t.classList.remove('active'));
    tabs[0].classList.add('active');

    const searchInput = document.getElementById('catalogSearch');
    if (searchInput)
    {
        searchInput.value = '';
    }

    renderCatalog(allProducts);
}

function viewProduct(productId)
{
    window.location.href = `${BASE_URL}search?q=${productId}`;
}

async function addToCart(productId)
{
    try
    {
        const userId = localStorage.getItem('customer_user');

        if (!userId)
        {
            Swal.fire({
                icon: 'warning',
                title: 'Login Diperlukan',
                text: 'Silakan login untuk menambahkan produk ke keranjang',
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

        await apiPost('cart', {
            user_id: userId,
            product_id: productId,
            qty: 1
        });

        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: 'Produk ditambahkan ke keranjang',
            timer: 2000,
            showConfirmButton: false
        });

        updateCartBadge();
    }
    catch (error)
    {
        console.error('[ADD TO CART ERROR]', error);
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: 'Gagal menambahkan produk ke keranjang'
        });
    }
}

function updateCartBadge()
{
    const badge = document.getElementById('cartBadge');
    const mobileBadge = document.getElementById('mobileCartBadge');
    if (!badge) return;

    const userId = localStorage.getItem('customer_user');
    if (!userId) return;

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
