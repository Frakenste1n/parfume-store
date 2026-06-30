<section class="brands-section">
    <div class="container-custom">
        <div class="brands-header" data-aos="fade-up">
            <span class="brands-subtitle">Luxury House</span>
            <h1 class="brands-title">Brand Kami</h1>
            <p class="brands-description">Koleksi parfum dari brand-brand ternama dunia</p>
        </div>

        <div class="brands-grid" id="brandsGrid">
            <div class="brands-loading">
                <div class="loading-spinner"></div>
                <p>Memuat brand...</p>
            </div>
        </div>

        <div class="brands-empty" id="brandsEmpty" style="display: none;">
            <div class="empty-state-card">
                <i class="bi bi-building"></i>
                <h3>Belum ada brand tersedia</h3>
                <p>Data brand sedang dalam persiapan. Silakan kembali lagi nanti.</p>
                <a href="<?= base_url() ?>" class="back-home-btn">Kembali ke Beranda</a>
            </div>
        </div>
    </div>
</section>
