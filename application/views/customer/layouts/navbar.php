<nav class="navbar-custom">

    <div class="nav-left">
        <a href="<?= base_url() ?>" class="logo-wrapper">
            <img id="navbarLogo" class="logo-image" src="" alt="Logo">
            <div>
                <h3 id="siteName"><?= htmlspecialchars($site_name ?? 'Parfume Store', ENT_QUOTES, 'UTF-8') ?></h3>
                <span id="siteTagline">Luxury Perfume Store</span>
            </div>
        </a>
    </div>

    <div class="nav-center" id="navCenter">
        <a href="<?= base_url() ?>">Beranda</a>
        <a href="<?= base_url('katalog') ?>">Katalog</a>
        <a href="<?= base_url('brands') ?>">Brand</a>
        <a href="<?= base_url('tentang') ?>">Tentang</a>
    </div>

    <div class="nav-right">
        <button id="searchBtn" class="nav-icon-btn" type="button" aria-label="Search">
            <i class="bi bi-search"></i>
        </button>

        <div class="auth-dropdown-wrapper">
            <button id="authBtn" class="nav-icon-btn" type="button" aria-label="Account">
                <i id="authIcon" class="bi bi-person-circle"></i>
            </button>
            <div id="authDropdown" class="auth-dropdown">
                <div id="authDropdownContent"></div>
            </div>
        </div>

        <button id="cartBtn" class="nav-icon-btn cart-btn" type="button" aria-label="Cart">
            <i class="bi bi-bag"></i>
            <span id="cartBadge">0</span>
        </button>

        <button id="hamburgerBtn" class="nav-icon-btn hamburger-btn" type="button" aria-label="Menu">
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
        </button>
    </div>

</nav>

<div class="mobile-menu-overlay" id="mobileMenuOverlay">
    <div class="mobile-menu">
        <div class="mobile-menu-header">
            <a href="<?= base_url() ?>" class="logo-wrapper">
                <img id="mobileNavbarLogo" class="logo-image" src="" alt="Logo">
                <div>
                    <h3 id="mobileSiteName"><?= htmlspecialchars($site_name ?? 'Parfume Store', ENT_QUOTES, 'UTF-8') ?></h3>
                </div>
            </a>
            <button id="closeMobileMenu" class="mobile-menu-close" type="button" aria-label="Close">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <div class="mobile-menu-links">
            <a href="<?= base_url() ?>" class="mobile-menu-link">
                <i class="bi bi-house"></i>
                <span>Beranda</span>
            </a>
            <a href="<?= base_url('katalog') ?>" class="mobile-menu-link">
                <i class="bi bi-grid"></i>
                <span>Katalog</span>
            </a>
            <a href="<?= base_url('brands') ?>" class="mobile-menu-link">
                <i class="bi bi-tag"></i>
                <span>Brand</span>
            </a>
            <a href="<?= base_url('tentang') ?>" class="mobile-menu-link">
                <i class="bi bi-info-circle"></i>
                <span>Tentang</span>
            </a>
        </div>
        <div class="mobile-menu-footer">
            <div id="mobileAuthSection">
                <button id="mobileAuthBtn" class="mobile-menu-btn">
                    <i class="bi bi-person-circle"></i>
                    <span>Akun</span>
                </button>
            </div>
            <a href="<?= base_url('cart') ?>" class="mobile-menu-btn">
                <i class="bi bi-bag"></i>
                <span>Keranjang</span>
                <span id="mobileCartBadge" class="mobile-cart-badge">0</span>
            </a>
        </div>
    </div>
</div>

<div id="searchOverlay" class="search-overlay">
    <div class="search-overlay-panel">
        <div class="search-overlay-header">
            <h4>Cari Parfum</h4>
            <button type="button" id="closeSearchOverlay" aria-label="Close">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <form id="quickSearchForm">
            <div class="search-overlay-input">
                <i class="bi bi-search"></i>
                <input
                    type="text"
                    id="quickSearchInput"
                    placeholder="Nama parfum, brand, kategori..."
                    autocomplete="off">
                <button type="submit">Cari</button>
            </div>
        </form>
        <p class="search-overlay-hint">Tekan Enter untuk melihat semua hasil pencarian.</p>
    </div>
</div>
