<?php
include('header.php'); 
$user_id =  isset($_SESSION['users']) ? $_SESSION['users']: NULL; 

if ($_SERVER["REQUEST_METHOD"] == "GET") {
 
    $limit = 9;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($page - 1) * $limit;
    $category_id = isset($_GET['category_id'])? ($_GET['category_id']): NULL; 
    $search = isset($_GET['search'])? ($_GET['search']): NULL;
    $price = isset($_GET['price'])? ($_GET['price']): 1000;
    $sales = isset($_GET['sales']) ? $_GET['sales'] : NULL;
    $brand_id = isset($_GET['brand_id']) ? $_GET['brand_id'] : NULL;

    $price_query = !empty($price) ? "AND product.price <= $price" : "";
    // print_r($price);

    $category_name = "SELECT category.id, category.c_name, COUNT(product.category_id) AS product_count FROM category
    LEFT JOIN product ON category.id = product.category_id
    GROUP BY category.id";
    $result = $conn->query($category_name);

    $brand_query = "SELECT brand.id, brand.brand_name FROM brand
    LEFT JOIN product ON brand.id = product.brand_id GROUP BY brand.id";
    $brand_result = $conn->query($brand_query);

    $search_query = "";
    if (!empty($search)) {
        $search = $conn->real_escape_string($search);
        $search_query = "AND (product.p_name LIKE '%$search%' OR product.description LIKE '%$search%' OR category.c_name LIKE '%$search%')";
    }

    $sales_query = "";
    if(!empty($sales)){
        $sales_query = "AND product.sale_price IS NOT NULL";
    }
    
    $brand_query = "";
    if (!empty($brand_id)) {
        $brand_query = "AND product.brand_id = $brand_id";
    }

    if(!empty($category_id)){
        $product_detailts = "SELECT product.*, category.c_name AS category_name 
          FROM product 
          INNER JOIN category ON product.category_id = category.id
          where category.id = $category_id $search_query $price_query $sales_query $brand_query LIMIT $limit OFFSET $offset";      
          // print_r($product_detailts);die;

    }else{
        $product_detailts = "SELECT product.*, category.c_name AS category_name 
          FROM product 
          INNER JOIN category ON product.category_id = category.id WHERE 1=1 $search_query $price_query $sales_query $brand_query LIMIT $limit OFFSET $offset";       
    }
    // print_r($product_detailts);
      $product_result = $conn->query($product_detailts); 
    //   print_r($product_result);die;

    if (!empty($category_id)) {
      $total_products_query = "SELECT COUNT(*) AS total FROM product WHERE category_id = $category_id $search_query $price_query $sales_query $brand_query";
    }  
    else{
      $total_products_query = "SELECT category.c_name, COUNT(*) AS total FROM product
        LEFT JOIN category
         ON product.category_id = category.id WHERE 1=1 $search_query $price_query $sales_query $brand_query";
      // print_r($total_products_query);die;
    }
    $sales_product_query = "SELECT product.*, category.c_name AS category_name,
    (SELECT AVG(rating) FROM review_table WHERE product_id = product.id) AS avg_rating
    FROM product 
    INNER JOIN category ON product.category_id = category.id 
    WHERE product.sale_price IS NOT NULL LIMIT 3";
    $sales_product_result = $conn->query($sales_product_query);

    $total_products_result = $conn->query($total_products_query);
    $total_products_row = $total_products_result->fetch_assoc();
    $total_products = $total_products_row['total'];
    $total_pages = ceil($total_products / $limit);
    // print_r($total_pages);die;   
}
$conn->close();
?>
<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Shop</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Shop</li>
    </ol>
</div>
<!-- Single Page Header End -->

