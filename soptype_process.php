<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $idsoptype=$_POST['idsoptype']; 
 $soptype=$_POST['soptype']; 
	
	if($action=="add") //menangani aksi penambahan data soptype 
	{ 
   //$sql = "SELECT IFNULL(max(CAST(idsoptype AS UNSIGNED)),0)+1  FROM soptype";  
   //$result = mysql_query($sql);  
  //$data  = mysql_fetch_array($result);  
  //$idsoptype = $data[0];	 
    mysql_query(" insert into soptype (idsoptype,soptype)  values  ('$idsoptype','$soptype')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data soptype 
	{ 
$sql = " update soptype set idsoptype='$idsoptype',soptype='$soptype' where idsoptype = $idsoptype";  
		$test = mysql_query($sql); 
		echo '{"status":"2"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data soptype 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from soptype where idsoptype ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
