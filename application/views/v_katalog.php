<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog | AURA.</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css?v=' . time()); ?>">
    <style>
        .brand-title {
            text-align: left;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--wf-light);
            color: var(--wf-dark);
            letter-spacing: 3px;
            font-size: 24px;
            text-transform: uppercase;
        }

        .catalog-container {
            padding: 50px 5%;
            overflow: hidden;
        }

        .brand-section {
            margin-bottom: 80px;
        }
    </style>
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

    <div class="catalog-container">
        <header style="text-align: center; margin-bottom: 60px;">
            <h1 style="font-size: 45px; color: var(--wf-dark); letter-spacing: 2px;">OUR COLLECTIONS</h1>
            <p style="color: #666;">Menyediakan 30 pilihan keharuman terbaik untuk karaktermu.</p>
        </header>

        <div class="brand-section">
            <h2 class="brand-title">Saff & Co. Collections</h2>
            <div class="product-scroll">

                <div class="product-card">
                    <div style="width: 100%; aspect-ratio: 1 / 1; overflow: hidden; border-radius: 4px; margin-bottom: 15px; background-color: var(--wf-light);">
                        <img src="<?php echo base_url('assets/img/saffco1.jpeg'); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div style="padding: 12px; text-align: left; display: flex; flex-direction: column; justify-content: space-between; height: 140px;">
                        <div>
                            <h3 style="color: var(--wf-dark); font-size: 14px; margin-bottom: 5px;">SAFF & CO. COCO</h3>
                            <p style="color: #666; font-size: 11px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">Wangi segar citrus bercampur kelapa dan woody. Kesan profesional, bersih, dan modern.</p>
                        </div>
                        <button class="btn-checkout" style="padding: 6px 10px; font-size: 11px; margin-top: 8px;">+ KERANJANG</button>
                    </div>
                </div>

                <div class="product-card">
                    <div style="width: 100%; aspect-ratio: 1 / 1; overflow: hidden; border-radius: 4px; margin-bottom: 15px; background-color: var(--wf-light);">
                        <img src="<?php echo base_url('assets/img/las_pozas..jpeg'); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div style="padding: 12px; text-align: left; display: flex; flex-direction: column; justify-content: space-between; height: 140px;">
                        <div>
                            <h3 style="color: var(--wf-dark); font-size: 14px; margin-bottom: 5px;">SAFF & CO. LAS POZAS</h3>
                            <p style="color: #666; font-size: 11px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">Wangi elegan nan mewah. Cocok untuk acara malam yang eksklusif.</p>
                        </div>
                        <button class="btn-checkout" style="padding: 6px 10px; font-size: 11px; margin-top: 8px;">+ KERANJANG</button>
                    </div>
                </div>

                <div class="product-card">
                    <div style="width: 100%; aspect-ratio: 1 / 1; overflow: hidden; border-radius: 4px; margin-bottom: 15px; background-color: var(--wf-light);">
                        <img src="<?php echo base_url('assets/img/s.o.t.b.jpeg'); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div style="padding: 12px; text-align: left; display: flex; flex-direction: column; justify-content: space-between; height: 140px;">
                        <div>
                            <h3 style="color: var(--wf-dark); font-size: 14px; margin-bottom: 5px;">SAFF & CO. S.O.T.B</h3>
                            <p style="color: #666; font-size: 11px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">S.O.T.B (Somewhere Over The Bridge)

                                Perpaduan mandarin, vanilla, dan musk. Aromanya creamy, manis, tapi tetap fresh.</p>
                        </div>
                        <button class="btn-checkout" style="padding: 6px 10px; font-size: 11px; margin-top: 8px;">+ KERANJANG</button>
                    </div>
                </div>

                <div class="product-card">
                    <div style="width: 100%; aspect-ratio: 1 / 1; overflow: hidden; border-radius: 4px; margin-bottom: 15px; background-color: var(--wf-light);">
                        <img src="<?php echo base_url('assets/img/TROUPE.jpeg'); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div style="padding: 12px; text-align: left; display: flex; flex-direction: column; justify-content: space-between; height: 140px;">
                        <div>
                            <h3 style="color: var(--wf-dark); font-size: 14px; margin-bottom: 5px;">SAFF & CO. TROUPE</h3>
                            <p style="color: #666; font-size: 11px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">Wangi elegan nan mewah. Cocok untuk acara malam yang eksklusif.</p>
                        </div>
                        <button class="btn-checkout" style="padding: 6px 10px; font-size: 11px; margin-top: 8px;">+ KERANJANG</button>
                    </div>
                </div>

                <div class="product-card">
                    <div style="width: 100%; aspect-ratio: 1 / 1; overflow: hidden; border-radius: 4px; margin-bottom: 15px; background-color: var(--wf-light);">
                        <img src="<?php echo base_url('assets/img/LOUI.jpeg'); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div style="padding: 12px; text-align: left; display: flex; flex-direction: column; justify-content: space-between; height: 140px;">
                        <div>
                            <h3 style="color: var(--wf-dark); font-size: 14px; margin-bottom: 5px;">SAFF & CO. LOUI</h3>
                            <p style="color: #666; font-size: 11px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">Aroma fruity-woody yang manis dan classy. Memberi kesan santai tapi tetap elegan.</p>
                        </div>
                        <button class="btn-checkout" style="padding: 6px 10px; font-size: 11px; margin-top: 8px;">+ KERANJANG</button>
                    </div>
                </div>

                <div class="product-card">
                    <div style="width: 100%; aspect-ratio: 1 / 1; overflow: hidden; border-radius: 4px; margin-bottom: 15px; background-color: var(--wf-light);">
                        <img src="<?php echo base_url('assets/img/COLETTE.jpeg'); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div style="padding: 12px; text-align: left; display: flex; flex-direction: column; justify-content: space-between; height: 140px;">
                        <div>
                            <h3 style="color: var(--wf-dark); font-size: 14px; margin-bottom: 5px;">SAFF & CO. COLETTE</h3>
                            <p style="color: #666; font-size: 11px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">Aroma floral feminin dengan sentuhan manis lembut. Memberikan kesan anggun dan kalem.</p>
                        </div>
                        <button class="btn-checkout" style="padding: 6px 10px; font-size: 11px; margin-top: 8px;">+ KERANJANG</button>
                    </div>
                </div>

                <div class="product-card">
                    <div style="width: 100%; aspect-ratio: 1 / 1; overflow: hidden; border-radius: 4px; margin-bottom: 15px; background-color: var(--wf-light);">
                        <img src="<?php echo base_url('assets/img/OMNIA.jpeg'); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div style="padding: 12px; text-align: left; display: flex; flex-direction: column; justify-content: space-between; height: 140px;">
                        <div>
                            <h3 style="color: var(--wf-dark); font-size: 14px; margin-bottom: 5px;">SAFF & CO. OMNIA</h3>
                            <p style="color: #666; font-size: 11px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">Aroma amber hangat dengan nuansa manis dan sensual. Cocok untuk acara formal.</p>
                        </div>
                        <button class="btn-checkout" style="padding: 6px 10px; font-size: 11px; margin-top: 8px;">+ KERANJANG</button>
                    </div>
                </div>

                <div class="product-card">
                    <div style="width: 100%; aspect-ratio: 1 / 1; overflow: hidden; border-radius: 4px; margin-bottom: 15px; background-color: var(--wf-light);">
                        <img src="<?php echo base_url('assets/img/SONNET.jpeg'); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div style="padding: 12px; text-align: left; display: flex; flex-direction: column; justify-content: space-between; height: 140px;">
                        <div>
                            <h3 style="color: var(--wf-dark); font-size: 14px; margin-bottom: 5px;">SAFF & CO. SONNET</h3>
                            <p style="color: #666; font-size: 11px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">Wangi dark, woody, dan sedikit smoky. Cocok untuk yang ingin tampil maskulin atau misterius.</p>
                        </div>
                        <button class="btn-checkout" style="padding: 6px 10px; font-size: 11px; margin-top: 8px;">+ KERANJANG</button>
                    </div>
                </div>

                <div class="product-card">
                    <div style="width: 100%; aspect-ratio: 1 / 1; overflow: hidden; border-radius: 4px; margin-bottom: 15px; background-color: var(--wf-light);">
                        <img src="<?php echo base_url('assets/img/CASCAVEL.jpeg'); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div style="padding: 12px; text-align: left; display: flex; flex-direction: column; justify-content: space-between; height: 140px;">
                        <div>
                            <h3 style="color: var(--wf-dark); font-size: 14px; margin-bottom: 5px;">SAFF & CO. CASCAVEL</h3>
                            <p style="color: #666; font-size: 11px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">Dominasi bunga dengan sentuhan manis ringan. Fresh dan cocok untuk siang hari.</p>
                        </div>
                        <button class="btn-checkout" style="padding: 6px 10px; font-size: 11px; margin-top: 8px;">+ KERANJANG</button>
                    </div>
                </div>

                <div class="product-card">
                    <div style="width: 100%; aspect-ratio: 1 / 1; overflow: hidden; border-radius: 4px; margin-bottom: 15px; background-color: var(--wf-light);">
                        <img src="<?php echo base_url('assets/img/LAS_POZAS.jpeg'); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div style="padding: 12px; text-align: left; display: flex; flex-direction: column; justify-content: space-between; height: 140px;">
                        <div>
                            <h3 style="color: var(--wf-dark); font-size: 14px; margin-bottom: 5px;">SAFF & CO. LAS POZAS</h3>
                            <p style="color: #666; font-size: 11px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">Wangi green fresh seperti daun dan citrus. Memberikan kesan energik dan sporty</p>
                        </div>
                        <button class="btn-checkout" style="padding: 6px 10px; font-size: 11px; margin-top: 8px;">+ KERANJANG</button>
                    </div>
                </div>


            </div>
        </div>

        <div class="brand-section">
            <h2 class="brand-title">Octarine Collections</h2>
            <div class="product-scroll">

                <div class="product-card">
                    <div style="width: 100%; aspect-ratio: 1 / 1; overflow: hidden; border-radius: 4px; margin-bottom: 15px; background-color: var(--wf-light);">
                        <img src="<?php echo base_url('assets/img/oc01.jpeg'); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div style="padding: 12px; text-align: left; display: flex; flex-direction: column; justify-content: space-between; height: 140px;">
                        <div>
                            <h3 style="color: var(--wf-dark); font-size: 14px; margin-bottom: 5px;">KAYU MANIS</h3>
                            <p style="color: #666; font-size: 11px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">Aroma hangat khas kayu manis dengan sentuhan spicy dan woody. Memberikan kesan dewasa dan cocok untuk malam hari.</p>
                        </div>
                        <button class="btn-checkout" style="padding: 6px 10px; font-size: 11px; margin-top: 8px;">+ KERANJANG</button>
                    </div>
                </div>

                <div class="product-card">
                    <div style="width: 100%; aspect-ratio: 1 / 1; overflow: hidden; border-radius: 4px; margin-bottom: 15px; background-color: var(--wf-light);">
                        <img src="<?php echo base_url('assets/img/oc02.jpeg'); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div style="padding: 12px; text-align: left; display: flex; flex-direction: column; justify-content: space-between; height: 140px;">
                        <div>
                            <h3 style="color: var(--wf-dark); font-size: 14px; margin-bottom: 5px;">ELIXIR HOMME</h3>
                            <p style="color: #666; font-size: 11px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">Cocok untuk suasana santai atau hangout sore.</p>
                        </div>
                        <button class="btn-checkout" style="padding: 6px 10px; font-size: 11px; margin-top: 8px;">+ KERANJANG</button>
                    </div>
                </div>

                <div class="product-card">
                    <div style="width: 100%; aspect-ratio: 1 / 1; overflow: hidden; border-radius: 4px; margin-bottom: 15px; background-color: var(--wf-light);">
                        <img src="<?php echo base_url('assets/img/oc03.jpeg'); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div style="padding: 12px; text-align: left; display: flex; flex-direction: column; justify-content: space-between; height: 140px;">
                        <div>
                            <h3 style="color: var(--wf-dark); font-size: 14px; margin-bottom: 5px;">LIBRERO</h3>
                            <p style="color: #666; font-size: 11px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">Memberikan kesan bersih, feminin, dan energik.</p>
                        </div>
                        <button class="btn-checkout" style="padding: 6px 10px; font-size: 11px; margin-top: 8px;">+ KERANJANG</button>
                    </div>
                </div>

                <div class="product-card">
                    <div style="width: 100%; aspect-ratio: 1 / 1; overflow: hidden; border-radius: 4px; margin-bottom: 15px; background-color: var(--wf-light);">
                        <img src="<?php echo base_url('assets/img/oc04.jpeg'); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div style="padding: 12px; text-align: left; display: flex; flex-direction: column; justify-content: space-between; height: 140px;">
                        <div>
                            <h3 style="color: var(--wf-dark); font-size: 14px; margin-bottom: 5px;">BLACK OPIUM</h3>
                            <p style="color: #666; font-size: 11px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">Cocok untuk tampil misterius dan berkarakter kuat.</p>
                        </div>
                        <button class="btn-checkout" style="padding: 6px 10px; font-size: 11px; margin-top: 8px;">+ KERANJANG</button>
                    </div>
                </div>

                <div class="product-card">
                    <div style="width: 100%; aspect-ratio: 1 / 1; overflow: hidden; border-radius: 4px; margin-bottom: 15px; background-color: var(--wf-light);">
                        <img src="<?php echo base_url('assets/img/oc05.jpeg'); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div style="padding: 12px; text-align: left; display: flex; flex-direction: column; justify-content: space-between; height: 140px;">
                        <div>
                            <h3 style="color: var(--wf-dark); font-size: 14px; margin-bottom: 5px;">CITRUS BLOOM</h3>
                            <p style="color: #666; font-size: 11px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">Perpaduan citrus segar dan bunga lembut. Memberikan kesan ceria, ringan, dan cocok untuk siang hari.</p>
                        </div>
                        <button class="btn-checkout" style="padding: 6px 10px; font-size: 11px; margin-top: 8px;">+ KERANJANG</button>
                    </div>
                </div>

                <div class="product-card">
                    <div style="width: 100%; aspect-ratio: 1 / 1; overflow: hidden; border-radius: 4px; margin-bottom: 15px; background-color: var(--wf-light);">
                        <img src="<?php echo base_url('assets/img/oc06.jpeg'); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div style="padding: 12px; text-align: left; display: flex; flex-direction: column; justify-content: space-between; height: 140px;">
                        <div>
                            <h3 style="color: var(--wf-dark); font-size: 14px; margin-bottom: 5px;">MELON</h3>
                            <p style="color: #666; font-size: 11px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">Aroma segar seperti laut dengan nuansa aquatic dan sedikit salty. Memberikan kesan bebas dan menyegarkan.</p>
                        </div>
                        <button class="btn-checkout" style="padding: 6px 10px; font-size: 11px; margin-top: 8px;">+ KERANJANG</button>
                    </div>
                </div>

                <div class="product-card">
                    <div style="width: 100%; aspect-ratio: 1 / 1; overflow: hidden; border-radius: 4px; margin-bottom: 15px; background-color: var(--wf-light);">
                        <img src="<?php echo base_url('assets/img/oc07.jpeg'); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div style="padding: 12px; text-align: left; display: flex; flex-direction: column; justify-content: space-between; height: 140px;">
                        <div>
                            <h3 style="color: var(--wf-dark); font-size: 14px; margin-bottom: 5px;">VANILA SKY</h3>
                            <p style="color: #666; font-size: 11px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">Wangi vanilla manis dengan sentuhan creamy. Cocok untuk kamu yang suka aroma hangat dan comforting.</p>
                        </div>
                        <button class="btn-checkout" style="padding: 6px 10px; font-size: 11px; margin-top: 8px;">+ KERANJANG</button>
                    </div>
                </div>

                <div class="product-card">
                    <div style="width: 100%; aspect-ratio: 1 / 1; overflow: hidden; border-radius: 4px; margin-bottom: 15px; background-color: var(--wf-light);">
                        <img src="<?php echo base_url('assets/img/oc08.jpeg'); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div style="padding: 12px; text-align: left; display: flex; flex-direction: column; justify-content: space-between; height: 140px;">
                        <div>
                            <h3 style="color: var(--wf-dark); font-size: 14px; margin-bottom: 5px;">GREEN TEA</h3>
                            <p style="color: #666; font-size: 11px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">Aroma teh hijau yang fresh dan calming. Memberikan efek relaksasi dan cocok untuk aktivitas sehari-hari.</p>
                        </div>
                        <button class="btn-checkout" style="padding: 6px 10px; font-size: 11px; margin-top: 8px;">+ KERANJANG</button>
                    </div>
                </div>

                <div class="product-card">
                    <div style="width: 100%; aspect-ratio: 1 / 1; overflow: hidden; border-radius: 4px; margin-bottom: 15px; background-color: var(--wf-light);">
                        <img src="<?php echo base_url('assets/img/oc9.jpeg'); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div style="padding: 12px; text-align: left; display: flex; flex-direction: column; justify-content: space-between; height: 140px;">
                        <div>
                            <h3 style="color: var(--wf-dark); font-size: 14px; margin-bottom: 5px;">AMBER NIGHT</h3>
                            <p style="color: #666; font-size: 11px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">Aroma amber hangat, sedikit manis dan sensual. </p>
                        </div>
                        <button class="btn-checkout" style="padding: 6px 10px; font-size: 11px; margin-top: 8px;">+ KERANJANG</button>
                    </div>
                </div>

                <div class="product-card">
                    <div style="width: 100%; aspect-ratio: 1 / 1; overflow: hidden; border-radius: 4px; margin-bottom: 15px; background-color: var(--wf-light);">
                        <img src="<?php echo base_url('assets/img/o10.jpg'); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div style="padding: 12px; text-align: left; display: flex; flex-direction: column; justify-content: space-between; height: 140px;">
                        <div>
                            <h3 style="color: var(--wf-dark); font-size: 14px; margin-bottom: 5px;">FLORAL MUSK</h3>
                            <p style="color: #666; font-size: 11px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">Memberikan kesan clean, lembut, dan elegan.</p>
                        </div>
                        <button class="btn-checkout" style="padding: 6px 10px; font-size: 11px; margin-top: 8px;">+ KERANJANG</button>
                    </div>
                </div>
            </div>

            <div class="brand-section">
                <h2 class="brand-title">Scarlett Collections</h2>
                <div class="product-scroll">

                    <div class="product-card">
                        <div style="width: 100%; aspect-ratio: 1 / 1; overflow: hidden; border-radius: 4px; margin-bottom: 15px; background-color: var(--wf-light);">
                            <img src="<?php echo base_url('assets/img/LAS_POZAS.jpeg'); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div style="padding: 12px; text-align: left; display: flex; flex-direction: column; justify-content: space-between; height: 140px;">
                            <div>
                                <h3 style="color: var(--wf-dark); font-size: 14px; margin-bottom: 5px;">SAFF & CO. LAS POZAS</h3>
                                <p style="color: #666; font-size: 11px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">Wangi green fresh seperti daun dan citrus. Memberikan kesan energik dan sporty</p>
                            </div>
                            <button class="btn-checkout" style="padding: 6px 10px; font-size: 11px; margin-top: 8px;">+ KERANJANG</button>
                        </div>
                    </div>

                    <div class="product-card">
                        <div style="width: 100%; aspect-ratio: 1 / 1; overflow: hidden; border-radius: 4px; margin-bottom: 15px; background-color: var(--wf-light);">
                            <img src="<?php echo base_url('assets/img/LAS_POZAS.jpeg'); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div style="padding: 12px; text-align: left; display: flex; flex-direction: column; justify-content: space-between; height: 140px;">
                            <div>
                                <h3 style="color: var(--wf-dark); font-size: 14px; margin-bottom: 5px;">SAFF & CO. LAS POZAS</h3>
                                <p style="color: #666; font-size: 11px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">Wangi green fresh seperti daun dan citrus. Memberikan kesan energik dan sporty</p>
                            </div>
                            <button class="btn-checkout" style="padding: 6px 10px; font-size: 11px; margin-top: 8px;">+ KERANJANG</button>
                        </div>
                    </div>

                    <div class="product-card">
                        <div style="width: 100%; aspect-ratio: 1 / 1; overflow: hidden; border-radius: 4px; margin-bottom: 15px; background-color: var(--wf-light);">
                            <img src="<?php echo base_url('assets/img/LAS_POZAS.jpeg'); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div style="padding: 12px; text-align: left; display: flex; flex-direction: column; justify-content: space-between; height: 140px;">
                            <div>
                                <h3 style="color: var(--wf-dark); font-size: 14px; margin-bottom: 5px;">SAFF & CO. LAS POZAS</h3>
                                <p style="color: #666; font-size: 11px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">Wangi green fresh seperti daun dan citrus. Memberikan kesan energik dan sporty</p>
                            </div>
                            <button class="btn-checkout" style="padding: 6px 10px; font-size: 11px; margin-top: 8px;">+ KERANJANG</button>
                        </div>
                    </div>

                    <div class="product-card">
                        <div style="width: 100%; aspect-ratio: 1 / 1; overflow: hidden; border-radius: 4px; margin-bottom: 15px; background-color: var(--wf-light);">
                            <img src="<?php echo base_url('assets/img/LAS_POZAS.jpeg'); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div style="padding: 12px; text-align: left; display: flex; flex-direction: column; justify-content: space-between; height: 140px;">
                            <div>
                                <h3 style="color: var(--wf-dark); font-size: 14px; margin-bottom: 5px;">SAFF & CO. LAS POZAS</h3>
                                <p style="color: #666; font-size: 11px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">Wangi green fresh seperti daun dan citrus. Memberikan kesan energik dan sporty</p>
                            </div>
                            <button class="btn-checkout" style="padding: 6px 10px; font-size: 11px; margin-top: 8px;">+ KERANJANG</button>
                        </div>
                    </div>

                    <div class="product-card">
                        <div style="width: 100%; aspect-ratio: 1 / 1; overflow: hidden; border-radius: 4px; margin-bottom: 15px; background-color: var(--wf-light);">
                            <img src="<?php echo base_url('assets/img/LAS_POZAS.jpeg'); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div style="padding: 12px; text-align: left; display: flex; flex-direction: column; justify-content: space-between; height: 140px;">
                            <div>
                                <h3 style="color: var(--wf-dark); font-size: 14px; margin-bottom: 5px;">SAFF & CO. LAS POZAS</h3>
                                <p style="color: #666; font-size: 11px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">Wangi green fresh seperti daun dan citrus. Memberikan kesan energik dan sporty</p>
                            </div>
                            <button class="btn-checkout" style="padding: 6px 10px; font-size: 11px; margin-top: 8px;">+ KERANJANG</button>
                        </div>
                    </div>

                    <div class="product-card">
                        <div style="width: 100%; aspect-ratio: 1 / 1; overflow: hidden; border-radius: 4px; margin-bottom: 15px; background-color: var(--wf-light);">
                            <img src="<?php echo base_url('assets/img/LAS_POZAS.jpeg'); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div style="padding: 12px; text-align: left; display: flex; flex-direction: column; justify-content: space-between; height: 140px;">
                            <div>
                                <h3 style="color: var(--wf-dark); font-size: 14px; margin-bottom: 5px;">SAFF & CO. LAS POZAS</h3>
                                <p style="color: #666; font-size: 11px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">Wangi green fresh seperti daun dan citrus. Memberikan kesan energik dan sporty</p>
                            </div>
                            <button class="btn-checkout" style="padding: 6px 10px; font-size: 11px; margin-top: 8px;">+ KERANJANG</button>
                        </div>
                    </div>

                    <div class="product-card">
                        <div style="width: 100%; aspect-ratio: 1 / 1; overflow: hidden; border-radius: 4px; margin-bottom: 15px; background-color: var(--wf-light);">
                            <img src="<?php echo base_url('assets/img/LAS_POZAS.jpeg'); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div style="padding: 12px; text-align: left; display: flex; flex-direction: column; justify-content: space-between; height: 140px;">
                            <div>
                                <h3 style="color: var(--wf-dark); font-size: 14px; margin-bottom: 5px;">SAFF & CO. LAS POZAS</h3>
                                <p style="color: #666; font-size: 11px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">Wangi green fresh seperti daun dan citrus. Memberikan kesan energik dan sporty</p>
                            </div>
                            <button class="btn-checkout" style="padding: 6px 10px; font-size: 11px; margin-top: 8px;">+ KERANJANG</button>
                        </div>
                    </div>

                    <div class="product-card">
                        <div style="width: 100%; aspect-ratio: 1 / 1; overflow: hidden; border-radius: 4px; margin-bottom: 15px; background-color: var(--wf-light);">
                            <img src="<?php echo base_url('assets/img/LAS_POZAS.jpeg'); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div style="padding: 12px; text-align: left; display: flex; flex-direction: column; justify-content: space-between; height: 140px;">
                            <div>
                                <h3 style="color: var(--wf-dark); font-size: 14px; margin-bottom: 5px;">SAFF & CO. LAS POZAS</h3>
                                <p style="color: #666; font-size: 11px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">Wangi green fresh seperti daun dan citrus. Memberikan kesan energik dan sporty</p>
                            </div>
                            <button class="btn-checkout" style="padding: 6px 10px; font-size: 11px; margin-top: 8px;">+ KERANJANG</button>
                        </div>
                    </div>

                    <div class="product-card">
                        <div style="width: 100%; aspect-ratio: 1 / 1; overflow: hidden; border-radius: 4px; margin-bottom: 15px; background-color: var(--wf-light);">
                            <img src="<?php echo base_url('assets/img/LAS_POZAS.jpeg'); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div style="padding: 12px; text-align: left; display: flex; flex-direction: column; justify-content: space-between; height: 140px;">
                            <div>
                                <h3 style="color: var(--wf-dark); font-size: 14px; margin-bottom: 5px;">SAFF & CO. LAS POZAS</h3>
                                <p style="color: #666; font-size: 11px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">Wangi green fresh seperti daun dan citrus. Memberikan kesan energik dan sporty</p>
                            </div>
                            <button class="btn-checkout" style="padding: 6px 10px; font-size: 11px; margin-top: 8px;">+ KERANJANG</button>
                        </div>
                    </div>

                    <div class="product-card">
                        <div style="width: 100%; aspect-ratio: 1 / 1; overflow: hidden; border-radius: 4px; margin-bottom: 15px; background-color: var(--wf-light);">
                            <img src="<?php echo base_url('assets/img/LAS_POZAS.jpeg'); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div style="padding: 12px; text-align: left; display: flex; flex-direction: column; justify-content: space-between; height: 140px;">
                            <div>
                                <h3 style="color: var(--wf-dark); font-size: 14px; margin-bottom: 5px;">SAFF & CO. LAS POZAS</h3>
                                <p style="color: #666; font-size: 11px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">Wangi green fresh seperti daun dan citrus. Memberikan kesan energik dan sporty</p>
                            </div>
                            <button class="btn-checkout" style="padding: 6px 10px; font-size: 11px; margin-top: 8px;">+ KERANJANG</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <footer class="footer">
            <div class="footer-container">
                <div class="footer-col">
                    <div class="footer-title">AURA.</div>
                    <div class="footer-link"></div>
                    <div class="footer-link"></div>
                </div>
                <div class="footer-col">
                    <div class="footer-title"></div>
                    <div class="footer-link"></div>
                    <div class="footer-link"></div>
                </div>
                <div class="footer-col">
                    <div class="footer-title"></div>
                    <div class="footer-link"></div>
                    <div class="footer-link"></div>
                </div>
                <div class="footer-col">
                    <div class="footer-title"></div>
                    <div class="footer-link"></div>
                    <div class="footer-link"></div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="footer-copyright"></div>
            </div>
        </footer>

</body>

</html>