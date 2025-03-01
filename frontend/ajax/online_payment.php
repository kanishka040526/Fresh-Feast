<?php
session_start();
include('../connectmysql.php');

$user_id = isset($_SESSION['users']) ? $_SESSION['users'] : [];
$coupon_discount = isset($_SESSION['coupon_discount']) ? $_SESSION['coupon_discount'] : 0;

$existing_address = null;
if (!empty($user_id['id'])) {
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
} else {
    $products = [];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $payment_id = $_POST['payment_id'];
    parse_str($_POST['form_data'], $form_data);

    if (isset($form_data['address_option']) && $form_data['address_option'] == 'existing') {
        $address_id = $existing_address['id'];
    } else {
        $first_name = $form_data['first_name'];
        $last_name = $form_data['last_name'];
        $address = $form_data['address'];
        $city = $form_data['city'];
        $state = $form_data['state'];
        $country = $form_data['country'];
        $pin_code = $form_data['pin_code'];
        $email = $form_data['email'];
        $tel = $form_data['tel'];
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

        $errors = array_filter($errors);

        if (!empty($errors)) {
            echo json_encode(['status' => 'validation', 'error' => $errors]);
            exit;
        }

        if (empty($errors)) {
            $billing = $conn->prepare("INSERT INTO address_details (user_id, first_name, last_name, address, city, state, country, pin_code, tel, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $billing->bind_param("ssssssssss", $user_id['id'], $first_name, $last_name, $address, $city, $state, $country, $pin_code, $tel, $email);

            if ($billing->execute()) {
                $address_id = $conn->insert_id;
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error inserting address: ' . $billing->error]);
                exit;
            } 
        } 
    }

    if (isset($address_id)) {
        $order_status = 'completed';
    }

    $order_product = $conn->prepare("INSERT INTO orders (address_id, user_id, product_id, image, quantity, payment_status, p_name, price, sale_price, payment_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $success = true;
    foreach ($products as $product) {
        $quantity = $product['quantity'];
        $p_name = $product['p_name'];
        $image = $product['image'];
        $price = $product['price'];
        $sale_price = isset($product['sale_price']) ? $product['sale_price'] : 0;

        $stock = "SELECT stock_level FROM product WHERE id = ?";
        $sql = $conn->prepare($stock);
        $sql->bind_param('i', $product['id']);
        $sql->execute();
        $result = $sql->get_result();
        $stock_quantity = $result->fetch_assoc();
        $available_stock = $stock_quantity['stock_level'];
        $new_stock = $available_stock - $quantity;

        $update_query = "UPDATE product SET stock_level = ? WHERE id = ?";
        $sql = $conn->prepare($update_query);
        $sql->bind_param('ii', $new_stock, $product['id']);
        $sql->execute();
        
        $order_product->bind_param("ssssssssss", $address_id, $user_id['id'], $product['id'], $image, $quantity, $order_status, $p_name, $price, $sale_price, $payment_id);

        if (!$order_product->execute()) {
            $success = false;
            break;
        }
    }

    if ($success) {
        $delete = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
        $delete->bind_param('s', $user_id['id']);
        $delete->execute();

        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error in placing order']);
    }
}
$conn->close();
?>