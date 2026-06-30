$('#loginForm').submit(function (e) {

    e.preventDefault();

    const $btn = $('.auth-btn');
    const originalText = $btn.text();

    $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Loading...');

    $.ajax({
        url: BASE_URL + 'api/login',
        method: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function (res) {

            if (!res.success)
            {
                Swal.fire('Oops', res.message, 'error');
                return;
            }

            if (res.data.role === 'admin')
            {
                Swal.fire(
                    'Akses ditolak',
                    'Halaman ini hanya untuk customer. Admin silakan login via panel admin.',
                    'warning'
                );
                return;
            }

            localStorage.setItem('customer_token', 'true');
            localStorage.setItem('customer_user', res.data.id);
            localStorage.setItem('customer_name', res.data.name);

            Swal.fire({
                icon: 'success',
                title: 'Login Berhasil',
                text: 'Selamat datang, ' + res.data.name,
                timer: 1400,
                showConfirmButton: false
            }).then(() => {
                window.location.href = BASE_URL;
            });
        },
        error: function () {
            Swal.fire('Oops', 'Server tidak dapat dihubungi', 'error');
        },
        complete: function () {
            $btn.prop('disabled', false).text(originalText);
        }
    });
});

$('.toggle-password').click(function () {

    const input = $(this).closest('.input-wrapper').find('input');
    const icon = $(this).find('i');

    if (input.attr('type') === 'password')
    {
        input.attr('type', 'text');
        icon.removeClass('bi-eye').addClass('bi-eye-slash');
    }
    else
    {
        input.attr('type', 'password');
        icon.removeClass('bi-eye-slash').addClass('bi-eye');
    }
});
