<?php
include "connect.php";


function studentinfo($id) { 
//edit perintah sql di bawah ini // 
$sql = "select * from student where id='$id'"; 
$result = mysql_query($sql); 
$row = mysql_fetch_array($result); 
return $row; 
}

function bookcategoryinfo($id) { 
//edit perintah sql di bawah ini // 
$sql = "select * from bookcategory where idcat='$id'"; 
$result = mysql_query($sql); 
$row = mysql_fetch_array($result); 
return $row; 
}

function empinfo($id) { 
$sql = "select * from emp where idemp ='$id'"; 
$result = mysql_query($sql); 
$row = mysql_fetch_array($result); 
return $row; 
}

function booksourceinfo($id) { 
//edit perintah sql di bawah ini // 
$sql = "select * from booksource where idsource='$id'"; 
$result = mysql_query($sql); 
$row = mysql_fetch_array($result); 
return $row; 
}

function bookgroupinfo($id) { 
//edit perintah sql di bawah ini // 
$sql = "select * from bookgroup where idbookgroup='$id'"; 
$result = mysql_query($sql); 
$row = mysql_fetch_array($result); 
return $row; 
}

function kelasinfo($id) { 
//edit perintah sql di bawah ini // 
$sql = "select * from kelas where idclass='$id'"; 
$result = mysql_query($sql); 
$row = mysql_fetch_array($result); 
return $row; 
}

function groupclassinfo($id) { 
//edit perintah sql di bawah ini // 
$sql = "select * from groupclass where idgroup='$id'"; 
$result = mysql_query($sql); 
$row = mysql_fetch_array($result); 
return $row; 
}

function teacherinfo($id) { 
//edit perintah sql di bawah ini // 
$sql = "select * from teacher where idteacher='$id'"; 
$result = mysql_query($sql); 
$row = mysql_fetch_array($result); 
return $row; 
}



function createstudentoption($idkab) {
$sql = "select id,full_name from student";
$result = mysql_query($sql);
if(!isset($idkab) || $kabname == '')
   echo "<option></option>";
while($row = mysql_fetch_row($result)) {
  echo "<option value=$row[0]";
      if($idkab == $row[0]) echo 'selected';
     echo ">$row[1]</option>";
}
}


function createkelasoption($id) {
$sql = "select idclass,class_desc from kelas order by CAST(idclass AS UNSIGNED) ";
$result = mysql_query($sql);
if(!isset($id) || $colname == '')
//   echo "<option></option>";
while($row = mysql_fetch_row($result)) {
  echo "<option value= '".$row[0]."'";
      if($id == $row[0]) echo 'selected';
     echo ">$row[1]</option>";
}
}


function settanggal($tgl) {
$tgl1 = substr($tgl,6,4);
$tgl2 = substr($tgl,3,2);
$tgl3 = substr($tgl,0,2);
$tgl = $tgl1.'-'.$tgl2.'-'.$tgl3;
return $tgl;
}

function settanggaljam($tgl) {
$tgl1 = substr($tgl,6,4);
$tgl2 = substr($tgl,3,2);
$tgl3 = substr($tgl,0,2);
$tgl4 = substr($tgl,11,8);
$tgl = $tgl1.'-'.$tgl2.'-'.$tgl3.' '.$tgl4;
return $tgl;
}

function nowdatetime() {
$tglnow = date("Y-m-d H:i:s");
return gettanggaljam($tglnow);	
}

function gettanggaljam($tgl) {
$tgl1 = substr($tgl,8,2);
$tgl2 = substr($tgl,5,2);
$tgl3 = substr($tgl,0,4);
$tgl4 = substr($tgl,11,8);
$tgl = $tgl1.'-'.$tgl2.'-'.$tgl3.' '.$tgl4;
return $tgl;
}


function gettanggal($tgl) {
$tgl1 = substr($tgl,8,2);
$tgl2 = substr($tgl,5,2);
$tgl3 = substr($tgl,0,4);
$tgl = $tgl1.'-'.$tgl2.'-'.$tgl3;
return $tgl;
}


function nf($number) {
	$nf = number_format($number,0,',','.');
return $nf;
}	

function rnf($number) {
	$rnf = str_replace('.','',$number);
return $rnf;
}	



function createbulanoption($bulan){
      echo "<option value=\"1\""; if($bulan == 1) echo 'selected'; echo ">Januari</option>";
       echo "<option value=\"2\""; if($bulan == 2) echo 'selected'; echo ">Pebruari</option>";
       echo "<option value=\"3\""; if($bulan == 3) echo "selected"; echo ">Maret</option>";
       echo "<option value=\"4\""; if($bulan == 4) echo "selected"; echo ">April</option>";
       echo "<option value=\"5\""; if($bulan == 5) echo "selected"; echo ">Mei</option>";
       echo "<option value=\"6\""; if($bulan == 6) echo "selected"; echo ">Juni</option>";
       echo "<option value=\"7\""; if($bulan == 7) echo "selected"; echo ">Juli</option>";
       echo "<option value=\"8\""; if($bulan == 8) echo "selected"; echo ">Agustus</option>";
       echo "<option value=\"9\""; if($bulan == 9) echo "selected"; echo ">September</option>";
       echo "<option value=\"10\""; if($bulan == 10) echo "selected"; echo ">Oktober</option>";
       echo "<option value=\"11\""; if($bulan == 11) echo "selected"; echo ">Nopember</option>";
       echo "<option value=\"12\""; if($bulan == 12) echo "selected"; echo ">Desember</option>";     
}

function createtahunoption($tahun){
	    echo "<option value=\"2012\""; if($tahun == 2012) echo "selected"; echo "> 2012 </option>";
       echo "<option value=\"2013\""; if($tahun == 2013) echo "selected"; echo "> 2013 </option>";
       echo "<option value=\"2014\""; if($tahun == 2014) echo "selected"; echo "> 2014 </option>";
       echo "<option value=\"2015\""; if($tahun == 2015) echo "selected"; echo "> 2015 </option>";
       echo "<option value=\"2016\""; if($tahun == 2016) echo "selected"; echo "> 2016 </option>";
       echo "<option value=\"2017\""; if($tahun == 2017) echo "selected"; echo "> 2017 </option>";
       echo "<option value=\"2018\""; if($tahun == 2017) echo "selected"; echo "> 2018 </option>";
       echo "<option value=\"2019\""; if($tahun == 2018) echo "selected"; echo "> 2019 </option>";

}
 

?>
