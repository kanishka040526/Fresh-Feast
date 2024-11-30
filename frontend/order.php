<?php
session_start();

if (!isset($_SESSION['users'])) {
    header('Location: sign-in.php');
    exit();
  }
  

include("connectmysql.php");

$user_id = isset($_SESSION['users']) ? $_SESSION['users'] : [];


$order_data = $conn->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY id DESC");
$order_data->bind_param('s', $user_id['id']);        
$order_data->execute();       
$order_data_result = $order_data->get_result();
// $order_details = $order_data_result->fetch_assoc();
// print_r($order_details);die;
$conn->close();
include("header.php");
?>

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Your Orders</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Checkout</li>
    </ol>
</div>
<!-- Single Page Header End -->

<div class="container-fluid testimonial py-5">
                <div class="testimonial-header text-center">
                    <h1 class="display-5 mb-5 text-dark">Your Orders</h1>
                </div>
                <div>
                    <?php
                    if($order_data_result->num_rows > 0){
                        while($rows = $order_data_result->fetch_assoc()){
                    ?>
                    <div  style="margin:40px; width: 75%;" class="testimonial-item img-border-radius bg-light rounded p-4">
                        <div class="position-relative">
                            <i class="fa fa-quote-right fa-2x text-secondary position-absolute" style="bottom: 30px; right: 0;"></i>
                            <div class="mb-4 pb-4 border-bottom border-secondary">
                                <table>
                                    <thead>
                                        <tr >
                                            <th style="padding-right: 40px; margin: 0px;">order Placed</th>
                                            <th style="padding-right: 40px; margin: 0px;" >Total</th>
                                            <th style="text-align:end; margin: 0px;" >order Id</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="mb-0" style="margin: 0px;"><?php echo htmlspecialchars($rows['date']);?>
                                            </td>
                                            <td style="margin: 0px;" class="mb-0"> &#8377 <?php echo htmlspecialchars($rows['price']);?>
                                            </td>
                                            <td style="padding-left:800px; margin: 0px;" class="mb-0"><?php echo htmlspecialchars($rows['id']);?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex align-items-center flex-nowrap">
                                <div class="bg-secondary rounded">
                                    <img src="../admin/imgs/<?= $rows[ 'image'];?>"
                                    alt="<?= $rows['p_name']; ?>" class="img-fluid rounded" style="width: 100px; height: 100px;">
                                </div>
                                <div class="ms-4 d-block">
                                    <h4 class="text-dark"><?php echo htmlspecialchars($rows['p_name'])?></h4>
                                    <p class="m-0 pb-3">Quantity : <?php echo htmlspecialchars( $rows['quantity'])?></p>
                                    <div class="d-flex pe-5">
                                    <a href="order_details.php?id=<?= $rows['id'];?>" class="btn border border-secondary rounded-pill px-3 text-primary"> view  Details</a>
                                    <button data-product-id="<?= $rows['product_id']; ?>" type="button" name="add_to_cart" class="btn border border-secondary rounded-pill px-3 text-primary" id = "add_to_cart" style="margin-left: 10px;">
                                        <i class="fa fa-shopping-bag me-2"></i>Buy this Again 
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    }else {
                        echo "you didn't place any Order!!!!";
                    }
                    ?>
                </div>
        </div>

<?php
include("footer.php");
?>