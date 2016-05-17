<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $idslshdr=$_POST['idslshdr']; 
 $sls_date=settanggal($_POST['sls_date']); 
 $sls_status=$_POST['sls_status']; 
 $unit_idunit=$_POST['unit_idunit']; 
 $emp_idemp=$_POST['emp_idemp']; 
	if($action=="add") //menangani aksi penambahan data slshdrunit 
	{ 
	//  $idpelanggan = buatID("tbl_pelanggan","P"); 
 mysql_query(" insert into slshdrunit (idslshdr,sls_date,sls_status,unit_idunit,emp_idemp)  values  ('$idslshdr','$sls_date','open','$unit_idunit','$emp_idemp')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data slshdrunit 
	{ 
$sql = " update slshdrunit set idslshdr='$idslshdr',sls_date='$sls_date',sls_status='$sls_status',unit_idunit='$unit_idunit',emp_idemp='$emp_idemp' where idslshdr = $idslshdr";  
		$test = mysql_query($sql); 
		echo '{"status":"2"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data slshdrunit 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from slshdrunit where idslshdr ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
