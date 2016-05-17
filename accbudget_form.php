  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data accbudget"; 
	$status="Simpan"; 
  
   $tahun = date('Y');
   $bulan = date('m');
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from accbudget where idaccbudget = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idaccbudget=$data['idaccbudget']; 
		$tahun=$data['tahun']; 
		$bulan=$data['bulan']; 
		$budget=$data['budget']; 
		$acc_idacc=$data['acc_idacc']; 
		$saldoawal=$data['saldoawal']; 
		$saldo=$data['saldo']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Simpan"; 
		$judul="Update data accbudget"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#accbudget").focus();  
  
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
	   
	  if (combo == "idaccbudget"){ 
      dataString = 'idaccbudget='+ cari;  
   } 
   else if (combo == "tahun"){ 
      dataString = 'tahun='+ cari; 
    } 
   else if (combo == "bulan"){ 
      dataString = 'bulan='+ cari; 
    } 
   else if (combo == "budget"){ 
      dataString = 'budget='+ cari; 
    } 
   else if (combo == "acc_idacc"){ 
      dataString = 'acc_idacc='+ cari; 
    } 
   else if (combo == "saldoawal"){ 
      dataString = 'saldoawal='+ cari; 
    } 
   else if (combo == "saldo"){ 
      dataString = 'saldo='+ cari; 
    } 
 
    $.ajax({ 
      url: "accbudget_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#accbudget_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data accbudget ini?")){ 
    		$.ajax({ 
        	url: "accbudget_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 2) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil diupdate!"); 
              loadData(); //reload list data 
          		$("#divPageEntry").load("accbudget_form.php");   
              $("#divPageEntry").hide(); 
            } 
          else if(response.status == 1) { 
          	  alert("Data Baru berhasil disimpan!"); 
              loadData(); //reload list data 
              	$("#divLOV").hide(); 
         //   window.location="accbudget_detail.php?id="+$("input#idslshdr").val(); 
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
  
		page3="accbudget_display.php";  
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
<form method="post" name="accbudget_form" action="" id="accbudget_form">  
<p class="judul">Form Memasukkan / Edit Data Saldo Account</p>  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">idaccbudget</td><td><input type="text" id="idaccbudget" name="idaccbudget" size="10" <? echo $readonly;?> value="<? echo $idaccbudget;?>" /></td> 
</tr> 
<?php }?> 

<input type="hidden" id="company_idcompany" name="company_idcompany" size="10" maxlength="25" value="<? echo $company_idcompany;?>" />


<tr> 
<td class="right">tahun</td> 
<td><input type="text" id="tahun" name="tahun" size="10" maxlength="25" value="<? echo $tahun;?>" /></td> 
</tr> 
<tr> 
<td class="right">bulan</td> 
<td><select id="bulan" name="bulan">
 <? createbulanoption($bulan);?>
</select></td> 
</tr> 
<tr> 
<td class="right">acc_idacc</td> 
<td>
<input type="text" id="acc_idacc" name="acc_idacc" size="5" maxlength="25" value="<? echo $acc_idacc;?>" />
<input type="text" id="accname" name="accname" size="30" maxlength="25" value="<? echo $accname;?>" />
</td> 
</tr> 

<tr> 
<td class="right">budget</td> 
<td><input  class="right" type="text" id="budget" name="budget" size="10" maxlength="25" value="<? echo $budget;?>" /></td> 
</tr> 
<tr> 
<td class="right">saldoawal</td> 
<td><input  class="right" type="text" id="saldoawal" name="saldoawal" size="10" maxlength="25" value="<? echo $saldoawal;?>" /></td> 
</tr> 
<tr> 
<td class="right">saldo</td> 
<td><input  class="right" type="text" id="saldo" name="saldo" size="10" maxlength="25" value="<? echo $saldo;?>" /></td> 
</tr> 
<tr> 
<td ><input class="button" type="submit" value="<? echo $status;?>"></td> 
<td ><input class="button" type="button" id="btnclose" value="Tutup Form"></td>  
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
