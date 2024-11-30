<?php
include('header.php');

$user_id = isset($_SESSION['users']) ? $_SESSION['users'] : [];
$coupon_discount = isset($_SESSION['coupon_discount']) ? $_SESSION['coupon_discount'] : 0;
// print_r($user_id);die;

$existing_address = null; 
if (!empty($user_id['id'])){
    $sql = $conn->prepare("SELECT * FROM address_details WHERE user_id = ?");
    $sql->bind_param("s", $user_id['id']);
    $sql->execute();
    $used_address = $sql->get_result();
    $existing_address = $used_address->fetch_assoc();
    
    $cart_details = $conn->prepare("SELECT cart.product_id AS id, cart.quantity, product.* FROM cart INNER JOIN product ON cart.product_id = product.id WHERE cart.user_id = ?");
    $cart_details->bind_param('i', $user_id['id']);
    $cart_details->execute();
    $result = $cart_details->get_result();
    $products = $result->fetch_all(MYSQLI_ASSOC);
    // print_r($products);die;
}else {
    $products = [];
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['address_option']) && $_POST['address_option'] == 'existing') {
        $address_id = $existing_address['id'];
    } else {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $country = $_POST['country'];
        $pin_code = $_POST['pin_code'];
        $email = $_POST['email'];
        $tel = $_POST['tel'];
        $errors = [];
        $pattern = "/^[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/";

        if (empty($first_name) || strlen($first_name) < 2) {
            $errors['first_name'] = 'Enter valid Name';
        }

        if (empty($address)) {
            $errors['address'] = "Required";
        }

        if (empty($city)) {
            $errors['city'] = "Required";
        }

        if (empty($state)) {
            $errors['state'] = "Required";
        }

        if (empty($country)) {
            $errors['country'] = "Required";
        }

        if (empty($pin_code)) {
            $errors['pin_code'] = "Required";
        }
        if (empty($email)) {
            $errors['email'] = "Required";
        } elseif (!preg_match($pattern, $email)) {
            $errors['email'] = "Invalid email";
        }

        if (empty($tel)) {
            $errors['tel'] = "Required";
        } elseif (strlen($tel) != 10) {
            $errors['tel'] = "Enter correct Number";
        }

    }
}
$conn->close(); 
?>

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Checkout</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Checkout</li>
    </ol>
</div>
<!-- Single Page Header End -->

