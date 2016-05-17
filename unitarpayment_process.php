<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
include_once("config.php"); 
	 
 $action=$_POST['action']; 
 $idunitarpayment=$_POST['idunitarpayment']; 
 $pay_value=$_POST['pay_value']; 
 $unit_idunit=$_POST['unit_idunit']; 
 $unitar_idunitar=$_POST['unitar_idunitar']; 
 
 $pay_date=settanggal($_POST['pay_date']); 
 $pay_name=$_POST['pay_name']; 
 $pay_note=$_POST['pay_note']; 
 $transfer=$_POST['transfer'];
 $unitmstpayment_idpayment=$_POST['unitmstpayment_idpayment']; 
	 

	 
	if($action=="add") //menangani aksi penambahan data unitarpayment 
	{ 
	//  $idpelanggan = buatID("tbl_pelanggan","P"); 
 mysql_query(" insert into unitarpayment (idunitarpayment,pay_value,unit_idunit,pay_date,pay_name,pay_note,unitmstpayment_idpayment,unitar_idunitar,transfer)  values  ('$idunitarpayment','$pay_value','$unit_idunit','$pay_date','$pay_name','$pay_note','$unitmstpayment_idpayment','$unitar_idunitar','$transfer')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data unitarpayment 
	{ 
$sql = " update unitarpayment set idunitarpayment='$idunitarpayment',pay_value='$pay_value',unit_idunit='$unit_idunit',pay_date='$pay_date',pay_name='$pay_name',pay_note='$pay_note',unitmstpayment_idpayment='$unitmstpayment_idpayment',transfer='$transfer' where idunitarpayment = $idunitarpayment";  
		$test = mysql_query($sql); 
		echo '{"status":"1"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data unitarpayment 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from unitarpayment where idunitarpayment ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
