  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data"; 
	$status="Simpan"; 
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from prospekflow where idprospekflow = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idprospekflow=$data['idprospekflow']; 
		$prospekflow=$data['prospekflow']; 
		$dateflow=$data['dateflow']; 
		$prospek_idprospek=$data['prospek_idprospek']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Simpan"; 
		$judul="Edit Data"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#prospekflow").focus();  
  
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
	   
	  if (combo == "idprospekflow"){ 
      dataString = 'idprospekflow='+ cari;  
   } 
   else if (combo == "prospekflow"){ 
      dataString = 'prospekflow='+ cari; 
    } 
   else if (combo == "dateflow"){ 
      dataString = 'dateflow='+ cari; 
    } 
   else if (combo == "prospek_idprospek"){ 
      dataString = 'prospek_idprospek='+ cari; 
    } 
 
    $.ajax({ 
      url: "prospekflow_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#prospekflow_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data prospekflow ini?")){ 
    		$.ajax({ 
        	url: "prospekflow_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 2) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil diupdate!"); 
              loadData(); //reload list data 
          		$("#divPageEntry").load("prospekflow_form.php");   
              $("#divPageEntry").hide(); 
            } 
          else if(response.status == 1) { 
          	  alert("Data Baru berhasil disimpan!"); 
              loadData(); //reload list data 
         //   window.location="prospekflow_detail.php?id="+$("input#idslshdr").val(); 
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
  
		page3="prospekflow_display.php";  
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
				jQuery('input[name=rcv_date]').datepicker({changeYear:true, changeMonth:true, yearRange:"1990:2025",dateFormat: "dd-mm-yy"});
			})			
</script>	 
<form method="post" name="prospekflow_form" action="" id="prospekflow_form">  
<p class="judul">Form Memasukkan / Edit Data prospekflow</p>  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">idprospekflow</td><td><input type="text" id="idprospekflow" name="idprospekflow" size="10" <? echo $readonly;?> value="<? echo $idprospekflow;?>" /></td> 
</tr> 
<?php } else {?> 
<tr><td class="right">idprospekflow</td><td><input type="text" id="idprospekflow" name="idprospekflow" size="10" value="<? echo $idprospekflow;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td class="right">prospekflow</td> 
<td><input type="text" id="prospekflow" name="prospekflow" size="30" maxlength="45" value="<? echo $prospekflow;?>" /></td> 
</tr> 
<tr> 
<td class="right">dateflow</td> 
<td><input type="text" id="dateflow" name="dateflow" size="30" maxlength="45" value="<? echo $dateflow;?>" /></td> 
</tr> 
<tr> 
<td class="right">prospek_idprospek</td> 
<td><input type="text" id="prospek_idprospek" name="prospek_idprospek" size="30" maxlength="45" value="<? echo $prospek_idprospek;?>" /></td> 
</tr> 
<tr> 
<td ><input class="button" type="submit" value="<? echo $status;?>"></td> 
<td ><input class="button" type="button" id="btnclose" value="Tutup Form"></td>  
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
