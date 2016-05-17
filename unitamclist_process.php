<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $idunitamclist=$_POST['idunitamclist']; 
 $clstatus=$_POST['clstatus']; 
 $unit_idunit=$_POST['unit_idunit']; 
 $amclist_idamclist=$_POST['amclist_idamclist']; 
	if($action=="add") //menangani aksi penambahan data unitamclist 
	{ 
	//  $idpelanggan = buatID("tbl_pelanggan","P"); 
 mysql_query(" insert into unitamclist (idunitamclist,clstatus,unit_idunit,amclist_idamclist)  values  ('$idunitamclist','$clstatus','$unit_idunit','$amclist_idamclist')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data unitamclist 
	{ 
$sql = " update unitamclist set idunitamclist='$idunitamclist',clstatus='$clstatus',unit_idunit='$unit_idunit',amclist_idamclist='$amclist_idamclist' where idunitamclist = $idunitamclist";  
		$test = mysql_query($sql); 
		echo '{"status":"2"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data unitamclist 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from unitamclist where idunitamclist ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
