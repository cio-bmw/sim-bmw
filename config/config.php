<?php
$mysql_hostname = "localhost";  //alamat server
$mysql_user = "root";       //username untuk koneksi ke database
$mysql_password = "11111";   //password koneksi ke database, klo tidak ada bisa dikosongkan
$mysql_database = "citrasehat";   //nama database yang akan diakses/digunakan

mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Koneksi ke database gagal!");
mysql_select_db($mysql_database) or die("Database tidak ditemukan!");

function thumbnail($image_path,$thumb_path,$image_name,$thumb_width,$thumb_height) {
           $ext = strtolower(end(explode('.', "$image_path/$image_name")));
             if ($ext == 'jpg' || $ext == 'jpeg') {
               $src_img = @imagecreatefromjpeg("$image_path/$image_name");
               } else if ($ext == 'png') {
                  $src_img = @imagecreatefrompng("$image_path/$image_name");
                  # Only if your version of GD includes GIF support
                  } else if ($ext == 'gif') {
                  $src_img = @imagecreatefromgif("$image_path/$image_name");
              }
              $origw=imagesx($src_img);
              $origh=imagesy($src_img); 

              $scale = min($thumb_width/$origw,$thumb_height/$origh);
              if ($scale <1) {
                    $new_w= floor($scale*$origw);
                    $new_h = floor($scale*$origh);
                 } else {
                   $new_w=$origw;
                   $new_h=$origh;
              }

              $dst_img = imagecreatetruecolor($new_w,$new_h);
              imagecopyresized($dst_img,$src_img,0,0,0,0,$new_w,$new_h,imagesx($src_img),imagesy($src_img)); 

              imagejpeg($dst_img, "$thumb_path/$image_name"); 
              return true; 
}


function createKelasMenu($classid) {
    global $mysql_scmst_class_table;
    $sql = "select class_id,class_name from $mysql_scmst_class_table order by class_name";
    $result = execsql($sql, $mysql_tpriorities_table);
    if(!isset($classid) || $classid == '')
        echo "<option></option>";
    while($row = mysql_fetch_row($result)) {
        echo "<option value=\"$row[0]\" ";
            if($classid == $row[0]) echo "selected";
            echo "> $row[1] </option>";
    }
}

function createcodeMenu($codeteacher) {
    global $mysql_scmst_teachers_table;
    $sql = "select code_teacher,full_name,call_name,address,sex,birth_place,birth_date,religion,nation from $mysql_scmst_teachers_table";
    $result = execsql($sql, $mysql_tpriorities_table);
    if(!isset($codeteacher) || $codeteacher == '')
        echo "<option></option>";
    while($row = mysql_fetch_row($result)) {
        echo "<option value=\"$row[0]\" ";
            if($codeteacher == $row[0]) echo "selected";
            echo "> $row[1] </option>";
    }
}


function createmoduleMenu($modulecode) {
    global $mysql_scmst_modul_table;
    $sql = "select modul_code,modul_name from $mysql_scmst_modul_table";
    $result = execsql($sql, $mysql_tpriorities_table);
    if(!isset($modulecode) || $modulecode == '')
        echo "<option></option>";
    while($row = mysql_fetch_row($result)) {
        echo "<option value=\"$row[0]\" ";
            if($modulecode == $row[0]) echo "selected";
            echo "> $row[1] </option>";
    }
}



function kirimsms($noTlp,$pesan) {

// menghitung jumlah pecahan
$jmlSMS = ceil(strlen($pesan)/153);
 
// memecah pesan asli
$pecah  = str_split($pesan, 153);
 
// proses untuk mendapatkan ID record yang akan disisipkan ke tabel OUTBOX
$sql = "SHOW TABLE STATUS LIKE 'outbox'";
$result = execsql($sql);
$data  = mysql_fetch_array($result);
$newID = $data['Auto_increment'];
 
// proses penyimpanan ke tabel mysql untuk setiap pecahan
for ($i=1; $i<=$jmlSMS; $i++)
{
// membuat UDH untuk setiap pecahan, sesuai urutannya
$udh = "050003A7".sprintf("%02s", $jmlSMS).sprintf("%02s", $i);
 
// membaca text setiap pecahan
$msg = $pecah[$i-1];
 
if ($i == 1)
{
// jika merupakan pecahan pertama, maka masukkan ke tabel OUTBOX
$sql = "INSERT INTO outbox (DestinationNumber, UDH, TextDecoded, ID, MultiPart, CreatorID)
VALUES ('$noTelp', '$udh', '$msg', '$newID', 'true', 'Gammu')";
}
else
{
// jika bukan merupakan pecahan pertama, simpan ke tabel OUTBOX_MULTIPART
$sql = "INSERT INTO outbox_multipart(UDH, TextDecoded, ID, SequencePosition)
VALUES ('$udh', '$msg', '$newID', '$i')";
}
 
// jalankan query
if(execsql($sql)) { }
//mysql_query($query);
}
}




