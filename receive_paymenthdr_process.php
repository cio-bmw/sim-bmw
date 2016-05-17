<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $idpaymenthdr=$_POST['idpaymenthdr']; 
 $pay_date=settanggal($_POST['pay_date']); 
 $pay_name=$_POST['pay_name']; 
 $pay_note=$_POST['pay_note']; 
 $supplier_idsupp=$_POST['supplier_idsupp']; 
	if($action=="add") //menangani aksi penambahan data receive_paymenthdr 
	{ 
 mysql_query(" insert into receive_paymenthdr (idpaymenthdr,pay_date,pay_name,pay_note,supplier_idsupp)  values  ('$idpaymenthdr','$pay_date','$pay_name','$pay_note','$supplier_idsupp')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data receive_paymenthdr 
	{ 
$sql = " update receive_paymenthdr set idpaymenthdr='$idpaymenthdr',pay_date='$pay_date',pay_name='$pay_name',pay_note='$pay_note',supplier_idsupp='$supplier_idsupp' where idpaymenthdr = $idpaymenthdr";  
		$test = mysql_query($sql); 
		echo '{"status":"2"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data receive_paymenthdr 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from receive_paymenthdr where idpaymenthdr ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
