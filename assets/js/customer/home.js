let homeData = {};
let currentSlide = 0;
let heroInterval = null;

document.addEventListener('DOMContentLoaded', async () =>
{
    try
    {
        homeData = await apiGet('home');

        if (!homeData)
        {
            return;
        }

        renderSettings();
        renderHero();
        renderProducts();
        renderCategories();
        renderBrands();
        initHeroAutoSlide();
    }
    catch (error)
    {
        console.error('[HOME]', error);
        showHomeError();
    }
});

function showHomeError()
{
    const hero = document.getElementById('heroContent');

    if (hero)
    {
        showError(hero, 'Gagal memuat data beranda');
    }
}

function renderSettings()
{
    const settings = homeData.settings || {};

    if (settings.featured_subtitle)
    {
        document.getElementById('featuredSubtitle').textContent =
            settings.featured_subtitle;
    }

    if (settings.featured_title)
    {
        document.getElementById('featuredTitle').textContent =
            settings.featured_title;
    }
}

function renderHero()
{
    const container = document.getElementById('heroContent');
    const banners = homeData.banners || [];

    if (!banners.length)
    {
        showEmpty(container, 'Belum ada banner aktif');
        return;
    }

    renderHeroSlide();
}

function renderHeroSlide()
{
    const banners = homeData.banners || [];

    if (!banners.length)
    {
        return;
    }

    const banner = banners[currentSlide];
    const imageUrl = uploadUrl('banners', banner.image);
    const buttonLink = normalizeLink(banner.button_link);
    const buttonText = banner.button_text || 'Shop Now';
    const description = banner.subtitle || (homeData.settings && homeData.settings.about_us) || '';

    document.getElementById('heroContent').innerHTML = `
    <div class="hero-content">
        <div class="hero-left">
            <div class="hero-subtitle">${escapeHtml(banner.subtitle || 'Luxury Collection')}</div>
            <h1 class="hero-title">${escapeHtml(banner.title || 'Discover Your Scent')}</h1>
            <div class="hero-description">${escapeHtml(truncate(description, 160))}</div>
            ${buttonLink ? `
            <a href="${buttonLink}" class="hero-button">
                ${escapeHtml(buttonText)}
                <i class="bi bi-arrow-right"></i>
            </a>` : ''}
        </div>
        <div class="hero-right">
            <img src="${imageUrl}" alt="${escapeHtml(banner.title || 'Banner')}" class="hero-image">
            <div class="hero-controls">
                <button type="button" id="prevHero"><i class="bi bi-arrow-left"></i></button>
                <div class="hero-dots" id="heroDots"></div>
                <button type="button" id="nextHero"><i class="bi bi-arrow-right"></i></button>
            </div>
        </div>
    </div>`;

    renderDots();
    bindHeroControls();
}

function bindHeroControls()
{
    const prev = document.getElementById('prevHero');
    const next = document.getElementById('nextHero');

    if (prev)
    {
        prev.addEventListener('click', prevSlide);
    }

    if (next)
    {
        next.addEventListener('click', nextSlide);
    }
}

function renderDots()
{
    const dotsEl = document.getElementById('heroDots');

    if (!dotsEl)
    {
        return;
    }

    let html = '';

    homeData.banners.forEach((banner, index) =>
    {
        html += `<div class="hero-dot ${index === currentSlide ? 'active' : ''}" data-index="${index}"></div>`;
    });

    dotsEl.innerHTML = html;

    dotsEl.querySelectorAll('.hero-dot').forEach((dot) =>
    {
        dot.addEventListener('click', () =>
        {
            goSlide(Number(dot.dataset.index));
        });
    });
}

function nextSlide()
{
    if (!homeData.banners || !homeData.banners.length)
    {
        return;
    }

    currentSlide++;

    if (currentSlide >= homeData.banners.length)
    {
        currentSlide = 0;
    }

    renderHeroSlide();
}

function prevSlide()
{
    if (!homeData.banners || !homeData.banners.length)
    {
        return;
    }

    currentSlide--;

    if (currentSlide < 0)
    {
        currentSlide = homeData.banners.length - 1;
    }

    renderHeroSlide();
}

function goSlide(index)
{
    currentSlide = index;
    renderHeroSlide();
}

function initHeroAutoSlide()
{
    if (!homeData.banners || homeData.banners.length <= 1)
    {
        return;
    }

    if (heroInterval)
    {
        clearInterval(heroInterval);
    }

    heroInterval = setInterval(nextSlide, 5000);
}

