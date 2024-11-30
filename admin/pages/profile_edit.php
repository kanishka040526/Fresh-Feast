<?php
    session_start();
    $userdetails = isset($_SESSION['userdetails']) ? $_SESSION['userdetails'] : [];
    // print_r($userdetails);die;

    include("connectmysql.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
        $userName = $_POST['userName'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $errors = [];
        $pattern =  "/^[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/";

        if(empty($userName)){
            $errors['userName'] = "*Required*";
        }else if ($userName == " " || $userName < 2) {
            $errors['userName'] = "*Enter correct Name*";
        }else{
            $errors['userName'] = "";
        }

        if (empty($email)) {
            $errors['email'] = "*Required*";
        }elseif (!preg_match($pattern,$email)) {
            $errors['email'] = "*Enter valid Email*";
        }else {
            $errors['email'] = "";
        }

        if(empty($password)){
            $errors['password'] = "*Required*";
        }elseif (strlen($password) < 6) {
            $errors['password'] = "*Atleast 6 character required*";
        }else {
            $errors['password'] = "";
        }

        $errors = array_filter($errors);

        if(empty($errors)){
            $update = "UPDATE admin_detail SET userName = ? , email = ?, password= ? WHERE email = ?";
            $sql = $conn->prepare($update);
            $sql->bind_param('ssss', $userName, $email, $password, $userdetails['email']);

            if($sql->execute()){
                $_SESSION['userdetails'] = [
                    'userName' => $userName,
                    'email' => $email,
                    'password' => $password
                ];
                $_SESSION['profile_update'] = "Updated successfully";
                header("Location:profile.php");
                exit();
            }else {
            echo "Error: " . $sql->error;
        }
    }
    }
    $conn->close();
    include("navbar.php");
?>
<section>
    <div class="container-sidenav">
            <?php
                include('sidenavbar.php');
            ?>
        </div>
        <div class="container">
        <h1>Update profile</h1>
        <form class="form_data" action="" method="post" novalidate>
            <div>
                <label class="label" for="name">Name:</label> 
                <input type="text" name="userName" id="userName" placeholder="Name" value="<?= isset($userdetails['userName']) ? htmlspecialchars($userdetails['userName']):'';?>">
                <span class="errors"><?= isset($errors['userName'])? $errors['userName'] :'';?></span>
            </div>    
            <div>
            <label class="label" for="email">Email:</label>      
                <input type="email" name="email" id="email" placeholder="Email" value="<?= isset($userdetails['email']) ? htmlspecialchars($userdetails['email']):'';?>" >
                <span class="errors"><?= isset($errors['email'])? $errors['email']:'';?></span>
            </div>
            <div>
            <label class="label" for="password">Password:</label>      
                <input type="password" name="password" id="password" placeholder="Password" value="<?= isset($userdetails['password']) ? htmlspecialchars($userdetails['password']):'';?>">
                <span class="errors"><?= isset($errors['password'])? $errors['password']:'';?></span>
            </div>
                <div>
                    <input type="submit" name = "update" value="Update">
                </div>
        </form>
    </div>
</section>
</body>
</html>
