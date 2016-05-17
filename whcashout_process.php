<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $idcashout=$_POST['idcashout']; 
 $txndate=settanggal($_POST['txndate']); 
 $txndesc=$_POST['txndesc']; 
 $txnvalue=$_POST['txnvalue']; 
 $sektor_idsektor=$_POST['sektor_idsektor']; 
	if($action=="add") //menangani aksi penambahan data whcashout 
	{ 
 mysql_query(" insert into whcashout (idcashout,txndate,txndesc,txnvalue,sektor_idsektor)  values  ('$idcashout','$txndate','$txndesc','$txnvalue','$sektor_idsektor')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data whcashout 
	{ 
$sql = " update whcashout set idcashout='$idcashout',txndate='$txndate',txndesc='$txndesc',txnvalue='$txnvalue',sektor_idsektor='$sektor_idsektor' where idcashout = $idcashout";  
		$test = mysql_query($sql); 
		echo '{"status":"2"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data whcashout 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from whcashout where idcashout ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
