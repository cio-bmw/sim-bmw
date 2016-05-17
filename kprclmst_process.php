<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
    include_once("config.php"); 
     
  $action=$_POST['action']; 
 $idkprclmst=$_POST['idkprclmst']; 
 $kprclmst=$_POST['kprclmst']; 
 $kprpct=$_POST['kprpct']; 
 $kprtime=$_POST['kprtime'];
 $kprseq=$_POST['kprseq'];
    if($action=="add") //menangani aksi penambahan data kprclmst 
    { 
 mysql_query(" insert into kprclmst (idkprclmst,kprclmst,kprpct,kprseq,kprtime)  values  ('$idkprclmst','$kprclmst','$kprpct','$kprseq','$kprtime')")  or die("Data gagal Di Tambahkan!");
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
        exit; 
    } 
    elseif($action=="update") //menangani aksi perubahan data kprclmst 
    { 
$sql = " update kprclmst set idkprclmst='$idkprclmst',kprclmst='$kprclmst',kprpct='$kprpct',kprseq='$kprseq',kprtime='$kprtime' where idkprclmst = $idkprclmst";
        $test = mysql_query($sql); 
        echo '{"status":"2"}'; 
        exit; 
    } 
    elseif($_GET['action']=="delete") //menangani aksi penghapusan data kprclmst 
    { 
        $id = $_GET['id']; 
        $test = mysql_query("delete from kprclmst where idkprclmst ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
        } 
        exit; 
    } 
     
?> 