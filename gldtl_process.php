<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $idgldtl=$_POST['idgldtl']; 
 $glhdr_idglhdr=$_POST['glhdr_idglhdr']; 
 $dvalue=$_POST['dvalue']; 
 $kvalue=$_POST['kvalue']; 
 $acc_idacc=$_POST['acc_idacc']; 
	if($action=="add") //menangani aksi penambahan data gldtl 
	{ 
 mysql_query(" insert into gldtl (idgldtl,glhdr_idglhdr,dvalue,kvalue,acc_idacc)  values  ('$idgldtl','$glhdr_idglhdr','$dvalue','$kvalue','$acc_idacc')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data gldtl 
	{ 
$sql = " update gldtl set idgldtl='$idgldtl',glhdr_idglhdr='$glhdr_idglhdr',dvalue='$dvalue',kvalue='$kvalue',acc_idacc='$acc_idacc' where idgldtl = $idgldtl";  
		$test = mysql_query($sql); 
		echo '{"status":"2"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data gldtl 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from gldtl where idgldtl ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
