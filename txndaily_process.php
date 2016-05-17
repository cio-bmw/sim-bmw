<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $idtxndaily=$_POST['idtxndaily']; 
 $txndate=settanggal($_POST['txndate']); 
 $txndesc=$_POST['txndesc']; 
 $dvalue=$_POST['dvalue']; 
 $kvalue=$_POST['kvalue']; 
 $saldo=$_POST['saldo']; 
 $txnflag=$_POST['txnflag']; 
 $txnpos_idtxnpos=$_POST['txnpos_idtxnpos']; 
 $txnalokasi_idtxnalokasi=$_POST['txnalokasi_idtxnalokasi']; 
	if($action=="add") //menangani aksi penambahan data txndaily 
	{ 
 mysql_query(" insert into txndaily (idtxndaily,txndate,txndesc,dvalue,kvalue,saldo,txnflag,txnpos_idtxnpos,txnalokasi_idtxnalokasi)  values  ('$idtxndaily','$txndate','$txndesc','$dvalue','$kvalue','$saldo','$txnflag','$txnpos_idtxnpos','$txnalokasi_idtxnalokasi')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data txndaily 
	{ 
$sql = " update txndaily set idtxndaily='$idtxndaily',txndate='$txndate',txndesc='$txndesc',dvalue='$dvalue',kvalue='$kvalue',saldo='$saldo',txnflag='$txnflag',txnpos_idtxnpos='$txnpos_idtxnpos',txnalokasi_idtxnalokasi='$txnalokasi_idtxnalokasi' where idtxndaily = $idtxndaily";  
		$test = mysql_query($sql); 
		echo '{"status":"2"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data txndaily 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from txndaily where idtxndaily ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
