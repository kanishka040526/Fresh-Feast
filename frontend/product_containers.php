

    <div class="rounded position-relative fruite-item">
        <div class="fruite-img">
            <a href="shopdetails.php?id=<?= $rows['id'];?>"
                class="rounded position-relative fruite-item">
                    <img class="img-fluid w-100 rounded-top" id="product-image" src="../admin/imgs/<?= $rows[ 'image'];?>"
                    alt="<?= $rows['p_name']; ?>">
            </a>    
        </div>
        <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style ="top: 10px; left: 10px;">
            <?= $rows['category_name'];?>
        </div>
        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
            <a href="shopdetails.php?id=<?= $rows['id'];?>"
            class="rounded position-relative fruite-item">
                <h4 style="display:flex; justify-content:space-between;">
                    <?= $rows['p_name'];?>
                    <?php
                    if(isset($_SESSION['users'])){
                    ?>
                    <button wishlist-product-id="<?= $rows['id']; ?>" type="button" name="wishlist" id = "wishlist" style="border: none; background: none;">
                    <i class='far fa-heart' style='font-size:24px;color:red;'></i>
                    </button>
                    
                    <?php
                    }else{
                        echo "";
                    }
                    ?>
                </h4>
                <p style="color: #847575; height: 150px; align-content: center; text-align:left;">
                    <?= $rows['description'];?>
                </p>
            </a>
            <div class="d-flex justify-content-between flex-lg-wrap">
                <div class="text-dark fs-5 fw-bold mb-0">
                    <?php if (!empty($rows['sale_price'])): ?>
                    <h5 class="fw-bold me-2"> &#8377 <?= $rows['sale_price']; ?></h5>
                    <h5 class="text-danger text-decoration-line-through"> &#8377 <?= $rows['price']; ?></h5> 
                    <?php else: ?>
                    <h5 class="fw-bold" style="margin-top: 32px;">&#8377 <?= $rows['price']; ?></h5>
                    <?php endif; ?>
                </div>
                <?php 
                if($rows['stock_level'] > 0){
                ?>
                <button data-product-id="<?= $rows['id']; ?>" type="button" name="add_to_cart" class="btn border border-secondary rounded-pill px-3 text-primary" id = "add_to_cart">
                <i class="fa fa-shopping-bag me-2"></i>Add to cart 
                </button>
                <?php
                    }else{
                ?>
                <button name="not_in_stock" class="btn rounded-pill border-secondary border px-3 " id = "not_in_stock"><i class="fa fa-close" style="color:red"></i> Not in Stock</button> 
                <?php
                    }
                ?> 
            </div>
        </div>
    </div>
</div>
