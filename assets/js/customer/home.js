let homeData = {};
let currentSlide = 0;
let heroInterval = null;

document.addEventListener('DOMContentLoaded', async () =>
{
    homeData = await apiGet('/home');

    if (!homeData)
    {
        return;
    }

    renderHero();
    renderProducts();
    renderCategories();
    renderBrands();

    initHeroAutoSlide();
});


function formatRupiah(number)
{
    return new Intl.NumberFormat(
        'id-ID',
        {
            style: 'currency',
            currency: 'IDR',
            maximumFractionDigits: 0
        }
    ).format(number);
}


/* ===================================
 HERO
=================================== */

function renderHero()
{
    renderHeroSlide();
    renderDots();

    document
        .getElementById('prevHero')
        .addEventListener('click', prevSlide);

    document
        .getElementById('nextHero')
        .addEventListener('click', nextSlide);
}


function renderHeroSlide()
{
    const banner = homeData.banners[currentSlide];

    const imageUrl =
        `${window.location.origin}/parfume-store/uploads/banners/${banner.image}`;

    document.getElementById('heroContent').innerHTML =

    `
    <div class="hero-content">

        <div class="hero-left">

            <div class="hero-subtitle">

                ${banner.subtitle}

            </div>

            <h1 class="hero-title">

                ${banner.title}

            </h1>

            <div class="hero-description">

                Discover exclusive fragrances crafted for elegance and timeless luxury.

            </div>

            <a
                href="${banner.button_link}"
                class="hero-button">

                ${banner.button_text}

                <i class="bi bi-arrow-right"></i>

            </a>

        </div>


        <div class="hero-right">

            <img
                src="${imageUrl}"
                class="hero-image">


            <div class="hero-controls">

                <button id="prevHero">

                    <i class="bi bi-arrow-left"></i>

                </button>


                <div
                    class="hero-dots"
                    id="heroDots">

                </div>


                <button id="nextHero">

                    <i class="bi bi-arrow-right"></i>

                </button>

            </div>

        </div>

    </div>
    `;

    renderDots();

    document
        .getElementById('prevHero')
        .addEventListener('click', prevSlide);

    document
        .getElementById('nextHero')
        .addEventListener('click', nextSlide);
}


function renderDots()
{
    let html = '';

    homeData.banners.forEach((banner,index)=>
    {
        html += `
        <div
            class="hero-dot ${index===0 ? 'active' : ''}"
            onclick="goSlide(${index})">
        </div>
        `;
    });

    document.getElementById('heroDots').innerHTML = html;
}


function updateDots()
{
    document
        .querySelectorAll('.hero-dot')
        .forEach((dot,index)=>
        {
            dot.classList.toggle(
                'active',
                index===currentSlide
            );
        });
}


function nextSlide()
{
    currentSlide++;

    if(currentSlide>=homeData.banners.length)
    {
        currentSlide=0;
    }

    renderHeroSlide();
}


function prevSlide()
{
    currentSlide--;

    if(currentSlide<0)
    {
        currentSlide=
        homeData.banners.length-1;
    }

    renderHeroSlide();
}


function goSlide(index)
{
    currentSlide=index;
    renderHeroSlide();
}


function initHeroAutoSlide()
{
    heroInterval=setInterval(
        nextSlide,
        5000
    );
}



/* ===================================
 PRODUCTS
=================================== */

function renderProducts()
{
    let html='';

    homeData.featured_products.forEach(product=>
    {
        const image=
        `${window.location.origin}/parfume-store/uploads/products/${product.thumbnail}`;

        html+=`

        <div class="product-card"
             data-aos="fade-up">

            <div class="product-image-wrapper">

                <img
                    src="${image}"
                    class="product-image">

            </div>

            <div class="product-body">

                <div class="product-brand">

                    ${product.brand_name}

                </div>

                <div class="product-name">

                    ${product.name}

                </div>

                <div class="product-price">

                    ${formatRupiah(product.price)}

                </div>

                <button class="add-cart-btn">

                    Add To Cart

                </button>

            </div>

        </div>

        `;
    });

    document
        .getElementById('featuredProducts')
        .innerHTML=html;
}



/* ===================================
 CATEGORY
=================================== */

function renderCategories()
{
    let html='';

    homeData.categories.forEach(category=>
    {
        html+=`

        <a
            href="${window.location.origin}/parfume-store/katalog?category=${category.id}"
            class="category-pill"
            data-aos="zoom-in">

            ${category.name}

        </a>

        `;
    });

    document
        .getElementById('categoriesContainer')
        .innerHTML=html;
}



/* ===================================
 BRANDS
=================================== */

function renderBrands()
{
    let html='';

    homeData.brands.forEach(brand=>
    {
        const logo=
        `${window.location.origin}/parfume-store/uploads/brands/${brand.logo}`;

        html+=`

        <div class="brand-card"
             data-aos="fade-up">

            <img
                src="${logo}"
                class="brand-logo">


            <div>

                <div class="brand-name">

                    ${brand.name}

                </div>

                <div class="brand-country">

                    ${brand.origin_country}

                </div>

                <div class="brand-description">

                    ${brand.description ?? ''}

                </div>

            </div>

        </div>

        `;
    });

    document
        .getElementById('brandsContainer')
        .innerHTML=html;
}