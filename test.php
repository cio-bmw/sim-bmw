 <?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 

 $sql = "select * from sektor"; 
 $result = mysql_query($sql);
?> 
		<?php 
   		
   	//menampilkan data sektor 
	
		$i=1;
		$no=0;
  		while($row = mysql_fetch_array($result)){
       $idsektor.$i =   $row['idsektor'];
             
       $test =mysql_query("insert into test(test) values ('$idsektor.$i')");
    	 }
	     
?>