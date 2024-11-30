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
      $product_id = $_POST['id'];
      $delete = "DELETE FROM product WHERE id = ?";
      $sql = $conn->prepare($delete);
      $sql->bind_param('i', $product_id);
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

  $sql = "SELECT product.*, category.c_name AS category_name 
  FROM product 
  INNER JOIN category ON product.category_id = category.id ORDER BY id DESC LIMIT $limit OFFSET $offset";
  $result = $conn->query($sql);

  $total_products_query = "SELECT COUNT(*) AS total FROM product";
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
        if (isset($_SESSION['product_success'])) {
          echo $_SESSION['product_success'] ;
          unset($_SESSION['product_success']);
        }
        if (isset($_SESSION['product_edit_success'])) {
          echo $_SESSION['product_edit_success'] ;
          unset($_SESSION['product_edit_success']);
        }
      ?>
      </div>
        <div class="heading">
          <h1>Products</h1>
          <a href="add_products.php">Add</a>
        </div>
        <table class="table-contant">
          <thead class="table-head">
            <tr>
              <th>Image</th>
              <th>Category</th>
              <th>Name</th>
              <th>Price</th>
              <th>Sale price</th>
              <th>Description</th>
            </tr>
          </thead>
          <tbody class="table-body">
            <?php while($rows = $result->fetch_assoc())
                    { 
                    ?>
            <tr>
              <td>
                <img class="output_image" src="../imgs/<?= $rows['image'];?>" alt="<?= $rows['p_name'];?>">
              </td>
              <td>
                <?= $rows['category_name'];?>
              </td>
              <td>
                <?= $rows['p_name'];?>
              </td>
              <td>
                  <?= $rows['price']; ?>
              </td>
              <td>
                <?= $rows['sale_price']?>
              </td>
              <td>
                <?= $rows['description'];?>
              </td>
              <td><a href="edit_product.php?id=<?= $rows['id'];?>" class="edit_and_delete">Edit</a></td>
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
            url: "products.php",
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
