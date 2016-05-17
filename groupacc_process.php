<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $idgroupacc=$_POST['idgroupacc']; 
 $groupname=$_POST['groupname']; 
	if($action=="add") //menangani aksi penambahan data groupacc 
	{ 
 mysql_query(" insert into groupacc (idgroupacc,groupname)  values  ('$idgroupacc','$groupname')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data groupacc 
	{ 
$sql = " update groupacc set idgroupacc='$idgroupacc',groupname='$groupname' where idgroupacc = $idgroupacc";  
		$test = mysql_query($sql); 
		echo '{"status":"2"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data groupacc 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from groupacc where idgroupacc ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
