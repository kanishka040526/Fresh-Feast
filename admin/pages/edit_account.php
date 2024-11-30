<?php
    session_start();

    if (!isset($_SESSION['userdetails'])) {
        header('Location: sign-in.php');
        exit();
    }

    $productdetails = [];
    
    include('connectmysql.php');

    $account_id = isset($_GET['id']) ? ($_GET['id']) : "";

    if ($account_id) { 
        $sql = "SELECT * FROM social_media WHERE id = ?";
        $sql = $conn->prepare($sql);
        $sql->bind_param("i", $account_id);
        $sql->execute();
        $result = $sql->get_result();
        $productdetails = $result->fetch_assoc();
        // print_r($productdetails);die;
    }
 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $platform = $_POST['platform'];
        $url = $_POST['url'];
        $icon = $_POST['icon'];
        $errors = [];
        
        if(empty($platform)){
            $errors['platform'] = "*Required*";
        }else{
            $errors['platform'] = "";
        }

        if (empty($url)) {
            $errors['url'] = "*Required*";
        }else {
            $errors['url'] = "";
        }

        if (empty($icon)) {
            $errors['icon'] = "*Required*";
        }else {
            $errors['icon'] = "";
        }
        $errors = array_filter($errors);

        if(empty($errors) &&  isset($_POST['update'])){

            $update = "UPDATE social_media SET platform = ? , url = ?, icon = ? WHERE id = ?";
            $sql = $conn->prepare($update);
            $sql->bind_param('sssi', $platform, $url, $icon, $account_id);
            $sql->execute();
           
            $result = $sql->get_result();
           
            if($sql->execute()){
                $_SESSION['edit_account_success'] = "successfully Updated";
                header("Location:social_accounts.php");
                exit();
            }else {
            echo "Error: " . $sql->error;
            }
        }
    }
    $conn->close();
    include("navbar.php");
?>

<div class="container-form">
    <section>
      <div class="container-sidenav">
        <?php include('sidenavbar.php')?>
      </div>
      <div class="container">
        <h1 class="text-secondary">Update Account</h1>
        <form action="" class="form_data" method="post" novalidate enctype="multipart/form-data">
            <div>
                <label for="category name">platform</label>
                <input type="text" id="platform" name="platform" placeholder="Name" value="<?= isset($productdetails['platform']) ? htmlspecialchars($productdetails['platform']):'';?>">
                <scan class="errors">
                    <?= isset($errors['platform']) ? $errors['platform']:'';?>
                </scan>
            </div>
            <div>
                <label for="url">Url</label>
                <textarea name="url" id="url" placeholder="url" ><?= isset($productdetails['url']) ? htmlspecialchars($productdetails['url']):'';?></textarea>
                <scan class="errors">
                    <?= isset($errors['url']) ? $errors['url']:'';?>
                </scan>
            </div>
            <div>
                <label for="icon">icon</label>
                <textarea name="icon" id="icon" placeholder="icon" ><?= isset($productdetails['icon']) ? htmlspecialchars($productdetails['icon']):'';?></textarea>
                <scan class="errors">
                    <?= isset($errors['icon']) ? $errors['icon']:'';?>
                </scan>
            </div>
            <div class="update_delete">
                <input type="submit" name="update" value="update">
            </div>
        </form>
    </div>
    </section>
    </div>
</body>

</html>
