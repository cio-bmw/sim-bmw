<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $UpdatedInDB=$_POST['UpdatedInDB']; 
 $InsertIntoDB=$_POST['InsertIntoDB']; 
 $SendingDateTime=$_POST['SendingDateTime']; 
 $DeliveryDateTime=$_POST['DeliveryDateTime']; 
 $Text=$_POST['Text']; 
 $DestinationNumber=$_POST['DestinationNumber']; 
 $Coding=$_POST['Coding']; 
 $UDH=$_POST['UDH']; 
 $SMSCNumber=$_POST['SMSCNumber']; 
 $Class=$_POST['Class']; 
 $TextDecoded=$_POST['TextDecoded']; 
 $ID=$_POST['ID']; 
 $SenderID=$_POST['SenderID']; 
 $SequencePosition=$_POST['SequencePosition']; 
 $Status=$_POST['Status']; 
 $StatusError=$_POST['StatusError']; 
 $TPMR=$_POST['TPMR']; 
 $RelativeValidity=$_POST['RelativeValidity']; 
 $CreatorID=$_POST['CreatorID']; 
	
	if($action=="add") //menangani aksi penambahan data sentitems 
	{ 
   //$sql = "SELECT IFNULL(max(CAST(idsentitems AS UNSIGNED)),0)+1  FROM sentitems";  
   //$result = mysql_query($sql);  
  //$data  = mysql_fetch_array($result);  
  //$idsentitems = $data[0];	 
    mysql_query(" insert into sentitems (UpdatedInDB,InsertIntoDB,SendingDateTime,DeliveryDateTime,Text,DestinationNumber,Coding,UDH,SMSCNumber,Class,TextDecoded,ID,SenderID,SequencePosition,Status,StatusError,TPMR,RelativeValidity,CreatorID)  values  ('$UpdatedInDB','$InsertIntoDB','$SendingDateTime','$DeliveryDateTime','$Text','$DestinationNumber','$Coding','$UDH','$SMSCNumber','$Class','$TextDecoded','$ID','$SenderID','$SequencePosition','$Status','$StatusError','$TPMR','$RelativeValidity','$CreatorID')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data sentitems 
	{ 
$sql = " update sentitems set UpdatedInDB='$UpdatedInDB',InsertIntoDB='$InsertIntoDB',SendingDateTime='$SendingDateTime',DeliveryDateTime='$DeliveryDateTime',Text='$Text',DestinationNumber='$DestinationNumber',Coding='$Coding',UDH='$UDH',SMSCNumber='$SMSCNumber',Class='$Class',TextDecoded='$TextDecoded',ID='$ID',SenderID='$SenderID',SequencePosition='$SequencePosition',Status='$Status',StatusError='$StatusError',TPMR='$TPMR',RelativeValidity='$RelativeValidity',CreatorID='$CreatorID' where UpdatedInDB = $UpdatedInDB";  
		$test = mysql_query($sql); 
		echo '{"status":"2"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data sentitems 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from sentitems where UpdatedInDB ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
