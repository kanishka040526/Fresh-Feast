
    $(document).on('submit', '#checkout-form', function(event) {
        event.preventDefault();
        $('.errors').text(''); 

        var formData = $('#checkout-form').serialize();

        $.ajax({
            url: 'ajax/cod_checkout.php',
            method: 'POST',
            data: formData,
            success: function(response) {
                console.log(response);  
                var response = JSON.parse(response);
                if (response.status === 'validation') {
                    var errors = response.error;
                    for (var key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            $('#error_' + key).text(errors[key]);
                        }
                    }    
                } else if (response.status === 'error') {
                    alert(response.message);
                }
            }
        });
    });