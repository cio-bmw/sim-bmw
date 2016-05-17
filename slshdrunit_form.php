  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data Pengeluaran Barang Ke Unit/Fasum"; 
	$status="Tambah"; 
   $sql = "SELECT IFNULL(max(idslshdr),0)+1  FROM slshdrunit";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idslshdr = $data[0];	 
   $sls_date = date('d-m-Y');  
   
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from slshdrunit where idslshdr = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idslshdr=$data['idslshdr']; 
		$sls_date=gettanggal($data['sls_date']); 
		$sls_status=$data['sls_status']; 
		$unit_idunit=$data['unit_idunit']; 
		$emp_idemp=$data['emp_idemp']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data slshdrunit"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#slshdrunit").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var sektor = $("select#idsektor").val(); 
	   
	   dataString = 'kavling='+ cari + '&idsektor='+sektor;
 
    $.ajax({ 
      url: "slshdrunit_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#slshdrunit_form").submit(function(){ 
  
     var vunit = $("input#unit_idunit").val();
     if (vunit =="") {
     alert('kavling belum di pilih');
     $("input#unit_idunit").focus();
     return false     	
     	
     	}       
  
  
    if (confirm("Apakah benar akan menyimpan data slshdrunit ini?")){ 
    		$.ajax({ 
        	url: "slshdrunit_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 2) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil diupdate!"); 
              loadData(); //reload list data 
             //$("#divPageEntry").load("slshdrunit_form.php");   
             // $("#divPageEntry").hide(); 
            } 
          else if(response.status == 1) { 
           alert("Data Baru berhasil disimpan!"); 
           window.location="slsdtlunit.php?id="+$("input#idslshdr").val(); 
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
  
		page3="slshdrunit_display.php";  
		$("#divPageData").load(page3);  
		$("#divPageData").show();  
		return false;  
	});  
 }); 
 </script> 
<form method="post" name="slshdrunit_form" action="" id="slshdrunit_form">  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">No Dok</td><td><input type="text" id="idslshdr" name="idslshdr" size="10" <? echo $readonly;?> value="<? echo $idslshdr;?>" /></td> 
</tr> 
<?php } else {?> 
<tr><td class="right">No Dok</td><td><input type="text" id="idslshdr" name="idslshdr" size="10" value="<? echo $idslshdr;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td class="right">Tanggal</td> 
<td><input type="text" id="sls_date" name="sls_date" size="30" maxlength="25" value="<? echo $sls_date;?>" /></td> 
</tr> 
<tr> 
<td class="right">Unit/Kavling</td> 
<td>
<input type="text" id="unit_idunit" name="unit_idunit" size="5" maxlength="25" value="<? echo $unit_idunit;?>" />/
<input type="text" id="kavling" name="kavling" size="10" maxlength="25" value="<? echo $kavling;?>" />
</td> 
</tr> 
<tr> 
<td class="right">Status</td> 
<td>
<input type="text" id="sls_status" name="sls_status" size="5" maxlength="25" value="<? echo $sls_status;?>" />
</td> 
</tr> 


<input type="hidden" id="emp_idemp" name="emp_idemp" size="30" maxlength="25" value="<? echo $emp_idemp;?>" /> 
<tr> 
<td ><input class="button" type="submit" value="<? echo $status;?>"></td> 
<td ><input class="button" type="button" id="btnclose" value="Tutup Form"></td>  
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
