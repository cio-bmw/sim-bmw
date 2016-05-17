  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data Check List"; 
	$status="Tambah"; 
   $sql = "SELECT IFNULL(max(idamclist),0)+1  FROM amclist";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idamclist = $data[0];	 
   $amclistseq = $data[0];
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from amclist where idamclist = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idamclist=$data['idamclist']; 
		$amclist=$data['amclist']; 
		$amclistseq=$data['amclistseq']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data amclist"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#amclist").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "idamclist"){ 
      dataString = 'idamclist='+ cari;  
   } 
   else if (combo == "amclist"){ 
      dataString = 'amclist='+ cari; 
    } 
   else if (combo == "amclistseq"){ 
      dataString = 'amclistseq='+ cari; 
    } 
 
    $.ajax({ 
      url: "amclist_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#amclist_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data amclist ini?")){ 
    		$.ajax({ 
        	url: "amclist_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 2) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil diupdate!"); 
              loadData(); //reload list data 
          		$("#divPageEntry").load("amclist_form.php");   
              $("#divPageEntry").hide(); 
            } 
          else if(response.status == 1) { 
          	  alert("Data Baru berhasil disimpan!"); 
              loadData(); //reload list data 
         //   window.location="amclist_detail.php?id="+$("input#idslshdr").val(); 
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
  
		page3="amclist_display.php";  
		$("#divPageData").load(page3);  
		$("#divPageData").show();  
		return false;  
	});  
 }); 
 </script> 
<form method="post" name="amclist_form" action="" id="amclist_form">  
<p class="judul">Form Memasukkan / Edit Data Check List</p>  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">idamclist</td><td><input type="text" id="idamclist" name="idamclist" size="10" <? echo $readonly;?> value="<? echo $idamclist;?>" /></td> 
</tr> 
<?php } else {?> 
<tr><td class="right">idamclist</td><td><input type="text" id="idamclist" name="idamclist" size="10" value="<? echo $idamclist;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td class="right">amclist</td> 
<td><input type="text" id="amclist" name="amclist" size="30" maxlength="25" value="<? echo $amclist;?>" /></td> 
</tr> 
<tr> 
<td class="right">amclistseq</td> 
<td><input type="text" id="amclistseq" name="amclistseq" size="30" maxlength="25" value="<? echo $amclistseq;?>" /></td> 
</tr> 
<tr> 
<td ><input class="button" type="submit" value="<? echo $status;?>"></td> 
<td ><input class="button" type="button" id="btnclose" value="Tutup Form"></td>  
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
