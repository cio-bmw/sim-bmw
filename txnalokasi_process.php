<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $idtxnalokasi=$_POST['idtxnalokasi']; 
 $alokasiname=$_POST['alokasiname']; 
	if($action=="add") //menangani aksi penambahan data txnalokasi 
	{ 
 mysql_query(" insert into txnalokasi (idtxnalokasi,alokasiname)  values  ('$idtxnalokasi','$alokasiname')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data txnalokasi 
	{ 
$sql = " update txnalokasi set idtxnalokasi='$idtxnalokasi',alokasiname='$alokasiname' where idtxnalokasi = $idtxnalokasi";  
		$test = mysql_query($sql); 
		echo '{"status":"2"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data txnalokasi 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from txnalokasi where idtxnalokasi ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
