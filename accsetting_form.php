  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data accsetting"; 
	$status="Simpan"; 
   $sql = "SELECT IFNULL(max(CAST(idaccsetting AS UNSIGNED)),0)+1  FROM accsetting";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idaccsetting = $data[0];	 
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from accsetting where idaccsetting = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idaccsetting=$data['idaccsetting']; 
		$app=$data['app']; 
		$dacc_idacc=$data['dacc_idacc']; 
		$kacc_idacc=$data['kacc_idacc']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Simpan"; 
		$judul="Update data accsetting"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#accsetting").focus();  
  
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
	   
	  if (combo == "idaccsetting"){ 
      dataString = 'idaccsetting='+ cari;  
   } 
   else if (combo == "app"){ 
      dataString = 'app='+ cari; 
    } 
   else if (combo == "dacc_idacc"){ 
      dataString = 'dacc_idacc='+ cari; 
    } 
   else if (combo == "kacc_idacc"){ 
      dataString = 'kacc_idacc='+ cari; 
    } 
 
    $.ajax({ 
      url: "accsetting_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#accsetting_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data accsetting ini?")){ 
    		$.ajax({ 
        	url: "accsetting_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 2) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil diupdate!"); 
              loadData(); //reload list data 
          		$("#divPageEntry").load("accsetting_form.php");   
              $("#divPageEntry").hide(); 
            } 
          else if(response.status == 1) { 
          	  alert("Data Baru berhasil disimpan!"); 
              loadData(); //reload list data 
         //   window.location="accsetting_detail.php?id="+$("input#idslshdr").val(); 
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
  
		page3="accsetting_display.php";  
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
<form method="post" name="accsetting_form" action="" id="accsetting_form">  
<p class="judul">Form Memasukkan / Edit Data accsetting</p>  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<tr>
<td class="right">Proses</td>
<td>
<select id="idaccsetting" name="idaccsetting">
<?    echo "<option value='101'"; if ($idaccsetting == '101') echo "selected"; echo ">&nbsp;Booking Fee&nbsp; </option>";
	    echo "<option value='102'"; if ($idaccsetting == '102') echo "selected"; echo ">&nbsp;Pembayaran A&nbsp; </option>";
	    echo "<option value='103'"; if ($idaccsetting == '103') echo "selected"; echo ">&nbsp;B&nbsp; </option>";
	    echo "<option value='104'"; if ($idaccsetting == '104') echo "selected"; echo ">&nbsp;AB&nbsp; </option>";
?>
</select> 
</td> 
</tr> 

<tr> 
<td class="right">app</td> 
<td><input type="text" id="app" name="app" size="30" maxlength="25" value="<? echo $app;?>" /></td> 
</tr> 
<tr> 
<td class="right">dacc_idacc</td> 
<td><input type="text" id="dacc_idacc" name="dacc_idacc" size="30" maxlength="25" value="<? echo $dacc_idacc;?>" /></td> 
</tr> 
<tr> 
<td class="right">kacc_idacc</td> 
<td><input type="text" id="kacc_idacc" name="kacc_idacc" size="30" maxlength="25" value="<? echo $kacc_idacc;?>" /></td> 
</tr> 
<tr> 
<td ><input class="button" type="submit" value="<? echo $status;?>"></td> 
<td ><input class="button" type="button" id="btnclose" value="Tutup Form"></td>  
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
