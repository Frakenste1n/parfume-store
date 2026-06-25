document.addEventListener('DOMContentLoaded', async () => {
    loadSettings();
    initNavbarButtons();
});

async function loadSettings() {
    const settings = await apiGet('/settings');

    if (!settings) {
        return;
    }

    const logoUrl = `${window.location.origin}/parfume-store/uploads/settings/${settings.logo}`;

    //--------------------------------
    // navbar
    //--------------------------------

    document.getElementById('siteName').textContent =
        settings.site_name;

    document.getElementById('navbarLogo').src =
        logoUrl;

    window.addEventListener(
        'scroll',
        () => {
            const navbar =
                document.querySelector('.navbar-custom');

            if (window.scrollY > 40) {
                navbar.classList.add(
                    'navbar-scrolled'
                );
            }
            else {
                navbar.classList.remove(
                    'navbar-scrolled'
                );
            }
        }
    );

    //--------------------------------
    // footer
    //--------------------------------

    document.getElementById('footerLogo').src =
        logoUrl;

    document.getElementById('footerSiteName').textContent =
        settings.site_name;

    document.getElementById('footerAbout').textContent =
        settings.about_us;

    document.getElementById('footerWhatsapp').innerHTML =
        `<i class="fa-brands fa-whatsapp"></i> ${settings.whatsapp}`;

    document.getElementById('footerEmail').innerHTML =
        `<i class="fa-regular fa-envelope"></i> ${settings.email}`;

    document.getElementById('footerAddress').innerHTML =
        `<i class="fa-solid fa-location-dot"></i> ${settings.address}`;

    document.getElementById('footerInstagram').href =
        settings.instagram;

    document.getElementById('footerInstagram').innerHTML =
        `<i class="fa-brands fa-instagram"></i> Instagram`;
}

function initNavbarButtons() {
    //--------------------------------
    // search
    //--------------------------------
    document.getElementById('searchBtn')
        .addEventListener('click', () => {
            window.location.href =
                `${window.location.origin}/parfume-store/katalog`;
        });


    //--------------------------------
    // cart
    //--------------------------------
    document.getElementById('cartBtn')
        .addEventListener('click', () => {
            window.location.href =
                `${window.location.origin}/parfume-store/cart`;
        });


    //--------------------------------
    // auth
    //--------------------------------

    //--------------------------------
    // auth
    //--------------------------------

    const isLogin =
        localStorage.getItem('customer_token');

    const authIcon =
        document.getElementById('authIcon');

    const authBtn =
        document.getElementById('authBtn');

    if (isLogin) {
        authIcon.className =
            'bi bi-box-arrow-right';

        authBtn.addEventListener('click', () => {
            localStorage.removeItem('customer_token');

            location.reload();
        });
    }
    else {
        authIcon.className =
            'bi bi-person';

        authBtn.addEventListener('click', () => {
            window.location.href =
                `${window.location.origin}/parfume-store/login`;
        });
    }
}