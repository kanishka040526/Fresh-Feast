
<?php
include('header.php');
include("merge_cart_items.php");
include("add-to-cart.php");

$user_id = isset($_SESSION['users']['id']) ? $_SESSION['users']['id'] : NULL;

if (!empty($user_id)) {
    merge_cart_items($conn, $user_id);

    $cart_details = $conn->prepare("SELECT cart.product_id AS id, cart.quantity, product.* FROM cart INNER JOIN product ON cart.product_id = product.id WHERE cart.user_id = ?");
    $cart_details->bind_param('s', $user_id);
    $cart_details->execute();
    $result = $cart_details->get_result();
    $products = $result->fetch_all(MYSQLI_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
        $product_id = intval($_POST['product_id']);
        $delete = $conn->prepare("DELETE FROM cart WHERE user_id = ? AND product_id = ?");
        $delete->bind_param('ss', $user_id, $product_id);
        $delete->execute();
        header('Location: cart.php');
        exit();
    }
} else {
    $cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
    $product_ids = array_keys($cart_items);
    if (!empty($product_ids)) {
        $fetch = implode(',', array_fill(0, count($product_ids), '?'));
        $stmt = $conn->prepare("SELECT * FROM product WHERE id IN ($fetch)");
        $stmt->bind_param(str_repeat('i', count($product_ids)), ...$product_ids);
        $stmt->execute();
        $result = $stmt->get_result();
        $products = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $products = [];
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
        $product_id = intval($_POST['product_id']);
        if (isset($_SESSION['cart'][$product_id])) {
            unset($_SESSION['cart'][$product_id]);
        }
        header("Location: cart.php");
        exit();
    }
}

$coupon_discount = 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['coupon_code'])) {
    $coupon_code = $_POST['coupon_code'];
    $sql = $conn->prepare("SELECT * FROM coupons WHERE code = ? AND start_date <= CURDATE() AND end_date >= CURDATE() AND (usage_limit = 0 OR used_count < usage_limit)");
    $sql->bind_param('i', $coupon_code);
    $sql->execute();
    $coupon_result = $sql->get_result();
    $coupon = $coupon_result->fetch_assoc();
    // print_r($coupon);die;
 
    if ($coupon) {
        if ($coupon['discount_type'] == 'percentage') {
            $coupon_discount = ($total_price * $coupon['discount_value']) / 100;
        } else {
            $coupon_discount = $coupon['discount_value'];
        }
        $update_coupon_sql = $conn->prepare("UPDATE coupons SET used_count = used_count + 1 WHERE id = ?");
        $update_coupon_sql->bind_param('i', $coupon['id']);
        $update_coupon_sql->execute();
    } else {
        echo "<script>alert('Invalid or expired coupon code');</script>";
    }

    $_SESSION['coupon_discount'] = $coupon_discount;
}

$conn->close();

$total_price = 0;
$gst_charge = 0;
$delivery_charge = 0;
foreach ($products as $product) {
    $price = !empty($product['sale_price']) ? $product['sale_price'] : $product['price'];
    $quantity = !empty($user_id) ? $product['quantity'] : $cart_items[$product['id']]['quantity'];
    $product_total = $price * $quantity;
    $total_price += $product_total;
}
$gst_charge = (2 / 100) * $total_price;
if ($total_price < 500 && $total_price != 0) {
    $delivery_charge = 50;
}

$total_after_discount = $total_price - $coupon_discount;
$grand_total = $total_after_discount + $gst_charge + $delivery_charge;

?>

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Cart</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Cart</li>
    </ol>
</div>
<!-- Single Page Header End -->

<!-- Cart Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <?php if (!empty($products)) { ?>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Products</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach ($products as $product) {
                            $price = !empty($product['sale_price']) ? $product['sale_price'] : $product['price'];
                            $quantity = !empty($user_id) ? $product['quantity'] : $cart_items[$product['id']]['quantity'];
                            $product_total = $price * $quantity;
                        ?>
                        <tr>
                            <th scope="row">
                                <div class="d-flex align-items-center">
                                    <img src="../admin/imgs/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['p_name']) ?>" class="img-fluid" style="width: 50px; height: 40px; border-radius: 30px; border: 1px solid black">
                                </div>
                            </th>
                            <td>
                                <p class="mb-0 mt-4"><?= htmlspecialchars($product['p_name']) ?></p>
                            </td>
                            <td>
                                <p class="mb-0 mt-4"><?= htmlspecialchars($price) ?></p>
                            </td>
                            <td>
                                <div class="input-group quantity mt-4" style="width: 100px;">
                                    <div class="input-group-btn"></div>
                                    <input type="text" class="form-control form-control-sm text-center border-0" style="margin:0px;" value="<?= htmlspecialchars($quantity) ?>">
                                    <div class="input-group-btn"></div>
                                </div>
                            </td>
                            <td>
                                <p class="mb-0 mt-4"> &#8377 <?= htmlspecialchars($product_total) ?></p>
                            </td>
                            <td>
                                <form method="post" action="cart.php">
                                    <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['id']) ?>">
                                    <button type="submit" name="delete" class="btn btn-md rounded-circle bg-light border mt-4">
                                        <i class="fa fa-times text-danger"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <p>Your cart is empty!</p>
        <?php } ?>

        <div class="mt-5">
            <form method="post" action="cart.php">
                <input type="text" name="coupon_code" class="border-0 border-bottom rounded me-5 py-3 mb-4" placeholder="Coupon Code">
                <button class="btn border-secondary rounded-pill px-4 py-3 text-primary" type="submit">Apply Coupon</button>
            </form>
        </div>

        <div class="row g-4 justify-content-end">
            <div class="col-8"></div>
            <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                <div class="bg-light rounded">
                    <div class="p-4">
                        <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                        <div class="d-flex justify-content-between mb-4">
                            <h5 class="mb-0 me-4">Subtotal:</h5>
                            <p class="mb-0">&#8377 <?= htmlspecialchars($total_price) ?></p>
                        </div>
                        <div class="d-flex justify-content-between mb-4">
                            <h5 class="mb-0 me-4">Discount:</h5>
                            <p class="mb-0">&#8377 <?= htmlspecialchars($coupon_discount) ?></p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-0 me-4">GST</h5>
                            <p class="mb-0">&#8377 <?= htmlspecialchars($gst_charge) ?></p>
                        </div>
                        <div class="d-flex justify-content-between mb-4" style="margin-top: 20px;">
                            <h5 class="mb-0 me-4">Delivery:</h5>
                            <p class="mb-0">&#8377 <?= htmlspecialchars($delivery_charge) ?></p>
                        </div>
                        <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                            <h5 class="mb-0 ps-4 me-4">Total</h5>
                            <p class="mb-0 pe-4">&#8377 <?= htmlspecialchars($grand_total) ?></p>
                        </div>
                        <?php if ($user_id): ?>
                            <a href="checkout.php" class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4">Proceed to Checkout</a>
                        <?php else: ?>
                            <a href="sign-up.php" class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4">Proceed to Checkout</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart Page End -->

<?php include('footer.php'); ?>
