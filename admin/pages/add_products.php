<?php
session_start();

if (!isset($_SESSION['userdetails'])) {
  header('Location: sign-in.php');
  exit();
}

include('connectmysql.php');

$categories = [];
$category_query = "SELECT id, c_name FROM category";
$result = $conn->query($category_query);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
        // print_r($categories);die;
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $p_name = $_POST['p_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $sale_price = $_POST['sale_price'];
    $stock_level = $_POST['stock_level'];
    $image = "";
    $errors = [];

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
    if (empty($category_id)) {
      $errors['category_id'] = "*Required*";
    } else {
      $errors['category_id'] = "";
    }
    if(empty($price)){
        $errors['price'] = "*Required*";
    }else {
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

    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
      $filename = $_FILES["image"]["name"];
        $target_dir = "../imgs/";
        $target_file = $target_dir . basename($filename);
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)){
            $image = $filename;
        }else{
            $errors = "*error in uploaded*";
        }
    }elseif(empty($image)){
        $errors['image'] = "*Required*";
    }else{
        $errors['image'] = "";
    }
    
    $errors = array_filter($errors);

    
    if(empty($errors)){
        $insert_product = "INSERT INTO product(category_id, p_name, description, price,sale_price, image, stock_level) VALUES ('$category_id', '$p_name', '$description', '$price', $sale_price, '$image', '$stock_level')";

        if($conn->query($insert_product) === TRUE){
            $_SESSION['product_success'] = "product added successfully";
            header("Location:products.php");
            exit();
        }else{
            echo "error :". $insert_product->error;
        }
    }
}
$conn->close();
include("navbar.php");
?>

  <div class="container-form">
    <section>
      <div class="container-sidenav">
        <?php include('sidenavbar.php')?>
      </div>
      <div class="container">
        <h1 class="text-secondary">ADD PRODUCTS</h1>
        <form action="add_products.php" class="form_data" method="post" novalidate enctype="multipart/form-data">
          <div>
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id">
              <option value="">Select Category</option>
              <?php foreach ($categories as $category): ?>
              <option <?= isset($_POST['category_id']) && $_POST['category_id'] == $category['id'] ? 'selected' : '' ?>  value="<?= $category['id']; ?>">
                <?= $category['c_name']; ?>
              </option>
              <?php endforeach; ?>
            </select>
            <span class="errors">
              <?= isset($errors['category_id']) ? $errors['category_id'] : ''; ?>
            </span>
          </div>
          <div>
            <label for="productname">Product Name</label>
            <input type="text" id="p_name" name="p_name" placeholder="Name" value= "<?= isset($p_name) ? htmlspecialchars($p_name) : ''; ?>">
            <scan class="errors">
              <?= isset($errors['p_name']) ? $errors['p_name']:'';?>
            </scan>
          </div>
          <div>
            <label for="description">Descripiton</label>
            <textarea name="description" id="description" placeholder="description"><?= isset($description) ? htmlspecialchars($description) : ''; ?></textarea>
            <scan class="errors">
              <?= isset($errors['description']) ? $errors['description']:'';?>
            </scan>
          </div>
          <div>
            <label for="price">Price</label>
            <input type="number" name="price" id="price" placeholder="Price" value= "<?= isset($price) ? htmlspecialchars($price) : ''; ?>">
            <scan class="errors" value="<?= isset($price) ? htmlspecialchars($price) : ''; ?>">
              <?= isset($errors['price']) ? $errors['price']:'';?>
            </scan>
          </div>
          <div>
          <label for="price">Sale Price</label>
          <input type="number" name="sale_price" placeholder="Sale Price" value= "<?= isset($sale_price) ? htmlspecialchars($sale_price) : ''; ?>">
          <scan class="errors" value="<?= isset($sale_price) ? htmlspecialchars($sale_price) : ''; ?>">
              <?= isset($errors['sale_price']) ? $errors['sale_price']:'';?>
          </scan>
          </div>
          <div>
          <label for="price">stock Level</label>
          <input type="number" name="stock_level" placeholder="stock level" value= "<?= isset($stock_level) ? htmlspecialchars($stock_level) : ''; ?>">
          <scan class="errors" value="<?= isset($stock_level) ? htmlspecialchars($stock_level) : ''; ?>">
              <?= isset($errors['stock_level']) ? $errors['stock_level']:'';?>
          </scan>
          </div>
          <div>
            <label for="image">Upload Image:</label>           
            <input type="file" name="image" id="image" value="<?= isset($image) ? htmlspecialchars($image) : ''; ?>">
            
            <scan class="errors">
              <?= isset($errors['image']) ? $errors['image']:'';?>
            </scan>
          </div>
          <div>
            <input type="submit" value="submit">
          </div>
        </form>
      </div>
    </section>
  </div>
</body>

</html>