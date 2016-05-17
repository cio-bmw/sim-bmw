<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $idbukutamu=$_POST['idbukutamu']; 
 $nama=$_POST['nama']; 
 $alamat=$_POST['alamat']; 
 $notlp=$_POST['notlp']; 
 $tanggal=settanggal($_POST['tanggal']); 
 $catatan=$_POST['catatan']; 
 $diterima=$_POST['diterima']; 
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
	 
	if($action=="add") //menangani aksi penambahan data bukutamu 
	{ 
	//  $idpelanggan = buatID("tbl_pelanggan","P"); 
 mysql_query(" insert into bukutamu (idbukutamu,nama,alamat,notlp,tanggal,catatan,diterima,emp_idemp)  values  ('$idbukutamu','$nama','$alamat','$notlp','$tanggal','$catatan','$diterima','$emp_idemp')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data bukutamu 
	{ 
$sql = " update bukutamu set idbukutamu='$idbukutamu',nama='$nama',alamat='$alamat',notlp='$notlp',tanggal='$tanggal',catatan='$catatan',diterima='$diterima',emp_idemp='$emp_idemp' where idbukutamu = $idbukutamu";  
		$test = mysql_query($sql); 
		echo '{"status":"1"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data bukutamu 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from bukutamu where idbukutamu ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
