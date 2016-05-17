	<?  
require_once ('login.php'); 
		$str="select * from outbox where idoutbox = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$UpdatedInDB=$data['UpdatedInDB']; 
		$InsertIntoDB=$data['InsertIntoDB']; 
		$SendingDateTime=$data['SendingDateTime']; 
		$Text=$data['Text']; 
		$DestinationNumber=$data['DestinationNumber']; 
		$Coding=$data['Coding']; 
		$UDH=$data['UDH']; 
		$Class=$data['Class']; 
		$TextDecoded=$data['TextDecoded']; 
		$ID=$data['ID']; 
		$MultiPart=$data['MultiPart']; 
		$RelativeValidity=$data['RelativeValidity']; 
		$SenderID=$data['SenderID']; 
		$SendingTimeOut=$data['SendingTimeOut']; 
		$DeliveryReport=$data['DeliveryReport']; 
		$CreatorID=$data['CreatorID']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data outbox"; 
?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/outbox_detail.js"></script> 
</head> 
<body> 
<? include_once "header.php"; ?>  
<div id="divSearch"> 
 <form id="outbox_detail" method="POST" action="" name="outbox_detail"> 
  <table  class="header" ><tr><td class="judul"> 
 <input  class="button" type="button" value="Tampilkan" id="btntampil">
 <input  class="button" type="button" value="Tambah Detail" id="btntambah">
 <? if($sls_status=='confirm') { ?>
 <input type="button" class="button" id="btnreopen" name="btnreopen" value="Batalkan Konfirmasi"> 
<? }  else { ?> 
 <input class="button" type="button"  name="btnconfirm" value="Konfirmasi" id="btnconfirm" />

  <? } ?>
 <input  class="button" type="button" value="Cetak" id="btncetak">
 <input  class="button" type="button" value="Kembali ke Daftar" id="btnlist">
   <input  class="button" type="button" value="Kembali Ke Menu" id="btnexit">
  </td> </tr></table>
  </form> 
</div> 
<p class="judul">Data Detail outbox</p>
 <table> 
<tr><td class="right">UpdatedInDB</td><td><input type="text" id="UpdatedInDB" name="UpdatedInDB" size="10" <? echo readonly;?> value="<? echo $UpdatedInDB;?>" /></td> 
</tr> 
<tr> 
<td class="right">InsertIntoDB</td> 
<td><input type="text" id="InsertIntoDB" name="InsertIntoDB" size="30" maxlength="25" value="<? echo $InsertIntoDB;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">SendingDateTime</td> 
<td><input type="text" id="SendingDateTime" name="SendingDateTime" size="30" maxlength="25" value="<? echo $SendingDateTime;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">Text</td> 
<td><input type="text" id="Text" name="Text" size="30" maxlength="25" value="<? echo $Text;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">DestinationNumber</td> 
<td><input type="text" id="DestinationNumber" name="DestinationNumber" size="30" maxlength="25" value="<? echo $DestinationNumber;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">Coding</td> 
<td><input type="text" id="Coding" name="Coding" size="30" maxlength="25" value="<? echo $Coding;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">UDH</td> 
<td><input type="text" id="UDH" name="UDH" size="30" maxlength="25" value="<? echo $UDH;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">Class</td> 
<td><input type="text" id="Class" name="Class" size="30" maxlength="25" value="<? echo $Class;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">TextDecoded</td> 
<td><input type="text" id="TextDecoded" name="TextDecoded" size="30" maxlength="25" value="<? echo $TextDecoded;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">ID</td> 
<td><input type="text" id="ID" name="ID" size="30" maxlength="25" value="<? echo $ID;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">MultiPart</td> 
<td><input type="text" id="MultiPart" name="MultiPart" size="30" maxlength="25" value="<? echo $MultiPart;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">RelativeValidity</td> 
<td><input type="text" id="RelativeValidity" name="RelativeValidity" size="30" maxlength="25" value="<? echo $RelativeValidity;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">SenderID</td> 
<td><input type="text" id="SenderID" name="SenderID" size="30" maxlength="25" value="<? echo $SenderID;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">SendingTimeOut</td> 
<td><input type="text" id="SendingTimeOut" name="SendingTimeOut" size="30" maxlength="25" value="<? echo $SendingTimeOut;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">DeliveryReport</td> 
<td><input type="text" id="DeliveryReport" name="DeliveryReport" size="30" maxlength="25" value="<? echo $DeliveryReport;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">CreatorID</td> 
<td><input type="text" id="CreatorID" name="CreatorID" size="30" maxlength="25" value="<? echo $CreatorID;?>" readonly /></td> 
</tr> 
</table> 
</div>  
<div id="column1-wrap">
<div id="divPageEntry"></div>
<div id="divPageData"></div> 
</div>
<div id="divLOV"></div> 
<div id="clear"></div> 
<div id="divLoading"></div> 
</body> 
</html>  
