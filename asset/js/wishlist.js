$(document).ready(function() {
    $(document).on('click','#wishlist', function(event) {
        event.preventDefault(); 
        let productID = $(this).attr('wishlist-product-id');  

        $.ajax({    
            type: 'POST',
            url: 'wishlist_data.php',
            data: {id: productID},
            success: function(response) {
                console.log(response); 
                var response = JSON.parse(response);
                if (response.status === 'success') {
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "wishlsited!!",
                        showConfirmButton: false,
                        timer: 1500
                      });
                } else {
                    Swal.fire({
                        position: "top-end",
                        icon: 'success',
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

