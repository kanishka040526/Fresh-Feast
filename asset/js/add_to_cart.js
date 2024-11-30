$(document).ready(function() {
    $(document).on('click','#add_to_cart', function(event) {
        event.preventDefault(); 
        let productID = $(this).attr('data-product-id');  
        let quantity = $(this).closest('.col-lg-6').find('.quantity input').val();

        $.ajax({
            type: 'POST',
            url: 'add-to-cart.php',
            data: {id: productID, quantity: quantity},
            success: function(response) {
                console.log(response); 
                var response = JSON.parse(response);
                if (response.status === 'success') {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                          toast.onmouseenter = Swal.stopTimer;
                          toast.onmouseleave = Swal.resumeTimer;
                        }
                      });
                      Toast.fire({
                        icon: "success",
                        title: "product added to cart!"
                      }).then(() => {
                        $('#cart_amount').text(response.cart_quantity);
                    });
                } else {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                          toast.onmouseenter = Swal.stopTimer;
                          toast.onmouseleave = Swal.resumeTimer;
                        }
                      });
                      Toast.fire({
                        icon: "error",
                        title: "Not in Stock!"
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

