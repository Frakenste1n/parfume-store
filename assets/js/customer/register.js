$(function () {

    $('.toggle-password').click(function () {

        const password =
            $('#registerPassword');

        if (password.attr('type') === 'password')
        {
            password.attr('type', 'text');

            $(this).find('i')
                .removeClass('bi-eye')
                .addClass('bi-eye-slash');
        }
        else
        {
            password.attr('type', 'password');

            $(this).find('i')
                .removeClass('bi-eye-slash')
                .addClass('bi-eye');
        }

    });


    $('#registerForm').submit(function (e) {

        e.preventDefault();

        if (
            $('#registerPassword').val() !==
            $('#confirmPassword').val()
        )
        {
            Swal.fire(
                'Oops',
                'Password tidak sama',
                'warning'
            );

            return;
        }

        $.ajax({

            url: BASE_URL + 'api/register',

            method: 'POST',

            data: $(this).serialize(),

            dataType: 'json',

            beforeSend: function () {

                $('.auth-btn')
                    .html(
                        '<span class="spinner-border spinner-border-sm"></span> Loading...'
                    )
                    .prop('disabled', true);

            },

            success: function (res) {

                if (res.success)
                {
                    Swal.fire({

                        icon: 'success',

                        title: 'Berhasil',

                        text: 'Akun berhasil dibuat'

                    }).then(() => {

                        window.location.href =
                            BASE_URL + 'login';

                    });
                }
                else
                {
                    Swal.fire(
                        'Oops',
                        res.message,
                        'error'
                    );
                }

            },

            complete: function () {

                $('.auth-btn')
                    .html('Create Account')
                    .prop('disabled', false);

            }

        });

    });

});