function headerforms() {
/*
echo '
<table class=grid><tr>
<td width=40px><a href="http://10.10.10.10/sisko/"><img src="./images/logosisko.jpg"></a></td>
</tr>
<tr height=1><td bgcolor=#003366 colspan=2></td></tr>
<tr height=15><td></td></tr>
</table>
';
*/
}



function footerforms() {
echo '';
}

function line($heigth,$color) {
echo '
<table width=100%><tr height = '.$height.'><td bgcolor = '.$color.'></td></tr></table>';
}
function gettanggal($tgl) {
$tgl1 = substr($tgl,6,4);
$tgl2 = substr($tgl,3,2);
$tgl3 = substr($tgl,0,2);
$tgl = $tgl1.'-'.$tgl2.'-'.$tgl3;
return $tgl;
}

function gettanggalsys($tgl) {
$tgl1 = substr($tgl,8,2);
$tgl2 = substr($tgl,5,2);
$tgl3 = substr($tgl,0,4);
$tgl = $tgl1.'-'.$tgl2.'-'.$tgl3;
return $tgl;
}


function productinfo($id) { 
//edit perintah sql di bawah ini // 
$sql = "select * from product where idproduct='$id'"; 
$result = execsql($sql); 
$row = mysql_fetch_array($result); 
return $row; 
}   


function createcategoryoption($optid) { 
$sql = "select idcat,catname,margin from category"; 
$result = execsql($sql); 
if(!isset($kolomid) || $kolomname == '') 
   echo "<option></option>"; 
while($row = mysql_fetch_row($result)) { 
  echo "<option value= $row[0]"; 
      if($kolomid == $row[0]) echo 'selected'; 
     echo ">$row[1]</option>"; 
} 
} 

function createuomoption($optid) { 
$sql = "select iduom,uomname from uom"; 
$result = execsql($sql); 
if(!isset($kolomid) || $kolomname == '') 
   echo "<option></option>"; 
while($row = mysql_fetch_row($result)) { 
  echo "<option value= $row[0]"; 
      if($kolomid == $row[0]) echo 'selected'; 
     echo ">$row[1]</option>"; 
} 
} 

function createsupplieroption($optid) { 
$sql = "select idsupp,suppname,supptype,address,phone,fax,email,website,creditlimit,npwp,contact,pooverdue,aroverdue,active from supplier"; 
$result = execsql($sql); 
if(!isset($kolomid) || $kolomname == '') 
   echo "<option></option>"; 
while($row = mysql_fetch_row($result)) { 
  echo "<option value= $row[0]"; 
      if($kolomid == $row[0]) echo 'selected'; 
     echo ">$row[1]</option>"; 
} 
} 

function categoryinfo($id) { 
//edit perintah sql di bawah ini // 
$sql = "select * from category "; //ganti disini  where xxx_id='$id'"; 
$result = execsql($sql); 
$row = mysql_fetch_array($result); 
return $row; 
}   
 
function supplierinfo($id) { 
//edit perintah sql di bawah ini // 
$sql = "select * from supplier where idsupp='$id'"; 
$result = execsql($sql); 
$row = mysql_fetch_array($result); 
return $row; 
}   

function pasieninfo($id) { 
//edit perintah sql di bawah ini // 
$sql = "select * from pasien where regno='".$id."'"; 
$result = execsql($sql); 
$row = mysql_fetch_array($result); 
return $row; 
}  

function nf($number) {
	$nf = number_format($number,0,',','.');
return $nf;
}	

function rnf($number) {
	$rnf = str_replace('.','',$number);
return $rnf;
}	

function createkabupatenoption($idkab) {
$sql = "select idkab,kabname from kabupaten";
$result = execsql($sql);
if(!isset($idkab) || $kabname == '')
   echo "<option></option>";
while($row = mysql_fetch_row($result)) {
  echo "<option value=$row[0]";
      if($idkab == $row[0]) echo 'selected';
     echo ">$row[1]</option>";
}
}

function roominfo($id) { 
//edit perintah sql di bawah ini // 
$sql = "select * from room where idroom='".$id."'"; 
$result = execsql($sql); 
$row = mysql_fetch_array($result); 
return $row; 
}   

function dokterinfo($id) { 
//edit perintah sql di bawah ini // 
$sql = "select * from dokter where iddr='".$id."'";
$result = execsql($sql); 
$row = mysql_fetch_array($result); 
return $row; 
}   
 
function desainfo($id) { 
//edit perintah sql di bawah ini // 
$sql = "select * from desa where iddesa='$id'";
$result = execsql($sql); 
$row = mysql_fetch_array($result); 
return $row; 
}   
 
function createkecamatanoption($optid) {
$sql = "select idkec,kecname from kecamatan";
$result = execsql($sql);
if(!isset($idkec) || $kecname == '')
   echo "<option></option>";
while($row = mysql_fetch_row($result)) {
  echo "<option value=$row[0]";
     // if($idkec == $row[0]) echo 'selected';
     echo ">$row[1]</option>";
}
} 

