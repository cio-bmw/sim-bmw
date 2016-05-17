<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 //$idspkpaymentdtl=$_POST['idspkpaymentdtl']; 
 $payvalue=$_POST['payvalue']; 
 $spkpaymenthdr_idspkpaymenthdr=$_POST['spkpaymenthdr_idspkpaymenthdr']; 
 $unitspk_idunitspk=$_POST['unitspk_idunitspk']; 
	if($action=="add") //menangani aksi penambahan data spkpaymentdtl 
	{ 
  $sql = "SELECT IFNULL(max(idspkpaymentdtl),0)+1  FROM spkpaymentdtl";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idspkpaymentdtl = $data[0];	 	
	
	//  $idpelanggan = buatID("tbl_pelanggan","P"); 
 mysql_query(" insert into spkpaymentdtl (idspkpaymentdtl,payvalue,spkpaymenthdr_idspkpaymenthdr,unitspk_idunitspk)  values  ('$idspkpaymentdtl','$payvalue','$spkpaymenthdr_idspkpaymenthdr','$unitspk_idunitspk')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data spkpaymentdtl 
	{ 
$sql = " update spkpaymentdtl set idspkpaymentdtl='$idspkpaymentdtl',payvalue='$payvalue',spkpaymenthdr_idspkpaymenthdr='$spkpaymenthdr_idspkpaymenthdr',unitspk_idunitspk='$unitspk_idunitspk' where idspkpaymentdtl = $idspkpaymentdtl";  
		$test = mysql_query($sql); 
		echo '{"status":"2"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data spkpaymentdtl 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from spkpaymentdtl where idspkpaymentdtl ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
