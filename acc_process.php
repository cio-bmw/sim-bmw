<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $idacc=$_POST['idacc']; 
 $accname=$_POST['accname']; 
 $accsaldo=$_POST['accsaldo']; 
 $groupacc_idgroupacc=$_POST['groupacc_idgroupacc']; 
	if($action=="add") //menangani aksi penambahan data acc 
	{ 
 mysql_query(" insert into acc (idacc,accname,accsaldo,groupacc_idgroupacc)  values  ('$idacc','$accname','$accsaldo','$groupacc_idgroupacc')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data acc 
	{ 
$sql = " update acc set idacc='$idacc',accname='$accname',accsaldo='$accsaldo',groupacc_idgroupacc='$groupacc_idgroupacc' where idacc = $idacc";  
		$test = mysql_query($sql); 
		echo '{"status":"2"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data acc 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from acc where idacc ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
