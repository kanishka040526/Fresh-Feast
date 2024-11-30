<?php
session_start();

if (!isset($_SESSION['userdetails'])) {
    header('Location: sign-in.php');
    exit();
}

include('connectmysql.php');

$products = [];
$product_query = "SELECT id, p_name FROM product";
$result = $conn->query($product_query);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
        // print_r($products);die;
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $description = $_POST['description'];
    $weight = $_POST['weight'];
    $origin = $_POST['origin'];
    $min_weight = $_POST['min_weight'];
    $quality = $_POST['quality'];
    $product_id = $_POST['product_id'];
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

    if (empty($origin)) {
      $errors['origin'] = "*Required*";
    } else {
      $errors['origin'] = "";
    }

    if(empty($min_weight)){
        $errors['min_weight'] = "*Required*";
    }else {
        $errors['min_weight'] = "";
      }

    if(empty($quality)){
        $errors['quality'] = "*Required*";
    }else {
        $errors['quality'] = "";
      }

    if(empty($product_id)){
        $errors['product_id'] = "*Required*";
    }else {
        $errors['product_id'] = "";
      }
    
    $errors = array_filter($errors);
    // print_r($errors);die;
    if(empty($errors)){ 
        $insert_details = "INSERT INTO details(product_id, description, weight, origin, quality, min_weight) VALUES('$product_id', '$description', '$weight', '$origin', '$quality', '$min_weight')";
        
        if($conn->query($insert_details) === TRUE){
            $_SESSION['product_details_success'] = "Details added successfully";
            header("Location:product_details.php");
            exit();
        }else{
            echo "Error: " . $conn->error;
        }
    }
}

$conn->close();
include("navbar.php");
?>

<body>
  <div class="container-categories">
    <section>
      <div class="container-sidenav">
        <?php include('sidenavbar.php')?>
      </div>
      <div class="container">
        <h1 class="text-secondary">ADD PRODUCT DETAILS</h1>
        <form action="add_details.php" class="form_data" method="post" novalidate>
            <div style="display: flex; justify-content: space-between; width: 870px;">
                <div>
                    <label for="product_id">Product</label>
                    <select name="product_id" id="product_id">
                        <option value="">select product</option>
                        <?php foreach ($products as $product): ?>
                            <option <?= isset($_POST['product_id']) && $_POST['product_id'] == $product['id'] ? 'selected' : '' ?>  value="<?= $product['id']; ?>">
                                <?= htmlspecialchars($product['p_name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <span class="errors">
                        <?= isset($errors['product_id']) ? $errors['product_id'] : ''; ?>
                    </span>
                </div>
                <div>
                    <label for="quality">Quality</label>
                    <input name="quality" id="quality" placeholder="quality.." value="<?= isset($quality) ? htmlspecialchars($quality) : '' ?>">
                    <span class="errors">
                        <?= isset($errors['quality']) ? $errors['quality'] : ''; ?>
                    </span>
                </div>
                <div>
                    <label for="min_weight">MIN-WEIGHT</label>
                    <input name="min_weight" id="min_weight" placeholder="minimum weight" value="<?= isset($min_weight) ? htmlspecialchars($min_weight) : '' ?>">
                    <span class="errors">
                        <?= isset($errors['min_weight']) ? $errors['min_weight'] : ''; ?>
                    </span>
                </div>
            </div>
            <div>
                <label for="description">Description</label>
                <textarea name="description" id="detail_description" placeholder="Description.."><?= isset($description)? htmlspecialchars($description):''?></textarea>
                <span class="errors">
                    <?= isset($errors['description']) ? $errors['description'] : ''; ?>
                </span>
            </div>       
            <div>
                <label for="weight">Weight</label>
                <input type="text" name="weight" id="weight" placeholder="Weigth.." value="<?= isset($weight) ? htmlspecialchars($weight):''?>">
                <span class="errors">
                    <?= isset($errors['weight']) ? $errors['weight'] : ''; ?>
                </span>
            </div>    
            <div>
                <label for="origin">Origin</label>
                <input type="text" name="origin" id="origin" placeholder="origin.." value="<?= isset($origin) ? htmlspecialchars($origin) : '' ?>">
                <span class="errors">
                    <?= isset($errors['origin']) ? $errors['origin'] : ''; ?>
                </span>
            </div>
            <div>
                <input type="submit" value="Submit">
            </div>
        </form>
      </div>
    </section>
  </div>
</body>

</html>

