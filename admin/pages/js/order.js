  function updateStatus(orderId, status, cancellationReason = '') {
    $.ajax({
      type: "POST",
      url: "orders.php",
      data: {
        status: status,
        order_id: orderId,
        cancellation_reason: cancellationReason
      },
      success: function(response) {
        var data = JSON.parse(response);
        if (data.status === "success") {
          Swal.fire({
            title: "Updated!",
            text: "The order status has been updated.",
            icon: "success"
          }).then(() => {
            window.location.reload();
          });
        } else {
          Swal.fire({
            title: "Error!",
            text: "There was an error updating the order status: " + data.message,
            icon: "error"
          });
        }
      },
      error: function() {
        Swal.fire({
          title: "Error!",
          text: "There was an error updating the order status.",
          icon: "error"
        });
      }
    });
  }