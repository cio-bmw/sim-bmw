<?php 
include_once('config.php'); 

$text = $_POST['text'];
$execute = $_POST['execute'];

if (isset($execute)) {
$exe = mysql_query("'".$text."'");
echo $text;
}

?>

<form method="post" name="category_form" action="" id="category_form">  
<textarea name="text"  cols="50"></textarea>
<input type="submit" name = "execute" value="execute">
</form>

