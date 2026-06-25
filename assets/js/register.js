$('#registerForm').submit(function(e){

    e.preventDefault();

    $.ajax({

        url: BASE_URL + 'api/register',

        method: 'POST',

        data: $(this).serialize(),

        dataType:'json',

        success:function(res){

            if(res.success){

                Swal.fire({

                    icon:'success',

                    title:'Berhasil',

                    text:'Akun berhasil dibuat'

                }).then(()=>{

                    window.location.href =
                        BASE_URL + 'login';

                });

            }

        }

    });

});