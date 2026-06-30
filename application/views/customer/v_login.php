<section class="auth-section">

    <div class="auth-wrapper">

        <div class="auth-card" data-aos="fade-up">

            <a href="<?= base_url() ?>" class="auth-logo">
                <img src="<?= !empty($site_logo) ? htmlspecialchars($site_logo, ENT_QUOTES, 'UTF-8') : '' ?>" id="siteLogo" alt="Logo">
                <h2><?= htmlspecialchars($site_name ?? 'Parfume Store', ENT_QUOTES, 'UTF-8') ?></h2>
            </a>

            <h3>Welcome Back</h3>

            <p class="auth-subtitle">
                Masuk ke akun <?= htmlspecialchars($site_name ?? 'toko', ENT_QUOTES, 'UTF-8') ?> untuk melanjutkan belanja
            </p>

            <form id="loginForm">

                <div class="form-group">

                    <label>Email</label>

                    <div class="input-wrapper">

                        <i class="bi bi-envelope"></i>

                        <input
                            type="email"
                            name="email"
                            required
                            placeholder="Masukkan email Anda">

                    </div>

                </div>

                <div class="form-group">

                    <label>Password</label>

                    <div class="input-wrapper">

                        <i class="bi bi-lock"></i>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            required
                            placeholder="Masukkan password">

                        <button
                            type="button"
                            class="toggle-password">

                            <i class="bi bi-eye"></i>

                        </button>

                    </div>

                </div>

                <button
                    class="auth-btn"
                    type="submit">

                    <i class="bi bi-box-arrow-in-right"></i>
                    Login

                </button>

            </form>

            <div class="auth-bottom">

                Belum punya akun?

                <a href="<?= base_url('register') ?>">
                    Register
                </a>

            </div>

        </div>

    </div>

</section>
