<?php
session_start();

if (!isset($_SESSION['userdetails'])) {
  header('Location: sign-in.php');
  exit();
}
else{
include('connectmysql.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['delete']) && isset($_POST['id'])) {
      $product_details = $_POST['id'];
      $delete = "DELETE FROM details WHERE id = ?";
      $sql = $conn->prepare($delete);
      $sql->bind_param('i', $product_details);
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

  $sql = "SELECT details.*, product.p_name AS product_name 
  FROM details 
  INNER JOIN product ON product.id = details.product_id ORDER BY id DESC LIMIT $limit OFFSET $offset";
  $result = $conn->query($sql);

  $total_products_query = "SELECT COUNT(*) AS total FROM details";
  $total_products_result = $conn->query($total_products_query);
  $total_products_row = $total_products_result->fetch_assoc();
  $total_products = $total_products_row['total'];
  $total_pages = ceil($total_products / $limit);
    
}}
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
        if (isset($_SESSION['product_details_success'])) {
          echo $_SESSION['product_details_success'] ;
          unset($_SESSION['product_details_success']);
        }
        if (isset($_SESSION['product_details_edit'])) {
          echo $_SESSION['product_details_edit'] ;
          unset($_SESSION['product_details_edit']);
        }
      ?>
      </div>
        <div class="heading">
          <h1>Product Details</h1>
          <a href="add_details.php">Add</a>
        </div>
        <table class="table-contant">
          <thead class="table-head">
            <tr>
              <th>Product Name</th>
              <th>Description</th>
              <th>weight</th>
              <th>origin</th>
              <th>Quality</th>
              <th></th>
              <th></th>
            </tr>
          </thead>
          <tbody class="table-body">
            <?php while($rows = $result->fetch_assoc())
                    { 
                    ?>
            <tr>
              <td>
                <?= $rows['product_name'];?>
              </td>
              <td>
                <?= $rows['description'];?>
              </td>
              <td>
                  <?= $rows['weight']; ?>
              </td>
              <td>
                <?= $rows['origin']?>
              </td>
              <td>
                <?= $rows['quality'];?>
              </td>
              <td><a href="edit_details.php?id=<?= $rows['id'];?>" class="edit_and_delete">Edit</a></td>
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
  <!-- <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script> -->
  <script>
    function archiveFunction(event, productid) {
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
            url: "product_details.php",
            data: { delete: true, id: productid },
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
