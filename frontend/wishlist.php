<?php
session_start();

if (!isset($_SESSION['users'])) {
    header('Location: sign-in.php');
    exit();
  }
  
include("connectmysql.php");
include("wishlist_data.php");

$user_id = isset($_SESSION['users']['id']) ? $_SESSION['users']['id'] : [];

$wishlist_details = $conn->prepare("SELECT wishlist.*, product.p_name, product.price, product.image, product.description, product.stock_level FROM wishlist INNER JOIN product ON wishlist.product_id = product.id WHERE wishlist.user_id = ?");
$wishlist_details->bind_param('s', $user_id);
$wishlist_details->execute();
$result = $wishlist_details->get_result();
$products = $result->fetch_all(MYSQLI_ASSOC);
    // print_r($products);die;  
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $product_id = intval($_POST['product_id']);
    $delete = $conn->prepare("DELETE FROM wishlist WHERE user_id = ? AND product_id = ?");
    $delete->bind_param('ss', $user_id, $product_id);
    $delete->execute();
    header('Location: wishlist.php');
    exit();
   }
    
$conn->close();
include("header.php");
?>

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">My Wishlist</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Wishlist</li>
    </ol>
</div>
<!-- Single Page Header End -->

<div class="container-fluid testimonial py-5">
                <div class="testimonial-header text-center">
                    <h4 class="text-primary"></h4>
                    <h1 class="display-5 mb-5 text-dark" Style="text-align: left; margin:40px;">Wishlist</h1>
                </div>
                <div>
                    <?php
                    if(!empty($products)){
                        foreach($products as $product){
                    ?>
                    <div  style="margin:40px; width: 80%;" class="testimonial-item img-border-radius bg-light rounded p-4">
                        <div class="position-relative">
                            <i class="fa fa-quote-right fa-2x text-secondary position-absolute" style="bottom: 30px; right: 0;"></i>
                            <div class="mb-4 pb-4 border-bottom border-secondary">
                                <table>
                                    <thead>
                                        <tr style="display:flex; justify-content:space-between;" >
                                            <th style="margin:0px; padding-right: 500px;
                                            }">Price : &#8377 <?php echo htmlspecialchars($product['price']);?></th>
                                            <th style="margin:0px; padding-left: 500px;
                                            }">
                                                <form method="post" action="wishlist.php" style="margin-top: -25px;}">
                                                    <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['product_id']) ?>">
                                                    <button type="submit" name="delete" class="btn btn-md bg-light border mt-4">
                                                    <i class="fa fa-times text-danger"></i>
                                                    </button>
                                                </form>
                                            </th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="d-flex align-items-center flex-nowrap">
                                <div class="bg-secondary rounded">
                                    <img src="../admin/imgs/<?= $product[ 'image'];?>"
                                    alt="<?= $product['p_name']; ?>" class="img-fluid rounded" style="width: 100px; height: 100px;">
                                </div>
                                <div class="ms-4 d-block">
                                    <h4 class="text-dark"><?php echo htmlspecialchars($product['p_name'])?></h4>
                                    <p class="m-0 pb-3"><?php echo htmlspecialchars( $product['description'])?></p>
                                    <div class="d-flex pe-5">
                                    <a href="shopdetails.php?id=<?= $product['product_id'];?>" class="btn border border-secondary rounded-pill px-3 text-primary"> view  Details</a>
                                    <?php
                                        if($product['stock_level'] > 0){
                                    ?>
                                    <button data-product-id="<?= $product['product_id']; ?>" type="button"                     name="add_to_cart" class="btn border border-secondary rounded-pill px-3 text-primary" id = "add_to_cart"  style="margin-left: 10px;">
                                    <i class="fa fa-shopping-bag me-2"></i>Add to cart 
                                    </button>
                                    <?php
                                        }else{
                                    ?>
                                    <button name="not_in_stock" class="btn border px-3 " id = "not_in_stock" style="margin-left: 10px;"> Not in Stock</button> 
                                    <?php
                                        }
                                    ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                      }
                      }else {
                        echo "Blank!!!";
                    }
                    ?>
                </div>
        </div>

<?php
include("footer.php");
?>