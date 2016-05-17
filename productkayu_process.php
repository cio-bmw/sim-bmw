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
 $salesprice=$_POST['salesprice']; 
 $costprice=$_POST['costprice']; 
 $stock=$_POST['stock']; 
 $stockwh=$_POST['stockwh']; 
 $limitstock=$_POST['limitstock']; 
 $limitstockwh=$_POST['limitstockwh']; 
 $status=$_POST['status']; 
 $active=$_POST['active']; 
 $boxqty=$_POST['boxqty']; 
	if($action=="add") //menangani aksi penambahan data productkayu 
	{ 
 mysql_query(" insert into productkayu (idproduct,productname,uom_iduom,category_idcat,supplier_idsupp,location_idlocation,salesprice,costprice,stock,stockwh,limitstock,limitstockwh,status,active,boxqty)  values  ('$idproduct','$productname','$uom_iduom','$category_idcat','$supplier_idsupp','$location_idlocation','$salesprice','$costprice','$stock','$stockwh','$limitstock','$limitstockwh','$status','$active','$boxqty')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data productkayu 
	{ 
$sql = " update productkayu set idproduct='$idproduct',productname='$productname',uom_iduom='$uom_iduom',category_idcat='$category_idcat',supplier_idsupp='$supplier_idsupp',location_idlocation='$location_idlocation',salesprice='$salesprice',costprice='$costprice',stock='$stock',stockwh='$stockwh',limitstock='$limitstock',limitstockwh='$limitstockwh',status='$status',active='$active',boxqty='$boxqty' where idproduct = $idproduct";  
		$test = mysql_query($sql); 
		echo '{"status":"2"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data productkayu 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from productkayu where idproduct ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
