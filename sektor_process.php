<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
include_once("config.php"); 
	
 $action=$_POST['action']; 
 $idsektor=$_POST['idsektor']; 
 $sektorname=$_POST['sektorname']; 
 $address=$_POST['address']; 
 $emp_idempmkt=$_POST['emp_idempmkt']; 
 $emp_idempgdg=$_POST['emp_idempgdg']; 
 
 $map_img=$_POST['map_img']; 
 $siteplan_img=$_POST['siteplan_img']; 
 
 

	if($action=="add") //menangani aksi penambahan data sektor 
	{ 
    mysql_query(" insert into sektor (idsektor,sektorname,address,emp_idempmkt,emp_idempgdg,front_img,map_img,siteplan_img)  values  ('$idsektor','$sektorname','$address','$emp_idempmkt','$emp_idempgdg','$front_img','$map_img','$siteplan_img')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data sektor 
	{ 
$sql = " update sektor set idsektor='$idsektor',sektorname='$sektorname',address='$address',emp_idempmkt='$emp_idempmkt',emp_idempgdg='$emp_idempgdg',front_img='$front_img',map_img='$map_img',siteplan_img='$siteplan_img' where idsektor = '".$idsektor."'";  
		$test = mysql_query($sql); 
		echo '{"status":"1"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data sektor 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from sektor where idsektor ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
 
?> 
