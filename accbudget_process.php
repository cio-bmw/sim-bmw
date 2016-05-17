<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $idaccbudget=$_POST['idaccbudget']; 
 $tahun=$_POST['tahun']; 
 $bulan=$_POST['bulan']; 
 $budget=$_POST['budget']; 
 $acc_idacc=$_POST['acc_idacc']; 
 $saldoawal=$_POST['saldoawal']; 
 $saldo=$_POST['saldo']; 
 $company_idcompany=$_POST['company_idcompany']; 
 
	if($action=="add") //menangani aksi penambahan data accbudget 
	{ 
	$sql = "SELECT IFNULL(max(CAST(idaccbudget AS UNSIGNED)),0)+1  FROM accbudget";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idaccbudget = $data[0];	
   
   mysql_query(" insert into accbudget (company_idcompany,idaccbudget,tahun,bulan,budget,acc_idacc,saldoawal,saldo)  values  ('$company_idcompany','$idaccbudget','$tahun','$bulan','$budget','$acc_idacc','$saldoawal','$saldo')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data accbudget 
	{ 
$sql = " update accbudget set company_idcompany='$company_idcompany',tahun='$tahun',bulan='$bulan',budget='$budget',acc_idacc='$acc_idacc',saldoawal='$saldoawal',saldo='$saldo' where idaccbudget = $idaccbudget";  
		$test = mysql_query($sql); 
		echo '{"status":"2"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data accbudget 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from accbudget where idaccbudget ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
