<!DOCTYPE html>
<html lang="id">
<head>
    <title>Keranjang | AURA.</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css?v=' . time()); ?>">
</head>
<body>
    <nav class="navbar"><div class="logo-text">AURA.</div><ul class="nav-links"><li><a href="<?php echo base_url(); ?>">Beranda</a></li><li><a href="<?php echo base_url('index.php/welcome/katalog'); ?>">Katalog</a></li><li><a href="<?php echo base_url('index.php/welcome/brands'); ?>">Brands</a></li><li><a href="<?php echo base_url('index.php/welcome/tentang'); ?>">Tentang Kami</a></li></ul><div class="nav-icons"><a href="<?php echo base_url('index.php/welcome/search'); ?>"><i class="fas fa-search"></i></a><a href="<?php echo base_url('index.php/welcome/login'); ?>"><i class="far fa-user"></i></a><a href="<?php echo base_url('index.php/welcome/cart'); ?>"><i class="fas fa-shopping-cart"></i></a></div></nav>

    <section class="cart-section">
        <div class="cart-left">
            <div class="checkout-box">
                <div class="box-title"><i class="fas fa-map-marker-alt"></i> Alamat Pengiriman</div>
                <p><strong>Jeremia Hutabarat</strong> (+62) 812-3456-7890</p>
                <p style="color: #666; margin-top: 5px;">Jl. Margonda Raya No. 100, Beji, Kota Depok, Jawa Barat 16424</p>
            </div>

            <div class="checkout-box">
                <div class="box-title"><i class="fas fa-box"></i> Produk Dipesan</div>
                <div class="cart-item">
                    <div class="item-img"></div>
                    <div class="item-info">
                        <h4>Saff & Co. - CHNO</h4>
                        <p style="color: #666; font-size: 14px;">Variant: 50ml</p>
                    </div>
                    <div class="item-price">Rp 199.000</div>
                </div>
                <div class="cart-item">
                    <div class="item-img"></div>
                    <div class="item-info">
                        <h4>Scarlett - Dreamy</h4>
                        <p style="color: #666; font-size: 14px;">Variant: 30ml</p>
                    </div>
                    <div class="item-price">Rp 75.000</div>
                </div>
            </div>
        </div>

        <div class="cart-right">
            <div class="box-title">Ringkasan Belanja</div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 15px;"><span>Total Harga (2 barang)</span><span>Rp 274.000</span></div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 15px;"><span>Ongkos Kirim</span><span>Rp 15.000</span></div>
            <hr style="border: 0; border-top: 1px solid #eee; margin: 15px 0;">
            <div style="display: flex; justify-content: space-between; font-weight: bold; font-size: 18px; color: var(--wf-dark);"><span>Total Tagihan</span><span>Rp 289.000</span></div>
            
            <div class="box-title" style="margin-top: 30px;">Metode Pembayaran</div>
            <select class="login-input" style="margin-bottom: 0;">
                <option>BCA Virtual Account</option>
                <option>GoPay</option>
                <option>ShopeePay</option>
                <option>Mandiri Virtual Account</option>
            </select>

            <button class="btn-checkout">BUAT PESANAN</button>
        </div>
    </section>
</body>
</html>