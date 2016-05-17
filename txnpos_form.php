  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data Pos Transaksi"; 
	$status="Simpan"; 
   $sql = "SELECT IFNULL(max(idtxnpos),0)+1  FROM txnpos";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idtxnpos = $data[0];	 
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from txnpos where idtxnpos = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idtxnpos=$data['idtxnpos']; 
		$posname=$data['posname']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Simpan"; 
		$judul="Update data Pos"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#txnpos").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "idtxnpos"){ 
      dataString = 'idtxnpos='+ cari;  
   } 
   else if (combo == "posname"){ 
      dataString = 'posname='+ cari; 
    } 
 
    $.ajax({ 
      url: "txnpos_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#txnpos_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data txnpos ini?")){ 
    		$.ajax({ 
        	url: "txnpos_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 2) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil diupdate!"); 
              loadData(); //reload list data 
          		$("#divPageEntry").load("txnpos_form.php");   
              $("#divPageEntry").hide(); 
            } 
          else if(response.status == 1) { 
          	  alert("Data Baru berhasil disimpan!"); 
              loadData(); //reload list data 
         //   window.location="txnpos_detail.php?id="+$("input#idslshdr").val(); 
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
  
		page3="txnpos_display.php";  
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
<form method="post" name="txnpos_form" action="" id="txnpos_form">  
<p class="judul">Form Memasukkan / Edit Data txnpos</p>  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">Kode</td><td><input type="text" id="idtxnpos" name="idtxnpos" size="10" <? echo $readonly;?> value="<? echo $idtxnpos;?>" /></td> 
</tr> 
<?php } else {?> 
<tr><td class="right">Kode</td><td><input type="text" id="idtxnpos" name="idtxnpos" size="10" value="<? echo $idtxnpos;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td class="right">Nama Pos</td> 
<td><input type="text" id="posname" name="posname" size="30" maxlength="25" value="<? echo $posname;?>" /></td> 
</tr> 
<tr> 
<td ><input class="button" type="submit" value="<? echo $status;?>"></td> 
<td ><input class="button" type="button" id="btnclose" value="Tutup Form"></td>  
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
