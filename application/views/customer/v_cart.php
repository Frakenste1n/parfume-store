<section class="cart-section">
    <div class="container-custom">
        <div class="cart-header" data-aos="fade-up">
            <span class="cart-subtitle">Shopping Bag</span>
            <h1 class="cart-title">Keranjang Belanja</h1>
            <p class="cart-description">Review dan kelola item di keranjang Anda</p>
        </div>

        <div class="cart-content" id="cartContent">
            <div class="cart-loading">
                <div class="loading-spinner"></div>
                <p>Memuat keranjang...</p>
            </div>
        </div>

        <div class="cart-empty" id="cartEmpty" style="display: none;">
            <div class="empty-state-card">
                <i class="bi bi-cart-x"></i>
                <h3>Keranjang kosong</h3>
                <p>Anda belum menambahkan produk ke keranjang</p>
                <a href="<?= base_url('katalog') ?>" class="browse-products-btn">Jelajahi Produk</a>
            </div>
        </div>
    </div>
</section>
