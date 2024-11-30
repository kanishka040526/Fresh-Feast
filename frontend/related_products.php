<div class="vesitable">
            <div class="owl-carousel vegetable-carousel justify-content-center">
            <?php
               while($related_details_rows = $related_details_result->fetch_assoc()){
            ?>
                <div class="border border-primary rounded position-relative vesitable-item">
                    <a href="shopdetails.php?id=<?= $related_details_rows['id']?>">
                    <div class="vesitable-img">
                        <img id="related_image" src="../admin/imgs/<?= $related_details_rows['image'];?>" class="img-fluid w-100 rounded-top" alt="<?= $rows['p_name']; ?>">
                    </div>
                    </a>
                    <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;"><?= $related_details_rows['category_name'];?></div>
                    <div class="p-4 pb-0 rounded-bottom">
                        <h4 style="display:flex; justify-content:space-between;">
                            <?= $related_details_rows['p_name'];?>
                        <?php
                        if(isset($_SESSION['users'])){
                        ?>
                        <button wishlist-product-id="<?= $related_details_rows['id']; ?>" type="button" name="wishlist" id = "wishlist" style="border: none; background: none;">
                        <i class='far fa-heart' style='font-size:24px;color:red;'></i>
                        </button>
                        <?php
                        }else{
                            echo "";
                        }
                        ?>
                        </h4>
                        <p style="height: 150px; align-content: center;"><?= $related_details_rows['description'];?></p>
                        <div class="d-flex justify-content-between flex-lg-wrap">
                            <div class="text-dark fs-5 fw-bold">
                            <?php if (!empty($related_details_rows['sale_price'])): ?>
                                <h5 class="fw-bold"> &#8377 <?= $related_details_rows['sale_price']; ?></h5>
                                <h5 class="text-danger text-decoration-line-through" > &#8377 <?= $related_details_rows['price']; ?></h5>
                            <?php else: ?>
                            <h5 class="fw-bold" style="margin-top: 10px;">&#8377 <?= $related_details_rows['price']; ?></h5>
                            <?php endif; ?>
                            </div>
                            <?php 
                              if($related_details_rows['stock_level'] > 0){
                            ?>
                            <button type="button" data-product-id="<?= $related_details_rows['id']; ?>" class="btn border border-secondary rounded-pill px-3 py-1 mb-4 text-primary" id="add_to_cart"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</button>
                            <?php
                            }else{
                            ?>
                            <button name="not_in_stock" class="btn border border-secondary rounded-pill px-3 py-1 mb-4" id = "not_in_stock"><i class="fa fa-close" style="color:red"></i> Not in Stock</button> 
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>                        
            </div>
        </div>