<? require_once ('login.php'); ?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/acc.js"></script> 

<?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data acc"; 
	$status="Simpan"; 
   $sql = "SELECT IFNULL(max(CAST(idacc AS UNSIGNED)),0)+1  FROM acc";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idacc = $data[0];	 
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from acc where idacc = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idacc=$data['idacc']; 
		$accname=$data['accname']; 
		$accsaldo=$data['accsaldo']; 
		$groupacc_idgroupacc=$data['groupacc_idgroupacc']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Simpan"; 
		$judul="Update data acc"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#acc").focus();  
  
 $("input").not($(":submit")).keypress(function (evt) {  
              if (evt.keyCode == 13) {  
                  iname = $(this).val();  
                  if (iname !== 'Submit') {  
                      var fields = $(this).parents('form:eq(0),body').find('button, input, textarea, select');  
                      var index = fields.index(this);  
                      if (index > -1 && (index + 1) < fields.length) {  
                          fields.eq(index + 1).focus();  
                      }  
                      return false;  
                  }  
              }  
          });  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "idacc"){ 
      dataString = 'idacc='+ cari;  
   } 
   else if (combo == "accname"){ 
      dataString = 'accname='+ cari; 
    } 
   else if (combo == "accsaldo"){ 
      dataString = 'accsaldo='+ cari; 
    } 
   else if (combo == "groupacc_idgroupacc"){ 
      dataString = 'groupacc_idgroupacc='+ cari; 
    } 
 
    $.ajax({ 
      url: "acc_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#acc_form").submit(function(){ 
   if (confirm("Apakah benar akan melakukan Proses Posting Bulanan ini?")){ 
   window.open("acc_montlyprocess.php","_blank");  
   });
 
 $("#btnclose").click(function(){  
		$("#divPageEntry").hide();  
      $("#divLOV").hide();  
  
		page3="acc_display.php";  
		$("#divPageData").load(page3);  
		$("#divPageData").show();  
		return false;  
	});  
 }); 
 </script> 
<script type="text/javascript" src="js/jquery-1.9.1.js"></script> 
<link rel="stylesheet" href="css/jquery-ui.css" />
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" language="javascript">
			jQuery(function(){
				jQuery('input[name=rcv_date]').datepicker({changeYear:true, changeMonth:true, yearRange:"1990:2025",dateFormat: "dd-mm-yyyy"});
			})			
</script>	 
<body>
<? include_once "header.php"; ?>    
<form method="post" name="acc_form" action="" id="acc_form">  
<p class="judul">Proses Posting Bulanan</p>  
<table> 
<tr><th colspan="2"><b></b></th></tr> 
<tr> 
<td class="right">
Tahun : 
<input type="text" id="tahun" name="tahun" size="5" value="<? echo $tahun;?> " >
Bulan :
<select id="bulan" name="bulan">
<? createbulanoption($bulan); ?>
</select> </td> 
</tr> 

<tr> 
<td><input type="checkbox" id="mtrlbuy" name="mtrlbuy" size="30" maxlength="25" value="checked" <? echo $mtrlbuy;?> />Pembelian</td> 
</tr>
<tr>
<td><input type="checkbox" id="mtrlstok" name="mtrlstok" size="30" maxlength="25" value="checked" <? echo $mtrlstok;?> />Stok Material</td> 
</tr>


<tr> 
<td ><input class="button" type="submit" value="<? echo $status;?>"></td> 
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
</body>