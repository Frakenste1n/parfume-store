<nav class="navbar-custom">

    <div class="nav-left">

        <a
            href="<?= base_url() ?>"
            class="logo-wrapper">

            <img
                id="navbarLogo"
                class="logo-image"
                src="">

            <div>

                <h3 id="siteName">
                    AURA
                </h3>

                <span>
                    Luxury Perfume Store
                </span>

            </div>

        </a>

    </div>


    <div class="nav-center">

        <a href="<?= base_url() ?>">
            Beranda
        </a>

        <a href="<?= base_url('katalog') ?>">
            Katalog
        </a>

        <a href="<?= base_url('brands') ?>">
            Brand
        </a>

        <a href="<?= base_url('tentang') ?>">
            Tentang
        </a>

    </div>


    <div class="nav-right">

        <button
            id="searchBtn"
            class="nav-icon-btn">

            <i class="bi bi-search"></i>

        </button>


        <button
    id="authBtn"
    class="nav-icon-btn">

    <i
        id="authIcon"
        class="bi bi-person-circle"></i>

</button>

        <button
            id="cartBtn"
            class="nav-icon-btn cart-btn">

            <i class="bi bi-bag"></i>

            <span id="cartBadge">
                0
            </span>

        </button>

    </div>

</nav>