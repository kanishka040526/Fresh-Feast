<?php

session_start();

if (!isset($_SESSION['users'])) {
    header('Location: sign-in.php');
    exit();
  }

include('header.php');
  
$users = isset($_SESSION['users']['id']) ? $_SESSION['users']['id'] : NULL;
// echo($users);die;
if(!empty($users)){
    $profile_details = $conn->prepare("SELECT * FROM user WHERE id = ?");
    $profile_details->bind_param('i', $users);
    $profile_details->execute();
    $profile_result = $profile_details->get_result();
    $profile_data = $profile_result->fetch_assoc();
    // print_r($profile_data);die;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = $_POST['userName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $tel = $_POST['tel'];
    $errors = [];
         
    if(empty($userName)){
        $errors['userName'] = "*Required*";
    }else{
        $errors['userName'] = "";
    }

    if (empty($email)) {
        $errors['email'] = "*Required*";
    }else {
        $errors['email'] = "";
    }

    if (empty($password)) {
        $errors['password'] = "*Required*";
    }else {
        $errors['password'] = "";
    }

    if (empty($tel)) {
        $errors['tel'] = "*Required*";
    }else {
        $errors['tel'] = "";
    }

    $errors = array_filter($errors);

    if(empty($errors) && isset($_POST['update'])){

        $update = "UPDATE user SET userName = ? , email = ?, password = ?, tel = ? WHERE id = ?";
        $sql = $conn->prepare($update);
        $sql->bind_param('ssssi', $userName, $email, $password, $tel, $users);
       
        if($sql->execute()){
            $_SESSION['success'] = "successfully Updated";
            // header("Location:profile.php");
            // exit();
        }else {
        echo "Error: " . $sql->error;
        }
    }
}
$conn->close();

?>
<div>
    <div class="container-details">
        <div class="user-profile">
            <h3>Update Profile</h3>
        </div>
    <form action="edit_profile.php" method="post" novalidation>
        <div>
            <label class="label" for="userName">Name:</label>
            <input type="text" name="userName" id="userName"
            value="<?= isset($profile_data['userName'])? htmlspecialchars($profile_data['userName']):''; ?>">
        </div>
        <div>                    
        <label class="label" for="email">Email:</label>
        <input type="email" name="email" id="email"
            value="<?=isset($profile_data['email'])? htmlspecialchars($profile_data['email']):''; ?>">
        </div>
        <div>                    
        <label class="label" for="password">Password:</label>
        <input type="password" name="password" id="password"
            value="<?=isset($profile_data['password'])? htmlspecialchars($profile_data['password']):'';?>">
        </div>
        <div>                    
        <label class="label" for="Number">Number:</label>
        <input type="number" name="tel" id="tel"
            value="<?=isset($profile_data['tel'])? htmlspecialchars($profile_data['tel']):'';?>">
        </div>
        <div class="update_delete">
            <input class="btn border-secondary py-3 bg-white text-primary " type="submit" name="update" value="update">
        </div>
    </form>
</div>

<?php
    include("footer.php");
?>