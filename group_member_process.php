<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $group_id=$_POST['group_id']; 
 $member_id=$_POST['member_id']; 
	
	if($action=="add") //menangani aksi penambahan data group_member 
	{ 
   //$sql = "SELECT IFNULL(max(CAST(idgroup_member AS UNSIGNED)),0)+1  FROM group_member";  
   //$result = mysql_query($sql);  
  //$data  = mysql_fetch_array($result);  
  //$idgroup_member = $data[0];	 
    mysql_query(" insert into group_member (group_id,member_id)  values  ('$group_id','$member_id')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data group_member 
	{ 
$sql = " update group_member set group_id='$group_id',member_id='$member_id' where group_id = $group_id";  
		$test = mysql_query($sql); 
		echo '{"status":"2"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data group_member 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from group_member where group_id ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
