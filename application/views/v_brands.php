<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brands | AURA.</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css?v=' . time()); ?>">
</head>
<body>

    <nav class="navbar">
        <div class="logo-text">AURA.</div>
        <ul class="nav-links">
            <li><a href="<?php echo base_url(); ?>">Beranda</a></li>
            <li><a href="<?php echo base_url('index.php/welcome/katalog'); ?>">Katalog</a></li>
            <li><a href="<?php echo base_url('index.php/welcome/brands'); ?>">Brands</a></li>
            <li><a href="<?php echo base_url('index.php/welcome/tentang'); ?>">Tentang Kami</a></li>
        </ul>
        <div class="nav-icons">
            <a href="<?php echo base_url('index.php/welcome/search'); ?>"><i class="fas fa-search"></i></a>
            <a href="<?php echo base_url('index.php/welcome/login'); ?>"><i class="far fa-user"></i></a>
            <a href="<?php echo base_url('index.php/welcome/cart'); ?>"><i class="fas fa-shopping-cart"></i></a>
        </div>
    </nav>

    <section style="padding: 100px 5%; text-align: center; min-height: 50vh;">
        <h1 style="font-size: 50px; color: var(--wf-dark); letter-spacing: 2px;">MITRA BRAND KAMI</h1>
        <p style="margin-top: 15px; color: #666; margin-bottom: 50px;">Jelajahi keharuman eksklusif dari Saff & Co, Octarine, dan Scarlett.</p>

       <div class="brand-text-container">
            <div class="brand-text-item brand-saff-text">
                <h3>SAFF & CO.</h3>
            </div>
            <div class="brand-text-item brand-octa-text">
                <h3>OCTARINE</h3>
            </div>
            <div class="brand-text-item brand-scarlett-text">
                <h3>Scarlett</h3>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-col"><div class="footer-title">AURA.</div><div class="footer-link"></div><div class="footer-link"></div></div>
            <div class="footer-col"><div class="footer-title"></div><div class="footer-link"></div><div class="footer-link"></div></div>
            <div class="footer-col"><div class="footer-title"></div><div class="footer-link"></div><div class="footer-link"></div></div>
            <div class="footer-col"><div class="footer-title"></div><div class="footer-link"></div><div class="footer-link"></div></div>
        </div>
        <div class="footer-bottom">
            <div class="footer-copyright"></div>
        </div>
    </footer>

</body>
</html>