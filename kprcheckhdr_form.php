  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data kprcheckhdr"; 
	$status="Simpan"; 
   
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from kprcheckhdr where idkprcheckhdr = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idkprcheckhdr=$data['idkprcheckhdr']; 
		$startdate=$data['startdate']; 
		$bankname=$data['bankname']; 
		$notaris=$data['notaris']; 
		$unit_idunit=$data['unit_idunit']; 
		$emp_am=$data['emp_am']; 
		$emp_kpr=$data['emp_kpr']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Simpan"; 
		$judul="Update data kprcheckhdr"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#kprcheckhdr").focus();  
  
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
	   
	  if (combo == "idkprcheckhdr"){ 
      dataString = 'idkprcheckhdr='+ cari;  
   } 
   else if (combo == "startdate"){ 
      dataString = 'startdate='+ cari; 
    } 
   else if (combo == "bankname"){ 
      dataString = 'bankname='+ cari; 
    } 
   else if (combo == "notaris"){ 
      dataString = 'notaris='+ cari; 
    } 
   else if (combo == "unit_idunit"){ 
      dataString = 'unit_idunit='+ cari; 
    } 
   else if (combo == "emp_am"){ 
      dataString = 'emp_am='+ cari; 
    } 
   else if (combo == "emp_kpr"){ 
      dataString = 'emp_kpr='+ cari; 
    } 
 
    $.ajax({ 
      url: "kprcheckhdr_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#kprcheckhdr_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data kprcheckhdr ini?")){ 
    		$.ajax({ 
        	url: "kprcheckhdr_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 2) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil diupdate!"); 
              loadData(); //reload list data 
          		$("#divPageEntry").load("kprcheckhdr_form.php");   
              $("#divPageEntry").hide(); 
            } 
          else if(response.status == 1) { 
          	  alert("Data Baru berhasil disimpan!"); 
              loadData(); //reload list data 
         //   window.location="kprcheckhdr_detail.php?id="+$("input#idslshdr").val(); 
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
  
		page3="kprcheckhdr_display.php";  
		$("#divPageData").load(page3);  
		$("#divPageData").show();  
		return false;  
	});  

$("#btnlovunit").click(function(){  
		page3="kprcheckhdr_unitlov.php?idsektor="+$("select#idsektor").val();  
		$("#divLOV").load(page3);  
		$("#divLOV").show();  
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
<form method="post" name="kprcheckhdr_form" action="" id="kprcheckhdr_form">  
<p class="judul">Form Memasukkan / Edit Data kprcheckhdr</p>  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">idkprcheckhdr</td><td><input type="text" id="idkprcheckhdr" name="idkprcheckhdr" size="10" <? echo $readonly;?> value="<? echo $idkprcheckhdr;?>" /></td> 
</tr> 
<?php } ?> 
<tr> 
<td class="right">startdate</td> 
<td><input type="text" id="startdate" name="startdate" size="30" maxlength="25" value="<? echo $startdate;?>" /></td> 
</tr> 
<tr> 
<td class="right">bankname</td> 
<td><input type="text" id="bankname" name="bankname" size="30" maxlength="25" value="<? echo $bankname;?>" /></td> 
</tr> 
<tr> 
<td class="right">notaris</td> 
<td><input type="text" id="notaris" name="notaris" size="30" maxlength="25" value="<? echo $notaris;?>" /></td> 
</tr> 
<tr> 
<td class="right">unit_idunit</td> 
<td>
<input type="text" id="unit_idunit" name="unit_idunit" size="5" maxlength="25" value="<? echo $unit_idunit;?>" />
<input type="button" id="btnlovunit" name="btnlovunit" value="..." />
<input type="text" id="kavling" name="kavling" size="20" maxlength="25" value="<? echo $kavling;?>" />

</td> 
</tr> 
<tr> 
<td class="right">AM</td> 
<td><select id="emp_am" name="emp_am">
<? createempoption($emp_am); ?>"
</select> 
</td> 
</tr> 
<tr> 
<td class="right">Team KPRr</td> 
<td><select id="emp_kpr" name="emp_kpr">
<? createempoption($emp_kpr);?>" />
</select> </td> 
</tr> 
<tr> 
<td ><input class="button" type="submit" value="<? echo $status;?>"></td> 
<td ><input class="button" type="button" id="btnclose" value="Tutup Form"></td>  
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
