<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $UpdatedInDB=$_POST['UpdatedInDB']; 
 $ReceivingDateTime=$_POST['ReceivingDateTime']; 
 $Text=$_POST['Text']; 
 $SenderNumber=$_POST['SenderNumber']; 
 $Coding=$_POST['Coding']; 
 $UDH=$_POST['UDH']; 
 $SMSCNumber=$_POST['SMSCNumber']; 
 $Class=$_POST['Class']; 
 $TextDecoded=$_POST['TextDecoded']; 
 $ID=$_POST['ID']; 
 $RecipientID=$_POST['RecipientID']; 
 $Processed=$_POST['Processed']; 
	
	if($action=="add") //menangani aksi penambahan data inbox 
	{ 
   //$sql = "SELECT IFNULL(max(CAST(idinbox AS UNSIGNED)),0)+1  FROM inbox";  
   //$result = mysql_query($sql);  
  //$data  = mysql_fetch_array($result);  
  //$idinbox = $data[0];	 
    mysql_query(" insert into inbox (UpdatedInDB,ReceivingDateTime,Text,SenderNumber,Coding,UDH,SMSCNumber,Class,TextDecoded,ID,RecipientID,Processed)  values  ('$UpdatedInDB','$ReceivingDateTime','$Text','$SenderNumber','$Coding','$UDH','$SMSCNumber','$Class','$TextDecoded','$ID','$RecipientID','$Processed')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data inbox 
	{ 
$sql = " update inbox set UpdatedInDB='$UpdatedInDB',ReceivingDateTime='$ReceivingDateTime',Text='$Text',SenderNumber='$SenderNumber',Coding='$Coding',UDH='$UDH',SMSCNumber='$SMSCNumber',Class='$Class',TextDecoded='$TextDecoded',ID='$ID',RecipientID='$RecipientID',Processed='$Processed' where UpdatedInDB = $UpdatedInDB";  
		$test = mysql_query($sql); 
		echo '{"status":"2"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data inbox 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from inbox where UpdatedInDB ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
