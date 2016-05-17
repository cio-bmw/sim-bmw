<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $idunitkpr=$_POST['idunitkpr']; 
 $check_date=$_POST['check_date']; 
 $unit_idunit=$_POST['unit_idunit']; 
 $kprclmst_idkprclmst=$_POST['kprclmst_idkprclmst']; 
	
	if($action=="add") //menangani aksi penambahan data unitkpr 
	{ 
   $sql = "SELECT IFNULL(max(CAST(idunitkpr AS UNSIGNED)),0)+1  FROM unitkpr";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idunitkpr = $data[0];	 
    mysql_query(" insert into unitkpr (idunitkpr,check_date,unit_idunit,kprclmst_idkprclmst)  values  ('$idunitkpr','$check_date','$unit_idunit','$kprclmst_idkprclmst')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data unitkpr 
	{ 
$sql = " update unitkpr set idunitkpr='$idunitkpr',check_date='$check_date',unit_idunit='$unit_idunit',kprclmst_idkprclmst='$kprclmst_idkprclmst' where idunitkpr = $idunitkpr";  
		$test = mysql_query($sql); 
		echo '{"status":"2"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data unitkpr 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from unitkpr where idunitkpr ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
