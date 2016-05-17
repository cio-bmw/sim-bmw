<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $idemp=$_POST['idemp']; 
 $empasswd=MD5($_POST['empasswd']); 
 $empname=$_POST['empname']; 
 $empphone=$_POST['empphone']; 
 $gp=$_POST['gp']; 
 $gs=$_POST['gs']; 
 $mkt=$_POST['mkt']; 
 $tch=$_POST['tch']; 
 $acc=$_POST['acc']; 
 $kpr=$_POST['kpr']; 
 $adm=$_POST['adm']; 
	if($action=="add") //menangani aksi penambahan data emp 
	{ 
 mysql_query(" insert into emp (idemp,empasswd,empname,empphone,gp,gs,mkt,tch,acc,kpr,adm)  values  ('$idemp','$empasswd','$empname','$empphone','$gp','$gs','$mkt','$tch','$acc','$kpr','$adm')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data emp 
	{ 
$sql = " update emp set idemp='$idemp',empasswd='$empasswd',empname='$empname',empphone='$empphone',gp='$gp',gs='$gs',mkt='$mkt',tch='$tch',acc='$acc',kpr='$kpr',adm='$adm' where idemp = '$idemp'";  
		$test = mysql_query($sql); 
		echo '{"status":"2"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data emp 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from emp where idemp ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
