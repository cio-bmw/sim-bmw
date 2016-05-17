<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $idcompany=$_POST['idcompany']; 
 $company=$_POST['company']; 
 $kas_idacc=$_POST['kas_idacc'];
	
	if($action=="add") //menangani aksi penambahan data company 
	{ 
  
    mysql_query(" insert into company (idcompany,company)  values  ('$idcompany','$company')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data company 
	{ 
$sql = " update company set idcompany='$idcompany',company='$company',kas_idacc='$kas_idacc' where idcompany = $idcompany";  
		$test = mysql_query($sql); 
		echo '{"status":"2"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data company 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from company where idcompany ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
