<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $idprospekflow=$_POST['idprospekflow']; 
 $prospekflow=$_POST['prospekflow']; 
 $dateflow=$_POST['dateflow']; 
 $prospek_idprospek=$_POST['prospek_idprospek']; 
	
	if($action=="add") //menangani aksi penambahan data prospekflow 
	{ 
   $sql = "SELECT IFNULL(max(CAST(idprospekflow AS UNSIGNED)),0)+1  FROM prospekflow";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idprospekflow = $data[0];	 
    mysql_query(" insert into prospekflow (idprospekflow,prospekflow,dateflow,prospek_idprospek)  values  ('$idprospekflow','$prospekflow','$dateflow','$prospek_idprospek')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data prospekflow 
	{ 
$sql = " update prospekflow set idprospekflow='$idprospekflow',prospekflow='$prospekflow',dateflow='$dateflow',prospek_idprospek='$prospek_idprospek' where idprospekflow = $idprospekflow";  
		$test = mysql_query($sql); 
		echo '{"status":"2"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data prospekflow 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from prospekflow where idprospekflow ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
