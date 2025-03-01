<?php

include("connectmysql.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $userName = $_POST['userName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $tel = $_POST['tel'];
    $pattern = "/^[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/";
    $errors = [];

    if(empty($userName)){
        $errors['userName'] = "*required*";
    }elseif($userName == " " || $userName < 2){
        $errors['userName'] = '*Enter valid Name*';
    }else{
        $errors['userName'] = "";
    }

    if(empty($email)){
        $errors['email'] = "*required*";
    }elseif(!preg_match($pattern,$email)){
        $errors['email'] = '*Enter valid Email*';
    }else{
        $email_check = "SELECT * FROM user WHERE email = ?";
        $sql = $conn->prepare($email_check);
        $sql->bind_param('s', $email);
        $sql->execute();
        $result = $sql->get_result();
        
        if ($result->num_rows > 0) {
            $errors['email'] = "*Email already exist*";
        }
    }

    if (empty($password)) {
        $errors['password'] = "*required*";
    }elseif (strlen($password) < 6) {
        $errors['password'] = "*Atleast 6 characters required*";
    }else{
        $errors['password'] = "";
    }

    if (empty($tel)) {
        $errors['tel'] = "*required*";
    }elseif (strlen($tel) < 6) {
        $errors['tel'] = "*Invalid Number*";
    }else{
        $errors['tel'] = "";
    }

    $errors = array_filter($errors);

    if(empty($errors)){
        $user = "INSERT INTO user(userName, email, password, tel) VALUES ('$userName', '$email','$password', '$tel')";

        if($conn->query($user) === TRUE){
            echo "Register successfully";
        }else{
            echo "error :" . $user->error;
        }
    }
    if(empty($errors)){
        header("Location:sign-in.php");
        exit();
    }
    
    $conn->close();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="icon type" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQsp1ZogWcSUdojcoZnDbfjPZYkeJY5aCQX3g&s">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../asset/css/sign-up.css" rel="stylesheet">
</head>
<body>
    <div class="container-signup">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a aria-current="page" href="index.php">
                <i class="fa fa-chart-pie"></i>Home</a>
            </li>
          <li class="nav-item">
            <a href="#"><i class="fa fa-user"></i>Profile</a>
          </li>
          <li class="nav-item">
            <a href="#">
            <i class="fas fa-user-circle"></i>Sign Up</a>
          </li>
          <li class="nav-item">
            <a href="sign-in.php">
            <i class="fas fa-key"></i>Sign In</a>
          </li>
        </ul>
    </div> 
    <div class="container-main">
        <div class="card-header text-center pt-4">
            <h2>Create account</h2>
        </div>
        <div class="register-form">
            <form action="sign-up.php" method="post" novalidation>
                <div>
                    <input type="text" name="userName" id="userName" placeholder="Name.." value="<?= isset($userName) ? htmlspecialchars($userName) : '' ?>">
                    <span class="errors"><?=isset($errors['userName'])? $errors['userName']:''; ?></span>
                </div>
                <div>
                    <input type="email" name="email" id="email" placeholder="email.." value="<?= isset($email) ?
                    htmlspecialchars($email) : '' ?>">
                    <span class="errors"><?=isset($errors['email'])? $errors['email']:''; ?></span>
                </div>
                <div>
                    <input type="password" name="password" id="password" placeholder="password.." value="<?= isset($password) ? htmlspecialchars($password) : '' ?>">
                    <span class="errors"><?=isset($errors['password'])? $errors['password']:''; ?></span>
                </div>
                <div>
                    <input type="tel" name="tel" id="tel" placeholder="Number.." value="<?= isset($tel) ? htmlspecialchars($tel) : '' ?>">
                    <span class="errors"><?=isset($errors['tel'])? $errors['tel']:''; ?></span>
                </div>
                <div>
                    <input type="checkbox" name="terms" id="terms" checked>
                    <span class="terms-and-conditions">I Agree all<a href="#">Terms and conditions</a><span>
                </div>
                <div>
                    <input type="submit" value="Sign-up">
                </div>
                <div>
                   <p class="sign-in-here">already have an account? <a href="sign-in.php">sign in</a></p>
                </div>
            </form>
        </div>
    </div>        
</body>
</html>