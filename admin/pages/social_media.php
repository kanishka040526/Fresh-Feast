<?php
session_start();

if (!isset($_SESSION['userdetails'])) {
    header('Location: sign-in.php');
    exit();
}
include("connectmysql.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save'])) {
    $platform = $_POST['platform'];
    $url = $_POST['url'];
    $icon = $_POST['icon'];
    $errors = [];

    if(empty($platform)){
        $errors['platform'] = "*required*";
    }else{
        $errors['platform'] = "";
    }
    if(empty($url)){
        $errors['url'] = "*required*";
    }else{
        $errors['url'] = "";
    }
    if(empty($platform)){
        $errors['icon'] = "*required*";
    }else{
        $errors['icon'] = "";
    }

    $errors = array_filter($errors);

    if(empty($errors)){
    $sql = "INSERT INTO social_media (platform, url, icon) VALUES ('$platform', '$url', '$icon')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['account_success'] = "Submitted!!";
        header("Location:social_media.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    }
}
$conn->close();

include("navbar.php"); 
?>
    <div class="container-form">
      <section>
        <div class="container-sidenav">
            <?php
                include('sidenavbar.php');
            ?>    
        </div>
        <div class="container">
        <h1 class="text-secondary">Social-Media Accounts</h1>
        <form action="social_media.php" class="form_data" method="POST" novalidate>
            <div>
                <label class="label"for="platform">Platform:</label>
                <input type="text" id="platform" name="platform" placeholder="Platform..." value="<?= isset($platform) ? htmlspecialchars($platform) : ''; ?>">
                <span class="errors">
              <?= isset($errors['platform']) ? $errors['platform'] : ''; ?>
            </span>
            </div>
            <div>
                <label class="label" for="url">URL:</label>
                <input type="text" id="url" name="url" placeholder="url..." value="<?= isset($url) ? htmlspecialchars($url) : ''; ?>">
                <span class="errors">
                    <?= isset($errors['url']) ? $errors['url'] : ''; ?>
                </span>
            </div>
            <div>
                <label class="label"for="icon">icon:</label>
                <input type="text" id="icon" name="icon" placeholder="icon..." value="<?= isset($icon) ? htmlspecialchars($icon) : ''; ?>">
                <span class="errors">
                    <?= isset($errors['icon']) ? $errors['icon'] : ''; ?>
                </span>
            </div>
            <input type="submit" value="Save" name="save">
        </form>
        </div>
      </section>
    </div>
