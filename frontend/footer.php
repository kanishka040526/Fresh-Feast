<?php
include("connectmysql.php");

$social_media = "SELECT * FROM social_media";
$social_result = $conn->query($social_media);

$conn->close();
?>
    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5">
        <div class="container py-5">
            <div class="pb-4 mb-4" style="border-bottom: 1px solid rgba(226, 175, 24, 0.5) ;">
                <div class="row g-4">
                    <div class="col-lg-3">
                        <a href="#">
                            <h1 class="text-primary mb-0">Fruitables</h1>
                            <p class="text-secondary mb-0">Fresh products</p>
                        </a>
                    </div>
                    <div class="col-lg-6">
                        <div class="position-relative mx-auto">
                            <input class="form-control border-0 w-100 py-3 px-4 rounded-pill" type="number" placeholder="Your Email">
                            <button type="submit" class="btn btn-primary border-0 border-secondary py-3 px-4 position-absolute rounded-pill text-white" style="top: 0; right: -3%;">Subscribe Now</button>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="d-flex justify-content-end pt-3">
                        <?php
                        while($rows = $social_result->fetch_assoc()){
                        ?>
                            <a class="btn  btn-outline-secondary me-2 btn-md-square rounded-circle" href="<?= $rows['url']?>"><i class="<?= $rows['icon']?>"></i></a>
                            <?php
                        }
                        ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item">
                        <h4 class="text-light mb-3">Why People Like us!</h4>
                        <p class="mb-4">typesetting, remaining essentially unchanged. It was 
                            popularised in the 1960s with the like Aldus PageMaker including of Lorem Ipsum.</p>
                        <a href="" class="btn border-secondary py-2 px-4 rounded-pill text-primary">Read More</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex flex-column text-start footer-item">
                        <h4 class="text-light mb-3">Shop Info</h4>
                        <a class="btn-link" href="aboutus.php">About Us</a>
                        <a class="btn-link" href="contact.php">Contact Us</a>
                        <a class="btn-link" href="privacy_policy.php">Privacy Policy</a>
                        <a class="btn-link" href="terms_and_condition.php">Terms & Condition</a>
                        <a class="btn-link" href="return_policy.php">Return Policy</a>
                        <a class="btn-link" href="fnq.php">FAQs & Help</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex flex-column text-start footer-item">
                        <h4 class="text-light mb-3">Account</h4>
                        <a class="btn-link" href="profile.php">My Account</a>
                        <a class="btn-link" href="shop.php">Shop</a>
                        <a class="btn-link" href="cart.php">Shopping Cart</a>
                        <a class="btn-link" href="wishlist.php">Wishlist</a>
                        <a class="btn-link" href="order.php">Order History</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item">
                        <h4 class="text-light mb-3">Contact</h4>
                        <p>Address: 1429 Netus Rd, NY 48247</p>
                        <p>Email: Example@gmail.com</p>
                        <p>Phone: +0123 4567 8910</p>
                        <p>Payment Accepted</p>
                        <img src="../asset/img/payment.png" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Copyright Start -->
    <div class="container-fluid copyright bg-dark py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <span class="text-light"><a href="#"><i class="fas fa-copyright text-light me-2"></i>Your Site Name</a>, All right reserved.</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Copyright End -->
    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>   

    
    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../asset/lib/easing/easing.min.js"></script>
    <script src="../asset/lib/waypoints/waypoints.min.js"></script>
    <script src="../asset/lib/lightbox/js/lightbox.min.js"></script>
    <script src="../asset/lib/owlcarousel/owl.carousel.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>   
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script> 
   
    <!-- Template Javascript -->
    <script src="../asset/js/main.js"></script>
    <script src="../asset/js/wishlist.js"></script>
    <script src="../asset/js/add_to_cart.js"></script>
    <script src="../asset/js/contact.js"></script>
    <script src="../asset/js/payment.js"></script>
    <script src="../asset/js/address.js"></script>
    <script src="../asset/js/cancel_order.js"></script>
    <script src="../asset/js/validation.js"></script>
    <script>
        function showSales() {
            window.location.href = 'shop.php?sales=true';
        }
        function showDiscount() {
            window.location.href = 'discount.php';
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const stars = document.querySelectorAll('.fa-star');
            const ratingInput = document.getElementById('rating');

            stars.forEach(star => {
                star.addEventListener('click', function() {
                let rating = this.getAttribute('data-rating');
                ratingInput.value = rating;

                    stars.forEach(s => {
                        if (s.getAttribute('data-rating') <= rating) {
                            s.classList.remove('text-muted');
                            s.classList.add('text-secondary');
                        } else {
                            s.classList.add('text-muted');
                            s.classList.remove('text-secondary');
                        }
                    });
                });
            });
        });
    </script>
</body>
</html>