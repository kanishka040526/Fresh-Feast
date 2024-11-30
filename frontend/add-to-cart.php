<?php
session_start();
include("connectmysql.php");


$user_id = isset($_SESSION['users']['id']) ? $_SESSION['users']['id'] : NULL ;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) { 

    $product_id = $_POST['id'];
    $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
        
    $stock = "SELECT stock_level FROM product WHERE id = ?";
    $sql = $conn->prepare($stock);
    $sql->bind_param('i', $product_id);
    $sql->execute();
    $result = $sql->get_result();
    $stock_quantity = $result->fetch_assoc();
    // print_r($stock_quantity);die;       

    if(empty($user_id)){
        if ($stock_quantity) {
            $available_stock = $stock_quantity['stock_level'];
            if ($quantity <= $available_stock) {
                if (!isset($_SESSION['cart'])) {
                    $_SESSION['cart'] = [];
                }
                if (isset($_SESSION['cart'][$product_id])) {
                    $_SESSION['cart'][$product_id]['quantity'] += $quantity;
                }else {
                    $_SESSION['cart'][$product_id] = [
                        'product_id' => $product_id,
                        'p_name' => $p_name,
                        'quantity' => $quantity,
                    ];
                }
                // // $new_stock = $available_stock - $quantity;
                // //   $update_query = "UPDATE product SET stock_level = ? WHERE id = ?";
                // // $sql = $conn->prepare($update_query);
                // // $sql->bind_param('ss', $new_stock, $product_id);
                // // $sql->execute();
                
                $total_quantity = 0;
                foreach ($_SESSION['cart'] as $item) {
                    $total_quantity += $item['quantity'];
                }

                echo json_encode([
                    'status' => 'success',
                    'cart_quantity' => $total_quantity
                ]);
                
            }else {
                    echo json_encode(['status' => 'error', 'message' => 'Not enough stock']);
                }
        }else {
            echo json_encode(['status' => 'error', 'message' => 'Product not found']);
        } 
        exit;
    }
    else{
        if ($stock_quantity) {
            $available_stock = $stock_quantity['stock_level'];
            if ($quantity <= $available_stock) {
                $sql = $conn->prepare("SELECT * FROM cart WHERE user_id = ? AND product_id = ?");
                $sql->bind_param('ss', $user_id, $product_id);
                $sql->execute();
                $result = $sql->get_result();
                
                if ($result->num_rows > 0) {
                    $update = $conn->prepare("UPDATE cart SET quantity = quantity + ? WHERE user_id = ? AND product_id = ?");
                    $update->bind_param('sss', $quantity, $user_id, $product_id);
                    $update->execute();
                } else {
                    $insert = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
                    $insert->bind_param('sss', $user_id, $product_id, $quantity);
                    $insert->execute();
                }

                // $new_stock = $available_stock - $quantity;
                // $update_query = "UPDATE product SET stock_level = ? WHERE id = ?";
                // $sql = $conn->prepare($update_query);
                // $sql->bind_param('ss', $new_stock, $product_id);
                // $sql->execute();

                $total_quantity_query = "SELECT SUM(quantity) as total_quantity FROM cart WHERE user_id = ?";
                $sql = $conn->prepare($total_quantity_query);
                $sql->bind_param('s', $user_id);
                $sql->execute();
                $total_quantity_result = $sql->get_result();
                $total_quantity = $total_quantity_result->fetch_assoc()['total_quantity'];
                // print_r($total_quantity);die;
                echo json_encode([
                    'status' => 'success',
                    'cart_quantity' => $total_quantity
                ]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Not enough stock']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Product not found']);
        }
    }
}
// $conn->close();
?>