<!-- Checkout Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <h1 class="mb-4">Billing details</h1>
        <form id="checkout-form" action="checkout.php" method="POST" novalidation>
            <div class="row g-5">
                <div class="col-md-12 col-lg-6 col-xl-7">
                    <?php if ($existing_address): ?>
                    <div class="mb-4">
                        <h4>Use Existing Address</h4>
                        <div class="card p-3 mb-3" id="existing_address_hide"
                            style=" width: 600px;height: 200px; overflow: hidden;">
                            <p>
                                <?php echo htmlspecialchars($existing_address['first_name']. ' ' . $existing_address['last_name']); ?>
                            </p>
                            <p>
                                <?php echo htmlspecialchars($existing_address['address']); ?>
                            </p>
                            <p>
                                <?php echo htmlspecialchars($existing_address['city'] . ', ' . $existing_address['state'] . ', ' . $existing_address['country'] . ' - ' . $existing_address['pin_code']); ?>
                            </p>
                            <p>
                                <?php echo htmlspecialchars($existing_address['email']); ?>
                            </p>
                            <p>
                                <?php echo htmlspecialchars($existing_address['tel']); ?>
                            </p>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="use_existing_address" name="address_option"
                                value="existing" checked>
                            <label class="form-check-label" for="use_existing_address">Use this address</label>
                        </div>
                        <hr>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="use_new_address" name="address_option"
                                value="new">
                            <label class="form-check-label" for="use_new_address">Ship to a different address</label>
                        </div>
                    </div>
                    <?php endif; ?>

                    <div id="billing-details" style="<?php echo $existing_address ? 'display: none;' : ''; ?>">
                        <div class="row">
                            <div class="col-md-12 col-lg-6">
                                <div class="form-item w-100">
                                    <label class="form-label my-3">First Name<sup>*</sup></label>
                                    <input type="text" name="first_name" id="first_name" class="form-control">
                                    <span class="errors" id="error_first_name"></span>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="form-item w-100">
                                    <label class="form-label my-3">Last Name<sup>*</sup></label>
                                    <input type="text" id="last_name" name="last_name" class="form-control">
                                    <span class="errors" id="error_last_name"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Address <sup>*</sup></label>
                            <input type="text" class="form-control" name="address" id="users_address"
                                placeholder="House Number Street Name">
                                <span class="errors" id="error_address"></span>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Town/City<sup>*</sup></label>
                            <input type="text" class="form-control" name="city">
                            <span class="errors" id="error_city"></span>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">State<sup>*</sup></label>
                            <input type="text" class="form-control" name="state">
                            <span class="errors" id="error_state"></span>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Country<sup>*</sup></label>
                            <input type="text" class="form-control" name="country">
                            <span class="errors" id="error_country"></span>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Postcode/Zip<sup>*</sup></label>
                            <input type="text" class="form-control" name="pin_code">
                            <span class="errors" id="error_pin_code"></span>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Mobile<sup>*</sup></label>
                            <input type="tel" class="form-control" name="tel" id="tel">
                            <span class="errors" id="error_tel"></span>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Email Address<sup>*</sup></label>
                            <input type="email" class="form-control" name="email">
                            <span class="errors" id="error_email"></span>
                        </div>
                        <div class="form-item">
                            <textarea name="text" class="form-control" name="note" spellcheck="false" cols="30"
                                rows="11" placeholder="Oreder Notes (Optional)"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-5">
                    <?php if (!empty($products)){ ?>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Products</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">handle</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php  
                                    $total_price = 0;
                                    foreach($products as $product){
                                        if (!empty($product['sale_price'])){
                                            $price = $product['sale_price'];
                                        }else{
                                            $price = $product['price']; 
                                        }
                                        $product_total = $price * $product['quantity'];
                                        $total_price += $product_total;  
                                        $gst_charge = (2/100) * $total_price;
                                ?>
                                <tr>
                                    <th scope="row">
                                        <div class="d-flex align-items-center mt-2">
                                            <img src="../admin/imgs/<?= htmlspecialchars($product['image']) ?>"
                                                alt="<?= htmlspecialchars($product['p_name']) ?>"
                                                class="img-fluid rounded-circle" style="width: 90px; height: 90px;">
                                        </div>
                                    </th>
                                    <td class="py-5">
                                        <?= htmlspecialchars($product['p_name'])?>
                                    </td>
                                    <td class="py-5">&#8377
                                        <?= htmlspecialchars($price)?>
                                    </td>
                                    <td class="py-5">
                                        <?= htmlspecialchars($product['quantity']) ?>
                                    </td>
                                    <td class="py-5">&#8377
                                        <?= htmlspecialchars($price * $product['quantity']) ?>
                                    </td>
                                    <td>
                                        <form method="post" action="checkout.php">
                                            <input type="hidden" name="product_id"
                                                value="<?= htmlspecialchars($product['id']) ?>">
                                            <button type="button" name="delete"
                                                class="btn btn-md rounded-circle bg-light border mt-4">
                                                <i class="fa fa-times text-danger"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                                            }
                                        ?>
                                <tr>
                                    <th scope="row">
                                    </th>
                                    <td class="py-5"></td>
                                    <td class="py-5"></td>
                                    <td class="py-5">
                                        <p class="mb-0 text-dark py-3">Subtotal</p>
                                    </td>
                                    <td class="py-5">
                                        <div class="py-3 border-bottom border-top">
                                            <p class="mb-0 text-dark">&#8377
                                                <?= htmlspecialchars($total_price)?>
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                    </th>
                                    <td class="py-5">
                                        <p class="mb-0 text-dark py-4">Shipping</p>
                                    </td>
                                    <?= 
                                    $delivery_charge = "";
                                    if($total_price < 500 && $total_price != 0) {
                                        $delivery_charge = 50;
                                    }else{
                                        $delivery_charge = 0;
                                    }
                                    ?>
                                    <td colspan="3" class="py-5">
                                        <div class="form-check text-start">
                                            <div class="form-check-label" for="Shipping-1">Free Shipping : Over &#8377
                                                500</div>
                                        </div>
                                        <div class="form-check text-start">
                                            <div class="form-check-label" for="Shipping-2">GST: &#8377
                                                <?= htmlspecialchars($gst_charge)?>
                                            </div>
                                        </div>
                                        <div class="form-check text-start">
                                            <div class="form-check-label" for="Shipping-2">Discount: &#8377
                                                <?= htmlspecialchars($coupon_discount)?>
                                            </div>
                                        </div>
                                        <div class="form-check text-start">
                                            <div class="form-check-label" for="Shipping-3">Delivery charge : &#8377
                                                <?= htmlspecialchars($delivery_charge)?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                    </th>
                                    <td class="py-5">
                                        <p class="mb-0 text-dark text-uppercase py-3">TOTAL</p>
                                    </td>
                                    <td class="py-5"></td>
                                    <td class="py-5"></td>
                                    <td class="py-5">
                                        <div class="py-3 border-bottom border-top">
                                            <p class="mb-0 text-dark">&#8377
                                                <?= htmlspecialchars($total_price + $delivery_charge + $gst_charge - $coupon_discount) ?>
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <?php
                    }else { 
                        echo "add products in cart!";
                        $total_price = 0;
                        $gst_charge = 0;
                    }
                    ?>  
                    <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                        <input type="hidden" id="total_amount_topay" name="selected_payment_method" value="<?= htmlspecialchars($total_price + $delivery_charge + $gst_charge - $coupon_discount) ?>">
                    </div>
                    <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                        <input type="hidden" id="user_contact_number" name="selected_payment_method" value="91<?= htmlspecialchars($user_id['tel']) ?>">
                    </div>
                    <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                        <input type="hidden" id="user_contact_email" name="selected_payment_method" value="<?= htmlspecialchars($user_id['email']) ?>">
                    </div>                  
                    <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                        <input type="hidden" id="selected_payment_method" name="selected_payment_method" value="">
                    </div>
                    <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                        <div class="col-12">
                            <div class="form-check text-start my-3">
                                <input type="radio" class="form-check-input bg-primary border-0" id="Cash-1" name="payment_method" value="cod">
                                <label class="form-check-label" for="Cash-1">Cash On Delivery</label>
                            </div>
                            <div class="form-check text-start my-3">
                                <input type="radio" class="form-check-input bg-primary border-0" id="Paypal-1" name="payment_method" value="online">
                                <label class="form-check-label" for="Paypal-1">Online</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                        <button type="button" id="proceed-checkout" class="btn btn-primary w-100">Proceed to Checkout</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Checkout Page End -->
<?php
include('footer.php');
?>