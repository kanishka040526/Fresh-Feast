$(document).on('click','#contact_form', function (event) {
        event.preventDefault();

    var formData = {
        userName: $('#user_name').val(),
        email: $('#user_email').val(),
        message: $('#user_message').val()
    };

    console.log("Form Data: ", formData);

    $.ajax({
        url: 'contact.php',
        type: 'POST',
        data: formData,
        success: function (response) {
            // console.log("Response: ", response);
            var response = JSON.parse(response);
            if (response.status === 'success') {
                Swal.fire({
                    title: 'Submitted!',
                    text: 'Your form has been submitted successfully. Our administration will contact you soon.',
                    icon: 'success'
                }).then((result) => {
                    $('#contact_form')[0].reset();
                });
            } else {
                Swal.fire({
                    title: 'Error!',
                    text: 'There was an error submitting your form.',
                    icon: 'error'
                });
            }
        }
    });
});