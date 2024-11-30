<?php
include("header.php"); 

$user_id =  isset($_SESSION['users']) ? $_SESSION['users']: NULL; 

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $limit = 8;
    $category_id = isset($_GET['category_id'])? ($_GET['category_id']): NULL;
    $search = isset($_GET['search'])? ($_GET['search']): NULL;
    
    $category_name = "SELECT category.* FROM category
    LEFT JOIN product ON category.id = product.category_id
    GROUP BY category.id";
    $category_result = $conn->query($category_name);

    
    $category_query = "SELECT category.* FROM category
    LEFT JOIN product ON category.id = product.category_id
    GROUP BY category.id";
    $result = $conn->query($category_query);

    $search_query = "";
    if (!empty($search)) {
        $search = $conn->real_escape_string($search);
        $search_query = "AND (product.p_name LIKE '%$search%' OR product.description LIKE '%$search%' OR category.c_name LIKE '%$search%')";
    }

    if(!empty($category_id)){
        $product_detailts = "SELECT product.*, category.c_name AS category_name FROM product 
          INNER JOIN category ON product.category_id = category.id
          where category.id = $category_id LIMIT $limit";      
          // print_r($product_detailts);die;

    }else{
        $product_detailts = "SELECT product.*, category.c_name AS category_name FROM product
        INNER JOIN category ON product.category_id = category.id WHERE 1=1 LIMIT $limit";       
    }
    // print_r($product_detailts);
      $product_result = $conn->query($product_detailts); 

      $bestseller_details = "SELECT * FROM product LIMIT 6";
      $bestseller_result = $conn->query($bestseller_details);

    $related_details = "SELECT product.*, category.c_name AS category_name 
    FROM product 
    INNER JOIN category ON product.category_id = category.id where category.id = 6";
    $related_details_result = $conn->query($related_details);

    $users = "SELECT COUNT(id) as total_users FROM user";
    $user_details = $conn->query($users);

    $total_product = "SELECT SUM(stock_level) AS total_stock_products FROM product";
    $total_product_result = $conn->query($total_product);
}
$conn->close();
?>
<!-- Hero Start -->
<div class="container-fluid py-5 mb-5 hero-header">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-md-12 col-lg-7">
                <h4 class="mb-3 text-secondary">100% Organic Foods</h4>
                <h1 class="mb-5 display-3 text-primary">Organic Veggies & Fruits Foods</h1>
                <form method="GET" action="shop.php" class="position-relative mx-auto">
                    <input class="form-control border-2 border-secondary w-75 py-3 px-4 rounded-pill" type="search"
                        name="search" placeholder="Search" value="<?= htmlspecialchars($search) ?>">
                    <button type="submit"
                        class="btn btn-primary border-2 border-secondary py-3 px-4 position-absolute rounded-pill text-white h-100"
                        style="top: 0; right: 23%;">Submit Now</button>
                </form>
            </div>
            <div class="col-md-12 col-lg-5">
                <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        <?php
                        $i = 1;
                        while($category_row = $category_result->fetch_assoc()){
                        ?>
                        <div class="carousel-item <?= $i ==1 ? 'active' : '' ?>  rounded">
                            <img src="../admin/imgs/<?= $category_row['image']?>" class=" img-fluid bg-secondary rounded" style="width:510px; height:390px;"
                                alt="First slide">
                            <a href="shop.php?category_id=<?= $category_row['id']?>" class="btn px-4 py-2 text-white rounded"><?= $category_row['c_name']?></a>
                        </div>
                        <?php
                        $i++;
                        }
                        ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselId"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselId"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Hero End -->


<!-- Featurs Section Start -->
<div class="container-fluid featurs py-5">
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="featurs-item text-center rounded bg-light p-4">
                    <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                        <i class="fas fa-car-side fa-3x text-white"></i>
                    </div>
                    <div class="featurs-content text-center">
                        <h5>Free Shipping</h5>
                        <p class="mb-0">Free on order over &#8377 500</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="featurs-item text-center rounded bg-light p-4">
                    <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                        <i class="fas fa-user-shield fa-3x text-white"></i>
                    </div>
                    <div class="featurs-content text-center">
                        <h5>Security Payment</h5>
                        <p class="mb-0">100% security payment</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="featurs-item text-center rounded bg-light p-4">
                    <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                        <i class="fas fa-exchange-alt fa-3x text-white"></i>
                    </div>
                    <div class="featurs-content text-center">
                        <h5>30 Day Return</h5>
                        <p class="mb-0">30 day money guarantee</p>
                    </div>
                </div> 
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="featurs-item text-center rounded bg-light p-4">
                    <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                        <i class="fa fa-phone-alt fa-3x text-white"></i>
                    </div>
                    <div class="featurs-content text-center">
                        <h5>24/7 Support</h5>
                        <p class="mb-0">Support every time fast</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Featurs Section End -->


