<footer class="footer-custom">

    <div class="container-custom">

        <div class="footer-grid">

            <div class="footer-brand">

                <img
                    id="footerLogo"
                    class="footer-logo"
                    src="">

                <h2 id="footerSiteName">
                    AURA
                </h2>

                <p
                    id="footerAbout"
                    class="footer-about">
                </p>

            </div>


            <div class="footer-column">

                <h5>
                    Explore
                </h5>

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


            <div class="footer-column">

                <h5>
                    Contact
                </h5>

                <p id="footerWhatsapp"></p>

                <p id="footerEmail"></p>

                <a
                    id="footerInstagram"
                    target="_blank">
                    Instagram
                </a>

            </div>


            <div class="footer-column">

                <h5>
                    Address
                </h5>

                <p
                    id="footerAddress"
                    class="footer-address">
                </p>

                <div
                    id="footerMap"
                    class="footer-map">
                </div>

            </div>

        </div>

        <div class="footer-bottom" id="footerCopyright">
            © <?= date('Y') ?> <?= htmlspecialchars($site_name ?? 'Store', ENT_QUOTES, 'UTF-8') ?> · Crafted with Elegance
        </div>

    </div>

</footer>