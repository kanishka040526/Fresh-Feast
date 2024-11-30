<?php
session_start();

if (!isset($_SESSION['userdetails'])) {
  header('Location: sign-in.php');
  exit();
}

include('connectmysql.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['delete']) && isset($_POST['id'])) {
      $contact_id = $_POST['id'];
      $delete = "DELETE FROM contact WHERE id = ?";
      $sql = $conn->prepare($delete);
      $sql->bind_param('i', $contact_id);
      if ($sql->execute()) {
          echo json_encode(['status' => 'success']);
      } else {
          echo json_encode(['status' => 'error', 'message' => $sql->error]);
      }
      exit;
  }
}
if($_SERVER["REQUEST_METHOD"] == "GET"){

  $limit = 6;
  $page = isset($_GET['page']) ? $_GET['page'] : 1;
  $offset = ($page - 1) * $limit;
    
  $contact_data = "SELECT * FROM contact LIMIT $limit  OFFSET $offset";
  $result = $conn->query($contact_data);

  $total_products_query = "SELECT COUNT(*) AS total FROM contact";
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
      <div class="add_order">
        <div class="heading">
          <h1>Messages</h1>
        </div>
        <table class="table-contant">
          <thead class="table-head-orders">
            <tr>
              <th style="text-align: center;">Name</th>
              <th style="text-align: center;">Email</th>
              <th style="text-align: center;">Message</th>
              <th></th>
            </tr>
          </thead>
          <tbody class="table-body">
            <?php while($rows = $result->fetch_assoc())
                    { 
                    ?>
            <tr>
              <td>
                <?= $rows['userName'];?>
              </td>
              <td>
                <?= $rows['email'];?>
              </td>
              <td style="text-align: center;">
                <?= $rows['message'];?>
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
    function archiveFunction(event, contactID) {
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
            url: "contact_message.php",
            data: { delete: true, id: contactID },
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
