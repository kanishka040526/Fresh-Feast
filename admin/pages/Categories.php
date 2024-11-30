<?php
session_start();

if (!isset($_SESSION['userdetails'])) {
  header('Location: sign-in.php');
  exit();
}

include('connectmysql.php');
 
if($_SERVER["REQUEST_METHOD"] = "POST"){
  if (isset($_POST['delete']) && isset($_POST['id'])) {
    $category_id = $_POST['id'];
    $delete = "DELETE FROM category WHERE id = ?";
    $sql = $conn->prepare($delete);
    $sql->bind_param('i', $category_id);
    if ($sql->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $sql->error]);
    }
    exit; 
  }
  else{
    $sql = "SELECT * FROM category ORDER BY id DESC";
    $result = $conn->query($sql);
  }
  
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
          if (isset($_SESSION['category_success'])) {
            echo $_SESSION['category_success'] ;
            unset($_SESSION['category_success']);
          }
          if (isset($_SESSION['edit_category_success'])) {
            echo $_SESSION['edit_category_success'] ;
            unset($_SESSION['edit_category_success']);
          }
        ?>
      </div>
        <div class="heading">
          <h1>Categories</h1>
          <a href="add_categories.php">Add</a>
        </div>
        <table class="table-contant">
          <thead class="table-head">
            <tr>
              <th>Image</th>
              <th>Name</th>
              <th>Description</th>
              <th></th>
              <th></th>
            </tr>
          </thead>
          <tbody class="table-body">
            <?php 
            while($rows = $result->fetch_assoc())
                    { 
                    ?>
            <tr>
              <td>
                <img class="output_image" src="../imgs/<?= $rows['image'];?>" alt="<?= $rows['c_name'];?>">
              </td>
              <td>
                <?= $rows['c_name'];?>
              </td>
              <td>
                <?= $rows['description'];?>
              </td>
              <td>
                <a href="edit.php?id=<?= $rows['id'];?>" class="edit_and_delete">Edit</a>
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
    function archiveFunction(event, categoryid) {
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
          jQuery.ajax({
            type: "POST",
            url: "categories.php",
            data: { delete: true, id: categoryid},
            success: function(response) {
              // console.log(response);
              var data = JSON.parse(response);
              // console.log(response);
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