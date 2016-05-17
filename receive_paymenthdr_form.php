  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data receive_paymenthdr"; 
	$status="Simpan"; 
   $sql = "SELECT IFNULL(max(idpaymenthdr),0)+1  FROM receive_paymenthdr";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idpaymenthdr = $data[0];	 
   $pay_date= date('d-m-Y');
   
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from receive_paymenthdr where idreceive_paymenthdr = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idpaymenthdr=$data['idpaymenthdr']; 
		$pay_date=$data['pay_date']; 
		$pay_name=$data['pay_name']; 
		$pay_note=$data['pay_note']; 
		$supplier_idsupp=$data['supplier_idsupp']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Simpan"; 
		$judul="Update data receive_paymenthdr"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#receive_paymenthdr").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "idpaymenthdr"){ 
      dataString = 'idpaymenthdr='+ cari;  
   } 
   else if (combo == "pay_date"){ 
      dataString = 'pay_date='+ cari; 
    } 
   else if (combo == "pay_name"){ 
      dataString = 'pay_name='+ cari; 
    } 
   else if (combo == "pay_note"){ 
      dataString = 'pay_note='+ cari; 
    } 
   else if (combo == "supplier_idsupp"){ 
      dataString = 'supplier_idsupp='+ cari; 
    } 
 
    $.ajax({ 
      url: "receive_paymenthdr_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#receive_paymenthdr_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data receive_paymenthdr ini?")){ 
    		$.ajax({ 
        	url: "receive_paymenthdr_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 2) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil diupdate!"); 
              loadData(); //reload list data 
          		$("#divPageEntry").load("receive_paymenthdr_form.php");   
              $("#divPageEntry").hide(); 
            } 
          else if(response.status == 1) { 
          	  alert("Data Baru berhasil disimpan!"); 
              loadData(); //reload list data 
            window.location="receive_paymenthdr_detail.php?id="+$("input#idpaymenthdr").val(); 
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
  
		page3="receive_paymenthdr_display.php";  
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
<form method="post" name="receive_paymenthdr_form" action="" id="receive_paymenthdr_form">  
<p class="judul">Form Pembayaran Supplier</p>  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">No Dok</td><td><input type="text" id="idpaymenthdr" name="idpaymenthdr" size="10" <? echo $readonly;?> value="<? echo $idpaymenthdr;?>" /></td> 
</tr> 
<?php } else {?> 
<tr><td class="right">NO Dok</td><td><input type="text" id="idpaymenthdr" name="idpaymenthdr" size="10" value="<? echo $idpaymenthdr;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td class="right">Supplier</td> 
<td>
<input type="text" id="supplier_idsupp" name="supplier_idsupp" size="2" maxlength="25" value="<? echo $supplier_idsupp;?>" />
<input type="button" class="button" id="btnlovsupp" value="...">
<input type="text" id="suppname" name="suppname" size="15" maxlength="15" value="<? echo $suppname;?>" readonly/>
</td> 
</tr> 
<tr> 
<td class="right">Tanggal</td> 
<td><input type="text" id="pay_date" name="pay_date" size="30" maxlength="25" value="<? echo $pay_date;?>" /></td> 
</tr> 
<tr> 
<td class="right">Nama </td> 
<td><input type="text" id="pay_name" name="pay_name" size="30" maxlength="25" value="<? echo $pay_name;?>" /></td> 
</tr> 
<tr> 
<td class="right">Catatan</td> 
<td><input type="text" id="pay_note" name="pay_note" size="30" maxlength="25" value="<? echo $pay_note;?>" /></td> 
</tr> 

<tr> 
<td ><input class="button" type="submit" value="<? echo $status;?>"></td> 
<td ><input class="button" type="button" id="btnclose" value="Tutup Form"></td>  
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