<!-- Fruits Shop Start-->
<div class="container-fluid fruite py-5">
    <div class="container py-5">
        <div class="tab-class text-center">
            <div class="row g-4">
                <div class="col-lg-4 text-start">
                    <h1>Our Organic Products</h1>
                </div>
                <div class="col-lg-8 text-end">
                    <ul class="nav nav-pills d-inline-flex text-center mb-5">
                        <li class="nav-item">
                            <div>
                                <a class="d-flex py-2 m-2 bg-light rounded-pill text-dark" id="index-category"
                                    style="width: 130px; padding-left:25px;" href="?category_id=<?= $row['id'] = NULL; ?>">
                                    All Product
                                </a>
                            </div>                            
                        </li>
                        <?php
                                while($row = $result->fetch_assoc()){?>
                        <li class="nav-item">
                            <div>
                                <a class="d-flex py-2 m-2 bg-light rounded-pill text-dark"
                                style="width: 130px; padding-left:25px;" href="?category_id=<?= $row['id']; ?>">
                                <?= $row['c_name'];?>
                                </a>
                            </div>
                        </li>
                        <?php
                                }
                                ?>
                    </ul>
                </div>
            </div>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="row g-4">
                                <?php
                                        if($product_result->num_rows > 0){
                                            while($rows = $product_result->fetch_assoc()){ 
                                        ?>
                                <div class="col-md-6 col-lg-6 col-xl-3">
                                    <?php 
                                        include("product_containers.php");
                                        ?>
                                    <?php
                                            }
                                        }else{
                                          echo "No Results found!!!";
                                        }
                                        ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fruits Shop End-->


    <!-- Featurs Start -->
    <div class="container-fluid service py-5">
        <div class="container py-5">
            <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <a href="shop.php?category_id=8">
                        <div class="service-item bg-secondary rounded border border-secondary">
                            <img src="../asset/img/download.jpeg" style="height: 330px;" class="img-fluid rounded-top w-100" alt="">
                            <div class="px-4 rounded-bottom">
                                <div class="service-content bg-primary text-center p-4 rounded">
                                    <h5 class="text-white">Multi Vitamin</h5>
                                    <h3 class="mb-0">Grains</h3>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4">
                    <a href="shop.php?category_id=7">
                        <div class="service-item bg-dark rounded border border-dark">
                            <img src="../asset/img/featur-2.jpg" class="img-fluid rounded-top w-100" alt="">
                            <div class="px-4 rounded-bottom">
                                <div class="service-content bg-light text-center p-4 rounded">
                                    <h5 class="text-primary">Tasty Fruits</h5>
                                    <h3 class="mb-0">Free delivery</h3>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4">
                    <a href="shop.php?category_id=6">
                        <div class="service-item bg-primary rounded border border-primary">
                            <img src="../asset/img/featur-3.jpg" class="img-fluid rounded-top w-100" alt="">
                            <div class="px-4 rounded-bottom">
                                <div class="service-content bg-secondary text-center p-4 rounded">
                                    <h5 class="text-white">Healthy Veggies</h5>
                                    <h3 class="mb-0">shop here</h3>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Featurs End -->


    <!-- Vesitable Shop Start-->

    <div class="container-fluid vesitable py-5">
        <div class="container py-5">
            <h1 class="fw-bold mb-0">Fresh Organic Vegetables</h1>
            <?php   
                include("related_products.php");
                ?>
        </div>
    </div>
    <!-- Vesitable Shop End -->


    <!-- Banner Section Start-->
    <div class="container-fluid banner bg-secondary my-5">
        <div class="container py-5">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6">
                    <div class="py-4">
                        <h1 class="display-3 text-white">Fresh Exotic Fruits</h1>
                        <p class="fw-normal display-3 text-dark mb-4">in Our Store</p>
                        <p class="mb-4 text-dark">The generated Lorem Ipsum is therefore always free from repetition
                            injected humour, or non-characteristic words etc.</p>
                        <a href="shop.php?category_id=7"
                            class="banner-btn btn border-2 border-white rounded-pill text-dark py-3 px-5">BUY</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="position-relative">
                        <img src="../asset/img/baner-1.png" class="img-fluid w-100 rounded" alt="">
                        <div class="d-flex align-items-center justify-content-center bg-white rounded-circle position-absolute"
                            style="width: 140px; height: 140px; top: 0; left: 0;">
                            <h1 style="font-size: 100px;">1</h1>
                            <div class="d-flex flex-column">
                                <span class="h2 mb-0"> &#8377 200</span>
                                <span class="h4 text-muted mb-0">kg</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner Section End -->


    <!-- Bestsaler Product Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5" style="max-width: 700px;">
                <h1 class="display-4">Bestseller Products</h1>
                <p>Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which
                    looks reasonable.</p>
            </div>
            <div class="row g-4">   
            <?php
            if($product_result->num_rows >0){
                    while($bestseller_row = $bestseller_result->fetch_assoc()){
            ?> 
                <div class="col-lg-6">
                    <div class="rounded bg-light">
                        <div class="row align-items-center">
                            <div class="p-4 col-6">
                                <img src="../admin/imgs/<?= $bestseller_row['image']?>" class="rounded-circle w-100" style="height: 250px;"
                                    alt="<?= $bestseller_row['p_name']?>">
                            </div>
                            <div class="col-6">
                                <a href="shopdetails.php?id=<?= $bestseller_row['id']?>" class="h5"><?= $bestseller_row['p_name']?></a>
                                <?php
                                if(isset($_SESSION['users'])){
                                ?>
                                <button wishlist-product-id="<?= $bestseller_row['id']; ?>" type="button" name="wishlist" class="" id = "wishlist" style="border: none; background: none;">
                                <i class='far fa-heart' style='font-size:24px;color:red; margin-left:140px;'></i>
                                </button>
                    
                                <?php
                                }else{
                                    echo "";
                                }
                                ?>
                                <div class="d-flex my-3">
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <?php if (!empty($bestseller_row['sale_price'])): ?>
                                <h4 class="sale-price"> &#8377 <?= $bestseller_row['sale_price']; ?></h4>
                                <h4 class="regular-price"> <?=$bestseller_row['price']?></h4>
                                <?php else: ?>
                                <h4 class="sale-price mb-3"> &#8377 <?= $bestseller_row['price']; ?></h4> <br>
                                <?php endif; ?>
                                <?php 
                                if($bestseller_row['stock_level'] > 0){
                                ?>
                                <button data-product-id="<?= $bestseller_row['id']; ?>" type="button" name="add_to_cart" class="btn border border-secondary rounded-pill px-3 text-primary" id = "add_to_cart">
                                <i class="fa fa-shopping-bag me-2"></i>Add to cart 
                                </button>
                                <?php
                                    }else{
                                ?>
                                <button name="not_in_stock" class="btn border px-3 " id = "not_in_stock"><i class="fa fa-close" style="color:red"></i> Not in Stock</button> 
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    }
                }else{
                    echo "no product are availble";
                }
                ?>
            </div>
        </div>
    </div>
    <!-- Bestsaler Product End -->


    <!-- Fact Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="bg-light p-5 rounded">
                <div class="row g-4 justify-content-center">
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="counter bg-white rounded p-5">
                            <i class="fa fa-users text-secondary"></i>
                            <h4>satisfied customers</h4>
                            <?php
                            while($user_row = $user_details->fetch_assoc()){
                            ?>
                            <h1><?= $user_row['total_users']?></h1>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="counter bg-white rounded p-5">
                            <i class="fa fa-users text-secondary"></i>
                            <h4>quality of service</h4>
                            <h1>99%</h1>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="counter bg-white rounded p-5">
                            <i class="fa fa-users text-secondary"></i>
                            <h4>quality certificates</h4>
                            <h1>33</h1>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="counter bg-white rounded p-5">
                            <i class="fa fa-users text-secondary"></i>
                            <h4>Available Products</h4>
                            <?php
                            if($total_product_result->num_rows > 0){
                                while($total_product_row = $total_product_result->fetch_assoc()){ 
                            ?>
                            <h1><?= $total_product_row['total_stock_products']?></h1>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fact Start -->

    <?php include("footer.php"); ?>