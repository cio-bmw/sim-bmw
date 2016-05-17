  <?  
  include_once("config.php"); 
     	$spkpaymenthdr_idspkpaymenthdr = $_GET['id'];
	$action="add"; 
	$judul="Penambahan Data spkpaymentdtl"; 
	$status="Tambah"; 
 
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from spkpaymentdtl where idspkpaymentdtl = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idspkpaymentdtl=$data['idspkpaymentdtl']; 
		$payvalue=$data['payvalue']; 
		$spkpaymenthdr_idspkpaymenthdr=$data['spkpaymenthdr_idspkpaymenthdr']; 
		$unitspk_idunitspk=$data['unitspk_idunitspk']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data spkpaymentdtl"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#spkpaymentdtl").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#idspkpaymenthdr").val(); 
	  
      dataString = 'id='+ cari;  
   
    $.ajax({ 
      url: "spkpaymentdtl_displaymini.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#spkpaymentdtl_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data spkpaymentdtl ini?")){ 
    		$.ajax({ 
        	url: "spkpaymentdtl_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 2) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil diupdate!"); 
              loadData(); //reload list data 
              
              
      page1="spkpaymentdtl_form.php?id="+$("input#idspkpaymenthdr").val(); 
		$("#divPageEntry").load(page1); 
		$("#divPageEntry").show();
		return false;

            } 
          else if(response.status == 1) { 
          	  alert("Data Baru berhasil disimpan!"); 
              loadData(); //reload list data 
          page1="spkpaymentdtl_form.php?id="+$("input#idspkpaymenthdr").val(); 
		$("#divPageEntry").load(page1); 
		$("#divPageEntry").show();
		return false;
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
  
		page3="spkpaymentdtl_display.php?id="+$("input#idspkpaymenthdr").val();  
		$("#divPageData").load(page3);  
		$("#divPageData").show();  
		return false;  
	});  
 }); 
 </script> 
<form method="post" name="spkpaymentdtl_form" action="" id="spkpaymentdtl_form">  
<p class="judul">Form Memasukkan / Edit Data Pembayaran SPK</p>  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<input type="hidden" id="idspkpaymentdtl" name="idspkpaymentdtl" size="10" <? echo $readonly;?> value="<? echo $idspkpaymentdtl;?>" /></td> 
<tr> 
<td class="right">No SPK</td> 
<td>
<input type="text" id="unitspk_idunitspk" name="unitspk_idunitspk" size="5" maxlength="25" value="<? echo $unitspk_idunitspk;?>" />
<input type="text" id="category" name="category" size="20" maxlength="35" value="<? echo $category;?>" />
<input type="text" id="kavling" name="kavling" size="8" maxlength="25" value="<? echo $kavling;?>" />

</td> 

</tr> 

<tr> 
<td class="right">Jumlah</td> 
<td><input type="text" id="payvalue" name="payvalue" size="10" maxlength="25" value="<? echo $payvalue;?>" /></td> 
</tr> 
<input type="hidden" id="spkpaymenthdr_idspkpaymenthdr" name="spkpaymenthdr_idspkpaymenthdr" size="30" maxlength="25" value="<? echo $spkpaymenthdr_idspkpaymenthdr;?>" />
 
<tr> 
<td ><input class="button" type="submit" value="<? echo $status;?>"></td> 
<td ><input class="button" type="button" id="btnclose" value="Tutup Form"></td>  
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
