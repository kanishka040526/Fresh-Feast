<?php
session_start();
include('connectmysql.php');

if (!isset($_SESSION['userdetails'])) {
  header('Location: sign-in.php');
  exit();
}
else{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $code = $_POST['code'];
        $discount_type = $_POST['discount_type'];
        $discount_value = $_POST['discount_value'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $usage_limit = $_POST['usage_limit'];
        $errors = [];

        if(empty($code)){
            $errors['code'] = "*Requeried*";
        }
        if(empty($discount_type)){
            $errors['discount_type'] = "*Requeried*";
        }
        if(empty($discount_value)){
            $errors['discount_value'] = "*Requeried*";
        }
        if(empty($start_date)){
            $errors['start_date'] = "*Requeried*";
        }
        if(empty($end_date)){
            $errors['end_date'] = "*Requeried*";
        }
        if(empty($usage_limit)){
            $errors['usage_limit'] = "*Requeried*";
        }
        
        $errors = array_filter($errors);

        if(empty($errors)){
        $sql = $conn->prepare("INSERT INTO coupons (code, discount_type, discount_value, start_date, end_date, usage_limit) VALUES (?, ?, ?, ?, ?, ?)");
        $sql->bind_param('isssss', $code, $discount_type, $discount_value, $start_date, $end_date, $usage_limit);
        $sql->execute();
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
        <h1 class="text-secondary">Create Coupon</h1>
        <form method="POST" id="discountForm" class="form_data" action="add_discount.php" novalidation>
            <div>
                <label for="code">Coupon Code</label>
                <input type="text" name="code" placeholder="Coupon Code...." value="<?= isset($code) ? htmlspecialchars($code) : ''; ?>">
                <scan class="errors">
                    <?= isset($errors['code']) ? $errors['code']:'';?>
                </scan>
                <select name="discount_type" class="discount_type" style="display:block;">
                    <option value="percentage">Percentage</option>
                    <option value="fixed">Fixed Amount</option>
                </select>
            </div>
            <div>
                <label for="code">Discount Value</label>
                <input type="number" step="0.01" name="discount_value" placeholder="Discount Value" value="<?= isset($discount_value) ? htmlspecialchars($discount_value) : ''; ?>">
                <scan class="errors">
                    <?= isset($errors['discount_value']) ? $errors['discount_value']:'';?>
                </scan>
            </div>
            <div>
                <label for="code">Start Date</label>
                <input type="date" name="start_date" value="<?= isset($start_date) ? htmlspecialchars($start_date) : ''; ?>">
                <scan class="errors">
                    <?= isset($errors['start_date']) ? $errors['start_date']:'';?>
                </scan>
            </div>
            <div>
                <label for="end_date">End Date</label>
                <input type="date" name="end_date" value="<?= isset($end_date) ? htmlspecialchars($end_date) : ''; ?>">
                <scan class="errors">
                    <?= isset($errors['end_date']) ? $errors['end_date']:'';?>
                </scan>
            </div>
            <div>
                <label for="usage limit">Usage Limit</label>
                <input type="number" name="usage_limit" placeholder="Usage Limit" value="<?= isset($usage_limit) ? htmlspecialchars($usage_limit) : ''; ?>">
                <scan class="errors">
                    <?= isset($errors['usage_limit']) ? $errors['usage_limit']:'';?>
                </scan>
            </div>
            <div>
                <input type="submit" value="Create Coupon">
            </div>
</form>
      </div>
    </section>
  </div>

  <script>
  document.getElementById('discountForm').addEventListener('submit', function (event) {
    const startDate = new Date(document.getElementById('start_date').value);
    const endDate = new Date(document.getElementById('end_date').value);
    const today = new Date();
    today.setHours(0, 0, 0, 0);

    if (startDate <= today) {
      event.preventDefault();
      alert('Start date must be after today.');
    } else if (endDate <= startDate) {
      event.preventDefault();
      alert('End date must be after the start date.');
    }
  });
</script>
</body>

</html>