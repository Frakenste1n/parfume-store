$(function () {

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

    $('#registerForm').submit(function (e) {

        e.preventDefault();

        if ($('#registerPassword').val() !== $('#confirmPassword').val())
        {
            Swal.fire('Oops', 'Password tidak sama', 'warning');
            return;
        }

        const $btn = $('.auth-btn');
        const originalText = $btn.text();

        $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Loading...');

        $.ajax({
            url: BASE_URL + 'api/register',
            method: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function (res) {

                if (!res.success)
                {
                    Swal.fire('Oops', res.message, 'error');
                    return;
                }

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Akun berhasil dibuat. Silakan login.'
                }).then(() => {
                    window.location.href = BASE_URL + 'login';
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
});
