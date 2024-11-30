<?php
session_start();

if (!isset($_SESSION['userdetails'])) {
  header('Location: sign-in.php');
  exit();
}

include('connectmysql.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['status']) && isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];
    $cancellation_reason = isset($_POST['cancellation_reason']) ? $_POST['cancellation_reason'] : '';

    $update = "UPDATE orders SET status = ?, cancellation_reason = ? WHERE id = ?";
    $sql = $conn->prepare($update);
    $sql->bind_param('ssi', $status, $cancellation_reason, $order_id);
    if ($sql->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $sql->error]);
    }
    exit;
}

}
if($_SERVER["REQUEST_METHOD"] == "GET"){

  $limit = 15;
  $page = isset($_GET['page']) ? $_GET['page'] : 1;
  $offset = ($page - 1) * $limit;
    
  $order_data = "SELECT * FROM orders LIMIT $limit OFFSET $offset";
    $result = $conn->query($order_data);

  $total_products_query = "SELECT COUNT(*) AS total FROM orders";
  $total_products_result = $conn->query($total_products_query);
  $total_products_row = $total_products_result->fetch_assoc();
  $total_products = $total_products_row['total'];
  $total_pages = ceil($total_products / $limit);
 
}

$conn->close();
include("navbar.php");
?>
  <div class="container-categories-products">
    <section>
      <div class="container-sidenav">
        <?php include('sidenavbar.php')?>
      </div>
      <div class="add_categories_products">
        <div class="heading">
          <h1>Orders</h1>
        </div>
        <table class="table-contant">
          <thead class="table-head">
            <tr>
              <th style="text-align: center;">Name</th>
              <th style="text-align: center;">Price</th>
              <th style="text-align: center;">Payment-Status</th>
              <th style="text-align: center;">Quantity</th>
              <th style="text-align: center;">status</th>
              <th style="text-align: center;">Payment Id</th>
            </tr>
          </thead>
          <tbody class="table-body">
            <?php while($rows = $result->fetch_assoc()){ 
                      if(!empty($rows['sale_price'])|| $rows['sale_price'] != 0){
                        $price = $rows['sale_price'];
                      }else{
                        $price = $rows['price'];
                      }
                    ?>
            <tr>
              <td>
                <?= $rows['p_name'];?>
              </td>
              <td>
                <?= $price * $rows['quantity'];?>
              </td>
              <td class="payment_status">
                <?= $rows['payment_status']?>
              </td>
              <td style="text-align: center;">
                <?= $rows['quantity'];?>
              </td>
              <td>
              <form method="POST" action="orders.php" class="status-form">
                  <input type="hidden" name="order_id" value="<?= $rows['id']; ?>">
                  <select name="status" onchange="handleStatusChange(this, <?= $rows['id']; ?>)" class="status" <?= $rows['status'] == 'completed' ? 'disabled' : ''; ?>>
                    <option value="pending" <?= $rows['status'] == 'pending' ? 'selected' : ''; ?>>pending</option>
                    <option value="approved" <?= $rows['status'] == 'approved' ? 'selected' : ''; ?>>approved</option>
                    <option value="dispack" <?= $rows['status'] == 'dispack' ? 'selected' : ''; ?>>dispack</option>
                    <option value="intheway" <?= $rows['status'] == 'intheway' ? 'selected' : ''; ?>>in the way</option>
                    <option value="completed" <?= $rows['status'] == 'completed' ? 'selected' : ''; ?>>completed</option>
                    <option value="cancelled" <?= $rows['status'] == 'cancelled' ? 'selected' : ''; ?>>cancelled</option>
                  </select>
                </form>
              </td>
              <td>
              <?= !empty($rows['payment_id'])? $rows['payment_id']: 'Cash on delivery';?></td>
            </tr>
            <?php
                    }
                    ?>
          </tbody>
        </table>
        <div class="pagination">
            <?php if ($page > 1): ?>
            <a href="?page=<?= $page - 1 ?>"class="rounded">&laquo;</a>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="?page=<?= $i ?>" class="rounded <?= $i == $page ? 'active' : '' ?>"><?= $i ?>
            </a>
            <?php endfor; ?>
            <?php if ($page < $total_pages): ?>
            <a href="?page=<?= $page + 1 ?>"class="rounded">&raquo;</a>
            <?php endif; ?>
        </div>
                            
      </div>
    </section>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <script>
    function handleStatusChange(selectElement, orderId) {
      if (selectElement.value === 'cancelled') {
        Swal.fire({
          title: 'Enter cancellation reason',
          input: 'textarea',
          inputLabel: 'Reason',
          showCancelButton: true,
          inputValidator: (value) => {
            if (!value) {
              return 'You need to provide a reason!';
            }
          }
        }).then((result) => {
          if (result.isConfirmed) {
            updateStatus(orderId, selectElement.value, result.value);
          }
        });
      } else {
        updateStatus(orderId, selectElement.value);
      }
    }

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
  </script>
</body>

</html>
