<?php
include('header.php'); 

$sales_product_query = "SELECT product.*, category.c_name AS category_name,
(SELECT AVG(rating) FROM review_table WHERE product_id = product.id) AS avg_rating
FROM product 
INNER JOIN category ON product.category_id = category.id 
WHERE product.sale_price IS NOT NULL LIMIT 5";
$sales_product_result = $conn->query($sales_product_query);

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $userName = $_POST['userName'];
    $email = $_POST['email']; 
    $review = $_POST['review'];
    $product_id = $_POST['product_id'];
    $rating = $_POST['rating']; 
    $pattern = "/^[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/";
    $errors = [];

    if(empty($userName)){
        $errors['userName'] = "*required*";
    }elseif($userName == " " || $userName < 2){
        $errors['userName'] = "*Enter correct name*";
    }else{
        $errors['userName'] = "";
    }

    if(empty($email)){
        $errors['email'] = "*required*";
    }elseif(!preg_match($pattern,$email)){
        $errors['email'] = "*Enter valid email*";
    }else{
        $errors['email'] = "";
    }

    if(empty($review)){
        $errors['review'] = "*required*";
    }else{
        $errors['review'] = "";
    }
    
    if (empty($rating) || $rating < 1 || $rating > 5) {
        $errors['rating'] = "*required*";
    }

    $errors = array_filter($errors);
    
    if(empty($errors)){
        $reviews = "INSERT INTO review_table(product_id, userName, email, review, rating)
        VALUES ('$product_id', '$userName', '$email','$review', '$rating')";
        // print_r($reviews);die;
        if($conn->query($reviews) === TRUE){
            echo "review submitted";
            header("Location:shop.php");
            exit();
        }else{
            echo "error :" . $reviews->error;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET"){
    $product_id = isset($_GET['id'])? ($_GET['id']): NULL;

    $category_name = "SELECT category.c_name, category.id, COUNT(product.category_id) AS product_count FROM category 
    LEFT JOIN product ON category.id = product.category_id
    GROUP BY category.id";
    $result = $conn->query($category_name);

    if($product_id){
    $product_detailts = "SELECT product.*, category.c_name AS category_name,
    (SELECT AVG(rating) FROM review_table WHERE product_id = product.id) AS avg_rating
    FROM product 
    INNER JOIN category ON product.category_id = category.id where product.id = $product_id";
    $product_result = $conn->query($product_detailts);
    // $rows = $product_result->fetch_assoc();
    }
    
    if($product_id){
        $related_details = "SELECT product.*, category.c_name AS category_name FROM product 
        INNER JOIN category ON product.category_id = category.id";
        $related_details_result = $conn->query($related_details);
    }
    $all_details = "SELECT details.*, product.id FROM details INNER JOIN product ON details.product_id = product.id WHERE product.id = $product_id";
    $all_details_result = $conn->query($all_details);

    $review_details = "SELECT * FROM review_table WHERE product_id = $product_id";
    $review_show = $conn->query($review_details);
    // print_r($all_details_rows);die;
    // print_r($rows);die;
}   

$conn->close();
?>
<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Shop Detail</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Shop Detail</li>
    </ol>
</div>
<!-- Single Page Header End -->


<!-- Single Product Start -->
<div class="container-fluid py-5 mt-5">
    <div class="container py-5">
        <div class="row g-4 mb-5">
            <div class="col-lg-8 col-xl-9">
                <div class="row g-4">
                    <?php
                    if($product_result->num_rows > 0){
                        while($rows = $product_result->fetch_assoc()){
                            $averageRating = round($rows['avg_rating']);
                    ?>
                    <div class="col-lg-6">
                        <div class="border rounded">
                            <a href="../admin/imgs/<?= $rows['image'];?>">
                                <img class="img-fluid w-100 rounded-top" id="product-images"
                                    src="../admin/imgs/<?= $rows['image'];?>" alt="<?= $rows['p_name']; ?>">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h4 class="fw-bold mb-3">
                            <?=$rows['p_name']?>
                        </h4>
                        <p class="mb-3">Category:
                            <?=$rows['category_name']?>
                        </p>
                        <?php if (!empty($rows['sale_price'])): ?>
                            <h5 style="margin-bottom:0px;" class="fw-bold"> &#8377 <?= $rows['sale_price']; ?></h5>
                            <h5 class="text-danger text-decoration-line-through fw-bold"> &#8377 <?= $rows['price']; ?></h5>
                            <?php else: ?>
                                &#8377 <?= $rows['price']; ?>
                            <?php endif; ?>
                        <div class="d-flex mb-4">
                        <?php
                            for ($i = 1; $i <= 5; $i++) {
                                if ($i <= $averageRating) {
                                    echo '<i class="fa fa-star text-secondary"></i>';
                                } else {
                                    echo '<i class="fa fa-star text-muted"></i>';
                                }
                            }
                        ?>
                        </div>
                        <p class="mb-4">
                            <?=$rows['description']?>
                        </p>
                        <p class="mb-4">
                            <?=$rows['description']?>
                        </p>
                        <div class="input-group quantity mb-5" style="width: 100px;">
                            <div class="input-group-btn">
                                <button class="btn btn-sm btn-minus rounded-circle bg-light border">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control form-control-sm text-center border-0" value="1" style="margin:0px;">
                            <div class="input-group-btn">
                                <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <?php 
                            if($rows['stock_level'] > 0){
                        ?>                
                        <button data-product-id="<?= $rows['id']; ?>" type="button"
                            class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary"
                            id="add_to_cart">
                            <i class="fa fa-shopping-bag me-2 text-primary"></i>Add to cart
                        </button>
                        <?php
                            }else{
                        ?>
                        <button type="button" style="margin:-30px;" name="not_in_stock" class=" btn px-4 py-2 mb-4" id = "not_in_stock"><i class="fa fa-close" style="color:red"></i> Not in Stock</button>
                        <?php
                            }
                        ?>
                    </div>
                    <?php
                        }
                        }
                    ?>
                    <div class="col-lg-12">
                        <nav>
                            <div class="nav nav-tabs mb-3">
                                <button class="nav-link active border-white border-bottom-0" type="button" role="tab"
                                    id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about"
                                    aria-controls="nav-about" aria-selected="true">Description</button>
                                <button class="nav-link border-white border-bottom-0" type="button" role="tab"
                                    id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission"
                                    aria-controls="nav-mission" aria-selected="false">Reviews</button>
                            </div>
                        </nav>
                        <div class="tab-content mb-5">
                            <?php
                                if($all_details_result->num_rows > 0){
                                    while($all_details_rows = $all_details_result->fetch_assoc()){
                            ?>
                            <div class="tab-pane active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                                <p>
                                    <?= $all_details_rows['description']?>
                                </p>
                                <div class="px-2">
                                    <div class="row g-4">
                                        <div class="col-6">
                                            <div
                                                class="row bg-light align-items-center text-center justify-content-center py-2">
                                                <div class="col-6">
                                                    <p class="mb-0">Weight</p>
                                                </div>
                                                <div class="col-6">
                                                    <p class="mb-0">
                                                        <?= $all_details_rows['weight']?>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row text-center align-items-center justify-content-center py-2">
                                                <div class="col-6">
                                                    <p class="mb-0">Country of Origin</p>
                                                </div>
                                                <div class="col-6">
                                                    <p class="mb-0">
                                                        <?= $all_details_rows['origin']?>
                                                    </p>
                                                </div>
                                            </div>
                                            <div
                                                class="row bg-light text-center align-items-center justify-content-center py-2">
                                                <div class="col-6">
                                                    <p class="mb-0">Quality</p>
                                                </div>
                                                <div class="col-6">
                                                    <p class="mb-0">
                                                        <?= $all_details_rows['quality']?>
                                                    </p>
                                                </div>
                                            </div>
                                            <div
                                                class="row text-center align-items-center justify-content-center py-2">
                                                <div class="col-6">
                                                    <p class="mb-0">Min Weight</p>
                                                </div>
                                                <div class="col-6">
                                                    <p class="mb-0">
                                                        <?= $all_details_rows['min_weight']?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                                    }
                                }else{
                                    echo "details are not available!!!";
                                }
                            ?>
                            <div class="tab-pane" id="nav-mission" role="tabpanel" aria-labelledby="nav-mission-tab">
                                <?php 
                                if($review_show->num_rows > 0){
                                while($review_rows = $review_show->fetch_assoc()){
                                ?>
                                <div class="d-flex">
                                    <img src="../asset/img/avatar.jpg" class="img-fluid rounded-circle p-3"
                                        style="width: 100px; height: 100px;" alt="">
                                    <div class="">
                                        <p class="mb-2" style="font-size: 14px;">
                                            <?=$review_rows['date']?>
                                        </p>
                                        <div class="d-flex justify-content-between">
                                            <h5>
                                                <?=$review_rows['userName']?>
                                            </h5>
                                            <div class="d-flex mb-3">
                                                <?php
                                                for ($i = 1; $i <= 5; $i++) {
                                                    if ($i <= $review_rows['rating']) {
                                                        echo '<i class="fa fa-star text-secondary"></i>';
                                                    } else {
                                                        echo '<i class="fa fa-star text-muted"></i>';
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <p>
                                            <?=$review_rows['review']?>
                                        </p>
                                    </div>
                                </div>
                                <?php
                                } 
                            }else{
                                    echo "No reviews are available!!!!";
                                }
                                ?>
                            </div>
                            <div class="tab-pane" id="nav-vision" role="tabpanel">
                                <p class="text-dark">Tempor erat elitr rebum at clita. Diam dolor diam ipsum et tempor
                                    sit. Aliqu diam
                                    amet diam et eos labore. 3</p>
                                <p class="mb-0">Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam et eos labore.
                                    Clita erat ipsum et lorem et sit</p>
                            </div>
                        </div>
                    </div>
                    <form action="shopdetails.php" method="post" novalidation id="review_form">
                        <input type="hidden" name="product_id" value="<?= htmlspecialchars($product_id); ?>">
                        <input type="hidden" name="rating" id="rating" value="0">
                        <h4 class="mb-5 fw-bold">Leave a Reply</h4>
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="border-bottom rounded">
                                    <input type="text" name="userName" class="form-control border-0 me-4"
                                        placeholder="Your Name *"
                                        value="<?= isset($userName) ? htmlspecialchars($userName) : '' ?>">
                                    <span class="errors">
                                        <?=isset($errors['userName'])? $errors['userName']:''; ?>
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="border-bottom rounded">
                                    <input type="email" name="email" class="form-control border-0"
                                        placeholder="Your Email *"
                                        value="<?= isset($email) ? htmlspecialchars($email) : '' ?>">
                                    <span class="errors">
                                        <?=isset($errors['email'])? $errors['email']:''; ?>
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="border-bottom rounded my-4">
                                    <textarea name="review" id="" class="form-control border-0" cols="30" rows="8"
                                        placeholder="Your Review *"
                                        spellcheck="false"><?= isset($review) ? htmlspecialchars($review) : '' ?></textarea>
                                    <span class="errors">
                                        <?=isset($errors['review'])? $errors['review']:''; ?>
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-12">
                            <div class="d-flex justify-content-between py-3 mb-5">
                                <div class="d-flex align-items-center">
                                    <p class="mb-0 me-3">Please rate:</p>
                                    <div class="d-flex align-items-center" style="font-size: 12px;">
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <i class="fa fa-star text-muted" data-rating="<?= $i ?>"></i>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                                <input type="submit" value="Post Comment" class="btn border border-secondary text-primary rounded-pill px-4 py-3">
                            </div>
                          </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4 col-xl-3">
                <div class="row g-4 fruite">
                    <div class="col-lg-12">
                        <div class="mb-4">
                            <h4>Categories</h4>
                            <?php
                                while($row = $result->fetch_assoc()){
                            ?>
                            <ul class="list-unstyled fruite-categorie">
                                <li>
                                    <div class="d-flex justify-content-between fruite-name">
                                        <a href="shop.php?category_id=<?= $row['id']; ?>">
                                            <?=$row['c_name']?>
                                        </a>
                                        <span>
                                            <?=$row['product_count']?>
                                        </span>
                                    </div>
                                </li>
                            </ul>
                            <?php
                                }
                            ?>

                        </div>
                    </div>
                    <div class="col-lg-12">
                        <h4 class="mb-4">Featured products</h4>
                        <?php
                        if ($sales_product_result->num_rows > 0) { 
                            while($sales_row = $sales_product_result->fetch_assoc()) {
                                $averageRating = round($sales_row['avg_rating']);
                        ?>
                        <div class="d-flex align-items-center justify-content-start"> 
                            <div class="rounded" style="width: 100px; height: 100px;">
                            <img class="rounded me-4" style="width: 90px; height: 80px;" src="../admin/imgs/<?= $sales_row[ 'image'];?>"
                            alt="<?= $sales_row['p_name']; ?>" >
                            </div>
                            <div>
                                <h6 class="mb-2"><?= $sales_row['p_name']; ?></h6>
                                <div class="d-flex mb-2">
                                <?php
                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($i <= $averageRating) {
                                            echo '<i class="fa fa-star text-secondary"></i>';
                                        } else {
                                            echo '<i class="fa fa-star text-muted"></i>';
                                        }
                                    }
                                ?>
                                </div>
                                <div class="d-flex mb-2">
                                    <?php if (!empty($sales_row['sale_price'])): ?>
                                    <h5 class="fw-bold me-2"> &#8377 <?= $sales_row['sale_price']; ?></h5>
                                    <h5 class="text-danger text-decoration-line-through"> &#8377 <?= $sales_row['price']; ?></h5>
                                    <?php else: ?>
                                    &#8377 <?= $sales_row['price']; ?>
                                    <?php endif; ?></h5>
                                </div>
                            </div>
                        </div>
                        <?php
                            }
                        }else{
                            echo "Currently No sale is available!!";
                        }
                        ?>
                        <div class="d-flex justify-content-center my-4">
                            <button type="button" onclick="showSales()"
                                class="btn border border-secondary px-4 py-3 rounded-pill text-primary w-100">View
                                More</a>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="position-relative">
                            <img src="../asset/img/banner-fruits.jpg" class="img-fluid w-100 rounded" alt="">
                            <div class="position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%);">
                                <h3 class="text-secondary fw-bold">Fresh <br> Fruits <br> Banner</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h1 class="fw-bold mb-0">Related products</h1>
        <?php
        include("related_products.php");
        ?>
    </div>
</div>
<!-- Single Product End -->
<?php
        
    include('footer.php');
    
?>