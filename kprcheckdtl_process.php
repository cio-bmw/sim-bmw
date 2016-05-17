<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $idkprcheckdtl=$_POST['idkprcheckdtl']; 
 $startdate=$_POST['startdate']; 
 $enddate=$_POST['enddate']; 
 $kprclmst_idkprclmst=$_POST['kprclmst_idkprclmst']; 
 $kprcheckhdr_idkprcheckhdr=$_POST['kprcheckhdr_idkprcheckhdr']; 
	if($action=="add") //menangani aksi penambahan data kprcheckdtl 
	{ 
 mysql_query(" insert into kprcheckdtl (idkprcheckdtl,startdate,enddate,kprclmst_idkprclmst,kprcheckhdr_idkprcheckhdr)  values  ('$idkprcheckdtl','$startdate','$enddate','$kprclmst_idkprclmst','$kprcheckhdr_idkprcheckhdr')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data kprcheckdtl 
	{ 
$sql = " update kprcheckdtl set idkprcheckdtl='$idkprcheckdtl',startdate='$startdate',enddate='$enddate',kprclmst_idkprclmst='$kprclmst_idkprclmst',kprcheckhdr_idkprcheckhdr='$kprcheckhdr_idkprcheckhdr' where idkprcheckdtl = $idkprcheckdtl";  
		$test = mysql_query($sql); 
		echo '{"status":"2"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data kprcheckdtl 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from kprcheckdtl where idkprcheckdtl ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
