<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $idslshdr=$_POST['idslshdr']; 
 $sls_date=$_POST['sls_date']; 
 $sls_bon=$_POST['sls_bon']; 
 $sls_titip=$_POST['sls_titip']; 
 $due_date=$_POST['due_date']; 
 $sls_blj=$_POST['sls_blj']; 
 $sls_tambahan=$_POST['sls_tambahan']; 
 $sls_total=$_POST['sls_total']; 
 $sls_bayar=$_POST['sls_bayar']; 
 $sls_kembali=$_POST['sls_kembali']; 
 $sls_desc=$_POST['sls_desc']; 
 $payment_date=$_POST['payment_date']; 
 $sls_status=$_POST['sls_status']; 
 $sls_diskon=$_POST['sls_diskon']; 
 $emp_idemp=$_POST['emp_idemp']; 
 $customer_idcustomer=$_POST['customer_idcustomer']; 
	 
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
	 
	if($action=="add") //menangani aksi penambahan data pelanggan 
	{ 
	//  $idpelanggan = buatID("tbl_pelanggan","P"); 
 mysql_query(" insert into slshdr (idslshdr,sls_date,sls_bon,sls_titip,due_date,sls_blj,sls_tambahan,sls_total,sls_bayar,sls_kembali,sls_desc,payment_date,sls_status,sls_diskon,emp_idemp,customer_idcustomer)  values  ('$idslshdr','$sls_date','$sls_bon','$sls_titip','$due_date','$sls_blj','$sls_tambahan','$sls_total','$sls_bayar','$sls_kembali','$sls_desc','$payment_date','$sls_status','$sls_diskon','$emp_idemp','$customer_idcustomer')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data pelanggan 
	{ 
$sql = " update slshdr set idslshdr='$idslshdr',sls_date='$sls_date',sls_bon='$sls_bon',sls_titip='$sls_titip',due_date='$due_date',sls_blj='$sls_blj',sls_tambahan='$sls_tambahan',sls_total='$sls_total',sls_bayar='$sls_bayar',sls_kembali='$sls_kembali',sls_desc='$sls_desc',payment_date='$payment_date',sls_status='$sls_status',sls_diskon='$sls_diskon',emp_idemp='$emp_idemp',customer_idcustomer='$customer_idcustomer' where idslshdr = $idslshdr";  
		$test = mysql_query($sql); 
		echo '{"status":"1"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data pelanggan 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from slshdr where idslshdr ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
