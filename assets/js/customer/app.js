document.addEventListener('DOMContentLoaded', async () =>
{
    await loadSettings();
    initNavbarButtons();
    initSearchOverlay();
    initMobileMenu();
});

async function loadSettings()
{
    try
    {
        const settings = await apiGet('settings');

        if (!settings)
        {
            return;
        }

        applySiteBranding(settings);
    }
    catch (error)
    {
        console.error('[SETTINGS]', error);
    }
}

function applySiteBranding(settings)
{
    const logoUrl = uploadUrl('settings', settings.logo);
    const fallbackLogo = `https://ui-avatars.com/api/?name=${encodeURIComponent(settings.site_name || 'Store')}&background=4b4035&color=fff`;

    setTextContent('siteName', settings.site_name);
    setTextContent('mobileSiteName', settings.site_name);
    setTextContent('siteTagline', settings.featured_subtitle || 'Luxury Perfume Store');
    setImageSrc('navbarLogo', logoUrl, fallbackLogo);
    setImageSrc('mobileNavbarLogo', logoUrl, fallbackLogo);
    setImageSrc('footerLogo', logoUrl, fallbackLogo);
    setTextContent('footerSiteName', settings.site_name);
    setTextContent('footerAbout', settings.about_us);
    setTextContent('footerCopyright', `© ${new Date().getFullYear()} ${settings.site_name || 'Store'} · Crafted with Elegance`);

    setHtmlContent('footerWhatsapp', settings.whatsapp
        ? `<i class="bi bi-whatsapp"></i> ${escapeHtml(settings.whatsapp)}`
        : '');

    setHtmlContent('footerEmail', settings.email
        ? `<i class="bi bi-envelope"></i> ${escapeHtml(settings.email)}`
        : '');

    if (settings.google_maps_embed)
    {
        setHtmlContent('footerMap', `
            <iframe
                src="${escapeHtml(settings.google_maps_embed)}"
                allowfullscreen
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        `);
    }

    const instagramEl = document.getElementById('footerInstagram');

    if (instagramEl && settings.instagram)
    {
        instagramEl.href = settings.instagram;
        instagramEl.innerHTML = '<i class="bi bi-instagram"></i> Instagram';
    }

    document.querySelectorAll('#siteLogo, .auth-logo h2').forEach((el) =>
    {
        if (el.tagName === 'H2')
        {
            el.textContent = settings.site_name || 'Store';
        }
    });

    document.querySelectorAll('#siteLogo').forEach((el) =>
    {
        el.src = logoUrl || fallbackLogo;
    });

    // Update cart badge
    updateCartBadge();
}

function setTextContent(id, value)
{
    const el = document.getElementById(id);

    if (el && value)
    {
        el.textContent = value;
    }
}

function setImageSrc(id, src, fallback)
{
    const el = document.getElementById(id);

    if (el)
    {
        el.src = src || fallback;
    }
}

function setHtmlContent(id, html)
{
    const el = document.getElementById(id);

    if (el)
    {
        el.innerHTML = html;
    }
}

function initNavbarButtons()
{
    const cartBtn = document.getElementById('cartBtn');

    if (cartBtn)
    {
        cartBtn.addEventListener('click', () =>
        {
            window.location.href = `${BASE_URL}cart`;
        });
    }

    initAuthButton();

    window.addEventListener('scroll', () =>
    {
        const navbar = document.querySelector('.navbar-custom');

        if (!navbar)
        {
            return;
        }

        navbar.classList.toggle('navbar-scrolled', window.scrollY > 40);
    });
}

