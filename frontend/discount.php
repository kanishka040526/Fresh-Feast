<?php 
include("header.php");
include("connectmysql.php");

$coupon_details = "SELECT * FROM coupons";
$coupon_result = $conn->query($coupon_details);
// print_r($coupon_result);die;

$conn->close();
?>

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Discount Coupons</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Discount</li>
    </ol>
</div>


<div>
<table style="width:1400px; margin: 40px auto; border:4px solid #f4f6f8;" >
    <thead>
        <tr class="bg-light text-center align-items-center justify-content-center px-3 py-1">
            <th style="padding:10px;">Code</th>
            <th style="padding:10px;">Type</th>
            <th style="padding:10px;">Discount amount</th>
            <th style="padding:10px;">Start Date</th>
            <th style="padding:10px;">End Date</th>
            <th style="padding:10px;">Created On</th>
        </tr>
    </thead>
    <?php
    if($coupon_result->num_rows > 0){
        while($coupon_details_rows = $coupon_result->fetch_assoc()){
    ?>
    <tbody>
        <tr class=" text-center align-items-center justify-content-center py-2">
        <td style="padding:20px;"><?= $coupon_details_rows['code']?></td>
        <td style="padding:20px;"><?= $coupon_details_rows['discount_type']?></td>
        <td style="padding:20px;"><?= $coupon_details_rows['discount_value']?></td>
        <td style="padding:20px;"><?= $coupon_details_rows['start_date']?></td>
        <td style="padding:20px;"><?= $coupon_details_rows['end_date']?></td>
        <td style="padding:20px;"><?= $coupon_details_rows['created_at']?></td>
        </tr>
    </tbody>
    <?php
        }
    }else{
        echo "NO DSCOUNT IS AVAILABLE!!!";
    }
?>
</table>
</div>
<!-- Single Page Header End -->
<?php
include("footer.php");
?>