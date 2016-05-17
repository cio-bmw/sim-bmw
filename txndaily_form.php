  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data txndaily"; 
	$status="Simpan"; 
   $sql = "SELECT IFNULL(max(idtxndaily),0)+1  FROM txndaily";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idtxndaily = $data[0];	 
   $txndate = date('d-m-Y');
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from txndaily where idtxndaily = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idtxndaily=$data['idtxndaily']; 
		$txndate=$data['txndate']; 
		$txndesc=$data['txndesc']; 
		$dvalue=$data['dvalue']; 
		$kvalue=$data['kvalue']; 
		$saldo=$data['saldo']; 
		$txnflag=$data['txnflag']; 
		$txnpos_idtxnpos=$data['txnpos_idtxnpos']; 
		$txnalokasi_idtxnalokasi=$data['txnalokasi_idtxnalokasi']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Simpan"; 
		$judul="Update data txndaily"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#txndaily").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "idtxndaily"){ 
      dataString = 'idtxndaily='+ cari;  
   } 
   else if (combo == "txndate"){ 
      dataString = 'txndate='+ cari; 
    } 
   else if (combo == "txndesc"){ 
      dataString = 'txndesc='+ cari; 
    } 
   else if (combo == "dvalue"){ 
      dataString = 'dvalue='+ cari; 
    } 
   else if (combo == "kvalue"){ 
      dataString = 'kvalue='+ cari; 
    } 
   else if (combo == "saldo"){ 
      dataString = 'saldo='+ cari; 
    } 
   else if (combo == "txnflag"){ 
      dataString = 'txnflag='+ cari; 
    } 
   else if (combo == "txnpos_idtxnpos"){ 
      dataString = 'txnpos_idtxnpos='+ cari; 
    } 
   else if (combo == "txnalokasi_idtxnalokasi"){ 
      dataString = 'txnalokasi_idtxnalokasi='+ cari; 
    } 
 
    $.ajax({ 
      url: "txndaily_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#txndaily_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data txndaily ini?")){ 
    		$.ajax({ 
        	url: "txndaily_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 2) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil diupdate!"); 
              loadData(); //reload list data 
          		$("#divPageEntry").load("txndaily_form.php");   
              $("#divPageEntry").hide(); 
            } 
          else if(response.status == 1) { 
          	  alert("Data Baru berhasil disimpan!"); 
              loadData(); //reload list data 
         //   window.location="txndaily_detail.php?id="+$("input#idslshdr").val(); 
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
  
		page3="txndaily_display.php";  
		$("#divPageData").load(page3);  
		$("#divPageData").show();  
		return false;  
	});  
 }); 
$("#btnlovpos").click(function(){ 
		pagelov="txnpos_lov.php"; 
		$("#divLOV").load(pagelov); 
		$("#divLOV").show(); 
		return false; 
	}); 
	
$("#btnlovalokasi").click(function(){ 
		pagelov="txnalokasi_lov.php"; 
		$("#divLOV").load(pagelov); 
		$("#divLOV").show(); 
		return false; 
	}); 	 
 
 </script> 
<script type="text/javascript" src="js/jquery-1.9.1.js"></script> 
<link rel="stylesheet" href="css/jquery-ui.css" />
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" language="javascript">
			jQuery(function(){
				jQuery('input[name=txndate]').datepicker({changeYear:true, changeMonth:true, yearRange:"1990:2025",dateFormat: "dd-mm-yy"});
			})			
</script>	 
<form method="post" name="txndaily_form" action="" id="txndaily_form">  
<p class="judul">Form Memasukkan / Edit Data txndaily</p>  
<table width="490px"> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">idtxndaily</td><td><input type="text" id="idtxndaily" name="idtxndaily" size="10" <? echo $readonly;?> value="<? echo $idtxndaily;?>" /></td> 
</tr> 
<?php } else {?> 
<tr><td class="right">idtxndaily</td><td><input type="text" id="idtxndaily" name="idtxndaily" size="10" value="<? echo $idtxndaily;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td class="right">Tanggal</td> 
<td><input type="text" id="txndate" name="txndate" size="10" maxlength="25" value="<? echo $txndate;?>" /></td> 
</tr> 
<tr> 
<td class="right">Keterangan</td> 
<td><input type="text" id="txndesc" name="txndesc" size="45" maxlength="45" value="<? echo $txndesc;?>" /></td> 
</tr> 
<tr> 
<td class="right">Debet</td> 
<td><input type="text" id="dvalue" name="dvalue" size="10" maxlength="25" value="<? echo $dvalue;?>" /></td> 
</tr> 
<tr> 
<td class="right">Kredit</td> 
<td><input type="text" id="kvalue" name="kvalue" size="10" maxlength="25" value="<? echo $kvalue;?>" /></td> 
</tr> 
<tr> 
<td class="right">txnflag</td> 
<td><input type="text" id="txnflag" name="txnflag" size="30" maxlength="25" value="<? echo $txnflag;?>" /></td> 
</tr> 
<tr> 
<td class="right">Pos</td> 
<td>
<input type="text" id="txnpos_idtxnpos" name="txnpos_idtxnpos" size="3" maxlength="25" value="<? echo $txnpos_idtxnpos;?>" >
<input type="button" class="button" id="btnlovpos" value="...">
<input type="text" id="posname" name="posname" size="35" maxlength="45" value="<? echo $posname;?>" readonly/>
</td> 
</tr> 
<tr> 
<td class="right">Alokasi</td> 
<td><input type="text" id="txnalokasi_idtxnalokasi" name="txnalokasi_idtxnalokasi" size="3" maxlength="25" value="<? echo $txnalokasi_idtxnalokasi;?>" /> 
<input type="button" class="button" id="btnlovalokasi" value="...">
<input type="text" id="alokasiname" name="alokasiname" size="35" maxlength="45" value="<? echo $alokasiname;?>" readonly/>
</td>
</tr> 
<tr> 
<td ><input class="button" type="submit" value="<? echo $status;?>"></td> 
<td ><input class="button" type="button" id="btnclose" value="Tutup Form"></td>  
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
