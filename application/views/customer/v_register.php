<section class="auth-section">

    <div class="auth-wrapper">

        <div class="auth-card" data-aos="fade-up">

            <a href="<?= base_url() ?>" class="auth-logo">
                <img src="<?= !empty($site_logo) ? htmlspecialchars($site_logo, ENT_QUOTES, 'UTF-8') : '' ?>" id="siteLogo" alt="Logo">
                <h2><?= htmlspecialchars($site_name ?? 'Parfume Store', ENT_QUOTES, 'UTF-8') ?></h2>
            </a>

            <h3>Create Account</h3>

            <p class="auth-subtitle">
                Buat akun customer <?= htmlspecialchars($site_name ?? 'toko', ENT_QUOTES, 'UTF-8') ?> untuk mulai belanja
            </p>

            <form id="registerForm">

                <div class="form-group">

                    <label>Full Name</label>

                    <div class="input-wrapper">

                        <i class="bi bi-person"></i>

                        <input
                            type="text"
                            name="name"
                            required
                            placeholder="Masukkan nama lengkap">

                    </div>

                </div>


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

                    <label>Phone Number</label>

                    <div class="input-wrapper">

                        <i class="bi bi-telephone"></i>

                        <input
                            type="text"
                            name="phone"
                            placeholder="Masukkan nomor telepon">

                    </div>

                </div>


                <div class="form-group">

                    <label>Alamat</label>

                    <div class="input-wrapper">

                        <i class="bi bi-geo-alt"></i>

                        <input
                            type="text"
                            name="address"
                            placeholder="Opsional">

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
                            required
                            placeholder="Masukkan password">

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
                            required
                            placeholder="Konfirmasi password">

                    </div>

                </div>


                <button
                    class="auth-btn"
                    type="submit">

                    <i class="bi bi-person-plus"></i>
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
