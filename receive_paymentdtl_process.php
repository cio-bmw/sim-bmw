<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $idpaymentdtl=$_POST['idpaymentdtl']; 
 $pay_value=$_POST['pay_value']; 
 $receivehdr_idreceivehdr=$_POST['receivehdr_idreceivehdr']; 
 $receive_paymenthdr_idpaymenthdr=$_POST['receive_paymenthdr_idpaymenthdr']; 
	if($action=="add") //menangani aksi penambahan data receive_paymentdtl 
	{ 
 mysql_query(" insert into receive_paymentdtl (idpaymentdtl,pay_value,receivehdr_idreceivehdr,receive_paymenthdr_idpaymenthdr)  values  ('$idpaymentdtl','$pay_value','$receivehdr_idreceivehdr','$receive_paymenthdr_idpaymenthdr')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data receive_paymentdtl 
	{ 
$sql = " update receive_paymentdtl set idpaymentdtl='$idpaymentdtl',pay_value='$pay_value',receivehdr_idreceivehdr='$receivehdr_idreceivehdr',receive_paymenthdr_idpaymenthdr='$receive_paymenthdr_idpaymenthdr' where idpaymentdtl = $idpaymentdtl";  
		$test = mysql_query($sql); 
		echo '{"status":"2"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data receive_paymentdtl 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from receive_paymentdtl where idpaymentdtl ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
