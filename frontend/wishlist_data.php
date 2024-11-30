<?php
include("connectmysql.php");
session_start();
$user_id = isset($_SESSION['users']['id']) ? $_SESSION['users']['id'] : NULL;
//  print_r($_SESSION);die;
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) { 

    $product_id = $_POST['id']; 
    
    $product_details = "SELECT * FROM product where id = ? ";
    $sql = $conn->prepare($product_details);
    $sql->bind_param('s', $product_id);
    $sql->execute();
    $product_result = $sql->get_result();
    $product_data = $product_result->fetch_assoc();
    // print_r($product_data);die;

    
    $sql = $conn->prepare("SELECT * FROM wishlist WHERE user_id = ? AND product_id = ?");
    $sql->bind_param('ss', $user_id, $product_id);
    $sql->execute();
    $result = $sql->get_result();  

    if ($result->num_rows > 0) {
        echo json_encode(['status' => 'error', 'message' => 'Product already wishlisted']);
    } else {
        $sql = $conn->prepare("INSERT INTO wishlist (product_id, user_id, p_name) VALUES (?, ?, ?)");
        $sql->bind_param('sss', $product_id, $user_id, $product_data['p_name']);
        $sql->execute();

        echo json_encode([
            'status' => 'success',
        ]);
    }}
?>