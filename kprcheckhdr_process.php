<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $idkprcheckhdr=$_POST['idkprcheckhdr']; 
 $startdate=settanggal($_POST['startdate']); 
 $bankname=$_POST['bankname']; 
 $notaris=$_POST['notaris']; 
 $unit_idunit=$_POST['unit_idunit']; 
 $emp_am=$_POST['emp_am']; 
 $emp_kpr=$_POST['emp_kpr']; 
 
 
	if($action=="add") //menangani aksi penambahan data kprcheckhdr 
	{ 
	$sql = "SELECT IFNULL(max(CAST(idkprcheckhdr AS UNSIGNED)),0)+1  FROM kprcheckhdr";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idkprcheckhdr = $data[0];	 
   mysql_query(" insert into kprcheckhdr (idkprcheckhdr,startdate,bankname,notaris,unit_idunit,emp_am,emp_kpr)  values  ('$idkprcheckhdr','$startdate','$bankname','$notaris','$unit_idunit','$emp_am','$emp_kpr')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    
    	$sql= "select * from kprclmst";
		$result=mysql_query($sql);
		while($row = mysql_fetch_array($result)){
			
		$sql1 = "SELECT IFNULL(max(CAST(idkprcheckdtl AS UNSIGNED)),0)+1  FROM kprcheckdtl";  
   	$result1 = mysql_query($sql1);  
   	$data1  = mysql_fetch_array($result1);  
   	$idkprcheckdtl = $data1[0];	 	
	
	   $idkprclmst = $row['idkprclmst'];
	
	   mysql_query(" insert into kprcheckdtl (idkprcheckdtl,startdate,enddate,kprclmst_idkprclmst,kprcheckhdr_idkprcheckhdr)  values  ('$idkprcheckdtl','$startdate','$enddate','$idkprclmst','$idkprcheckhdr')")  or die("Data gagal Di Tambahkan!");  

	
		}
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data kprcheckhdr 
	{ 
$sql = " update kprcheckhdr set idkprcheckhdr='$idkprcheckhdr',startdate='$startdate',bankname='$bankname',notaris='$notaris',unit_idunit='$unit_idunit',emp_am='$emp_am',emp_kpr='$emp_kpr' where idkprcheckhdr = $idkprcheckhdr";  
		$test = mysql_query($sql); 
		echo '{"status":"2"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data kprcheckhdr 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from kprcheckhdr where idkprcheckhdr ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
