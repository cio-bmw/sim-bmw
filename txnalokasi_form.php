  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data Alokasi Transaksi Kas"; 
	$status="Simpan"; 
   $sql = "SELECT IFNULL(max(idtxnalokasi),0)+1  FROM txnalokasi";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idtxnalokasi = $data[0];	 
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from txnalokasi where idtxnalokasi = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idtxnalokasi=$data['idtxnalokasi']; 
		$alokasiname=$data['alokasiname']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Simpan"; 
		$judul="Update data Alokasi Transaksi Kas"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#txnalokasi").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "idtxnalokasi"){ 
      dataString = 'idtxnalokasi='+ cari;  
   } 
   else if (combo == "alokasiname"){ 
      dataString = 'alokasiname='+ cari; 
    } 
 
    $.ajax({ 
      url: "txnalokasi_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#txnalokasi_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data txnalokasi ini?")){ 
    		$.ajax({ 
        	url: "txnalokasi_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 2) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil diupdate!"); 
              loadData(); //reload list data 
          		$("#divPageEntry").load("txnalokasi_form.php");   
              $("#divPageEntry").hide(); 
            } 
          else if(response.status == 1) { 
          	  alert("Data Baru berhasil disimpan!"); 
              loadData(); //reload list data 
         //   window.location="txnalokasi_detail.php?id="+$("input#idslshdr").val(); 
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
  
		page3="txnalokasi_display.php";  
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
<form method="post" name="txnalokasi_form" action="" id="txnalokasi_form">  
<p class="judul">Form Memasukkan / Edit Data txnalokasi</p>  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">Kode</td><td><input type="text" id="idtxnalokasi" name="idtxnalokasi" size="10" <? echo $readonly;?> value="<? echo $idtxnalokasi;?>" /></td> 
</tr> 
<?php } else {?> 
<tr><td class="right">Kode</td><td><input type="text" id="idtxnalokasi" name="idtxnalokasi" size="10" value="<? echo $idtxnalokasi;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td class="right">Nama Alokasi</td> 
<td><input type="text" id="alokasiname" name="alokasiname" size="30" maxlength="25" value="<? echo $alokasiname;?>" /></td> 
</tr> 
<tr> 
<td ><input class="button" type="submit" value="<? echo $status;?>"></td> 
<td ><input class="button" type="button" id="btnclose" value="Tutup Form"></td>  
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
