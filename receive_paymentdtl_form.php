  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data receive_paymentdtl"; 
	$status="Simpan"; 
   $sql = "SELECT IFNULL(max(idpaymentdtl),0)+1  FROM receive_paymentdtl";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idpaymentdtl = $data[0];	 
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from receive_paymentdtl where idreceive_paymentdtl = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idpaymentdtl=$data['idpaymentdtl']; 
		$pay_value=$data['pay_value']; 
		$receivehdr_idreceivehdr=$data['receivehdr_idreceivehdr']; 
		$receive_paymenthdr_idpaymenthdr=$data['receive_paymenthdr_idpaymenthdr']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Simpan"; 
		$judul="Update data receive_paymentdtl"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#receive_paymentdtl").focus();  
  
  document.getElementById('receive_paymenthdr_idpaymenthdr').value = $("input#idpaymenthdr").val();
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "idpaymentdtl"){ 
      dataString = 'idpaymentdtl='+ cari;  
   } 
   else if (combo == "pay_value"){ 
      dataString = 'pay_value='+ cari; 
    } 
   else if (combo == "receivehdr_idreceivehdr"){ 
      dataString = 'receivehdr_idreceivehdr='+ cari; 
    } 
   else if (combo == "receive_paymenthdr_idpaymenthdr"){ 
      dataString = 'receive_paymenthdr_idpaymenthdr='+ cari; 
    } 
 
    $.ajax({ 
      url: "receive_paymentdtl_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#receive_paymentdtl_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data receive_paymentdtl ini?")){ 
    		$.ajax({ 
        	url: "receive_paymentdtl_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 2) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil diupdate!"); 
              loadData(); //reload list data 
          		$("#divPageEntry").load("receive_paymentdtl_form.php");   
              $("#divPageEntry").hide(); 
            } 
          else if(response.status == 1) { 
          	  alert("Data Baru berhasil disimpan!"); 
              loadData(); //reload list data 
         //   window.location="receive_paymentdtl_detail.php?id="+$("input#idslshdr").val(); 
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
  
		page3="receive_paymentdtl_display.php";  
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
<form method="post" name="receive_paymentdtl_form" action="" id="receive_paymentdtl_form">  
<p class="judul">Form Memasukkan / Edit Data receive_paymentdtl</p>  
<table width="400px"> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<input type="hidden" id="idpaymentdtl" name="idpaymentdtl" size="10" <? echo $readonly;?> value="<? echo $idpaymentdtl;?>" />
<input type="hidden" id="receive_paymenthdr_idpaymenthdr" name="receive_paymenthdr_idpaymenthdr" size="10" maxlength="25" value="<? echo $receive_paymenthdr_idpaymenthdr;?>" />
<tr> 
<td class="right">No Dok penerimaan</td> 
<td><input placeholder="pilih dari daftar yg ada di kanan" type="text" id="receivehdr_idreceivehdr" name="receivehdr_idreceivehdr" size="20" maxlength="25" value="<? echo $receivehdr_idreceivehdr;?>" /></td> 
</tr> 
<tr> 
<td class="right">Jumlah</td> 
<td><input class="right" type="text" id="pay_value" name="pay_value" size="20" maxlength="25" value="<? echo $pay_value;?>" /></td> 
</tr> 

<tr> <td></td>
<td ><input class="button" type="submit" value="<? echo $status;?>"><input class="button" type="button" id="btnclose" value="Tutup Form"></td>  
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