function icdxinfo($id) { 
//edit perintah sql di bawah ini // 
$sql = "select * from icdx where idicdx='$id'";
$result = execsql($sql); 
$row = mysql_fetch_array($result); 
return $row; 
}   
 

function createagamaoption($idagama) { 
$sql = "select idagama,agama from agama"; 
$result = execsql($sql); 
if(!isset($idagama) || $agama == '') 
   //echo "<option></option>"; 
while($row = mysql_fetch_row($result)) { 
  echo "<option value=$row[0]"; 
      if($idagama == $row[0]) echo 'selected'; 
     echo ">$row[1]</option>"; 
} 
}  

function createjoboption($idjob) { 
$sql = "select idjob,jobname from job"; 
$result = execsql($sql); 
if(!isset($idjob) || $jobname == '') 
   //echo "<option></option>"; 
while($row = mysql_fetch_row($result)) { 
  echo "<option value=".$row[0].""; 
   if($idjob == $row[0]) echo 'selected'; 
     echo ">$row[1]</option>"; 
} 
} 


function createeducationoption($idedu) { 
$sql = "select idedu,eduname from education"; 
$result = execsql($sql); 
//if(!isset($idedu) || $eduname == '') 
//   echo "<option></option>"; 
while($row = mysql_fetch_row($result)) { 
  echo "<option value=".$row[0]."";
      if($idedu == $row[0]) echo 'selected'; 
     echo ">$row[1]</option>"; 
} 
} 

function createdesaoption($iddesa) { 
$sql = "select iddesa,desaname,kecamatan_idkec from desa"; 
$result = execsql($sql); 
if(!isset($iddesa) || $desaname == '') 
 //  echo "<option></option>"; 
while($row = mysql_fetch_row($result)) { 
  echo "<option value=". $row[0].""; 
      if($iddesa == $row[0]) echo 'selected'; 
     echo ">$row[1]</option>"; 
} 
} 

function createroomoption($idroom) { 
$sql = "select idroom,roomname,bangsal_idbangsal,kelas,tarif from room"; 
$result = execsql($sql); 
if(!isset($idroom) || $roomname == '') 
   echo "<option></option>"; 
while($row = mysql_fetch_row($result)) { 
  echo "<option value=". $row[0].""; 
      if($idroom == $row[0]) echo 'selected'; 
     echo ">$row[1]</option>"; 
} 
} 

function createdokteroption($iddr) { 
$sql = "select iddr,drname,address,phone,tarifpoli,vvip,vip,kelas1,kelas2,kelas3 from dokter"; 
$result = execsql($sql); 
if(!isset($iddr) || $drname == '') 
 //  echo "<option></option>"; 
while($row = mysql_fetch_row($result)) { 
  echo "<option value=".$row[0].""; 
      if($iddr == $row[0]) echo 'selected'; 
     echo ">$row[1]</option>"; 
} 
} 

function createicdxoption($idicdx) { 
$sql = "select idicdx,icdxname from icdx order by icdxname"; 
$result = execsql($sql); 
if(!isset($idicdx) || $icdxname == '') 
   echo "<option></option>"; 
while($row = mysql_fetch_row($result)) { 
  echo "<option value=".$row[0].""; 
      if($idicdx == $row[0]) echo 'selected'; 
     echo ">$row[1]</option>"; 
} 
} 

function createrjstatus($rjstatus){
	    echo "<option value='%'"; if ($rjstatus == '%') echo "selected"; echo ">&nbsp;Semua&nbsp; </option>";
       echo "<option value='open'"; if($rjstatus == 'open') echo "selected"; echo ">&nbsp;Open&nbsp; </option>";
       echo "<option value='close'"; if($rjstatus == 'close') echo "selected"; echo ">&nbsp;Close&nbsp; </option>";
   
}

function createpolioption($poli_id) { 
$sql = "select poli_id,poli_desc,kelas from poli"; 
$result = execsql($sql); 
if(!isset($poli_id) || $poli_desc == '') 
    echo "<option value='%'"; if ($poli_id == '%') echo "selected"; echo ">&nbsp;Semua&nbsp; </option>";
  
//   echo "<option value='%'></option>"; 
while($row = mysql_fetch_row($result)) { 
  echo "<option value='".$row[0]."'"; 
      if($poli_id == $row[0]) echo 'selected'; 
     echo ">".$row[1]."</option>"; 
} 
} 

function getpoliinfo($id) { 
//edit perintah sql di bawah ini // 
$sql = "select * from poli where poli_id='$id'"; 
$result = execsql($sql); 
$row = mysql_fetch_array($result); 
return $row; 
}   
 
 function getdesainfo($iddesa) { 
//edit perintah sql di bawah ini // 
$sql = "select * from desa where iddesa='$iddesa'"; 
$result = execsql($sql); 
$row = mysql_fetch_array($result); 
return $row; 
}   

 function getdokterinfo($iddr) { 
//edit perintah sql di bawah ini // 
$sql = "select * from dokter where iddr='$iddr'"; 
$result = execsql($sql); 
$row = mysql_fetch_array($result); 
return $row; 
}   



?>
