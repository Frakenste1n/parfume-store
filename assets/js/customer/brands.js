document.addEventListener('DOMContentLoaded', async () =>
{
    await loadBrands();
});

async function loadBrands()
{
    const grid = document.getElementById('brandsGrid');
    const empty = document.getElementById('brandsEmpty');

    try
    {
        const brands = await apiGet('brands');

        if (!brands || brands.length === 0)
        {
            grid.style.display = 'none';
            empty.style.display = 'block';
            return;
        }

        renderBrands(brands);
    }
    catch (error)
    {
        console.error('[BRANDS ERROR]', error);
        showError(grid, 'Gagal memuat brand. Silakan refresh halaman.');
    }
}

function renderBrands(brands)
{
    const grid = document.getElementById('brandsGrid');
    const empty = document.getElementById('brandsEmpty');

    if (!brands || brands.length === 0)
    {
        grid.innerHTML = '';
        grid.style.display = 'none';
        empty.style.display = 'block';
        return;
    }

    grid.style.display = 'grid';
    empty.style.display = 'none';

    grid.innerHTML = brands.map((brand, index) =>
    {
        const logoUrl = brand.logo
            ? uploadUrl('brands', brand.logo)
            : null;

        const isFeatured = brand.is_featured === 1;

        return `
            <div class="brand-card" data-aos="fade-up" data-aos-delay="${index * 50}">
                ${isFeatured ? '<span class="brand-featured-badge">Featured</span>' : ''}
                <div class="brand-card-logo">
                    ${logoUrl
                        ? `<img src="${logoUrl}" alt="${escapeHtml(brand.name)}" loading="lazy">`
                        : `<span class="brand-card-logo-placeholder">${escapeHtml(brand.name.charAt(0))}</span>`
                    }
                </div>
                <h3 class="brand-card-name">${escapeHtml(brand.name)}</h3>
                ${brand.origin_country ? `
                    <div class="brand-card-origin">
                        <i class="bi bi-geo-alt"></i>
                        ${escapeHtml(brand.origin_country)}
                    </div>
                ` : ''}
                ${brand.description ? `
                    <p class="brand-card-description">${escapeHtml(brand.description)}</p>
                ` : ''}
                <div class="brand-card-links">
                    ${brand.website ? `
                        <a href="${escapeHtml(brand.website)}" target="_blank" rel="noopener" class="brand-card-link" title="Website">
                            <i class="bi bi-globe"></i>
                        </a>
                    ` : ''}
                    ${brand.instagram ? `
                        <a href="${escapeHtml(brand.instagram)}" target="_blank" rel="noopener" class="brand-card-link" title="Instagram">
                            <i class="bi bi-instagram"></i>
                        </a>
                    ` : ''}
                </div>
            </div>
        `;
    }).join('');
}
