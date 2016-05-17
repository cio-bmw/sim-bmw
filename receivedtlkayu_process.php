<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $idreceivedtl=$_POST['idreceivedtl']; 
 $product_idproduct=$_POST['product_idproduct']; 
 $qty=$_POST['qty']; 
 $receive_price=$_POST['receive_price']; 
 $dtl_ppn=$_POST['dtl_ppn']; 
 $receive_priceppn=$_POST['receive_priceppn']; 
 $receive_pricedisc=$_POST['receive_pricedisc']; 
 $dtl_percent=$_POST['dtl_percent']; 
 $dtl_discount=$_POST['dtl_discount']; 
 $receivehdr_idreceivehdr=$_POST['receivehdr_idreceivehdr']; 
 $batch_no=$_POST['batch_no']; 
 $exp_date=$_POST['exp_date']; 
	if($action=="add") //menangani aksi penambahan data receivedtlkayu 
	{ 
	//  $idpelanggan = buatID("tbl_pelanggan","P"); 
 mysql_query(" insert into receivedtlkayu (idreceivedtl,product_idproduct,qty,receive_price,dtl_ppn,receive_priceppn,receive_pricedisc,dtl_percent,dtl_discount,receivehdr_idreceivehdr,batch_no,exp_date)  values  ('$idreceivedtl','$product_idproduct','$qty','$receive_price','$dtl_ppn','$receive_priceppn','$receive_pricedisc','$dtl_percent','$dtl_discount','$receivehdr_idreceivehdr','$batch_no','$exp_date')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data receivedtlkayu 
	{ 
$sql = " update receivedtlkayu set idreceivedtl='$idreceivedtl',product_idproduct='$product_idproduct',qty='$qty',receive_price='$receive_price',dtl_ppn='$dtl_ppn',receive_priceppn='$receive_priceppn',receive_pricedisc='$receive_pricedisc',dtl_percent='$dtl_percent',dtl_discount='$dtl_discount',receivehdr_idreceivehdr='$receivehdr_idreceivehdr',batch_no='$batch_no',exp_date='$exp_date' where idreceivedtl = $idreceivedtl";  
		$test = mysql_query($sql); 
		echo '{"status":"2"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data receivedtlkayu 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from receivedtlkayu where idreceivedtl ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
