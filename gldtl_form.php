  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data gldtl"; 
	$status="Simpan"; 
   $sql = "SELECT IFNULL(max(CAST(idgldtl AS UNSIGNED)),0)+1  FROM gldtl";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idgldtl = $data[0];	 
   $glhdr_idglhdr=$_GET['id']; 
   
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from gldtl where idgldtl = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idgldtl=$data['idgldtl']; 
		$glhdr_idglhdr=$data['glhdr_idglhdr']; 
		$dvalue=$data['dvalue']; 
		$kvalue=$data['kvalue']; 
		$acc_idacc=$data['acc_idacc']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Simpan"; 
		$judul="Update data gldtl"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#gldtl").focus();  
  
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
	
	 dataString = 'id='+ cari; 
   
    $.ajax({ 
      url: "gldtl_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#gldtl_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data gldtl ini?")){ 
    		$.ajax({ 
        	url: "gldtl_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 2) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil diupdate!"); 
              loadData(); //reload list data 
          		$("#divPageEntry").load("gldtl_form.php");   
              $("#divPageEntry").hide(); 
            } 
          else if(response.status == 1) { 
          	  alert("Data Baru berhasil disimpan!"); 
              loadData(); //reload list data 
         //   window.location="gldtl_detail.php?id="+$("input#idslshdr").val(); 
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
  
		page3="gldtl_display.php";  
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
<form method="post" name="gldtl_form" action="" id="gldtl_form">  
<p class="judul">Form Memasukkan / Edit Jurnal Detail</p>  
<table width="450px"> 
<tr><th colspan="5"><b><?php echo $judul; ?></b></th></tr> 
<input type="hidden" id="idgldtl" name="idgldtl" size="10" value="<? echo $idgldtl;?>" /></td> 
<input type="hidden" id="glhdr_idglhdr" name="glhdr_idglhdr" size="30" maxlength="25" value="<? echo $glhdr_idglhdr;?>" />
<tr>
<td >No Acc</td> 
<td >Nama Account</td> 
<td >Debet</td> 
<td >Kredit</td> 
<td >Aksi</td> 
</tr>

<tr> 
<td><input type="text" id="acc_idacc" name="acc_idacc" size="5" maxlength="25" value="<? echo $acc_idacc;?>" /></td>
<td><input type="text" id="accname" name="accname" size="15" maxlength="25" value="<? echo $accname;?>"/></td> 
<td><input class="right" type="text" id="dvalue" name="dvalue" size="5" maxlength="25" value="<? echo $dvalue;?>" /></td> 
<td><input class="right" type="text" id="kvalue" name="kvalue" size="5" maxlength="25" value="<? echo $kvalue;?>" /></td> 
<td ><input class="button" type="submit" value="<? echo $status;?>"></td> 
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
