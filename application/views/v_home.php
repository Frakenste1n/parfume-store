<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Art of Scent | Premium Parfume</title>
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
        </ul>
        </ul>
        <div class="nav-icons">
            <a href="<?php echo base_url('index.php/welcome/search'); ?>"><i class="fas fa-search"></i></a>
            <a href="<?php echo base_url('index.php/welcome/login'); ?>"><i class="far fa-user"></i></a>
            <a href="<?php echo base_url('index.php/welcome/cart'); ?>"><i class="fas fa-shopping-cart"></i></a>
        </div>
    </nav>

    <section class="hero-slider">
        <div class="slider-track" id="sliderTrack">
            <div class="slide">
                <div class="hero-left">
                    <div class="wireframe-title-large">
                        <h1>HIT PRODUCT #1</h1>
                    </div>
                    <div class="wireframe-text-line"></div>
                    <div class="wireframe-text-line short"></div>
                    <div class="wireframe-btn"></div>
                </div>
                <div class="hero-right">
                    <img src="<?php echo base_url('assets/img/las_pozas.jpeg'); ?>" alt="Saff" style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
                </div>
            </div>
            <div class="slide">
                <div class="hero-left">
                    <div class="wireframe-title-large">
                        <h1>HIT PRODUCT #2</h1>
                    </div>
                    <div class="wireframe-text-line"></div>
                    <div class="wireframe-text-line short"></div>
                    <div class="wireframe-btn"></div>
                </div>
                <div class="hero-right">
                    <img src="<?php echo base_url('assets/img/octarine1.jpg'); ?>" alt="Saff" style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
                </div>
            </div>
            <div class="slide">
                <div class="hero-left">
                    <div class="wireframe-title-large">
                        <h1>HIT PRODUCT #3</h1>
                    </div>
                    <div class="wireframe-text-line"></div>
                    <div class="wireframe-text-line short"></div>
                    <div class="wireframe-btn"></div>
                </div>
                <div class="hero-right">
                 <img src="<?php echo base_url('assets/img/scarlett.jpg'); ?>" alt="Saff" style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
                </div>
            </div>
        </div>

        <div class="slider-dots">
            <span class="dot active" onclick="currentSlide(0)"></span>
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
        </div>
    </section>

    <section class="brand-showcase">
        <div class="brand-container">
            <div class="brand-item brand-saff">
                <div class="brand-overlay">
                    <h2>SAFF & CO</h2>
                    <div class="wf-line-short"></div>
                </div>
            </div>
            <div class="brand-item brand-octarine">
                <div class="brand-overlay">
                    <h2>OCTARINE</h2>
                    <div class="wf-line-short"></div>
                </div>
            </div>
            <div class="brand-item brand-scarlett">
                <div class="brand-overlay">
                    <h2>SCARLETT</h2>
                    <div class="wf-line-short"></div>
                </div>
            </div>
        </div>
    </section>


    <footer class="footer">
        <div class="footer-container">
            <div class="footer-col">
                <div class="footer-title">LOGO</div>
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

    <script>
        let currentIndex = 0;
        const track = document.getElementById('sliderTrack');
        const dots = document.querySelectorAll('.dot');
        const totalSlides = document.querySelectorAll('.slide').length;

        function updateSlider() {
            if (!track) return;
            track.style.transform = `translateX(-${currentIndex * 100}%)`;
            dots.forEach(dot => dot.classList.remove('active'));
            dots[currentIndex].classList.add('active');
        }

        function nextSlide() {
            currentIndex++;
            if (currentIndex >= totalSlides) {
                currentIndex = 0;
            }
            updateSlider();
        }

        function currentSlide(index) {
            currentIndex = index;
            updateSlider();
            resetTimer();
        }

        let slideInterval = setInterval(nextSlide, 4000);

        function resetTimer() {
            clearInterval(slideInterval);
            slideInterval = setInterval(nextSlide, 4000);
        }
    </script>

</body>

</html>