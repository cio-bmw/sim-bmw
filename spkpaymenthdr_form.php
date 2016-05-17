  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Masukkan Data Pembayaran"; 
	$status="Tambah"; 
   $sql = "SELECT IFNULL(max(idspkpaymenthdr),0)+1  FROM spkpaymenthdr";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idspkpaymenthdr = $data[0];	 
   $paydate = date('d-m-Y');
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from spkpaymenthdr where idspkpaymenthdr = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idspkpaymenthdr=$data['idspkpaymenthdr']; 
		$paydate=$data['paydate']; 
		$contractor_idcontractor=$data['contractor_idcontractor']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data spkpaymenthdr"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#spkpaymenthdr").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "idspkpaymenthdr"){ 
      dataString = 'idspkpaymenthdr='+ cari;  
   } 
   else if (combo == "paydate"){ 
      dataString = 'paydate='+ cari; 
    } 
   else if (combo == "contractor_idcontractor"){ 
      dataString = 'contractor_idcontractor='+ cari; 
    } 
 
    $.ajax({ 
      url: "spkpaymenthdr_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#spkpaymenthdr_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data spkpaymenthdr ini?")){ 
    		$.ajax({ 
        	url: "spkpaymenthdr_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	  	if(response.status == 2) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil diupdate!"); 
              loadData(); //reload list data 
          		$("#divFormContent").load("spkpaymenthdr_form.php");   
              $("#divFormContent").hide(); 
                       } 
          	else if(response.status == 1) {
              window.location="spkpaymenthdr_detail.php?id="+$("input#idspkpaymenthdr").val(); 
          		
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
  
		page3=".php";  
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
			jQuery('input[name=paydate]').datepicker({changeYear:true, changeMonth:true, yearRange:"1990:2025",dateFormat: "dd-mm-yy"});
 
})	
</script>	 
 
<form method="post" name="spkpaymenthdr_form" action="" id="spkpaymenthdr_form">  
<p class="judul">Form Entry Pembayaran SPK</p>
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">No Dok</td><td><input type="text" id="idspkpaymenthdr" name="idspkpaymenthdr" size="10" <? echo $readonly;?> value="<? echo $idspkpaymenthdr;?>" /></td> 
</tr> 
<?php } else {?> 
<tr><td class="right">No Dok</td><td><input type="text" id="idspkpaymenthdr" name="idspkpaymenthdr" size="10" value="<? echo $idspkpaymenthdr;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td class="right">Tanggal</td> 
<td><input type="text" id="paydate" name="paydate" size="10" maxlength="25" value="<? echo $paydate;?>" /></td> 
</tr> 
<tr> 
<td class="right">Contractor</td> 
<td>
<input type="text" id="contractor_idcontractor" name="contractor_idcontractor" size="5" maxlength="25" value="<? echo $contractor_idcontractor;?>" />
<input type="text" id="contractorname" name="contractorname" size="30" maxlength="25" value="<? echo $contractorname;?>" />
</td> 
</tr> 
<tr> 
<td ><input class="button" type="submit" value="<? echo $status;?>"></td> 
<td ><input class="button" type="button" id="btnclose" value="Tutup Form"></td>  
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
