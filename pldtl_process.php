<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $idpldtl=$_POST['idpldtl']; 
 $plhdr_idplhdr=$_POST['plhdr_idplhdr']; 
 $acc_idacc=$_POST['acc_idacc']; 
	if($action=="add") //menangani aksi penambahan data pldtl 
	{ 
 mysql_query(" insert into pldtl (idpldtl,plhdr_idplhdr,acc_idacc)  values  ('$idpldtl','$plhdr_idplhdr','$acc_idacc')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data pldtl 
	{ 
$sql = " update pldtl set idpldtl='$idpldtl',plhdr_idplhdr='$plhdr_idplhdr',acc_idacc='$acc_idacc' where idpldtl = $idpldtl";  
		$test = mysql_query($sql); 
		echo '{"status":"2"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data pldtl 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from pldtl where idpldtl ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
