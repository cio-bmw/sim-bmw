<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $idamclist=$_POST['idamclist']; 
 $amclist=$_POST['amclist']; 
 $amclistseq=$_POST['amclistseq']; 
	if($action=="add") //menangani aksi penambahan data amclist 
	{ 
	//  $idpelanggan = buatID("tbl_pelanggan","P"); 
 mysql_query(" insert into amclist (idamclist,amclist,amclistseq)  values  ('$idamclist','$amclist','$amclistseq')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data amclist 
	{ 
$sql = " update amclist set idamclist='$idamclist',amclist='$amclist',amclistseq='$amclistseq' where idamclist = $idamclist";  
		$test = mysql_query($sql); 
		echo '{"status":"2"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data amclist 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from amclist where idamclist ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
