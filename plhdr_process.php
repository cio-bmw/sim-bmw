<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $idplhdr=$_POST['idplhdr']; 
 $plhdrname=$_POST['plhdrname']; 
 $plhdrseq=$_POST['plhdrseq']; 
 $pl_idpl=$_POST['pl_idpl']; 
 $plhdrsdk=$_POST['plhdrsdk']; 
	if($action=="add") //menangani aksi penambahan data plhdr 
	{ 
 mysql_query(" insert into plhdr (idplhdr,plhdrname,plhdrseq,pl_idpl,plhdrsdk)  values  ('$idplhdr','$plhdrname','$plhdrseq','$pl_idpl','$plhdrsdk')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data plhdr 
	{ 
$sql = " update plhdr set idplhdr='$idplhdr',plhdrname='$plhdrname',plhdrseq='$plhdrseq',pl_idpl='$pl_idpl',plhdrsdk='$plhdrsdk' where idplhdr = $idplhdr";  
		$test = mysql_query($sql); 
		echo '{"status":"2"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data plhdr 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from plhdr where idplhdr ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
