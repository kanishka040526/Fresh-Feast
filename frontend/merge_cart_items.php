<?php

function merge_cart_items($conn, $user_id) {
    if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
        return;
    }

    foreach ($_SESSION['cart'] as $product_id => $item) {
      //  print_r($product_id);die;
        $quantity = $item['quantity'];

        $sql = $conn->prepare("SELECT * FROM cart WHERE user_id = ? AND product_id = ?");
        $sql->bind_param('ss', $user_id, $product_id);
        $sql->execute();
        $result = $sql->get_result();
                
        if ($result->num_rows > 0) {
            $update = $conn->prepare("UPDATE cart SET quantity = quantity + ? WHERE user_id = ? AND product_id = ?");
            $update->bind_param('sss', $quantity, $user_id, $product_id);
            $update->execute();
        } else {
            $insert_cart = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
            $insert_cart->bind_param('sss', $user_id, $product_id, $quantity);
            $insert_cart->execute();
        }
    }

    unset($_SESSION['cart']);
}
?>