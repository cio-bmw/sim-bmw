<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $group_id=$_POST['group_id']; 
 $group_name=$_POST['group_name']; 
	
	if($action=="add") //menangani aksi penambahan data groups 
	{ 
   //$sql = "SELECT IFNULL(max(CAST(idgroups AS UNSIGNED)),0)+1  FROM groups";  
   //$result = mysql_query($sql);  
  //$data  = mysql_fetch_array($result);  
  //$idgroups = $data[0];	 
    mysql_query(" insert into groups (group_id,group_name)  values  ('$group_id','$group_name')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data groups 
	{ 
$sql = " update groups set group_id='$group_id',group_name='$group_name' where group_id = $group_id";  
		$test = mysql_query($sql); 
		echo '{"status":"2"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data groups 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from groups where group_id ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
