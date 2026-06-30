document.addEventListener('DOMContentLoaded', async () =>
{
    await loadAbout();
});

async function loadAbout()
{
    const content = document.getElementById('aboutContent');

    try
    {
        const [settings, founders] = await Promise.all([
            apiGet('settings'),
            apiGet('founders?active_only=true')
        ]);

        if (!settings)
        {
            renderEmptyState(content);
            return;
        }

        renderAboutContent(settings, founders || []);
    }
    catch (error)
    {
        console.error('[ABOUT ERROR]', error);
        showError(content, 'Gagal memuat informasi. Silakan refresh halaman.');
    }
}

function renderAboutContent(settings, founders)
{
    const content = document.getElementById('aboutContent');

    const logoUrl = settings.logo
        ? uploadUrl('settings', settings.logo)
        : `https://ui-avatars.com/api/?name=${encodeURIComponent(settings.site_name || 'Store')}&background=4b4035&color=fff&size=200`;

    content.innerHTML = `
        <div class="about-grid">
            <div class="about-main" data-aos="fade-up">
                <div class="about-main-header">
                    <div class="about-logo">
                        <img src="${logoUrl}" alt="${escapeHtml(settings.site_name || 'Logo')}">
                    </div>
                    <h2 class="about-site-name">${escapeHtml(settings.site_name || 'Toko')}</h2>
                </div>
                <div class="about-text">
                    ${settings.about_us ? formatAboutText(settings.about_us) : '<p>Informasi tentang kami belum tersedia.</p>'}
                </div>
            </div>
            <div class="about-sidebar" data-aos="fade-up" data-aos-delay="100">
                <div class="about-card">
                    <h3 class="about-card-title">Kontak Kami</h3>
                    ${settings.whatsapp ? `
                        <div class="contact-item">
                            <i class="bi bi-whatsapp"></i>
                            <div class="contact-item-content">
                                <div class="contact-item-label">WhatsApp</div>
                                <div class="contact-item-value">
                                    <a href="https://wa.me/${escapeHtml(settings.whatsapp.replace(/[^0-9]/g, ''))}" target="_blank" rel="noopener">
                                        ${escapeHtml(settings.whatsapp)}
                                    </a>
                                </div>
                            </div>
                        </div>
                    ` : ''}
                    ${settings.email ? `
                        <div class="contact-item">
                            <i class="bi bi-envelope"></i>
                            <div class="contact-item-content">
                                <div class="contact-item-label">Email</div>
                                <div class="contact-item-value">
                                    <a href="mailto:${escapeHtml(settings.email)}">${escapeHtml(settings.email)}</a>
                                </div>
                            </div>
                        </div>
                    ` : ''}
                    ${settings.instagram ? `
                        <div class="contact-item">
                            <i class="bi bi-instagram"></i>
                            <div class="contact-item-content">
                                <div class="contact-item-label">Instagram</div>
                                <div class="contact-item-value">
                                    <a href="${escapeHtml(settings.instagram)}" target="_blank" rel="noopener">
                                        ${escapeHtml(settings.instagram)}
                                    </a>
                                </div>
                            </div>
                        </div>
                    ` : ''}
                    ${settings.google_maps_embed ? `
                        <div class="map-container">
                            <iframe
                                src="${escapeHtml(settings.google_maps_embed)}"
                                allowfullscreen
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    ` : ''}
                </div>
            </div>
        </div>
        ${founders && founders.length > 0 ? `
            <div class="founders-section" data-aos="fade-up" data-aos-delay="200">
                <div class="founders-header">
                    <h3>Founders</h3>
                    <p>Orang-orang di balik ${escapeHtml(settings.site_name || 'toko kami')}</p>
                </div>
                <div class="founders-grid">
                    ${founders.map((founder, index) => `
                        <div class="founder-card" data-aos="fade-up" data-aos-delay="${index * 100}">
                            <div class="founder-photo">
                                ${founder.photo
                                    ? `<img src="${uploadUrl('founders', founder.photo)}" alt="${escapeHtml(founder.name)}">`
                                    : `<span class="founder-photo-placeholder">${escapeHtml(founder.name.charAt(0))}</span>`
                                }
                            </div>
                            <h4 class="founder-name">${escapeHtml(founder.name)}</h4>
                            <div class="founder-role">${escapeHtml(founder.position)}</div>
                            <div class="founder-social">
                                ${founder.whatsapp ? `
                                    <a href="https://wa.me/${escapeHtml(founder.whatsapp.replace(/[^0-9]/g, ''))}" target="_blank" rel="noopener" class="founder-social-link">
                                        <i class="bi bi-whatsapp"></i>
                                    </a>
                                ` : ''}
                                ${founder.instagram ? `
                                    <a href="${escapeHtml(founder.instagram.startsWith('http') ? founder.instagram : 'https://instagram.com/' + founder.instagram.replace('@', ''))}" target="_blank" rel="noopener" class="founder-social-link">
                                        <i class="bi bi-instagram"></i>
                                    </a>
                                ` : ''}
                            </div>
                        </div>
                    `).join('')}
                </div>
            </div>
        ` : ''}
    `;
}

function formatAboutText(text)
{
    if (!text)
    {
        return '';
    }

    const paragraphs = text.split('\n').filter(p => p.trim());

    if (paragraphs.length === 0)
    {
        return `<p>${escapeHtml(text)}</p>`;
    }

    return paragraphs.map(p => `<p>${escapeHtml(p)}</p>`).join('');
}

function renderEmptyState(content)
{
    content.innerHTML = `
        <div class="about-empty">
            <div class="empty-state-card">
                <i class="bi bi-info-circle"></i>
                <h3>Informasi Belum Tersedia</h3>
                <p>Informasi tentang kami sedang dalam persiapan. Silakan kembali lagi nanti.</p>
                <a href="${BASE_URL}" class="back-home-btn">Kembali ke Beranda</a>
            </div>
        </div>
    `;
}
