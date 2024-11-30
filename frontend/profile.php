<?php

session_start();

if (!isset($_SESSION['users'])) {
    header('Location: sign-in.php');
    exit();
  }

include('header.php');
  
$users = isset($_SESSION['users']) ? $_SESSION['users'] : [];
?>
<div>
    <div class="container-details"> 
        <div class="user-profile">
            <h3>User Profile</h3>
            <p><a href="edit_profile.php">Edit</a></p>
        </div>
    <form action="profile.php" class="user_details" method="post" novalidation>
        <div>
            <label class="label" for="userName">Name:</label>
            <input type="text" name="userName" id="userName"
            value="<?= isset($users['userName'])? htmlspecialchars($users['userName']):''; ?>">
        </div>
        <div>                    
        <label class="label" for="email">Email:</label>
        <input type="email" name="email" id="email"
            value="<?=isset($users['email'])? htmlspecialchars($users['email']):''; ?>">
        </div>
        <div>                    
        <label class="label" for="password">Password:</label>
        <input type="password" name="password" id="password"
            value="<?=isset($users['password'])? htmlspecialchars($users['password']):'';?>">
        </div>
        <div>                    
        <label class="label" for="Number">Number:</label>
        <input type="number" name="tel" id="tel"
            value="<?=isset($users['tel'])? htmlspecialchars($users['tel']):'';?>">
        </div>
    </form>
</div>

<?php
    include("footer.php");
?>