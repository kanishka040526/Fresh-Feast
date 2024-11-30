$(document).ready(function() {
    $(document).on('click','#cancelled', function(event) {
        event.preventDefault(); 
        let productID = $(this).attr('cancel-order-id');  

        $.ajax({
            type: 'POST',
            url: 'cancel_order.php',
            data: {id: productID},
            success: function(response) {
                console.log(response); 
                var response = JSON.parse(response);
                if (response.status === 'success') {
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "your order is cancelled!",
                        showConfirmButton: false,
                        timer: 1500
                      }).then(() => {
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        position: "top-end",
                        icon: 'error',
                        title: 'Error',
                        text: response.message, 
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            },
            error: function() {
                Swal.fire({
                    position: "top-end",
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong!',
                        showConfirmButton: false,
                        timer: 1500
                });
            }
        });
    });
});

