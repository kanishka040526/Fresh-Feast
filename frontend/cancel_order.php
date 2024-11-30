<?php
include("connectmysql.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) ) {
    $order_id = $_POST['id'];

    if (!empty($order_id)) {
        $update_order_status = "UPDATE orders SET status='cancelled' WHERE id = ?";
        $sql = $conn->prepare($update_order_status);
        $sql->bind_param('i', $order_id);
        
        if ($sql->execute()) {
            
            $products_query = "SELECT * FROM orders WHERE id = $order_id";
            $result = $conn->query($products_query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $product_id = $row['product_id'];
                    $quantity = $row['quantity'];

                    
                    $stock_query = "SELECT stock_level FROM product WHERE id = ?";
                    $sql = $conn->prepare($stock_query);
                    $sql->bind_param('i', $product_id);
                    $sql->execute();
                    $stock_result = $sql->get_result();
                    $stock_data = $stock_result->fetch_assoc();
                    $current_stock = $stock_data['stock_level']; 

                    $new_stock = $current_stock + $quantity;
                    $update_stock_query = "UPDATE product SET stock_level = ? WHERE id = ?";
                    $update_stock = $conn->prepare($update_stock_query);
                    $update_stock->bind_param('ii', $new_stock, $product_id);
                    $update_stock->execute();
                }

                echo json_encode([
                    'status' => 'success'
                ]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Something Went wrong!!!']);
            }
        } 
    }
}
// $conn->close();
?>
