<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $idunit=$_POST['idunit']; 
 $kavling=$_POST['kavling']; 
 $tipe=$_POST['tipe']; 
 $luastanah=$_POST['luastanah']; 
 $owner=$_POST['owner']; 
 $address=$_POST['address']; 
 $phone=$_POST['phone']; 
 $nkontrakuser=$_POST['nkontrakuser']; 
 $nkontrakcont=$_POST['nkontrakcont']; 
 $startbangun=settanggal($_POST['startbangun']); 
 $endbangun=settanggal($_POST['endbangun']); 
 $kpr_idkpr=$_POST['kpr_idkpr']; 
 $sektor_idsektor=$_POST['sektor_idsektor']; 
 $contractor_idcontractor=$_POST['contractor_idcontractor']; 
 $addlb = $_POST['addlb'];
$addlbvalue = $_POST['addlbvalue'];
$addlt = $_POST['addlt'];
$addltvalue = $_POST['addltvalue'];
 $tglduedate=$_POST['tglduedate'];
 $carabayar = $_POST['carabayar'];
 
	if($action=="add") //menangani aksi penambahan data unit 
	{ 
	//  $idpelanggan = buatID("tbl_pelanggan","P"); 
 mysql_query(" insert into unit (carabayar,tglduedate,idunit,kavling,tipe,luastanah,owner,address,phone,nkontrakuser,nkontrakcont,startbangun,endbangun,sektor_idsektor,addlb,addlbvalue,addlt,addltvalue)  
 values  ('$carabayar','$tglduedate','$idunit','$kavling','$tipe','$luastanah','$owner','$address','$phone','$nkontrakuser','$nkontrakcont','$startbangun','$endbangun','$sektor_idsektor','$addlb','$addlbvalue','$addlt','$adltvalue')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data unit 
	{ 
$sql = " update unit set carabayar='$carabayar',tglduedate='$tglduedate',addlb='$addlb',addlbvalue='$addlbvalue',addlt='$addlt',addltvalue='$addltvalue',kavling='$kavling',tipe='$tipe',luastanah='$luastanah',owner='$owner',address='$address',phone='$phone',nkontrakuser='$nkontrakuser',nkontrakcont='$nkontrakcont',startbangun='$startbangun',endbangun='$endbangun',kpr_idkpr='$kpr_idkpr',sektor_idsektor='$sektor_idsektor',contractor_idcontractor='$contractor_idcontractor' where idunit = '".$idunit."'";  
		$test = mysql_query($sql); 
		echo '{"status":"1"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data unit 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from unit where idunit ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
