<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $UpdatedInDB=$_POST['UpdatedInDB']; 
 $InsertIntoDB=$_POST['InsertIntoDB']; 
 $SendingDateTime=$_POST['SendingDateTime']; 
 $Text=$_POST['Text']; 
 $DestinationNumber=$_POST['DestinationNumber']; 
 $Coding=$_POST['Coding']; 
 $UDH=$_POST['UDH']; 
 $Class=$_POST['Class']; 
 $TextDecoded=$_POST['TextDecoded']; 
 $ID=$_POST['ID']; 
 $MultiPart=$_POST['MultiPart']; 
 $RelativeValidity=$_POST['RelativeValidity']; 
 $SenderID=$_POST['SenderID']; 
 $SendingTimeOut=$_POST['SendingTimeOut']; 
 $DeliveryReport=$_POST['DeliveryReport']; 
 $CreatorID=$_POST['CreatorID']; 
	
	if($action=="add") //menangani aksi penambahan data outbox 
	{ 
   //$sql = "SELECT IFNULL(max(CAST(idoutbox AS UNSIGNED)),0)+1  FROM outbox";  
   //$result = mysql_query($sql);  
  //$data  = mysql_fetch_array($result);  
  //$idoutbox = $data[0];	 
    mysql_query(" insert into outbox (UpdatedInDB,InsertIntoDB,SendingDateTime,Text,DestinationNumber,Coding,UDH,Class,TextDecoded,ID,MultiPart,RelativeValidity,SenderID,SendingTimeOut,DeliveryReport,CreatorID)  values  ('$UpdatedInDB','$InsertIntoDB','$SendingDateTime','$Text','$DestinationNumber','$Coding','$UDH','$Class','$TextDecoded','$ID','$MultiPart','$RelativeValidity','$SenderID','$SendingTimeOut','$DeliveryReport','$CreatorID')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data outbox 
	{ 
$sql = " update outbox set UpdatedInDB='$UpdatedInDB',InsertIntoDB='$InsertIntoDB',SendingDateTime='$SendingDateTime',Text='$Text',DestinationNumber='$DestinationNumber',Coding='$Coding',UDH='$UDH',Class='$Class',TextDecoded='$TextDecoded',ID='$ID',MultiPart='$MultiPart',RelativeValidity='$RelativeValidity',SenderID='$SenderID',SendingTimeOut='$SendingTimeOut',DeliveryReport='$DeliveryReport',CreatorID='$CreatorID' where UpdatedInDB = $UpdatedInDB";  
		$test = mysql_query($sql); 
		echo '{"status":"2"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data outbox 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from outbox where UpdatedInDB ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
