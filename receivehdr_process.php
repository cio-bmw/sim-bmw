<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $idreceivehdr=$_POST['idreceivehdr']; 
 $supplier_idsupp=$_POST['supplier_idsupp']; 
 $rcv_date=settanggaljam($_POST['rcv_date']); 
 $rcv_bon=$_POST['rcv_bon']; 
 $rcv_titip=$_POST['rcv_titip']; 
 $rcv_desc=$_POST['rcv_desc']; 
 $due_date=settanggaljam($_POST['due_date']); 
 $paid_date=$_POST['paid_date']; 
 $faktur=$_POST['faktur']; 
 $rcv_bayar=$_POST['rcv_bayar']; 
 $rcv_status=$_POST['rcv_status']; 
 $rcv_diskon=$_POST['rcv_diskon']; 
 $rcv_totprice=$_POST['rcv_totprice']; 
 $rcv_totdiskon=$_POST['rcv_totdiskon']; 
 $rcv_totppn=$_POST['rcv_totppn']; 
 $emp_idemp=$_POST['emp_idemp']; 
	 
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
	 
	if($action=="add") //menangani aksi penambahan data receivehdr 
	{ 
	//  $idpelanggan = buatID("tbl_pelanggan","P"); 
 mysql_query(" insert into receivehdr (idreceivehdr,supplier_idsupp,rcv_date,rcv_bon,rcv_titip,rcv_desc,due_date,paid_date,faktur,rcv_bayar,rcv_status,rcv_diskon,rcv_totprice,rcv_totdiskon,rcv_totppn,emp_idemp)  values  ('$idreceivehdr','$supplier_idsupp','$rcv_date','$rcv_bon','$rcv_titip','$rcv_desc','$due_date','$paid_date','$faktur','$rcv_bayar','open','$rcv_diskon','$rcv_totprice','$rcv_totdiskon','$rcv_totppn','$emp_idemp')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data receivehdr 
	{ 
$sql = " update receivehdr set idreceivehdr='$idreceivehdr',supplier_idsupp='$supplier_idsupp',rcv_date='$rcv_date',rcv_bon='$rcv_bon',rcv_titip='$rcv_titip',rcv_desc='$rcv_desc',due_date='$due_date',paid_date='$paid_date',faktur='$faktur',rcv_bayar='$rcv_bayar',rcv_status='$rcv_status',rcv_diskon='$rcv_diskon',rcv_totprice='$rcv_totprice',rcv_totdiskon='$rcv_totdiskon',rcv_totppn='$rcv_totppn',emp_idemp='$emp_idemp' where idreceivehdr = $idreceivehdr";  
		$test = mysql_query($sql); 
		echo '{"status":"1"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data receivehdr 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from receivehdr where idreceivehdr ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
