<?php
include("header.php");

$user_id = isset($_SESSION['users']) ? $_SESSION['users'] : [];
$order_id = isset($_GET['id'])? ($_GET['id']): NULL;

if(!empty($order_id)){
$oreder_details = "SELECT orders.*,orders.id AS orders_id, address_details.* FROM orders
INNER JOIN address_details ON orders.address_id = address_details.id WHERE orders.id = $order_id";
$order_result = $conn->query($oreder_details);
}
$conn->close();
?>

<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Order Detail</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Ordder Detail</li>
    </ol>
</div>

<div class="container-fluid mt-5">
    <div class="row g-4 mt-5 mb-5" style="margin-left: 20px;">
        <?php
           while($rows = $order_result->fetch_assoc()){
            ?>
        <div class="col-lg-6" style="width: 43%;">
            <div class="rounded">
                <a href="<?= $rows['image'];?>">
                    <img style="width:530px; height:350px;" src="../admin/imgs/<?= $rows['image'];?>" class="img-fluid rounded" alt="Image">
                </a>
            </div>
        </div>

        <div class="g-4 col-lg-6 bg-light rounded" style="width: 50%; padding-top:30px;">
            <div class="row" style="">
                <h6 class="fw-bold mb-3" style="width:50%;"> Name:
                    <?= $rows['first_name'].' '.$rows['last_name'];?>
                </h6>
                <div class="mb-3" style="width:50%; text-align:end;" >Date:
                    <?php echo $rows['date']?>
                </div>
            </div>

            <h4 class="fw-bold mb-3"> Product:
                <?= $rows['p_name'];?>
            </h4>
            
            <?php if (!empty($rows['sale_price'])): ?>
            <h5 style="margin-bottom:0px;" class="">Price: &#8377
                <?= $rows['sale_price']; ?>
            </h5>
            <?php else: ?>
            <h5> Price: &#8377
                <?= $rows['price']; ?>
            </h5>
            <?php endif; ?>

            <h6>Quantity:
                <?=" ". $rows['quantity']; ?>
            </h6>

            <h6>Address:</h6>
            <p class="mb-4 fw-bold">
                <?=$rows['address'].' '.', '. $rows['city'].' '.', '. $rows['state'].' '.', '.$rows['country'].' '.', '.$rows['pin_code']?>
            </p>

            <div style="width: 40%;">
                <h4 class="">Order Id:
                    <?=" ". $rows['orders_id']; ?>
                </h4>
            </div>
            <?php
            if($rows['status'] != 'cancelled'){ ?>
            <h6>Status:
                <?=" ". $rows['status']; ?>
            </h6>
             <?php if ($rows['status'] == 'pending' || $rows['status'] == 'approved'){ ?>
            <form action="cancel_order.php" style="padding-top: 20px;" method="post">
                <input type="hidden" name="order_id" value="<?= $rows['orders_id']; ?>">
                <button type="button" id="cancelled" cancel-order-id="<?= $rows['orders_id']?>" class="btn btn-danger">Cancel Order</button>
            </form>
            <?php 
                }
            }else{
            ?>
            <p class=" mt-3 px-3 " style="color:red; font-size:20px" id = "cancelled"><i class="fa fa-close" style="padding-right:4px;" ></i>Cancelled</p>
            <p class=" mt-3 px-3 fw-bold "><?php echo "Reason:".' '.$rows['cancellation_reason']?></p>
            <?php
            }
            ?>
        </div>
        <?php
            }
        ?>
    </div>
</div>

<?php include("footer.php");?>

