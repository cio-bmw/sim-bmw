<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $idunitclbangun=$_POST['idunitclbangun']; 
 $clstatus=$_POST['clstatus']; 
 $clbangun_idclbangun=$_POST['clbangun_idclbangun']; 
 $unit_idunit=$_POST['unit_idunit']; 
 $bobotpct=$_POST['bobotpct']; 
 $progress = $_POST['progress'];
 $unitspk_idunitspk=$_POST['unitspk_idunitspk']; 
 $workdays=$_POST['workdays']; 
	 
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
	 
	if($action=="add") //menangani aksi penambahan data unitclbangun 
	{ 
	//  $idpelanggan = buatID("tbl_pelanggan","P"); 
 mysql_query(" insert into unitclbangun (idunitclbangun,clstatus,clbangun_idclbangun,unit_idunit,bobotpct,unitspk_idunitspk,workdays)  values  ('$idunitclbangun','$clstatus','$clbangun_idclbangun','$unit_idunit','$bobotpct','$unitspk_idunitspk','$workdays')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data unitclbangun 
	{ 
$sql = " update unitclbangun set progress='$progress', idunitclbangun='$idunitclbangun',clstatus='$clstatus',clbangun_idclbangun='$clbangun_idclbangun',unit_idunit='$unit_idunit',bobotpct='$bobotpct',unitspk_idunitspk='$unitspk_idunitspk',workdays='$workdays' where idunitclbangun = $idunitclbangun";  
		$test = mysql_query($sql); 
		echo '{"status":"2"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data unitclbangun 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from unitclbangun where idunitclbangun ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
