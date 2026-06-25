<section class="auth-section">

    <div class="auth-wrapper">

        <div class="auth-banner" data-aos="fade-right">

            <div class="auth-overlay">

                <h1>Welcome Back</h1>

                <p>
                    Discover your signature scent and experience the art of luxury fragrance.
                </p>

            </div>

        </div>

        <div class="auth-card" data-aos="fade-left">

            <a href="<?= base_url() ?>" class="auth-logo">

                <img src="" id="siteLogo">

                <h2>AURA</h2>

            </a>

            <h3>Login</h3>

            <p class="auth-subtitle">
                Sign in to continue shopping
            </p>

            <form id="loginForm">

                <div class="form-group">

                    <label>Email</label>

                    <div class="input-wrapper">

                        <i class="bi bi-envelope"></i>

                        <input
                            type="email"
                            name="email"
                            required>

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
                            required>

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