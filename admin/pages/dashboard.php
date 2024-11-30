<?php
session_start();

if (!isset($_SESSION['userdetails'])) {
    header('Location: sign-in.php');
    exit();
  }
  include("connectmysql.php");

    $query = 'SELECT SUM(quantity) AS total_quantity, SUM(price) AS total_price FROM orders WHERE DATE(date) = CURDATE()';
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo 'No results found.';
    }

    $week_query = 'SELECT SUM(quantity) AS total_quantity, SUM(price) AS total_price FROM orders WHERE date >= NOW() - INTERVAL 1 WEEK';
    $week_result = $conn->query($week_query);

    if ($week_result->num_rows > 0) {
        $week_row = $week_result->fetch_assoc();
    } else {
        echo 'No results found.';
    }

    $month_query = 'SELECT SUM(quantity) AS total_quantity, SUM(price) AS total_price FROM orders WHERE date >= NOW() - INTERVAL 1 MONTH';
    $month_result = $conn->query($month_query);

    if ($month_result->num_rows > 0) {
        $month_row = $month_result->fetch_assoc();
        // print_r($month_row);die;
    } else {
        echo 'No results found.';
    }
    $conn->close();
    
  include("navbar.php"); 
?>
    <div class="container-dash">
        <div class="container-sidenav">
            <?php
                include('sidenavbar.php');
            ?>    
        </div>
        <div class="order_details">
        <section>
            <div class="container-order c-1">
                <h4>Today's Orders</h4>
                <div class="quantity_amount_number">
                    <?php echo !empty($row['total_quantity'])?$row['total_quantity']: 0?>
                </div>
            </div>
            <div class="container-order c-2">
                <h4>This week Orders</h4>
                <div class="quantity_amount_number">
                    <?php echo $week_row['total_quantity']?>
                </div>
            </div>
            <div class="container-order c-3">
                <h4>This Month Orders</h4>
                <div class="quantity_amount_number">
                    <?php echo $month_row['total_quantity']?>
                </div>
            </div>
        </section>
        <section>
            <div class="container-amount c-4">
                <h4>today's Amount</h4>
                <div class="quantity_amount_number">
                <span style="font-size:25px; margin: 5px;"> &#8377 </span><?=!empty($row['total_price'])?$row['total_price']: 0?>
                </div>
            </div>
            <div class="container-amount c-1">
                <h4>this week Amount</h4>
                <div class="quantity_amount_number">
                    <span style="font-size:25px; margin: 5px;"> &#8377 </span> <?= $week_row['total_price']?>
                </div>
            </div>
            <div class="container-amount c-5">
                <h4>This Month Amount</h4>
                <div class="quantity_amount_number">
                <span style="font-size:25px; margin: 5px;"> &#8377 </span><?= $month_row['total_price']?>
                </div>
            </div>
        </section>
        </div>
    </div>
    <script src="js/navbar.js"></script>
</body>
</html>