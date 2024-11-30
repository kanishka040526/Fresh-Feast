<?php
include("connectmysql.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $userName = $_POST['userName'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $errors = [];
    $pattern = "/^[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/";

    if(empty($userName)){
        $errors['userName'] = "*Required*";
    }elseif (strlen($userName)<2 || $userName == " ") {
        $errors['userName'] = "*Enter Correct Name*";
    }else{
        $errors['usesrName'] = "";
    }

    if(empty($email)){
        $errors['email'] = "*Required*";
    }elseif (!preg_match($pattern ,$email)) {
        $errors['email'] = "*Enter Valid Email*";
    }else{
        $errors['email'] = "";
    }

    if(empty($message)){
        $errors['message'] = "*Required*";
    }else{
        $errors['message'] = "";
    }

    $errors = array_filter($errors);

    if(empty($errors)){
        $sql = $conn->prepare("INSERT INTO contact(userName, email, message) VALUES (?, ?, ?)");
        $sql->bind_param("sss", $userName, $email, $message);

        if($sql->execute()) {
            echo json_encode(['status' => 'success']);
            exit();
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Database error.']);
            exit();
        }
    }
}
$conn->close();
include("header.php");
?>

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Contact</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active text-white">Contact</li>
            </ol>
        </div>
        <!-- Single Page Header End -->


        <!-- Contact Start -->
        <div class="container-fluid contact py-5">
            <div class="container py-5">
                <div class="p-5 bg-light rounded">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="text-center mx-auto" style="max-width: 700px;">
                                <h1 class="text-primary">Get in touch</h1>
                                <p class="mb-4">The contact form is currently inactive. Get a functional and working contact form with Ajax & PHP in a few minutes. Just copy and paste the files, add a little code and you're done.
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="h-100 rounded">
                                <iframe class="rounded w-100" 
                                style="height: 400px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387191.33750346623!2d-73.97968099999999!3d40.6974881!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sbd!4v1694259649153!5m2!1sen!2sbd" 
                                loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <form action="contact.php" method="POST" novalidation>
                                <div>
                                    <input type="text" name="userName" id="user_name" class="w-100 form-control border-0 py-3" placeholder="Your Name" value="<?= isset($userName) ? htmlspecialchars($userName) : '' ?>">
                                    <span class="errors"><?= isset($errors['userName'])? $errors['userName']:''; ?></span>
                                </div>
                                <div>
                                    <input type="email" name="email" id="user_email" class="w-100 form-control border-0 py-3" placeholder="Enter Your Email" value="<?= isset($email) ? htmlspecialchars($email) : ''?>">
                                    <span class="errors"><?= isset($errors['email'])? $errors['email']:''; ?></span>
                                </div>
                                <div>
                                    <textarea class="w-100 form-control border-0 py-3" rows="5" cols="10" name="message" style="margin: 10px;" id="user_message" placeholder="Your Message"><?= isset($message) ? htmlspecialchars($message): ''?></textarea> 
                                    <span class="errors"><?= isset($errors['message'])? $errors['message'] :'';?></span>                                    
                                </div>
                                <div>
                                    <input class="w-100 btn form-control border-secondary py-3 bg-white text-primary " id="contact_form" type="submit" value="Submit">
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-5">
                            <div class="d-flex p-4 rounded mb-4 bg-white">
                                <i class="fas fa-map-marker-alt fa-2x text-primary me-4"></i>
                                <div>
                                    <h4>Address</h4>
                                    <p class="mb-2">123 Street New York.USA</p>
                                </div>
                            </div>
                            <div class="d-flex p-4 rounded mb-4 bg-white">
                                <i class="fas fa-envelope fa-2x text-primary me-4"></i>
                                <div>
                                    <h4>Mail Us</h4>
                                    <p class="mb-2">info@example.com</p>
                                </div>
                            </div>
                            <div class="d-flex p-4 rounded bg-white">
                                <i class="fa fa-phone-alt fa-2x text-primary me-4"></i>
                                <div>
                                    <h4>Telephone</h4>
                                    <p class="mb-2">(+012) 3456 7890</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact End -->
<?php
include("footer.php");
?>
