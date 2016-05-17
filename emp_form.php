  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data emp"; 
	$status="Simpan"; 
   $sql = "SELECT IFNULL(max(CAST(idemp AS UNSIGNED)),0)+1  FROM emp";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idemp = $data[0];	 
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from emp where idemp = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idemp=$data['idemp']; 
		$empasswd=$data['empasswd']; 
		$empname=$data['empname']; 
		$empphone=$data['empphone']; 
		$gp=$data['gp']; 
		$gs=$data['gs']; 
		$mkt=$data['mkt']; 
		$tch=$data['tch']; 
		$acc=$data['acc']; 
		$kpr=$data['kpr']; 
		$adm=$data['adm']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Simpan"; 
		$judul="Update data emp"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#emp").focus();  
  
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
	   
	  if (combo == "idemp"){ 
      dataString = 'idemp='+ cari;  
   } 
   else if (combo == "empasswd"){ 
      dataString = 'empasswd='+ cari; 
    } 
   else if (combo == "empname"){ 
      dataString = 'empname='+ cari; 
    } 
   else if (combo == "empphone"){ 
      dataString = 'empphone='+ cari; 
    } 
   else if (combo == "gp"){ 
      dataString = 'gp='+ cari; 
    } 
   else if (combo == "gs"){ 
      dataString = 'gs='+ cari; 
    } 
   else if (combo == "mkt"){ 
      dataString = 'mkt='+ cari; 
    } 
   else if (combo == "tch"){ 
      dataString = 'tch='+ cari; 
    } 
   else if (combo == "acc"){ 
      dataString = 'acc='+ cari; 
    } 
   else if (combo == "kpr"){ 
      dataString = 'kpr='+ cari; 
    } 
   else if (combo == "adm"){ 
      dataString = 'adm='+ cari; 
    } 
 
    $.ajax({ 
      url: "emp_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#emp_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data emp ini?")){ 
    		$.ajax({ 
        	url: "emp_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 2) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil diupdate!"); 
              loadData(); //reload list data 
          		$("#divPageEntry").load("emp_form.php");   
              $("#divPageEntry").hide(); 
            } 
          else if(response.status == 1) { 
          	  alert("Data Baru berhasil disimpan!"); 
              loadData(); //reload list data 
         //   window.location="emp_detail.php?id="+$("input#idslshdr").val(); 
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
  
		page3="emp_display.php";  
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
<form method="post" name="emp_form" action="" id="emp_form">  
<p class="judul">Form Memasukkan / Edit Data emp</p>  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">idemp</td><td><input type="text" id="idemp" name="idemp" size="10" <? echo $readonly;?> value="<? echo $idemp;?>" /></td> 
</tr> 
<?php } else {?> 
<tr><td class="right">idemp</td><td><input type="text" id="idemp" name="idemp" size="10" value="<? echo $idemp;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td class="right">empasswd</td> 
<td><input type="text" id="empasswd" name="empasswd" size="30" maxlength="25" value="<? echo $empasswd;?>" /></td> 
</tr> 
<tr> 
<td class="right">empname</td> 
<td><input type="text" id="empname" name="empname" size="30" maxlength="25" value="<? echo $empname;?>" /></td> 
</tr> 
<tr> 
<td class="right">empphone</td> 
<td><input type="text" id="empphone" name="empphone" size="30" maxlength="25" value="<? echo $empphone;?>" /></td> 
</tr> 
<tr> 
<td class="right">gp</td> 
<td><input type="text" id="gp" name="gp" size="30" maxlength="25" value="<? echo $gp;?>" /></td> 
</tr> 
<tr> 
<td class="right">gs</td> 
<td><input type="text" id="gs" name="gs" size="30" maxlength="25" value="<? echo $gs;?>" /></td> 
</tr> 
<tr> 
<td class="right">mkt</td> 
<td><input type="text" id="mkt" name="mkt" size="30" maxlength="25" value="<? echo $mkt;?>" /></td> 
</tr> 
<tr> 
<td class="right">tch</td> 
<td><input type="text" id="tch" name="tch" size="30" maxlength="25" value="<? echo $tch;?>" /></td> 
</tr> 
<tr> 
<td class="right">acc</td> 
<td><input type="text" id="acc" name="acc" size="30" maxlength="25" value="<? echo $acc;?>" /></td> 
</tr> 
<tr> 
<td class="right">kpr</td> 
<td><input type="text" id="kpr" name="kpr" size="30" maxlength="25" value="<? echo $kpr;?>" /></td> 
</tr> 
<tr> 
<td class="right">adm</td> 
<td><input type="text" id="adm" name="adm" size="30" maxlength="25" value="<? echo $adm;?>" /></td> 
</tr> 
<tr> 
<td ><input class="button" type="submit" value="<? echo $status;?>"></td> 
<td ><input class="button" type="button" id="btnclose" value="Tutup Form"></td>  
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
