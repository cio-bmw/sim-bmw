<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $idactivity=$_POST['idactivity']; 
 $activity=$_POST['activity']; 
 $soptype_idsoptype=$_POST['soptype_idsoptype']; 
 $unitact_idunitact=$_POST['unitact_idunitact']; 
	
	if($action=="add") //menangani aksi penambahan data activity 
	{ 
   //$sql = "SELECT IFNULL(max(CAST(idactivity AS UNSIGNED)),0)+1  FROM activity";  
   //$result = mysql_query($sql);  
  //$data  = mysql_fetch_array($result);  
  //$idactivity = $data[0];	 
    mysql_query(" insert into activity (idactivity,activity,soptype_idsoptype,unitact_idunitact)  values  ('$idactivity','$activity','$soptype_idsoptype','$unitact_idunitact')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data activity 
	{ 
$sql = " update activity set idactivity='$idactivity',activity='$activity',soptype_idsoptype='$soptype_idsoptype',unitact_idunitact='$unitact_idunitact' where idactivity = $idactivity";  
		$test = mysql_query($sql); 
		echo '{"status":"2"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data activity 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from activity where idactivity ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
