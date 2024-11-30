<?php
ob_start();
session_start();
include("connectmysql.php");

$user_id =  isset($_SESSION['users']) ? $_SESSION['users']: NULL; 
$search = isset($_SESSION['search'])? $_SESSION['search']:'';   
// print_r($user_id);die;    
function getCartQuantity($conn,$user_id) {
    $total_quantity = 0;
    if (!empty($user_id)) {
        $total_quantity_query = "SELECT SUM(quantity) as total_quantity FROM cart WHERE user_id = ?";
        $sql = $conn->prepare($total_quantity_query);
        $sql->bind_param('i', $user_id['id']);
        $sql->execute();
        $total_quantity_result = $sql->get_result();
        if ($total_quantity_result->num_rows > 0) {
            $row = $total_quantity_result->fetch_assoc();
            $total_quantity = $row['total_quantity'];
        }
            // print_r($total_quantity);die;      
    } else {
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $item) {
                $total_quantity += $item['quantity'];
            }
        }
    }
    return $total_quantity;
}
$cart_quantity = getCartQuantity($conn, $user_id);

$search_query = "";
    if (!empty($search)) {
        $search = $conn->real_escape_string($search);
        $search_query = "AND (product.p_name LIKE '%$search%' OR product.description LIKE '%$search%' OR category.c_name LIKE '%$search%')";
    }
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fresh     Feast</title>
    <link rel="icon type" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQsp1ZogWcSUdojcoZnDbfjPZYkeJY5aCQX3g&s">
    <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet"> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="../asset/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
        <link href="../asset/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../asset/lib/owlcarousel/assets/owl.theme.default.min.css">

        <!-- Customized Bootstrap Stylesheet -->
        <link href="../asset/css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="../asset/css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <link href="../asset/css/profile.css" rel="stylesheet">

        <style>
            #product-image, #index_images, #related_image{
                height: 250px;
            }
#stock-alert-message{
    background: none;
    border: none;
    margin: 15px;

    text-align: center;
    font-size: 20px;
    color: red;
}

.errors{
    color: rgb(154, 24, 24);
    margin-left: 16px;
}

#review_form input, #review_form textarea{
    margin-bottom: -20px;
}

#not_in_stock{
    color: red;

}

.regular-price {
    color: red;
    text-decoration: line-through;
    margin-right: 10px;
  }
#index-category:hover,
#index-category.active{
    background-color: #ffc107;
}

.fa-star {
    cursor: pointer;
}
.fa-star.checked {
    color: orange;
}

</style>
   
</head>
<body>   
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Spinner Start -->
  <!--   <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div> -->
    <!-- Spinner End -->


    <!-- Navbar start -->
    <div class="container-fluid fixed-top">
        <div class="container topbar bg-primary d-none d-lg-block">
            <div class="d-flex justify-content-between">
                <div class="top-info ps-2">
                    <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="contact.php" class="text-white">123 Street, New York</a></small>
                    <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="mailto:Email@Example.com" class="text-white">Email@Example.com</a></small>
                </div>
                <div class="top-link pe-2">
                    <a href="privacy_policy.php" class="text-white"><small class="text-white mx-2">Privacy Policy</small>/</a>
                    <a href="terms_of_use.php" class="text-white"><small class="text-white mx-2">Terms of Use</small>/</a>
                    <a href="return_policy.php" class="text-white"><small class="text-white ms-2">Sales and Refunds</small></a>
                </div>
            </div>
        </div>
        <div class="container px-0">
            <nav class="navbar navbar-light bg-white navbar-expand-xl">
                <a href="index.php" class="navbar-brand"><h1 class="text-primary display-6">Fresh Feast</h1></a>
                <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars text-primary"></span>
                </button>
                <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                    <div class="navbar-nav mx-auto">
                        <a href="index.php" class="nav-item nav-link">Home</a>
                        <a href="shop.php" class="nav-item nav-link">Shop</a>
                        <a href="contact.php" class="nav-item nav-link">Contact</a>
                    </div>
                    <div class="d-flex m-3 me-0">
                        <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fas fa-search text-primary"></i></button>
                        <a href="cart.php" class="position-relative me-4 my-auto">
                            <i class="fa fa-shopping-bag fa-2x"></i>
                            
                            <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px;" id="cart_amount"><?= !empty($cart_quantity) ? $cart_quantity : 0 ?></p></span>    
                        </a>
                        <div class="nav-item dropdown">
                            <a href="#" class="my-auto" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown"><i class="fas fa-user fa-2x"></i></a>
                            <div class="dropdown-menu m-0 bg-secondary rounded-0">
                            <?php if ($user_id): ?>
                                <a href="profile.php" class="dropdown-item">Profile</a>
                                <a href="wishlist.php" class="dropdown-item">Wishlist</a>
                                <a href="order.php" class="dropdown-item">orders</a>
                                <a href="logout.php" class="dropdown-item">Logout</a>
                            <?php else: ?>
                                <a href="sign-in.php" class="dropdown-item">Sign-in</a>
                            <?php endif; ?>
                        </div>    
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->

    <!-- Modal Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="get" action="shop.php" class="modal-body d-flex align-items-center">
                    <div class="input-group w-75 mx-auto d-flex">
                        <input type="search" name="search" class="form-control p-3" style="
                        margin: 0px;" placeholder="keywords" value = "<?= htmlspecialchars($search) ?>" aria-describedby="search-icon-1">
                        <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
   