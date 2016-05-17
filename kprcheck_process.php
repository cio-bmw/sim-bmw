<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $idkprcheck=$_POST['idkprcheck']; 
 $startdate=$_POST['startdate']; 
 $enddate=$_POST['enddate']; 
 $unit_idunit=$_POST['unit_idunit']; 
 $kprclmst_idkprclmst=$_POST['kprclmst_idkprclmst']; 
	if($action=="add") //menangani aksi penambahan data kprcheck 
	{ 
 mysql_query(" insert into kprcheck (idkprcheck,startdate,enddate,unit_idunit,kprclmst_idkprclmst)  values  ('$idkprcheck','$startdate','$enddate','$unit_idunit','$kprclmst_idkprclmst')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data kprcheck 
	{ 
$sql = " update kprcheck set idkprcheck='$idkprcheck',startdate='$startdate',enddate='$enddate',unit_idunit='$unit_idunit',kprclmst_idkprclmst='$kprclmst_idkprclmst' where idkprcheck = $idkprcheck";  
		$test = mysql_query($sql); 
		echo '{"status":"2"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data kprcheck 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from kprcheck where idkprcheck ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
