<?php

$userdetails = isset($_SESSION['userdetails']) ? $_SESSION['userdetails'] : [];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon type" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQsp1ZogWcSUdojcoZnDbfjPZYkeJY5aCQX3g&s">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Marck+Script&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="pcss/dashboard.css">
    <link rel="stylesheet" href="pcss/form.css">
    <link rel="stylesheet" href="pcss/pages.css">
    <link rel="stylesheet" href="pcss/products.css">
    <link rel="stylesheet" href="pcss/orders.css">
    <link rel="stylesheet" href="pcss/profile.css">
    <link rel="stylesheet" href="pcss/top-navbar.css">
    <link rel="stylesheet" href="pcss/sidenavbar.css">
    
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar-main" id="navbarBlur" data-scroll="false">
        <div class="container-fluid">
            <div class="sidenav-header">
                <div class="navbar-brand">
                    <i class="fas fa-bars" style="padding:0px; color:white;" id="toggleSidenav"></i>
                    <span>Fruitables</span>
                </div>
            </div>
            <div class="search_bar">
                <div class="navbar-collapse" id="navbar">
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-search" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" style="margin:0px;" placeholder="Type here...">
                    </div>
                </div>
                <ul class="top-navbar-nav">
                    <li class="nav-item top-navbar-nav">
                        <img src="../../asset/img/avatar.jpg" class="img-fluid" alt="image">
                        <div class="user_details">
                            <a><?php echo isset($userdetails['userName'])? htmlspecialchars($userdetails['userName']):'';?></a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="logout.php"><i class="fa fa-sign-out" style="font-size:40px; padding: 4px; margin-top:4px;color:red"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>