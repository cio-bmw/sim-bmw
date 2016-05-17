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
	 
	//fungsi untuk men-generate ID pelanggan, ex: P0001  
	function buatID($tabel, $inisial){ 
    $struktur = mysql_query("select * from $tabel") or die("query tidak dapat dijalankan!"); 
    $field = mysql_field_name($struktur,0); 
   $panjang = mysql_field_len($struktur,0); 
    $row = mysql_num_rows($struktur); 
     
    $panjanginisial = strlen($inisial); 
    $awal = $panjanginisial + 1; 
    $bnyk = $panjang-$panjanginisial; 
     
    if ($row >= 1){ 
      $query = mysql_query("select max(substring($field,$awal,$bnyk)) as max from $tabel") or die("query tidak dapat dijalankan!"); 
      $hasil = mysql_fetch_assoc($query); 
      $angka = intval($hasil['max']); 
    } 
    else{ 
      $angka = 0; 
    } 
    
    $angka++; 
    $tmp= ""; 
    for ($i=0; $i < ($panjang-$panjanginisial-strlen($angka)) ; $i++){ 
      $tmp = $tmp."0"; 
    } 
    //return hasil generate ID 
    return strval($inisial.$tmp.$angka); 
  } 
	 
	if($action=="add") //menangani aksi penambahan data receivedtl 
	{ 
	//  $idpelanggan = buatID("tbl_pelanggan","P"); 
 mysql_query(" insert into receivedtl (idreceivedtl,product_idproduct,qty,receive_price,dtl_ppn,receive_priceppn,receive_pricedisc,dtl_percent,dtl_discount,receivehdr_idreceivehdr,batch_no,exp_date)  values  ('$idreceivedtl','$product_idproduct','$qty','$receive_price','$dtl_ppn','$receive_priceppn','$receive_pricedisc','$dtl_percent','$dtl_discount','$receivehdr_idreceivehdr','$batch_no','$exp_date')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data receivedtl 
	{ 
  $sql = " update receivedtl set idreceivedtl='$idreceivedtl',product_idproduct='$product_idproduct',qty='$qty',receive_price='$receive_price',dtl_ppn='$dtl_ppn',receive_priceppn='$receive_priceppn',receive_pricedisc='$receive_pricedisc',dtl_percent='$dtl_percent',dtl_discount='$dtl_discount',receivehdr_idreceivehdr='$receivehdr_idreceivehdr',batch_no='$batch_no',exp_date='$exp_date' where idreceivedtl = $idreceivedtl";  
		$test = mysql_query($sql); 
		echo '{"status":"2"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data receivedtl 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from receivedtl where idreceivedtl ='$id'"); 
      if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
