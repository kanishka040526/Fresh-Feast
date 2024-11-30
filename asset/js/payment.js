$(document).on('click', '#proceed-checkout', function(e) {
    e.preventDefault();

    var paymentMethod = $('input[name="payment_method"]:checked').val();
    if (!paymentMethod) {
        alert("Please select a payment method.");
        return;
    }

    var formData = $('#checkout-form').serialize();

    if (paymentMethod === 'cod') {
        var ajaxUrl = "ajax/cod_payment.php";
        $.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: formData,
            success: function(response) {
                var response = JSON.parse(response);
                if (response.status === 'success') {
                    window.location.href = 'index.php';
                } else if (response.status === 'validation') {
                    handleValidationErrors(response.error);
                    window.location.href = 'index.php';
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
            }
        });
    } else if (paymentMethod === 'online') {
        var ajaxUrl = "ajax/online_payment.php";
        let amount = parseFloat($('#total_amount_topay').val()).toFixed(2) * 100;
        let options = {
            key: "rzp_test_n4R6h1yH35QNY7",
            name: "Frutables",
            amount: parseInt(Math.round(amount)),
            currency: "INR",
            description: "Payment",
            handler: function(response) {
                handlePaymentSuccess(response, formData);
            },
            prefill: {
                'name': $('#userss_name').val(),
                "contact": $('#user_contact_number').val(),
                "email": $('#user_contact_email').val(),
            },
            notes: {
                address: $("#users_address").val()
            }
        };
        var rzp1 = new Razorpay(options);
        rzp1.open();
    }
});

function handlePaymentSuccess(response, formData) {
    $.ajax({
        url: "ajax/online_payment.php",
        type: 'POST',
        data: {
            payment_id: response.razorpay_payment_id,
            form_data: formData
        },
        success: function(response) {
            var response = JSON.parse(response);
            if (response.status === 'success') {
                window.location.href = 'index.php';
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
        }
    });
}

function handleValidationErrors(errors) {
    // Clear previous errors
    $('.errors').text('');

    // Display errors
    for (var key in errors) {
        if (errors.hasOwnProperty(key)) {
            $('#error_' + key).text(errors[key]);
        }
    }
}
