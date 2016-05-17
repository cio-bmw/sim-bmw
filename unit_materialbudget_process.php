<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $idbudget=$_POST['idbudget']; 
 $budget_qty=$_POST['budget_qty']; 
 $progress_qty=$_POST['progress_qty']; 
 $unit_idunit=$_POST['unit_idunit']; 
 $product_idproduct=$_POST['product_idproduct']; 
 $price=$_POST['price']; 
	if($action=="add") //menangani aksi penambahan data unit_materialbudget 
	{ 
	//  $idpelanggan = buatID("tbl_pelanggan","P"); 
 mysql_query(" insert into unit_materialbudget (idbudget,budget_qty,progress_qty,unit_idunit,product_idproduct,price)  values  ('$idbudget','$budget_qty','$progress_qty','$unit_idunit','$product_idproduct','$price')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data unit_materialbudget 
	{ 
$sql = " update unit_materialbudget set budget_qty='$budget_qty',progress_qty='$progress_qty',unit_idunit='$unit_idunit',product_idproduct='$product_idproduct',price='$price' where idbudget = $idbudget";  
		$test = mysql_query($sql); 
		echo '{"status":"2"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data unit_materialbudget 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from unit_materialbudget where idbudget ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
