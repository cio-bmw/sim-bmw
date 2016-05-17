<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $member_id=$_POST['member_id']; 
 $hp_no=$_POST['hp_no']; 
 $name=$_POST['name']; 
 $address=$_POST['address']; 
 $title=$_POST['title']; 
 $pilih=$_POST['pilih']; 
	
	if($action=="add") //menangani aksi penambahan data members 
	{ 
   //$sql = "SELECT IFNULL(max(CAST(idmembers AS UNSIGNED)),0)+1  FROM members";  
   //$result = mysql_query($sql);  
  //$data  = mysql_fetch_array($result);  
  //$idmembers = $data[0];	 
    mysql_query(" insert into members (member_id,hp_no,name,address,title,pilih)  values  ('$member_id','$hp_no','$name','$address','$title','$pilih')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data members 
	{ 
$sql = " update members set member_id='$member_id',hp_no='$hp_no',name='$name',address='$address',title='$title',pilih='$pilih' where member_id = $member_id";  
		$test = mysql_query($sql); 
		echo '{"status":"2"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data members 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from members where member_id ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
