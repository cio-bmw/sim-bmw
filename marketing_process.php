<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $idmarketing=$_POST['idmarketing']; 
 $marketing=$_POST['marketing']; 
 $phone=$_POST['phone']; 
	
	if($action=="add") //menangani aksi penambahan data marketing 
	{ 
   
    mysql_query(" insert into marketing (idmarketing,marketing,phone)  values  ('$idmarketing','$marketing','$phone')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data marketing 
	{ 
$sql = " update marketing set idmarketing='$idmarketing',marketing='$marketing',phone='$phone' where idmarketing = $idmarketing";  
		$test = mysql_query($sql); 
		echo '{"status":"2"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data marketing 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from marketing where idmarketing ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
