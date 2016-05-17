<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $idproduct=$_POST['idproduct']; 
 $productname=$_POST['productname']; 
 $uom_iduom=$_POST['uom_iduom']; 
 $category_idcat=$_POST['category_idcat']; 
 $supplier_idsupp=$_POST['supplier_idsupp']; 
 $location_idlocation=$_POST['location_idlocation']; 
 $salesprice=rnf($_POST['salesprice']); 
 $costprice=rnf($_POST['costprice']); 
 $stock=rnf($_POST['stock']); 
 $stockwh=rnf($_POST['stockwh']); 
 $limitstock=rnf($_POST['limitstock']); 
 $limitstockwh=rnf($_POST['limitstockwh']); 
 $status=$_POST['status']; 
 $active=$_POST['active']; 
 $boxqty=$_POST['boxqty']; 
	 
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
	 
	if($action=="add") //menangani aksi penambahan data product 
	{ 
	//  $idpelanggan = buatID("tbl_pelanggan","P"); 
 mysql_query(" insert into product (idproduct,productname,uom_iduom,category_idcat,supplier_idsupp,location_idlocation,salesprice,costprice,stock,stockwh,limitstock,limitstockwh,status,active,boxqty)  values  ('$idproduct','$productname','$uom_iduom','$category_idcat','$supplier_idsupp','$location_idlocation','$salesprice','$costprice','$stock','$stockwh','$limitstock','$limitstockwh','$status','$active','$boxqty')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data product 
	{ 
      $sql = " update product set productname='$productname',uom_iduom='$uom_iduom',category_idcat='$category_idcat',supplier_idsupp='$supplier_idsupp',location_idlocation='$location_idlocation',salesprice='$salesprice',costprice='$costprice',stock='$stock',stockwh='$stockwh',limitstock='$limitstock',limitstockwh='$limitstockwh',status='$status',active='$active',boxqty='$boxqty' where idproduct ='".$idproduct."'";  
		$test = mysql_query($sql); 
		echo '{"status":"1"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data product 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from product where idproduct ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
