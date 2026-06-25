<section class="auth-section">

    <div class="auth-wrapper">

        <div class="auth-banner" data-aos="fade-right">

            <div class="auth-overlay">

                <h1>Create Account</h1>

                <p>
                    Begin your luxury fragrance journey with AURA and discover timeless scents.
                </p>

            </div>

        </div>

        <div class="auth-card" data-aos="fade-left">

            <a
                href="<?= base_url() ?>"
                class="auth-logo">

                <img
                    id="siteLogo"
                    src="">

                <h2>AURA</h2>

            </a>

            <h3>Register</h3>

            <p class="auth-subtitle">
                Create your account to start shopping.
            </p>

            <form id="registerForm">

                <div class="form-group">

                    <label>Full Name</label>

                    <div class="input-wrapper">

                        <i class="bi bi-person"></i>

                        <input
                            type="text"
                            name="name"
                            required>

                    </div>

                </div>


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

                    <label>Phone Number</label>

                    <div class="input-wrapper">

                        <i class="bi bi-telephone"></i>

                        <input
                            type="text"
                            name="phone">

                    </div>

                </div>


                <div class="form-group">

                    <label>Password</label>

                    <div class="input-wrapper">

                        <i class="bi bi-lock"></i>

                        <input
                            type="password"
                            id="registerPassword"
                            name="password"
                            required>

                        <button
                            type="button"
                            class="toggle-password">

                            <i class="bi bi-eye"></i>

                        </button>

                    </div>

                </div>


                <div class="form-group">

                    <label>Confirm Password</label>

                    <div class="input-wrapper">

                        <i class="bi bi-shield-lock"></i>

                        <input
                            type="password"
                            id="confirmPassword"
                            required>

                    </div>

                </div>


                <button
                    class="auth-btn"
                    type="submit">

                    Create Account

                </button>

            </form>

            <div class="auth-bottom">

                Already have an account?

                <a href="<?= base_url('login') ?>">

                    Login

                </a>

            </div>

        </div>

    </div>

</section>