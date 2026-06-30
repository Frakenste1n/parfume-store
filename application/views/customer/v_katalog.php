<section class="catalog-section">
    <div class="container-custom">
        <div class="catalog-header" data-aos="fade-up">
            <span class="catalog-subtitle">Signature Collection</span>
            <h1 class="catalog-title">Katalog Produk</h1>
            <p class="catalog-description">Temukan parfum eksklusif dari berbagai brand ternama dunia</p>
        </div>

        <div class="catalog-filters" data-aos="fade-up" data-aos-delay="100">
            <div class="filter-tabs">
                <button class="filter-tab active" data-filter="all">Semua</button>
                <button class="filter-tab" data-filter="featured">Featured</button>
                <button class="filter-tab" data-filter="new">Terbaru</button>
            </div>
            <div class="filter-search">
                <div class="search-input-wrapper">
                    <i class="bi bi-search"></i>
                    <input type="text" id="catalogSearch" placeholder="Cari parfum...">
                </div>
            </div>
        </div>

        <div class="catalog-grid" id="catalogGrid">
            <div class="catalog-loading">
                <div class="loading-spinner"></div>
                <p>Memuat produk...</p>
            </div>
        </div>

        <div class="catalog-empty" id="catalogEmpty" style="display: none;">
            <div class="empty-state-card">
                <i class="bi bi-box-seam"></i>
                <h3>Produk tidak ditemukan</h3>
                <p>Coba kata kunci lain atau filter yang berbeda</p>
                <button class="reset-filters-btn" onclick="resetCatalogFilters()">Reset Filter</button>
            </div>
        </div>
    </div>
</section>
