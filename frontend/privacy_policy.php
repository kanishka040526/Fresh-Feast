<?php
include("header.php");

include("connectmysql.php");

$sql = "SELECT content FROM privacy_policy ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

$content = "";


$conn->close();

?>

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Privacy Policy</h1>
</div>
<!-- Single Page Header End -->

<div class="container-fluid testimonial py-5">
<?php 
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()){
?>
<div class="container">
    <?php echo ($row['content']); ?>
</div>
<?php
    }
}else{
    echo "nothing !!!!!";
}
?>
</div>

<?php
include("footer.php");
?>