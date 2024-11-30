<?php
session_start();

if (!isset($_SESSION['userdetails'])) {
  header('Location: sign-in.php');
  exit();
}

include('connectmysql.php');

$product_id = isset($_GET['id'])? ($_GET['id']):"";

if($product_id){
    $sql = "SELECT * FROM details WHERE  id = ?";
    $sql = $conn->prepare($sql);
    $sql->bind_param('s', $product_id);
    $sql->execute();
    $result = $sql->get_result();
    $productdetails = $result->fetch_assoc();
    // print_r($productdetails);die;
} 

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $description = $_POST['description'];
    $weight = $_POST['weight'];
    $origin = $_POST['origin'];
    $quality = $_POST['quality'];
    $errors = [];

    if(empty($description)){
        $errors['description'] = "*Required*";
    }else{
        $errors['description'] = "";
    }
    if(empty($weight)){
        $errors['weight'] = "*Required*";
    }else{
        $errors['weight'] = "";
    }
    if(empty($origin)){
      $errors['origin'] = "*Required*";
    }else{
      $errors['origin'] = "";
    }
    if(empty($quality)){
     $errors['quality'] = "*Required*";
  }else{
    $errors['quality'] = "";
  }
    $errors = array_filter($errors);
    if(empty($errors) &&  isset($_POST['update'])){

        $update = "UPDATE details SET description = ?, weight = ?, origin = ?, quality = ?  WHERE id = ?";
        $sql = $conn->prepare($update);
        $sql->bind_param('ssssi', $description, $weight, $origin, $quality, $product_id);       
        if($sql->execute()){
            $_SESSION['product_details_edit'] = "successfully Updated";
            header("Location:product_details.php");
            exit();
        }else {
        echo "Error: " . $sql->error;
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
        <h1 class="text-secondary">Update Product Details</h1>
        <form action="" class="form_data" method="post" novalidate enctype="multipart/form-data">
          <div>
            <label for="Price">weight</label>
            <input type="text" id="weight" name="weight" placeholder="weight"
              value="<?= isset($productdetails['weight']) ? htmlspecialchars($productdetails['weight']):'';?>">
            <scan class="errors">
              <?= isset($errors['weight']) ? $errors['weight']:'';?>
            </scan>
          </div>
          <div>
            <label for="sale Price">Origin</label>
            <input type="text" id="origin" name="origin" placeholder="origin"
              value="<?= isset($productdetails['origin']) ? htmlspecialchars($productdetails['origin']):'';?>">
            <scan class="errors">
              <?= isset($errors['origin']) ? $errors['origin']:'';?>
            </scan>
          </div>
          <div>
            <label for="Stock level">Quality</label>
            <input type="text" id="quality" name="quality" placeholder="Stock level"
              value="<?= isset($productdetails['quality']) ? htmlspecialchars($productdetails['quality']):'';?>">
            <scan class="errors">
              <?= isset($errors['quality']) ? $errors['quality']:'';?>
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
          <div class="update_delete">
            <input type="submit" name="update" value="update">
          </div>
        </form>
      </div>
    </section>
  </div>
</body>

</html>