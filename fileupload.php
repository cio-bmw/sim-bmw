<?
include_once("config.php"); 
$upload = $_POST['upload'];

if (isset($upload)) {

$temp = explode(".",$_FILES["Filename"]["name"]);
$newfilename = 'da1-'.rand(1,99999) . '.' .end($temp);

$target = "datafile/";
// asline $target = $target . basename( $_FILES['Filename']['name']);
$target = $target.$newfilename;

//This gets all the other information from the form
$Filename=basename( $_FILES['Filename']['name']);
$Description=$_POST['Description'];


//Writes the Filename to the server
if(move_uploaded_file($_FILES['Filename']['tmp_name'], $target)) {
    //Tells you if its all ok
    echo "The file ". basename( $_FILES['Filename']['name']). " has been uploaded, and your information has been added to the directory";
    // Connects to your Database
 ///   mysql_connect("localhost", "root", "") or die(mysql_error()) ;
 //   mysql_select_db("bmwaltabotanikk") or die(mysql_error()) ;

    //Writes the information to the database
    mysql_query("INSERT INTO picture (Filename,Description)
    VALUES ('$Filename', '$Description')") ;
} else {
    //Gives and error if its not
    echo "Sorry, there was a problem uploading your file.";
}
} else {
?>

<form method="post" action="" enctype="multipart/form-data">
    <p>Photo:</p>
    <input type="file" name="Filename"> 
    <p>Description</p>
    <textarea rows="10" cols="35" name="Description"></textarea>
    <br/>
    <input TYPE="submit" name="upload" value="Add"/>
</form>

<? } 

?>