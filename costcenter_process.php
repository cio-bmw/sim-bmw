<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $idcostcenter=$_POST['idcostcenter']; 
 $costcentername=$_POST['costcentername']; 
	
	if($action=="add") //menangani aksi penambahan data costcenter 
	{ 
   //$sql = "SELECT IFNULL(max(CAST(idcostcenter AS UNSIGNED)),0)+1  FROM costcenter";  
   //$result = mysql_query($sql);  
  //$data  = mysql_fetch_array($result);  
  //$idcostcenter = $data[0];	 
    mysql_query(" insert into costcenter (idcostcenter,costcentername)  values  ('$idcostcenter','$costcentername')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data costcenter 
	{ 
$sql = " update costcenter set idcostcenter='$idcostcenter',costcentername='$costcentername' where idcostcenter = $idcostcenter";  
		$test = mysql_query($sql); 
		echo '{"status":"2"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data costcenter 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from costcenter where idcostcenter ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
