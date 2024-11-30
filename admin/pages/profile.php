<?php
session_start();

$userdetails = isset($_SESSION['userdetails']) ? $_SESSION['userdetails'] : [];
include("navbar.php");
?>
    <section>
        <div class="container-sidenav">
            <?php
                include('sidenavbar.php');
            ?>
        </div>
            <div class="container">
                <div class="done_successfully">
                <?php
                if (isset($_SESSION['profile_update'])) {
                    echo $_SESSION['profile_update'] ;
                    unset($_SESSION['profile_update']);
                  }
                  ?>
                  </div>
                <div class="heading">
                    <h1 class="text-secondary">User Profile</h1>
                    <p><a href="profile_edit.php">Edit</a></p>
                </div>
                <form class="form_data" action="profile.php" method="post" novalidation>
                    <div>
                    <label class="label" for="userName">Name:</label>
                    <input type="text" name="userName" id="userName"
                        value="<?= isset($userdetails['userName'])? htmlspecialchars($userdetails['userName']):''; ?>">
                    </div>
                    <div>                    
                    <label class="label" for="email">Email:</label>
                    <input type="email" name="email" id="email"
                        value="<?=isset($userdetails['email'])? htmlspecialchars($userdetails['email']):''; ?>">
                    </div>
                    <div>                    
                    <label class="label" for="password">Password:</label>
                    <input type="password" name="password" id="password"
                        value="<?=isset($userdetails['password'])? htmlspecialchars($userdetails['password']):'';?>">
                    </div>
                </form>
            </div>
            </section>
</body>
</html>