<?php

include("connectmysql.php");
if($_SERVER["REQUEST_METHOD"] == "POST"){
$terms = $_POST['editor1'];

$sql = "INSERT INTO terms_and_condition (content) VALUES (?)";
$sql = $conn->prepare($sql);
$sql->bind_param("s", $terms);
$sql->execute();
header("Location: terms_and_condition.php");

}

$conn->close();
include("navbar.php");
?>
<section>
<div class="top-nav">
    <?php include("sidenavbar.php");?>
</div>
</div>
<div class="text_box">
    <form action="terms_and_condition.php" method="post">
        <textarea name="editor1" id="editor1">Type here and show console to see editor's height</textarea>
        <button class="btn_submit" type="submit">Save</button>
    </form>
</div>
</section>
<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min."></script>

<script>
    CKEDITOR.replace( 'editor1' );
CKEDITOR.on( 'instanceReady', function( evt )
  {
    var editor = evt.editor;
   
   editor.on('change', function (e) { 
    var contentSpace = editor.ui.space('contents');
    var ckeditorFrameCollection = contentSpace.$.getElementsByTagName('iframe');
    var ckeditorFrame = ckeditorFrameCollection[0];
    var innerDoc = ckeditorFrame.contentDocument;
    var innerDocTextAreaHeight = $(innerDoc.body).height();
    console.log(innerDocTextAreaHeight);
    });
 });

</script>
</body>
</html>

