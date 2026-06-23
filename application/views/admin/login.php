<!DOCTYPE html>
<html>

<head>
    <title>Admin Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>

        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
            font-family: system-ui, sans-serif;
            background: #050816;
        }

        /* BACKGROUND */
        .bg {
            position: absolute;
            inset: 0;
            z-index: 0;
        }

        .glow {
            position: absolute;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            filter: blur(120px);
            opacity: 0.4;
        }

        .blue { background: #3b82f6; top: -150px; left: -150px; }
        .purple { background: #a855f7; bottom: -200px; right: -200px; }
        .cyan { background: #22d3ee; top: 40%; left: 60%; }

        /* LOGIN */
        .center {
            position: absolute;
            inset: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            z-index: 2;

            transition: .4s;
        }

        .login-box {
            width: 360px;
            text-align: center;
        }

        .logo {
            width: 110px;
            height: 110px;
            margin: 0 auto 15px;

            border-radius: 20px;
            overflow: hidden;

            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(10px);
        }

        .logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .welcome h3 {
            color: white;
            font-size: 20px;
            margin-bottom: 5px;
        }

        .welcome p {
            color: rgba(255,255,255,0.6);
            font-size: 13px;
        }

        label {
            color: rgba(255,255,255,0.7);
            font-size: 13px;
        }

        .form-control {
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.1);
            color: white;
        }

        .form-control:focus {
            background: rgba(255,255,255,0.1);
            border-color: #3b82f6;
            box-shadow: none;
            color: white;
        }

        .btn-login {
            width: 100%;
            margin-top: 10px;

            background: linear-gradient(135deg, #3b82f6, #6366f1);
            border: none;

            padding: 10px;
            font-weight: 600;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(59,130,246,0.4);
        }

        /* WAVES */
        .wave-container {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 180px;
            overflow: hidden;
            z-index: 1;
        }

        .wave {
            position: absolute;
            width: 200%;
            height: 100%;
            animation: waveMove linear infinite;
        }

        .wave1 {
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1200 120'%3E%3Cpath d='M0,60 C300,120 900,0 1200,60 L1200,120 L0,120 Z' fill='rgba(255,255,255,0.05)'/%3E%3C/svg%3E");
            animation-duration: 10s;
        }

        .wave2 {
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1200 120'%3E%3Cpath d='M0,80 C300,20 900,140 1200,80 L1200,120 L0,120 Z' fill='rgba(255,255,255,0.04)'/%3E%3C/svg%3E");
            animation-duration: 18s;
            opacity: .6;
        }

        .wave3 {
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1200 120'%3E%3Cpath d='M0,70 C400,0 800,140 1200,70 L1200,120 L0,120 Z' fill='rgba(255,255,255,0.03)'/%3E%3C/svg%3E");
            animation-duration: 25s;
            opacity: .4;
        }

        @keyframes waveMove {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        /* SUCCESS OVERLAY */
        .success-overlay {
            position: fixed;
            inset: 0;
            background: rgba(5,8,22,0.9);
            backdrop-filter: blur(10px);

            display: flex;
            align-items: center;
            justify-content: center;

            z-index: 9999;
        }

        .success-box {
            text-align: center;
            color: white;
            animation: pop .4s ease;
        }

        @keyframes pop {
            from { transform: scale(0.8); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

        .check {
            width: 80px;
            height: 80px;
            margin: 0 auto 15px;

            background: #22c55e;
            border-radius: 50%;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 40px;
        }

        .loader {
            width: 35px;
            height: 35px;
            margin: 20px auto 0;

            border: 3px solid rgba(255,255,255,0.2);
            border-top-color: #3b82f6;

            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

    </style>

</head>

<body>

<!-- BACKGROUND -->
<div class="bg">
    <div class="glow blue"></div>
    <div class="glow purple"></div>
    <div class="glow cyan"></div>
</div>

<!-- LOGIN -->
<div class="center">

    <div class="login-box">

        <div class="logo">
            <img src="https://ui-avatars.com/api/?name=Parfume+CMS&background=0f172a&color=fff&size=200">
        </div>

        <div class="welcome">
            <h3>Selamat Datang</h3>
            <p>Admin Panel Parfume Store</p>
        </div>

        <div class="text-start">

            <label>Email</label>
            <input type="email" id="email" class="form-control">

            <label>Password</label>
            <input type="password" id="password" class="form-control">

            <button class="btn btn-login" onclick="login()">
                Login
            </button>

            <p id="msg" class="text-danger mt-3 text-center"></p>

        </div>

    </div>

</div>

<!-- WAVES -->
<div class="wave-container">
    <div class="wave wave1"></div>
    <div class="wave wave2"></div>
    <div class="wave wave3"></div>
</div>

<!-- SUCCESS OVERLAY -->
<div id="successOverlay" class="success-overlay d-none">

    <div class="success-box">

        <div class="check">
            <i class="bi bi-check2"></i>
        </div>

        <h3>Login Berhasil</h3>
        <p>Selamat datang kembali, Admin</p>

        <div class="loader"></div>

    </div>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
function login() {

    let email = $('#email').val();
    let password = $('#password').val();

    $('#msg').text('');

    $.ajax({
        url: "<?= base_url('api/login') ?>",
        type: "POST",
        data: { email, password },

        success: function(res) {

            if(res.status){

                // show success animation
                $('#successOverlay').removeClass('d-none');
                $('.center').css({
                    transform: 'scale(0.95)',
                    opacity: '0.3'
                });

                setTimeout(function() {
                    sessionStorage.setItem('token', res.token);
                    window.location.href = "<?= base_url('admin') ?>";
                }, 1800);

            } else {
                $('#msg').text(res.message);
            }

        },

        error: function() {
            $('#msg').text('Terjadi kesalahan server');
        }

    });

}
</script>

</body>

</html>