  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data"; 
	$status="Simpan"; 
   $sql = "SELECT IFNULL(max(CAST(idhistorypayment AS UNSIGNED)),0)+1  FROM historypayment";  
   $result = mysql_query($sql);  
  $data  = mysql_fetch_array($result);  
  $idhistorypayment = $data[0];	 
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from historypayment where idhistorypayment = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idhistorypayment=$data['idhistorypayment']; 
		$pay_date=$data['pay_date']; 
		$pay_value=$data['pay_value']; 
		$pay_name=$data['pay_name']; 
		$pay_note=$data['pay_note']; 
		$unitmstpayment_idpayment=$data['unitmstpayment_idpayment']; 
		$unithistory_idunithistory=$data['unithistory_idunithistory']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Simpan"; 
		$judul="Edit Data"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#historypayment").focus();  
  
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
	   
	  if (combo == "idhistorypayment"){ 
      dataString = 'idhistorypayment='+ cari;  
   } 
   else if (combo == "pay_date"){ 
      dataString = 'pay_date='+ cari; 
    } 
   else if (combo == "pay_value"){ 
      dataString = 'pay_value='+ cari; 
    } 
   else if (combo == "pay_name"){ 
      dataString = 'pay_name='+ cari; 
    } 
   else if (combo == "pay_note"){ 
      dataString = 'pay_note='+ cari; 
    } 
   else if (combo == "unitmstpayment_idpayment"){ 
      dataString = 'unitmstpayment_idpayment='+ cari; 
    } 
   else if (combo == "unithistory_idunithistory"){ 
      dataString = 'unithistory_idunithistory='+ cari; 
    } 
 
    $.ajax({ 
      url: "historypayment_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#historypayment_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data historypayment ini?")){ 
    		$.ajax({ 
        	url: "historypayment_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 2) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil diupdate!"); 
              loadData(); //reload list data 
          		$("#divPageEntry").load("historypayment_form.php");   
              $("#divPageEntry").hide(); 
            } 
          else if(response.status == 1) { 
          	  alert("Data Baru berhasil disimpan!"); 
              loadData(); //reload list data 
         //   window.location="historypayment_detail.php?id="+$("input#idslshdr").val(); 
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
  
		page3="historypayment_display.php";  
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
<form method="post" name="historypayment_form" action="" id="historypayment_form">  
<p class="judul">Form Memasukkan / Edit Data historypayment</p>  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">idhistorypayment</td><td><input type="text" id="idhistorypayment" name="idhistorypayment" size="10" <? echo $readonly;?> value="<? echo $idhistorypayment;?>" /></td> 
</tr> 
<?php } else {?> 
<tr><td class="right">idhistorypayment</td><td><input type="text" id="idhistorypayment" name="idhistorypayment" size="10" value="<? echo $idhistorypayment;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td class="right">pay_date</td> 
<td><input type="text" id="pay_date" name="pay_date" size="30" maxlength="45" value="<? echo $pay_date;?>" /></td> 
</tr> 
<tr> 
<td class="right">pay_value</td> 
<td><input type="text" id="pay_value" name="pay_value" size="30" maxlength="45" value="<? echo $pay_value;?>" /></td> 
</tr> 
<tr> 
<td class="right">pay_name</td> 
<td><input type="text" id="pay_name" name="pay_name" size="30" maxlength="45" value="<? echo $pay_name;?>" /></td> 
</tr> 
<tr> 
<td class="right">pay_note</td> 
<td><input type="text" id="pay_note" name="pay_note" size="30" maxlength="45" value="<? echo $pay_note;?>" /></td> 
</tr> 
<tr> 
<td class="right">unitmstpayment_idpayment</td> 
<td><input type="text" id="unitmstpayment_idpayment" name="unitmstpayment_idpayment" size="30" maxlength="45" value="<? echo $unitmstpayment_idpayment;?>" /></td> 
</tr> 
<tr> 
<td class="right">unithistory_idunithistory</td> 
<td><input type="text" id="unithistory_idunithistory" name="unithistory_idunithistory" size="30" maxlength="45" value="<? echo $unithistory_idunithistory;?>" /></td> 
</tr> 
<tr> 
<td ><input class="button" type="submit" value="<? echo $status;?>"></td> 
<td ><input class="button" type="button" id="btnclose" value="Tutup Form"></td>  
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
