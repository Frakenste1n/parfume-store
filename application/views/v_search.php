<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian | AURA.</title>
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

    <section style="padding: 150px 5%; text-align: center; min-height: 60vh;">
        <h1 style="font-size: 35px; color: var(--wf-dark); letter-spacing: 3px; margin-bottom: 40px;">TEMUKAN AROMAMU</h1>
        
        <div style="max-width: 600px; margin: 0 auto; display: flex; gap: 10px;">
            <input type="text" class="login-input" placeholder="Ketik nama parfum, brand, atau notes (cth: Vanilla)..." style="margin-bottom: 0;">
            <button class="btn-checkout" style="width: auto; margin-top: 0; padding: 0 25px;"><i class="fas fa-search"></i></button>
        </div>
    </section>

</body>
</html>