function renderProducts()
{
    const container = document.getElementById('featuredProducts');
    const products = homeData.featured_products || [];

    if (!products.length)
    {
        showEmpty(container, 'Belum ada produk unggulan');
        return;
    }

    let html = '';

    products.forEach((product) =>
    {
        const image = uploadUrl('products', product.thumbnail || product.primary_image);
        const fallbackImage = `https://ui-avatars.com/api/?name=${encodeURIComponent(product.name || 'Product')}&background=eae0d5&color=4b4035`;

        html += `
        <div class="product-card" data-aos="fade-up">
            <div class="product-image-wrapper">
                <img src="${image || fallbackImage}" alt="${escapeHtml(product.name)}" class="product-image">
            </div>
            <div class="product-body">
                <div class="product-brand">${escapeHtml(product.brand_name || '-')}</div>
                <div class="product-name">${escapeHtml(product.name || '-')}</div>
                <div class="product-price">${formatRupiah(product.price || 0)}</div>
                <button class="add-cart-btn" onclick="addToCart(${product.id})">
                    <i class="bi bi-bag"></i>
                    Tambah ke Keranjang
                </button>
            </div>
        </div>`;
    });

    container.innerHTML = html;
}

async function addToCart(productId)
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

    try
    {
        await apiPost('cart', {
            user_id: userId,
            product_id: productId,
            qty: 1
        });

        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: 'Produk ditambahkan ke keranjang',
            timer: 1500,
            showConfirmButton: false
        });

        // Update cart badge
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

async function updateCartBadge()
{
    const badge = document.getElementById('cartBadge');
    const mobileBadge = document.getElementById('mobileCartBadge');
    if (!badge) return;

    const userId = localStorage.getItem('customer_user');
    if (!userId) return;

    try
    {
        const cart = await apiGet(`cart?user_id=${userId}`);
        const totalItems = cart && cart.items ? cart.items.reduce((sum, item) => sum + (parseInt(item.qty) || 0), 0) : 0;
        badge.textContent = totalItems > 0 ? totalItems.toString() : '';
        badge.style.display = totalItems > 0 ? 'flex' : 'none';
        if (mobileBadge)
        {
            mobileBadge.textContent = totalItems.toString();
        }
    }
    catch (err)
    {
        console.error('[CART BADGE ERROR]', err);
    }
}

function renderCategories()
{
    const container = document.getElementById('categoriesContainer');
    const categories = homeData.categories || [];

    if (!categories.length)
    {
        showEmpty(container, 'Belum ada kategori');
        return;
    }

    const categoryIcons = [
        'bi-flower1',
        'bi-droplet',
        'bi-stars',
        'bi-sun',
        'bi-moon',
        'bi-heart',
        'bi-gem',
        'bi-snow'
    ];

    let html = '';

    categories.forEach((category, index) =>
    {
        const icon = categoryIcons[index % categoryIcons.length];
        html += `
        <a href="${BASE_URL}katalog?category=${category.id}" class="category-card" data-aos="fade-up" data-aos-delay="${index * 50}">
            <div class="category-icon">
                <i class="bi ${icon}"></i>
            </div>
            <div class="category-name">${escapeHtml(category.name)}</div>
            <div class="category-count">Lihat Produk</div>
        </a>`;
    });

    container.innerHTML = html;
}

function renderBrands()
{
    const container = document.getElementById('brandsContainer');
    const brands = homeData.brands || [];

    if (!brands.length)
    {
        showEmpty(container, 'Belum ada brand');
        return;
    }

    let html = '';

    brands.forEach((brand, index) =>
    {
        const logo = uploadUrl('brands', brand.logo);
        const fallbackLogo = `https://ui-avatars.com/api/?name=${encodeURIComponent(brand.name || 'Brand')}&background=f5efe6&color=4b4035&size=100`;

        html += `
        <div class="brand-card" data-aos="fade-up" data-aos-delay="${index * 50}">
            <div class="brand-logo-wrapper">
                <img src="${logo || fallbackLogo}" alt="${escapeHtml(brand.name)}">
            </div>
            <div class="brand-name">${escapeHtml(brand.name || '-')}</div>
            <div class="brand-country">${escapeHtml(brand.origin_country || '-')}</div>
            <div class="brand-description">${escapeHtml(truncate(brand.description, 90))}</div>
        </div>`;
    });

    container.innerHTML = html;
}

function normalizeLink(link)
{
    if (!link)
    {
        return '';
    }

    if (/^https?:\/\//i.test(link))
    {
        return link;
    }

    if (link.startsWith('/'))
    {
        return `${window.location.origin}${link}`;
    }

    return `${BASE_URL}${link.replace(/^\//, '')}`;
}

function escapeHtml(str)
{
    return String(str || '')
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;');
}
