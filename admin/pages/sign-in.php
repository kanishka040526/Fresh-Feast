<?php

session_start();

include("connectmysql.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $email = $_POST['email'];
    $password = $_POST['password'];
    $pattern = "/^[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/";
    $errors = [];

    if(empty($email)){
        $errors['email'] = "*required*";
    }else if (!preg_match($pattern,$email)) {
        $errors['emails'] = "*Enter a valid email*";
    }else{
        $email_check = "SELECT * FROM admin_detail WHERE email = ?";
        $sql = $conn->prepare($email_check);
        $sql->bind_param("s", $email);
        $sql->execute();
        $result = $sql->get_result();
        if($result->num_rows < 1){
            $errors['email'] = "*Email not registered*";
        }else {
            $errors['emails'] = "";
        }     
    }

    if (empty($password)) {
        $errors['password'] = "*required*";
    }elseif (strlen($password) < 6) {
        $errors['password'] = "*Atlest 6 character required*";
    }else {
        if (empty($errors['email'])) {
            $password_check = "SELECT * FROM admin_detail WHERE email = ? AND password = ?";
            $sql = $conn->prepare($password_check);
            $sql->bind_param("ss", $email, $password); 
            $sql->execute();
            $result = $sql->get_result();
            if ($result->num_rows < 1) {
                $errors['password'] = "*Password doesn't Match*";
            }
            else {
                $userdetails = $result->fetch_assoc();
                $_SESSION['userdetails'] = [
                    'userName' => $userdetails['userName'],
                    'email' => $userdetails['email'],
                    'password' => $userdetails['password']
                ];
                $_SESSION['success'] = "login Successfully!";
                header('Location: dashboard.php');
                exit();
            }
        }
    }
}
$conn -> close();

?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign-in</title>
    <link rel="icon type" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQsp1ZogWcSUdojcoZnDbfjPZYkeJY5aCQX3g&s">
    <link rel="stylesheet" href="pcss/sign-in.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="container-sign-in">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a aria-current="page" href="dashboard.php">
                <i class="fa fa-chart-pie"></i>Dashboard</a>
            </li>
          <li class="nav-item">
            <a href="profile.php"><i class="fa fa-user"></i>Profile</a>
          </li>
          <li class="nav-item">
            <a href="signup.php">
            <i class="fas fa-user-circle"></i>Sign Up</a>
          </li>
          <li class="nav-item">
            <a href="sign-in.php">
            <i class="fas fa-key"></i>Sign In</a>
          </li>
        </ul>
    </div>
    <div class="big-coontainer">
        <div class="container-1">
            <h1>Sign in</h1>
            <p>Enter your Email and password</p>
            <form action="sign-in.php" method="post" novalidate>
                <div>
                    <input type="email" name="email" id="email" placeholder="Email" value="<?= isset($email) ? htmlspecialchars($email) : ''; ?>">
                    <b><span class="errors"> <?= isset($errors['email']) ? $errors['email'] : '' ?>
                    </span></b>
                </div>
                <div>
                    <input type="password" name="password" id="password" placeholder="Password" value="<?= isset($password) ? htmlspecialchars($password) : ''; ?>">
                    <b><span class="errors"> <?= isset($errors['password']) ? $errors['password'] : ''; ?>
                    </span></b>
                </div>
                <p><a href="">Forgot password ?</a></p>
                <div>
                    <input type="submit" value="Login">
                </div>
            </form>
        </div>
        <div class="container-2">
            <h1>Fruitables</h1>
            <p>fresh fruits <br> and vegetables</p>
        </div>
    </div>
</body>
</html>