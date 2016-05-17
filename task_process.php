<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $idtask=$_POST['idtask']; 
 $project_idproject=$_POST['project_idproject']; 
 $emp_idemp=$_POST['emp_idemp']; 
 $keterangan=$_POST['keterangan']; 
 $startdate=$_POST['startdate']; 
 $enddate=$_POST['enddate']; 
 $finishdate=$_POST['finishdate']; 
 $taskstatus=$_POST['taskstatus']; 
	if($action=="add") //menangani aksi penambahan data task 
	{ 
 mysql_query(" insert into task (idtask,project_idproject,emp_idemp,keterangan,startdate,enddate,finishdate,taskstatus)  values  ('$idtask','$project_idproject','$emp_idemp','$keterangan','$startdate','$enddate','$finishdate','$taskstatus')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data task 
	{ 
$sql = " update task set idtask='$idtask',project_idproject='$project_idproject',emp_idemp='$emp_idemp',keterangan='$keterangan',startdate='$startdate',enddate='$enddate',finishdate='$finishdate',taskstatus='$taskstatus' where idtask = $idtask";  
		$test = mysql_query($sql); 
		echo '{"status":"2"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data task 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from task where idtask ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
