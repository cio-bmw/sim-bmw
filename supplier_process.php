<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $idsupp=$_POST['idsupp']; 
 $suppname=$_POST['suppname']; 
 $supptype=$_POST['supptype']; 
 $address=$_POST['address']; 
 $phone=$_POST['phone']; 
 $fax=$_POST['fax']; 
 $email=$_POST['email']; 
 $website=$_POST['website']; 
 $creditlimit=$_POST['creditlimit']; 
 $npwp=$_POST['npwp']; 
 $contact=$_POST['contact']; 
 $pooverdue=$_POST['pooverdue']; 
 $aroverdue=$_POST['aroverdue']; 
 $active=$_POST['active']; 
	 
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
	 
	if($action=="add") //menangani aksi penambahan data supplier 
	{ 
	//  $idpelanggan = buatID("tbl_pelanggan","P"); 
 mysql_query(" insert into supplier (idsupp,suppname,supptype,address,phone,fax,email,website,creditlimit,npwp,contact,pooverdue,aroverdue,active)  values  ('$idsupp','$suppname','$supptype','$address','$phone','$fax','$email','$website','$creditlimit','$npwp','$contact','$pooverdue','$aroverdue','$active')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data supplier 
	{ 
$sql = " update supplier set idsupp='$idsupp',suppname='$suppname',supptype='$supptype',address='$address',phone='$phone',fax='$fax',email='$email',website='$website',creditlimit='$creditlimit',npwp='$npwp',contact='$contact',pooverdue='$pooverdue',aroverdue='$aroverdue',active='$active' where idsupp = '".$idsupp."'";  
		$test = mysql_query($sql); 
		echo '{"status":"1"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data supplier 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from supplier where idsupp ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
