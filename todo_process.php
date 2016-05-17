<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $todo=$_POST['todo']; 
 $startdate=settanggal($_POST['startdate']); 
 $enddate=settanggal($_POST['enddate']); 
 $todostatus=$_POST['todostatus']; 
 $emp_idemp=$_POST['emp_idemp']; 
	if($action=="add") //menangani aksi penambahan data todo 
	{ 
 $sql = "SELECT IFNULL(max(CAST(idtodo AS UNSIGNED)),0)+1  FROM todo";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idtodo = $data[0];	 	
	
 mysql_query(" insert into todo (idtodo,todo,startdate,enddate,todostatus,emp_idemp)  values  ('$idtodo','$todo','$startdate','$enddate','$todostatus','$emp_idemp')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data todo 
	{ 
$sql = " update todo set idtodo='$idtodo',todo='$todo',startdate='$startdate',enddate='$enddate',todostatus='$todostatus',emp_idemp='$emp_idemp' where idtodo = $idtodo";  
		$test = mysql_query($sql); 
		echo '{"status":"2"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data todo 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from todo where idtodo ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