<!-- Fruits Shop Start-->
<div class="container-fluid fruite py-5">
    <div class="container py-5">
        <h1 class="mb-4">Fresh fruits shop</h1>
        <div class="row g-4">
            <div class="col-lg-12">
                <div class="row g-4">
                    <div class="col-xl-3">
                        <div class="input-group w-100 mx-auto d-flex">
                            <form method="GET" action="" class="input-group w-100 mx-auto d-flex">
                                <input type="search" name="search" class="form-control p-3" placeholder="keywords" style="margin:0px;"
                                aria-describedby="search-icon-1" value="<?= htmlspecialchars($search) ?>">
                                <span id="search-icon-1" class="input-group-text p-3"><i
                                class="fa fa-search"></i></span>
                            </form>
                        </div>
                    </div>
                    <div class="col-6"></div>
                    <div class="col-xl-3">
                        <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
                        <form method="GET" action="" class="w-100 d-flex">
                                <select id="brand" name="brand_id" class="form-select" onchange="this.form.submit()">
                                    <option value="">Brand</option>
                                    <?php
                                    while($brand_rows = $brand_result->fetch_assoc()){
                                        $selected = $brand_rows['id'] == $brand_id ? 'selected' : '';
                                    ?>
                                        <option value="<?= $brand_rows['id'] ?>" <?= $selected ?>><?= $brand_rows['brand_name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </form>

                        </div>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-lg-3">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <h4>Categories</h4>
                                    <?php 
                                      while($row = $result->fetch_assoc()){ 
                                    ?>
                                    <ul class="list-unstyled fruite-categorie">
                                        <li>
                                            <div class="d-flex justify-content-between fruite-name">
                                                <a href="?category_id=<?= $row['id']; ?>">
                                                    <?= $row['c_name'];?>
                                                </a >
                                                <span>
                                                    <?=$row["product_count"]?>
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
                                <div class="mb-3">
                                    <form action="shop.php" method="GET" class="mb-3">
                                        <h4 class="mb-2">Price</h4>
                                        <input type="range" class="form-range w-100" id="rangeInput" name="price"
                                            min="0" max="1000" value="<?= htmlspecialchars($price)?>"
                                            oninput="amount.value=rangeInput.value">
                                        <div style="dsiplay:flex; justify-content:space-between;">
                                        <output id="amount" style="margin-right:160px;" for="rangeInput">
                                            <?= htmlspecialchars($price) ?>
                                        </output>
                                        <button type="submit"
                                            class="btn btn-primary mt-2">Set Range</button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <h4>Additional</h4>
                                    <!-- <div class="mb-2">
                                        <input type="radio" class="me-2" id="Categories-1" name="Categories-1"
                                            value="Beverages">
                                        <label for="Categories-1"> Organic</label>
                                    </div>
                                    <div class="mb-2">
                                        <input type="radio" class="me-2" id="Categories-2" name="Categories-1" onclick="showFresh()"
                                            value="Beverages">
                                        <label for="Categories-2"> Fresh</label>
                                    </div> -->
                                    <div class="mb-2">
                                        <input type="radio" class="me-2" id="Categories-3" name="Categories-1" onclick="showSales()">
                                        <label for="Categories-3"> Sales</label>
                                    </div>
                                    <div class="mb-2">
                                        <input type="radio" class="me-2" id="Categories-4" name="Categories-1"
                                            value="Beverages" onclick="showDiscount()">
                                        <label for="Categories-4"> Discount</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <h4 class="mb-3">Featured products</h4>
                                <?php
                                if ($sales_product_result->num_rows > 0) { 
                                    while($sales_row = $sales_product_result->fetch_assoc()) {
                                        $averageRating = round($sales_row['avg_rating']);
                                ?>   
                                <div class="d-flex align-items-center justify-content-start">
                                    <div class="rounded me-4" style="width: 100px; height: 100px;">
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
                                            <h5 class="regular-price"> &#8377 <?= $sales_row['price']; ?></h5> <br>
                                            <h5 class="sale-price"> &#8377 <?= $sales_row['sale_price']; ?></h5>
                                            <?php else: ?>
                                            &#8377 <?= $sales_row['price']; ?>
                                            <?php endif; ?> 
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
                                    <button type="button" class="btn border border-secondary px-4 py-3 rounded-pill text-primary w-100" onclick="showSales()">View More</a>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="position-relative">
                                    <img src="../asset/img/banner-fruits.jpg" class="img-fluid w-100 rounded" alt="">
                                    <div class="position-absolute"
                                        style="top: 50%; right: 10px; transform: translateY(-50%);">
                                        <h3 class="text-secondary fw-bold">Fresh <br> Fruits <br> Banner</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="row g-4 justify-content-center">
                        <?php
                            if($product_result->num_rows > 0){
                                while($rows = $product_result->fetch_assoc()){ 
                        ?>
                        <div class="col-md-6 col-lg-3 col-xl-4">
                            <?php 
                            include("product_containers.php");
                            ?>
                            <?php
                                }
                            }else{
                              echo "No Results found!!!";
                            }
                            ?>
                            <div class="col-12">
                                <div class="pagination d-flex justify-content-center mt-5">
                                    <?php if ($page > 1): ?>
                                    <a href="?page=<?= $page - 1 ?><?= $category_id ? '&category_id=' . $category_id : '' ?><?= $search ? '&search=' . $search : '' ?><?= $price ? '&price=' . $price : '' ?><?= $sales ? '&sales=' . $sales : '' ?>"
                                        class="rounded">&laquo;</a>
                                    <?php endif; ?>
                                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                    <a href="?page=<?= $i ?><?= $category_id ? '&category_id=' . $category_id : '' ?><?= $search ? '&search=' . $search : '' ?><?= $price ? '&price=' . $price : '' ?><?= $sales ? '&sales=' . $sales : '' ?>"
                                        class="rounded <?= $i == $page ? 'active' : '' ?>">
                                        <?= $i ?>
                                    </a>
                                    <?php endfor; ?>
                                    <?php if ($page < $total_pages): ?>
                                    <a href="?page=<?= $page + 1 ?><?= $category_id ? '&category_id=' . $category_id : '' ?><?= $search ? '&search=' . $search : '' ?><?= $price ? '&price=' . $price : '' ?><?= $sales ? '&sales=' . $sales : '' ?>"
                                        class="rounded">&raquo;</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fruits Shop End-->
<?php

    include('footer.php');  
      
?>

