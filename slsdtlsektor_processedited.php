<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $idslsdtl=$_POST['idslsdtl']; 
 $cost_price=$_POST['cost_price']; 
 $qty=$_POST['qty']; 
 //$dtl_discount=$_POST['dtl_discount']; 
 $sales_price=$_POST['sales_price']; 
 //$dtl_percent=$_POST['dtl_percent']; 
 $product_idproduct=$_POST['product_idproduct']; 
 $slshdrsektor_idslshdr=$_POST['slshdrsektor_idslshdr']; 
	 

	 
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
$sql = " update slsdtlsektor set cost_price='$cost_price',qty='$qty',dtl_discount='$dtl_discount',sales_price='$sales_price',dtl_percent='$dtl_percent',product_idproduct='$product_idproduct',slshdrsektor_idslshdr='$slshdrsektor_idslshdr' where idslsdtl ='".$idslsdtl."'";  
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
 
    
    
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 	 
	 
?> 
