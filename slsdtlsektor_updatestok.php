<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $idslsdtl=$_POST['idslsdtl']; 
 $cost_price=$_POST['cost_price']; 
 $qty=$_POST['qty']; 
 $dtl_discount=$_POST['dtl_discount']; 
 $sales_price=$_POST['sales_price']; 
 $dtl_percent=$_POST['dtl_percent']; 
 $product_idproduct=$_POST['product_idproduct']; 
 $slshdrsektor_idslshdr=$_POST['slshdrsektor_idslshdr']; 
	 
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
	 
	if($action=="add") //menangani aksi penambahan data slsdtlsektor 
	{ 
	//  $idpelanggan = buatID("tbl_pelanggan","P"); 
 mysql_query(" insert into slsdtlsektor (idslsdtl,cost_price,qty,dtl_discount,sales_price,dtl_percent,product_idproduct,slshdrsektor_idslshdr)  values  ('$idslsdtl','$cost_price','$qty','$dtl_discount','$sales_price','$dtl_percent','$product_idproduct','$slshdrsektor_idslshdr')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data slsdtlsektor 
	{ 
$sql = " update slsdtlsektor set idslsdtl='$idslsdtl',cost_price='$cost_price',qty='$qty',dtl_discount='$dtl_discount',sales_price='$sales_price',dtl_percent='$dtl_percent',product_idproduct='$product_idproduct',slshdrsektor_idslshdr='$slshdrsektor_idslshdr' where idslsdtl = $idslsdtl";  
		$test = mysql_query($sql); 
		echo '{"status":"1"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data slsdtlsektor 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from slsdtlsektor where idslsdtl ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
