<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Member | AURA.</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">
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

    <section class="login-section">
        <div class="login-box">
            <h2>MEMBER LOGIN</h2>
            <input type="text" class="login-input" placeholder="Email / Username">
            <input type="password" class="login-input" placeholder="Password">
            <button class="btn-checkout">MASUK</button>
            <p style="margin-top: 25px; font-size: 14px; color: #666;">
                Belum punya akun? <a href="#" style="color: var(--wf-dark); font-weight: bold; text-decoration: none;">Daftar di sini</a>
            </p>
        </div>
    </section>

</body>
</html>