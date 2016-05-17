<?
$con=mysqli_connect("localhost","root","11111","bmw");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  } else {
   echo "koneksi berhasil";	
  	}
 ?> 