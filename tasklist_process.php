<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $idtasklist=$_POST['idtasklist']; 
 $project_idproject=$_POST['project_idproject']; 
 $emp_idemp=$_POST['emp_idemp']; 
 $taskname=$_POST['taskname']; 
 $keterangan=$_POST['keterangan']; 
 $startdate=$_POST['startdate']; 
 $enddate=$_POST['enddate']; 
 $finishdate=$_POST['finishdate']; 
 $files=$_POST['files']; 
 $taskstatus=$_POST['taskstatus']; 
	if($action=="add") //menangani aksi penambahan data tasklist 
	{ 
 mysql_query(" insert into tasklist (idtasklist,project_idproject,emp_idemp,taskname,keterangan,startdate,enddate,finishdate,files,taskstatus)  values  ('$idtasklist','$project_idproject','$emp_idemp','$taskname','$keterangan','$startdate','$enddate','$finishdate','$files','$taskstatus')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data tasklist 
	{ 
$sql = " update tasklist set idtasklist='$idtasklist',project_idproject='$project_idproject',emp_idemp='$emp_idemp',taskname='$taskname',keterangan='$keterangan',startdate='$startdate',enddate='$enddate',finishdate='$finishdate',files='$files',taskstatus='$taskstatus' where idtasklist = $idtasklist";  
		$test = mysql_query($sql); 
		echo '{"status":"2"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data tasklist 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from tasklist where idtasklist ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
