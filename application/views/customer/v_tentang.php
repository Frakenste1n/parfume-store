<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami | AURA.</title>
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

    <section class="about-section">
        <div class="about-header">
            <h1>DI BALIK AURA.</h1>
            <p>The Art of Scent — Dipersembahkan oleh Kelompok 4</p>
        </div>
        
        <div class="about-content">
            <p>AURA. lahir dari sebuah visi untuk menghadirkan pengalaman berbelanja wewangian yang eksklusif, minimalis, dan elegan. Kami percaya bahwa parfum bukan sekadar aroma yang menempel di tubuh, melainkan sebuah identitas, karakter, dan cerita tanpa kata.</p>
            <br>
            <p>Berawal dari proyek kolaborasi pengembangan web, platform ini dirancang dengan ketelitian, estetika, dan dedikasi tinggi. Tujuan kami adalah menciptakan standar baru dalam menghadirkan koleksi parfum premium secara digital, menjembatani <i>brand</i> lokal berkualitas dengan para pencinta aroma.</p>
        </div>

        <div class="team-section">
            <h2>THE FOUNDERS</h2>
            <div class="team-grid">
                <div class="team-member">Jeremia</div>
                <div class="team-member">Daffa</div>
                <div class="team-member">Zidane</div>
                <div class="team-member">Reno</div>
                <div class="team-member">Anas</div>
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
        <div class="footer-bottom"><div class="footer-copyright"></div></div>
    </footer>

</body>
</html>