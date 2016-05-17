<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $idtaskreplay=$_POST['idtaskreplay']; 
 $taskreplay=$_POST['taskreplay']; 
 $filename=$_POST['filename']; 
 $taskreplaydate=$_POST['taskreplaydate']; 
 $task_idtask=$_POST['task_idtask']; 
	if($action=="add") //menangani aksi penambahan data taskreplay 
	{ 
 mysql_query(" insert into taskreplay (idtaskreplay,taskreplay,filename,taskreplaydate,task_idtask)  values  ('$idtaskreplay','$taskreplay','$filename','$taskreplaydate','$task_idtask')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data taskreplay 
	{ 
$sql = " update taskreplay set idtaskreplay='$idtaskreplay',taskreplay='$taskreplay',filename='$filename',taskreplaydate='$taskreplaydate',task_idtask='$task_idtask' where idtaskreplay = $idtaskreplay";  
		$test = mysql_query($sql); 
		echo '{"status":"2"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data taskreplay 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from taskreplay where idtaskreplay ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
