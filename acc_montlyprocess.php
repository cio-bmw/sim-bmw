<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
 $action=$_POST['action']; 
 $mtrlbuy=$_POST['mtrlbuy']; 
 $mtrlstok=$_POST['mtrlstok']; 
 $bulan=$_POST['bulan']; 
 $tahun=$_POST['tahun']; 
 
echo ' status nya : '.$mtrlbuy;
 

   echo '{"status":"1"}';   
//	exit; 
		 
?> 
