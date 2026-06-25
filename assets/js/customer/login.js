$('#loginForm').submit(function(e){

    e.preventDefault();

    $.ajax({

        url: BASE_URL + 'api/login',

        method: 'POST',

        data: $(this).serialize(),

        dataType: 'json',

        success: function(res){

            if(res.success){

                localStorage.setItem(
                    'customer_token',
                    'true'
                );

                localStorage.setItem(
                    'customer_name',
                    res.data.name
                );

                window.location.href =
                    BASE_URL;

            }
            else{

                Swal.fire(
                    'Oops',
                    res.message,
                    'error'
                );
            }

        }

    });

});