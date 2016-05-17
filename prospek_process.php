<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $idprospek=$_POST['idprospek']; 
 $prospek=$_POST['prospek']; 
 $phone=$_POST['phone']; 
 $alamat=$_POST['alamat']; 
 $catatan=$_POST['catatan']; 
 $marketing_idmarketing=$_POST['marketing_idmarketing']; 
 $sektor_idsektor=$_POST['sektor_idsektor']; 
 $kavling=$_POST['kavling']; 
	
	if($action=="add") //menangani aksi penambahan data prospek 
	{ 
   $sql = "SELECT IFNULL(max(CAST(idprospek AS UNSIGNED)),0)+1  FROM prospek";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idprospek = $data[0];	 
    mysql_query(" insert into prospek (idprospek,prospek,phone,alamat,catatan,marketing_idmarketing,sektor_idsektor,kavling)  values  ('$idprospek','$prospek','$phone','$alamat','$catatan','$marketing_idmarketing','$sektor_idsektor','$kavling')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data prospek 
	{ 
$sql = " update prospek set idprospek='$idprospek',prospek='$prospek',phone='$phone',alamat='$alamat',catatan='$catatan',marketing_idmarketing='$marketing_idmarketing',sektor_idsektor='$sektor_idsektor',kavling='$kavling' where idprospek = $idprospek";  
		$test = mysql_query($sql); 
		echo '{"status":"2"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data prospek 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from prospek where idprospek ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
