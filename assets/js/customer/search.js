document.addEventListener('DOMContentLoaded', () =>
{
    const params = new URLSearchParams(window.location.search);
    const initialQuery = params.get('q') || '';

    const searchInput = document.getElementById('searchInput');
    const searchForm = document.getElementById('searchForm');

    if (initialQuery)
    {
        searchInput.value = initialQuery;
        runSearch(initialQuery);
    }

    searchForm.addEventListener('submit', (event) =>
    {
        event.preventDefault();
        const keyword = searchInput.value.trim();
        const url = new URL(window.location.href);

        if (keyword)
        {
            url.searchParams.set('q', keyword);
        }
        else
        {
            url.searchParams.delete('q');
        }

        window.history.replaceState({}, '', url.toString());
        runSearch(keyword);
    });
});

async function runSearch(keyword)
{
    const resultsEl = document.getElementById('searchResults');
    const metaEl = document.getElementById('searchMeta');

    if (!keyword)
    {
        metaEl.innerHTML = '';
        resultsEl.innerHTML = `
            <div class="search-empty-state">
                <i class="bi bi-search"></i>
                <p>Mulai ketik kata kunci untuk mencari parfum favoritmu.</p>
            </div>`;
        return;
    }

    showLoading(resultsEl);
    metaEl.innerHTML = `Mencari "<strong>${escapeHtml(keyword)}</strong>"...`;

    try
    {
        const data = await apiGet(`products/search?q=${encodeURIComponent(keyword)}`);
        const items = data.items || [];

        metaEl.innerHTML = items.length
            ? `Menampilkan <strong>${items.length}</strong> hasil untuk "<strong>${escapeHtml(keyword)}</strong>"`
            : `Tidak ada hasil untuk "<strong>${escapeHtml(keyword)}</strong>"`;

        if (!items.length)
        {
            showEmpty(resultsEl, 'Produk tidak ditemukan. Coba kata kunci lain.');
            return;
        }

        resultsEl.innerHTML = items.map(renderProductCard).join('');
    }
    catch (error)
    {
        metaEl.innerHTML = '';
        showError(resultsEl, 'Gagal memuat hasil pencarian');
    }
}

function renderProductCard(product)
{
    const image = uploadUrl('products', product.thumbnail || product.primary_image);
    const fallbackImage = `https://ui-avatars.com/api/?name=${encodeURIComponent(product.name || 'Product')}&background=eae0d5&color=4b4035`;

    return `
    <article class="search-product-card" data-aos="fade-up">
        <div class="search-product-image">
            <img src="${image || fallbackImage}" alt="${escapeHtml(product.name)}">
        </div>
        <div class="search-product-body">
            <span class="search-product-brand">${escapeHtml(product.brand_name || '-')}</span>
            <h3>${escapeHtml(product.name || '-')}</h3>
            <p>${escapeHtml(truncate(product.short_description, 90))}</p>
            <div class="search-product-footer">
                <strong>${formatRupiah(product.price || 0)}</strong>
                <a href="${BASE_URL}katalog">Detail</a>
            </div>
        </div>
    </article>`;
}

function escapeHtml(str)
{
    return String(str || '')
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;');
}
