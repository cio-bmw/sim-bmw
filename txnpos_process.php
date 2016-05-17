<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $idtxnpos=$_POST['idtxnpos']; 
 $posname=$_POST['posname']; 
	if($action=="add") //menangani aksi penambahan data txnpos 
	{ 
 mysql_query(" insert into txnpos (idtxnpos,posname)  values  ('$idtxnpos','$posname')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data txnpos 
	{ 
$sql = " update txnpos set idtxnpos='$idtxnpos',posname='$posname' where idtxnpos = $idtxnpos";  
		$test = mysql_query($sql); 
		echo '{"status":"2"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data txnpos 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from txnpos where idtxnpos ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
