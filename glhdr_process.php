<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $idglhdr=$_POST['idglhdr']; 
 $gl_date=settanggal($_POST['gl_date']); 
 $gl_desc=$_POST['gl_desc']; 
 $gl_refno=$_POST['gl_refno']; 
	if($action=="add") //menangani aksi penambahan data glhdr 
	{ $gl_status = 'open';
 mysql_query(" insert into glhdr (idglhdr,gl_date,gl_desc,gl_refno,gl_status)  values  ('$idglhdr','$gl_date','$gl_desc','$gl_refno','$gl_status')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data glhdr 
	{ 
$sql = " update glhdr set idglhdr='$idglhdr',gl_date='$gl_date',gl_desc='$gl_desc',gl_refno='$gl_refno' where idglhdr = $idglhdr";  
		$test = mysql_query($sql); 
		echo '{"status":"2"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data glhdr 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from glhdr where idglhdr ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
