  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data whcashout"; 
	$status="Simpan"; 
   $sql = "SELECT IFNULL(max(idcashout),0)+1  FROM whcashout";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idcashout = $data[0];	 
   $txndate = date('d-m-Y');
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from whcashout where idwhcashout = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idcashout=$data['idcashout']; 
		$txndate=$data['txndate']; 
		$txndesc=$data['txndesc']; 
		$txnvalue=$data['txnvalue']; 
		$sektor_idsektor=$data['sektor_idsektor']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Simpan"; 
		$judul="Update data whcashout"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#whcashout").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "idcashout"){ 
      dataString = 'idcashout='+ cari;  
   } 
   else if (combo == "txndate"){ 
      dataString = 'txndate='+ cari; 
    } 
   else if (combo == "txndesc"){ 
      dataString = 'txndesc='+ cari; 
    } 
   else if (combo == "txnvalue"){ 
      dataString = 'txnvalue='+ cari; 
    } 
   else if (combo == "sektor_idsektor"){ 
      dataString = 'sektor_idsektor='+ cari; 
    } 
 
    $.ajax({ 
      url: "whcashout_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#whcashout_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data whcashout ini?")){ 
    		$.ajax({ 
        	url: "whcashout_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 2) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil diupdate!"); 
              loadData(); //reload list data 
          		$("#divPageEntry").load("whcashout_form.php");   
              $("#divPageEntry").hide(); 
            } 
          else if(response.status == 1) { 
          	  alert("Data Baru berhasil disimpan!"); 
              loadData(); //reload list data 
         //   window.location="whcashout_detail.php?id="+$("input#idslshdr").val(); 
                    		} 
          	else 
          	{ 
          		alert("Data gagal di simpan!"); 
           	} 
        	} 
         }); 
     //		return false; 
     	} 
     //} 
     return false; 
   }); 
 $("#btnclose").click(function(){  
		$("#divPageEntry").hide();  
      $("#divLOV").hide();  
  
		page3="whcashout_display.php";  
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
<form method="post" name="whcashout_form" action="" id="whcashout_form">  
<p class="judul">Form Memasukkan / Edit Data whcashout</p>  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">idcashout</td><td><input type="text" id="idcashout" name="idcashout" size="10" <? echo $readonly;?> value="<? echo $idcashout;?>" /></td> 
</tr> 
<?php } else {?> 
<tr><td class="right">idcashout</td><td><input type="text" id="idcashout" name="idcashout" size="10" value="<? echo $idcashout;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td class="right">Tanggal</td> 
<td><input type="text" id="txndate" name="txndate" size="10" maxlength="15" value="<? echo $txndate;?>" /></td> 
</tr> 
<tr> 
<td class="right">Sektor</td> 
<td>
<input type="text" id="sektor_idsektor" name="sektor_idsektor" size="5" maxlength="25" value="<? echo $sektor_idsektor;?>" />
<input type="text" id="sektorname" name="sektorname" size="30" maxlength="25" value="<? echo $sektorname;?>" />
</td> 
</tr> 
<tr> 
<td class="right">Keterangan</td> 
<td><input type="text" id="txndesc" name="txndesc" size="30" maxlength="25" value="<? echo $txndesc;?>" /></td> 
</tr> 
<tr> 
<td class="right">Jumlah</td> 
<td><input class="right"  type="text" id="txnvalue" name="txnvalue" size="20" maxlength="25" value="<? echo $txnvalue;?>" /></td> 
</tr> 

<tr> 
<td ><input class="button" type="submit" value="<? echo $status;?>"></td> 
<td ><input class="button" type="button" id="btnclose" value="Tutup Form"></td>  
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
