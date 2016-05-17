<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $idaccsetting=$_POST['idaccsetting']; 
 $app=$_POST['app']; 
 $dacc_idacc=$_POST['dacc_idacc']; 
 $kacc_idacc=$_POST['kacc_idacc']; 
	if($action=="add") //menangani aksi penambahan data accsetting 
	{ 
 mysql_query(" insert into accsetting (idaccsetting,app,dacc_idacc,kacc_idacc)  values  ('$idaccsetting','$app','$dacc_idacc','$kacc_idacc')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data accsetting 
	{ 
$sql = " update accsetting set idaccsetting='$idaccsetting',app='$app',dacc_idacc='$dacc_idacc',kacc_idacc='$kacc_idacc' where idaccsetting = $idaccsetting";  
		$test = mysql_query($sql); 
		echo '{"status":"2"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data accsetting 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from accsetting where idaccsetting ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
