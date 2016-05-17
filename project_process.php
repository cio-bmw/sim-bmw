<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $idproject=$_POST['idproject']; 
 $startdate=settanggal($_POST['startdate']); 
 $Keterangan=$_POST['Keterangan']; 
	if($action=="add") //menangani aksi penambahan data project 
	{ 
 mysql_query(" insert into project (idproject,startdate,Keterangan)  values  ('$idproject','$startdate','$Keterangan')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data project 
	{ 
$sql = " update project set idproject='$idproject',startdate='$startdate',Keterangan='$Keterangan' where idproject = $idproject";  
		$test = mysql_query($sql); 
		echo '{"status":"2"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data project 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from project where idproject ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
