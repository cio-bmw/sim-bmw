  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data plhdr"; 
	$status="Simpan"; 
   $sql = "SELECT IFNULL(max(CAST(idplhdr AS UNSIGNED)),0)+1  FROM plhdr";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idplhdr = $data[0];	 
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from plhdr where idplhdr = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idplhdr=$data['idplhdr']; 
		$plhdrname=$data['plhdrname']; 
		$plhdrseq=$data['plhdrseq']; 
		$pl_idpl=$data['pl_idpl']; 
		$plhdrsdk=$data['plhdrsdk']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Simpan"; 
		$judul="Update data plhdr"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#plhdr").focus();  
  
 $("input").not($(":submit")).keypress(function (evt) {  
              if (evt.keyCode == 13) {  
                  iname = $(this).val();  
                  if (iname !== 'Submit') {  
                      var fields = $(this).parents('form:eq(0),body').find('button, input, textarea, select');  
                      var index = fields.index(this);  
                      if (index > -1 && (index + 1) < fields.length) {  
                          fields.eq(index + 1).focus();  
                      }  
                      return false;  
                  }  
              }  
          });  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "idplhdr"){ 
      dataString = 'idplhdr='+ cari;  
   } 
   else if (combo == "plhdrname"){ 
      dataString = 'plhdrname='+ cari; 
    } 
   else if (combo == "plhdrseq"){ 
      dataString = 'plhdrseq='+ cari; 
    } 
   else if (combo == "pl_idpl"){ 
      dataString = 'pl_idpl='+ cari; 
    } 
   else if (combo == "plhdrsdk"){ 
      dataString = 'plhdrsdk='+ cari; 
    } 
 
    $.ajax({ 
      url: "plhdr_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#plhdr_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data plhdr ini?")){ 
    		$.ajax({ 
        	url: "plhdr_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 2) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil diupdate!"); 
              loadData(); //reload list data 
          		$("#divPageEntry").load("plhdr_form.php");   
              $("#divPageEntry").hide(); 
            } 
          else if(response.status == 1) { 
          	  alert("Data Baru berhasil disimpan!"); 
              loadData(); //reload list data 
         //   window.location="plhdr_detail.php?id="+$("input#idslshdr").val(); 
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
  
		page3="plhdr_display.php";  
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
<form method="post" name="plhdr_form" action="" id="plhdr_form">  
<p class="judul">Form Memasukkan / Edit Data plhdr</p>  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">Id</td><td><input type="text" id="idplhdr" name="idplhdr" size="10" <? echo $readonly;?> value="<? echo $idplhdr;?>" /></td> 
</tr> 
<?php } else {?> 
<tr><td class="right">Id</td><td><input type="text" id="idplhdr" name="idplhdr" size="10" value="<? echo $idplhdr;?>" /></td> 
</tr> 
<?php }?> 
<input type="text" id="pl_idpl" name="pl_idpl" size="30" maxlength="25" value="<? echo $pl_idpl;?>" />
<tr> 
<td class="right">Keterangan</td> 
<td><input type="text" id="plhdrname" name="plhdrname" size="30" maxlength="25" value="<? echo $plhdrname;?>" /></td> 
</tr> 
<tr> 
<td class="right">plhdrseq</td> 
<td><input type="text" id="plhdrseq" name="plhdrseq" size="30" maxlength="25" value="<? echo $plhdrseq;?>" /></td> 
</tr> 

<tr> 
<td class="right">Debet/Kredit</td> 
<td><input type="text" id="plhdrsdk" name="plhdrsdk" size="30" maxlength="25" value="<? echo $plhdrsdk;?>" /></td> 
</tr> 
<tr> 
<td ><input class="button" type="submit" value="<? echo $status;?>"></td> 
<td ><input class="button" type="button" id="btnclose" value="Tutup Form"></td>  
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