function initAuthButton()
{
    const isLogin = localStorage.getItem('customer_token') === 'true';
    const authIcon = document.getElementById('authIcon');
    const authBtn = document.getElementById('authBtn');
    const authDropdown = document.getElementById('authDropdown');
    const authDropdownContent = document.getElementById('authDropdownContent');

    if (!authBtn || !authIcon)
    {
        return;
    }

    if (isLogin)
    {
        authIcon.className = 'bi bi-person-circle';

        // Render dropdown content
        if (authDropdownContent)
        {
            authDropdownContent.innerHTML = `
                <a href="${BASE_URL}orders" class="auth-dropdown-item">
                    <i class="bi bi-receipt"></i>
                    <span>Riwayat Pesanan</span>
                </a>
                <div class="auth-dropdown-divider"></div>
                <a href="#" class="auth-dropdown-item" onclick="handleLogout(event)">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </a>
            `;
        }

        // Toggle dropdown on click
        authBtn.addEventListener('click', (event) =>
        {
            event.stopPropagation();
            if (authDropdown)
            {
                authDropdown.classList.toggle('active');
            }
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', (event) =>
        {
            if (authDropdown && !authDropdown.contains(event.target) && !authBtn.contains(event.target))
            {
                authDropdown.classList.remove('active');
            }
        });
    }
    else
    {
        authIcon.className = 'bi bi-person';

        authBtn.addEventListener('click', () =>
        {
            window.location.href = `${BASE_URL}login`;
        });
    }
}

function handleLogout(event)
{
    event.preventDefault();
    Swal.fire({
        title: 'Keluar akun?',
        text: 'Anda akan logout dari akun customer.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya, logout',
        cancelButtonText: 'Batal'
    }).then((result) =>
    {
        if (!result.isConfirmed)
        {
            return;
        }

        localStorage.removeItem('customer_token');
        localStorage.removeItem('customer_user');
        localStorage.removeItem('customer_name');
        window.location.href = BASE_URL;
    });
}

function initSearchOverlay()
{
    const searchBtn = document.getElementById('searchBtn');
    const overlay = document.getElementById('searchOverlay');
    const closeBtn = document.getElementById('closeSearchOverlay');
    const quickForm = document.getElementById('quickSearchForm');
    const quickInput = document.getElementById('quickSearchInput');

    if (!searchBtn || !overlay)
    {
        return;
    }

    searchBtn.addEventListener('click', () =>
    {
        overlay.classList.add('active');
        document.body.classList.add('search-open');

        if (quickInput)
        {
            quickInput.focus();
        }
    });

    const closeOverlay = () =>
    {
        overlay.classList.remove('active');
        document.body.classList.remove('search-open');
    };

    if (closeBtn)
    {
        closeBtn.addEventListener('click', closeOverlay);
    }

    overlay.addEventListener('click', (event) =>
    {
        if (event.target === overlay)
        {
            closeOverlay();
        }
    });

    if (quickForm)
    {
        quickForm.addEventListener('submit', (event) =>
        {
            event.preventDefault();
            const keyword = quickInput.value.trim();
            window.location.href = `${BASE_URL}search${keyword ? '?q=' + encodeURIComponent(keyword) : ''}`;
        });
    }
}

function escapeHtml(str)
{
    return String(str || '')
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;');
}

function initMobileMenu()
{
    const hamburgerBtn = document.getElementById('hamburgerBtn');
    const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
    const closeMobileMenu = document.getElementById('closeMobileMenu');
    const mobileAuthBtn = document.getElementById('mobileAuthBtn');

    if (!hamburgerBtn || !mobileMenuOverlay)
    {
        return;
    }

    const openMenu = () =>
    {
        hamburgerBtn.classList.add('active');
        mobileMenuOverlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    };

    const closeMenu = () =>
    {
        hamburgerBtn.classList.remove('active');
        mobileMenuOverlay.classList.remove('active');
        document.body.style.overflow = '';
    };

    hamburgerBtn.addEventListener('click', openMenu);

    if (closeMobileMenu)
    {
        closeMobileMenu.addEventListener('click', closeMenu);
    }

    mobileMenuOverlay.addEventListener('click', (event) =>
    {
        if (event.target === mobileMenuOverlay)
        {
            closeMenu();
        }
    });

    // Close menu when clicking on a link
    const mobileLinks = mobileMenuOverlay.querySelectorAll('.mobile-menu-link');
    mobileLinks.forEach(link =>
    {
        link.addEventListener('click', closeMenu);
    });

    // Mobile auth section
    const mobileAuthSection = document.getElementById('mobileAuthSection');
    if (mobileAuthSection)
    {
        const isLogin = localStorage.getItem('customer_token') === 'true';

        if (isLogin)
        {
            mobileAuthSection.innerHTML = `
                <a href="${BASE_URL}orders" class="mobile-menu-btn">
                    <i class="bi bi-receipt"></i>
                    <span>Riwayat Pesanan</span>
                </a>
                <button id="mobileLogoutBtn" class="mobile-menu-btn mobile-logout-btn">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </button>
            `;

            const mobileLogoutBtn = document.getElementById('mobileLogoutBtn');
            if (mobileLogoutBtn)
            {
                mobileLogoutBtn.addEventListener('click', () =>
                {
                    Swal.fire({
                        title: 'Keluar akun?',
                        text: 'Anda akan logout dari akun customer.',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, logout',
                        cancelButtonText: 'Batal'
                    }).then((result) =>
                    {
                        if (!result.isConfirmed)
                        {
                            return;
                        }

                        localStorage.removeItem('customer_token');
                        localStorage.removeItem('customer_user');
                        localStorage.removeItem('customer_name');
                        window.location.href = BASE_URL;
                    });
                });
            }
        }
        else
        {
            mobileAuthSection.innerHTML = `
                <a href="${BASE_URL}login" class="mobile-menu-btn">
                    <i class="bi bi-person-circle"></i>
                    <span>Login</span>
                </a>
            `;
        }
    }

    // Update mobile logo
    const mobileNavbarLogo = document.getElementById('mobileNavbarLogo');
    const navbarLogo = document.getElementById('navbarLogo');
    if (mobileNavbarLogo && navbarLogo)
    {
        mobileNavbarLogo.src = navbarLogo.src;
    }
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
