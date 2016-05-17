<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $idreceivehdr=$_POST['idreceivehdr']; 
 $supplier_idsupp=$_POST['supplier_idsupp']; 
 $sektor_idsektor=$_POST['sektor_idsektor']; 
 $rcv_date=settanggal($_POST['rcv_date']); 
 $rcv_bon=$_POST['rcv_bon']; 
 $rcv_titip=$_POST['rcv_titip']; 
 $rcv_desc=$_POST['rcv_desc']; 
 $due_date=settanggal($_POST['due_date']); 
 $paid_date=$_POST['paid_date']; 
 $faktur=$_POST['faktur']; 
 $rcv_bayar=$_POST['rcv_bayar']; 
 $rcv_status=$_POST['rcv_status']; 
 $rcv_diskon=$_POST['rcv_diskon']; 
 $rcv_totprice=$_POST['rcv_totprice']; 
 $rcv_totdiskon=$_POST['rcv_totdiskon']; 
 $rcv_totppn=$_POST['rcv_totppn']; 
	 
	
	if($action=="add") //menangani aksi penambahan data receivehdrsektor 
	{ 
	//  $idpelanggan = buatID("tbl_pelanggan","P"); 
 mysql_query(" insert into receivehdrsektor (idreceivehdr,supplier_idsupp,sektor_idsektor,rcv_date,rcv_bon,rcv_titip,rcv_desc,due_date,paid_date,faktur,rcv_bayar,rcv_status,rcv_diskon,rcv_totprice,rcv_totdiskon,rcv_totppn)  values  ('$idreceivehdr','$supplier_idsupp','$sektor_idsektor','$rcv_date','$rcv_bon','$rcv_titip','$rcv_desc','$due_date','$paid_date','$faktur','$rcv_bayar','$rcv_status','$rcv_diskon','$rcv_totprice','$rcv_totdiskon','$rcv_totppn')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data receivehdrsektor 
	{ 
$sql = " update receivehdrsektor set idreceivehdr='$idreceivehdr',supplier_idsupp='$supplier_idsupp',sektor_idsektor='$sektor_idsektor',rcv_date='$rcv_date',rcv_bon='$rcv_bon',rcv_titip='$rcv_titip',rcv_desc='$rcv_desc',due_date='$due_date',paid_date='$paid_date',faktur='$faktur',rcv_bayar='$rcv_bayar',rcv_status='$rcv_status',rcv_diskon='$rcv_diskon',rcv_totprice='$rcv_totprice',rcv_totdiskon='$rcv_totdiskon',rcv_totppn='$rcv_totppn' where idreceivehdr = $idreceivehdr";  
		$test = mysql_query($sql); 
		echo '{"status":"1"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data receivehdrsektor 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from receivehdrsektor where idreceivehdr ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
