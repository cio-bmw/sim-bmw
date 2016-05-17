<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $idunithistory=$_POST['idunithistory']; 
 $namauser=$_POST['namauser']; 
 $tglmundur=$_POST['tglmundur']; 
 $alasan=$_POST['alasan']; 
 $unit_idunit=$_POST['unit_idunit']; 
	
	if($action=="add") //menangani aksi penambahan data unithistory 
	{ 
   //$sql = "SELECT IFNULL(max(CAST(idunithistory AS UNSIGNED)),0)+1  FROM unithistory";  
   //$result = mysql_query($sql);  
  //$data  = mysql_fetch_array($result);  
  //$idunithistory = $data[0];	 
    mysql_query(" insert into unithistory (idunithistory,namauser,tglmundur,alasan,unit_idunit)  values  ('$idunithistory','$namauser','$tglmundur','$alasan','$unit_idunit')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data unithistory 
	{ 
$sql = " update unithistory set idunithistory='$idunithistory',namauser='$namauser',tglmundur='$tglmundur',alasan='$alasan',unit_idunit='$unit_idunit' where idunithistory = $idunithistory";  
		$test = mysql_query($sql); 
		echo '{"status":"2"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data unithistory 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from unithistory where idunithistory ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
