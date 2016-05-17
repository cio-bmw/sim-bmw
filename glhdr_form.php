  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data glhdr"; 
	$status="Simpan"; 
   $sql = "SELECT IFNULL(max(CAST(idglhdr AS UNSIGNED)),0)+1  FROM glhdr";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idglhdr = $data[0];	 
   $gl_date = date('d-m-Y');
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from glhdr where idglhdr = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idglhdr=$data['idglhdr']; 
		$gl_date=gettanggal($data['gl_date']); 
		$gl_desc=$data['gl_desc']; 
		$gl_refno=$data['gl_refno']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Simpan"; 
		$judul="Update data glhdr"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#glhdr").focus();  
  
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
	   
	  if (combo == "idglhdr"){ 
      dataString = 'idglhdr='+ cari;  
   } 
   else if (combo == "gl_date"){ 
      dataString = 'gl_date='+ cari; 
    } 
   else if (combo == "gl_desc"){ 
      dataString = 'gl_desc='+ cari; 
    } 
   else if (combo == "gl_refno"){ 
      dataString = 'gl_refno='+ cari; 
    } 
 
    $.ajax({ 
      url: "glhdr_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#glhdr_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data glhdr ini?")){ 
    		$.ajax({ 
        	url: "glhdr_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 2) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil diupdate!"); 
              loadData(); //reload list data 
          		$("#divPageEntry").load("glhdr_form.php");   
              $("#divPageEntry").hide(); 
            } 
          else if(response.status == 1) { 
          	  alert("Data Baru berhasil disimpan!"); 
              loadData(); //reload list data 
            window.location="glhdr_detail.php?id="+$("input#idglhdr").val(); 
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
  
		page3="glhdr_display.php";  
		$("#divPageData").load(page3);  
		$("#divPageData").show();  
		return false;  
	});  
 }); 
 </script> 
<script type="text/javascript" language="javascript">
			jQuery(function(){
				jQuery('input[name=gl_date]').datepicker({changeYear:true, changeMonth:true, yearRange:"1990:2025",dateFormat: "dd-mm-yy"});
			})			
</script>	 
<form method="post" name="glhdr_form" action="" id="glhdr_form">  
<p class="judul">Form Memasukkan / Edit Jurnal</p>  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">No Dok</td><td><input type="text" id="idglhdr" name="idglhdr" size="10" <? echo $readonly;?> value="<? echo $idglhdr;?>" /></td> 
</tr> 
<?php } else {?> 
<tr><td class="right">No Dok</td><td><input type="text" id="idglhdr" name="idglhdr" size="10" value="<? echo $idglhdr;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td class="right">Tanggal</td> 
<td><input type="text" id="gl_date" name="gl_date" size="10" maxlength="25" value="<? echo $gl_date;?>" /></td> 
</tr> 
<tr> 
<td class="right">Keterangan</td> 
<td><input type="text" id="gl_desc" name="gl_desc" size="30" maxlength="25" value="<? echo $gl_desc;?>" /></td> 
</tr> 
<tr> 
<td class="right">No Ref</td> 
<td><input type="text" id="gl_refno" name="gl_refno" size="30" maxlength="25" value="<? echo $gl_refno;?>" /></td> 
</tr> 
<tr> 
<td ><input class="button" type="submit" value="<? echo $status;?>"></td> 
<td ><input class="button" type="button" id="btnclose" value="Tutup Form"></td>  
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
