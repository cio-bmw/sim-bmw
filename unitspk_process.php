<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $idunitspk=$_POST['idunitspk']; 
 $spkdate=settanggal($_POST['spkdate']); 
 $spkdesc1=$_POST['spkdesc1']; 
 $spkdesc2=$_POST['spkdesc2']; 
 $spkvalue=$_POST['spkvalue']; 
 $spkcat_idspkcat=$_POST['spkcat_idspkcat']; 
 $unit_idunit=$_POST['unit_idunit']; 
 $contractor_idcontractor=$_POST['contractor_idcontractor']; 
	 
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
	 
	if($action=="add") //menangani aksi penambahan data unitspk 
	{ 
	//  $idpelanggan = buatID("tbl_pelanggan","P"); 
 mysql_query(" insert into unitspk (idunitspk,spkdate,spkdesc1,spkdesc2,spkvalue,spkcat_idspkcat,unit_idunit,contractor_idcontractor,spkstatus)  values  ('$idunitspk','$spkdate','$spkdesc1','$spkdesc2','$spkvalue','$spkcat_idspkcat','$unit_idunit','$contractor_idcontractor','open')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data unitspk 
	{ 
$sql = " update unitspk set idunitspk='$idunitspk',spkdate='$spkdate',spkdesc1='$spkdesc1',spkdesc2='$spkdesc2',spkvalue='$spkvalue',spkcat_idspkcat='$spkcat_idspkcat',unit_idunit='$unit_idunit',contractor_idcontractor='$contractor_idcontractor' where idunitspk = $idunitspk";  
		$test = mysql_query($sql); 
		echo '{"status":"1"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data unitspk 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from unitspk where idunitspk ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
