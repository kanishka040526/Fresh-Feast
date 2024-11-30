<?php
    session_start();

    if (!isset($_SESSION['userdetails'])) {
        header('Location: sign-in.php');
        exit();
    }

    $productdetails = [];
    
    include('connectmysql.php');

    $category_id = isset($_GET['id']) ? ($_GET['id']) : "";

    if ($category_id) {
        
        $sql = "SELECT * FROM category WHERE id = ?";
        $sql = $conn->prepare($sql);
        $sql->bind_param("i", $category_id);
        $sql->execute();
        $result = $sql->get_result();
        $productdetails = $result->fetch_assoc();
        // print_r($productdetails);die;
    }
 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $c_name = $_POST['c_name'];
        $description = $_POST['description'];
        $image = isset($productdetails['image']) ? $productdetails['image'] : '';
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
        if(empty($c_name)){
            $errors['c_name'] = "*Required*";
        }else{
            $errors['c_name'] = "";
        }

        if (empty($description)) {
            $errors['description'] = "*Required*";
        }else {
            $errors['description'] = "";
        }

        $errors = array_filter($errors);

        if(empty($errors) &&  isset($_POST['update'])){

            $update = "UPDATE category SET c_name = ? , description = ?, image = ? WHERE id = ?";
            $sql = $conn->prepare($update);
            $sql->bind_param('sssi', $c_name, $description, $image, $category_id);
            $sql->execute();
           
            $result = $sql->get_result();
           
            if($sql->execute()){
                $_SESSION['edit_category_success'] = "successfully Updated";
                header("Location:categories.php");
                exit();
            }else {
            echo "Error: " . $sql->error;
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
        <h1 class="text-secondary">Update Categories</h1>
        <form action="" class="form_data" method="post" novalidate enctype="multipart/form-data">
            <div>
                <label for="category name">category Name</label>
                <input type="text" id="c_name" name="c_name" placeholder="Name" value="<?= isset($productdetails['c_name']) ? htmlspecialchars($productdetails['c_name']):'';?>">
                <scan class="errors_text">
                    <?= isset($errors['c_name']) ? $errors['c_name']:'';?>
                </scan>
            </div>
            <div>
                <label for="description">Descripiton</label>
                <textarea name="description" id="description" placeholder="description" ><?= isset($productdetails['description']) ? htmlspecialchars($productdetails['description']):'';?></textarea>
                <scan class="errors_text">
                    <?= isset($errors['description']) ? $errors['description']:'';?>
                </scan>
            </div>
            <div>
                <label for="image">Upload Image:</label>
                <img class="image_update" src="../imgs/<?= htmlspecialchars($productdetails['image']); ?>" alt="sorry"><br>
                <input type="file" name="image" id="image" value="">
                <scan class="errors_text">
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
