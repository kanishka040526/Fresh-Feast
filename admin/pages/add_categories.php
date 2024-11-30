<?php
session_start();
include('connectmysql.php');

if (!isset($_SESSION['userdetails'])) {
  header('Location: sign-in.php');
  exit();
}
else{
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $image = "";
    $c_name = $_POST['c_name'];
    $description = $_POST['description'];
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
    }elseif(empty($image)){
        $errors['image'] = "*Required*";
    }else{
        $errors['image'] = "";
    }

    if(empty($c_name)){
        $errors['c_name'] = "*Required*";
    }else{
        $errors['c_name'] = "";
    }
    if(empty($description)){
        $errors['description'] = "*Required*";
    }else{
        $errors['description'] = "";
    }
    $errors = array_filter($errors);

    
    if(empty($errors)){
        $insert_categories = "INSERT INTO category(image, c_name, description) VALUES ('$image','$c_name', '$description')";

        if($conn->query($insert_categories) === TRUE){
          $_SESSION['category_success'] = "Added successfully";
            header("Location:categories.php");
            exit();
        }else{
            echo "error :". $insert_categories->error;
        }
    }
}}
$conn->close();
include("navbar.php");
?>

  <div class="container-form">
    <section>
      <div class="container-sidenav">
        <?php include('sidenavbar.php')?>
      </div> 
      <div class="container">
        <h1 class="text-secondary">ADD CATEGORIES</h1>
        <form action="add_categories.php" class="form_data" method="post" novalidate enctype="multipart/form-data">
        <div>
          <label for="category name">category Name</label>
          <input type="text" id="c_name" name="c_name" placeholder="Name" value="<?= isset($c_name) ? htmlspecialchars($c_name) : ''; ?>">
          <scan class="errors">
            <?= isset($errors['c_name']) ? $errors['c_name']:'';?>
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
          <label for="image">Upload Image:</label>
          <input type="file" name="image" id="image">
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