<?php
session_start();

if (!isset($_SESSION['userdetails'])) {
  header('Location: sign-in.php');
  exit();
}

include('connectmysql.php');

$product_id = isset($_GET['id'])? ($_GET['id']):"";

if($product_id){
    $sql = "SELECT * FROM product WHERE  id = ?";
    $sql = $conn->prepare($sql);
    $sql->bind_param('s', $product_id);
    $sql->execute();
    $result = $sql->get_result();
    $productdetails = $result->fetch_assoc();
    // print_r($productdetails);die;
} 

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $p_name = $_POST['p_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $sale_price = $_POST['sale_price'];
    $stock_level = $_POST['stock_level'];
    $image = isset($productdetails['image'])?($productdetails['image']):'';
    $errors = [];

    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
        $filename = $_FILES["image"]["name"];
        $target_dir = "../imgs/";
        $target_file = $target_dir . basename($filename);
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)){
            $image = $filename;
        }else{
            $errors = "*error in uploaded*";
        }
    }

    if(empty($p_name)){
        $errors['p_name'] = "*Required*";
    }else{
        $errors['p_name'] = "";
    }
    if(empty($description)){
        $errors['description'] = "*Required*";
    }else{
        $errors['description'] = "";
    }
    if(empty($price)){
        $errors['price'] = "*Required*";
    }else{
        $errors['price'] = "";
    }
    if(empty($sale_price)){
      $errors['sale_price'] = "*Required*";
    }else{
      $errors['sale_price'] = "";
    }
    if(empty($stock_level)){
     $errors['stock_level'] = "*Required*";
  }else{
    $errors['stock_level'] = "";
  }
    $errors = array_filter($errors);
    if(empty($errors) &&  isset($_POST['update'])){

        $update = "UPDATE product SET image = ?, p_name = ? , price = ?, description = ?, sale_price = ?, stock_level = ?  WHERE id = ?";
        $sql = $conn->prepare($update);
        $sql->bind_param('ssssssi', $image, $p_name, $price, $description, $product_id, $sale_price, $stock_level);
        $sql->execute();
       
        $result = $sql->get_result();
       
        if($sql->execute()){
            $_SESSION['product_edit_success'] = "successfully Updated";
            header("Location:products.php");
            exit();
        }else {
        echo "Error: " . $sql->error;
        }
    }
    if(isset($_POST['delete'])){
      
        $delete = "DELETE FROM product WHERE id = ?";
        $sql = $conn->prepare($delete);
        $sql->bind_param('s', $product_id);
        $sql->execute();

        if ($success) {
          echo json_encode(['status' => 'success']);
          exit();
        } else {
          echo json_encode(['status' => 'error', 'message' => $sql->error]);
          exit();
        }
    }
}
$conn->close();
include("navbar.php");
?>

  <div class="container-from">
    <section>
      <div class="container-sidenav">
        <?php include('sidenavbar.php')?>
      </div>
      <div class="container">
        <h1 class="text-secondary">Update Product</h1>
        <form action="" class="form_data" method="post" novalidate enctype="multipart/form-data">
          <div>
            <label for="product name">Product Name</label>
            <input type="text" id="p_name" name="p_name" placeholder="Name"
              value="<?= isset($productdetails['p_name']) ? htmlspecialchars($productdetails['p_name']):'';?>">
            <scan class="errors">
              <?= isset($errors['p_name']) ? $errors['p_name']:'';?>
            </scan>
          </div>
          <div>
            <label for="Price">Price</label>
            <input type="number" id="price" name="price" placeholder="price"
              value="<?= isset($productdetails['price']) ? htmlspecialchars($productdetails['price']):'';?>">
            <scan class="errors">
              <?= isset($errors['price']) ? $errors['price']:'';?>
            </scan>
          </div>
          <div>
            <label for="sale Price">Sale Price</label>
            <input type="number" id="sale_price" name="sale_price" placeholder="Sale price"
              value="<?= isset($productdetails['sale_price']) ? htmlspecialchars($productdetails['sale_price']):'';?>">
            <scan class="errors">
              <?= isset($errors['sale_price']) ? $errors['sale_price']:'';?>
            </scan>
          </div>
          <div>
            <label for="Stock level">Stock Price</label>
            <input type="number" id="stock_level" name="stock_level" placeholder="Stock level"
              value="<?= isset($productdetails['stock_level']) ? htmlspecialchars($productdetails['stock_level']):'';?>">
            <scan class="errors">
              <?= isset($errors['stock_level']) ? $errors['stock_level']:'';?>
            </scan>
          </div>
          <div>
            <label for="description">Descripiton</label>
            <textarea name="description" id="description"
              placeholder="description"><?= isset($productdetails['description']) ? htmlspecialchars($productdetails['description']):'';?></textarea>
            <scan class="errors">
              <?= isset($errors['description']) ? $errors['description']:'';?>
            </scan>
          </div>
          <div>
            <label for="image">Upload Image:</label>
            <img class="image_update" src="../imgs/<?= htmlspecialchars($productdetails['image']); ?>" alt="sorry"><br>
            <input type="file" name="image" id="image" value="">
            <scan class="errors">
              <?= isset($errors['image']) ? $errors['image']:'';?>
            </scan>
          </div>
          <div class="update_delete">
            <input type="submit" name="update" value="update">
          </div>
        </form>
      </div>
    </section>
  </div>
</body>

</html>