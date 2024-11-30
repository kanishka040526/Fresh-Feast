<?php
session_start();

if (!isset($_SESSION['userdetails'])) {
  header('Location: sign-in.php');
  exit();
}

include('connectmysql.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['delete']) && isset($_POST['id'])) {
      $review_id = $_POST['id'];
      $delete = "DELETE FROM coupons WHERE id = ?";
      $sql = $conn->prepare($delete);
      $sql->bind_param('i', $review_id);
      if ($sql->execute()) {
          echo json_encode(['status' => 'success']);
      } else {
          echo json_encode(['status' => 'error', 'message' => $sql->error]);
      }
      exit;
  }
}
if($_SERVER["REQUEST_METHOD"] == "GET"){
    
  $review_data = "SELECT * FROM coupons ";
  $result = $conn->query($review_data);
    
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
      <div class = 'done_successfully'>
        <?php
          if (isset($_SESSION['account_success'])) {
            echo $_SESSION['account_success'] ;
            unset($_SESSION['account_success']);
          }
          if (isset($_SESSION['edit_account_success'])) {
            echo $_SESSION['edit_account_success'] ;
            unset($_SESSION['edit_account_success']);
          }
        ?>
        <div class="heading">
          <h1>Coupons</h1>
          <a href="add_discount.php">Add</a>
        </div>
        <table class="table-contant">
          <thead class="table-head">
            <tr>
              <th style="text-align: center;">code</th>
              <th style="text-align: center;">Discount Type</th>
              <th style="text-align: center;">Discount Value</th>
              <th style="text-align: center;">Start Date </th>
              <th style="text-align: center;">end Date</th>
              <th style="text-align: center;">Ugage limit</th>
              <th></th>
            </tr>
          </thead>
          <tbody class="table-body">
            <?php while($rows = $result->fetch_assoc())
                    { 
                    ?>
            <tr>
              <td>
                <?= $rows['code'];?>
              </td>
              <td>
                <?= $rows['discount_type'];?>
              </td>
              <td >
                <?= $rows['discount_value'];?>
              </td>
              <td>
                <?= $rows['start_date'];?>
              </td>
              <td>
                <?= $rows['end_date'];?>
              </td>
              <td>
                <?= $rows['usage_limit'];?>
              </td>
              <td>  
                <button name="delete" onclick="archiveFunction(event, <?= $rows['id']; ?>)" class="edit_and_delete">Delete</button>
              </td>
            </tr>
            <?php
                    }
                    ?>
          </tbody>
        </table>
                            
      </div>
    </section>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <script>
    function archiveFunction(event, reviewid) {
      event.preventDefault();
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then((result) => {
        // console.log(result);
        if (result.isConfirmed) {
          $.ajax({
            type: "POST",
            url: "social_account.php",
            data: { delete: true, id: reviewid },
            success: function(response) {
              // console.log(response);
              var data = JSON.parse(response);
              if (data.status === "success") {
                Swal.fire({
                  title: "Deleted!",
                  text: "Your product has been deleted.",
                  icon: "success"
                }).then(() => {
                  window.location.reload();
                });
              } else {
                Swal.fire({
                  title: "Error!",
                  text: "There was an error deleting the product: ",
                  icon: "error"
                });
              }
            },
            error: function() {
              Swal.fire({
                title: "Error!",
                text: "There was an error deleting the product.",
                icon: "error"
              });
            }
          });
        }
      });
    }
  </script>
</body>

</html>
