  <?  
  include_once("config.php"); 
   $unit_idunit=$_GET['idunit'];
	$action="add"; 
	$judul="Penambahan Data unit_materialbudget"; 
	$status="Tambah"; 
   $sql = "SELECT IFNULL(max(idbudget),0)+1  FROM unit_materialbudget";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idbudget = $data[0];	 
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from unit_materialbudget where idbudget = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idbudget=$data['idbudget']; 
		$budget_qty=$data['budget_qty']; 
		$progress_qty=$data['progress_qty']; 
		$unit_idunit=$data['unit_idunit']; 
		$product_idproduct=$data['product_idproduct']; 
		$price=$data['price']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data unit_materialbudget"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#unit_materialbudget").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "idbudget"){ 
      dataString = 'idbudget='+ cari;  
   } 
   else if (combo == "budget_qty"){ 
      dataString = 'budget_qty='+ cari; 
    } 
   else if (combo == "progress_qty"){ 
      dataString = 'progress_qty='+ cari; 
    } 
   else if (combo == "unit_idunit"){ 
      dataString = 'unit_idunit='+ cari; 
    } 
   else if (combo == "product_idproduct"){ 
      dataString = 'product_idproduct='+ cari; 
    } 
   else if (combo == "price"){ 
      dataString = 'price='+ cari; 
    } 
 
    $.ajax({ 
      url: "unit_materialbudget_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#unit_materialbudget_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data unit_materialbudget ini?")){ 
    		$.ajax({ 
        	url: "unit_materialbudget_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 2) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil diupdate!"); 
              loadData(); //reload list data 
          		$("#divPageEntry").load("unit_materialbudget_form.php");   
              $("#divPageEntry").hide(); 
            } 
          else if(response.status == 1) { 
          	  alert("Data Baru berhasil disimpan!"); 
          	page="unit_materialbudget_displaymini.php?idunit="+$("input#idunit").val(); 
		$("#divPageData").load(page); 
		$("#divPageData").show(); 
		
		
		page1="unit_materialbudget_form.php?idunit="+$("input#idunit").val(); 
		$("#divPageEntry").load(page1); 
		$("#divPageEntry").show(); 
		
		
		return false;
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
  
		page3="unit_materialbudget_display.php";  
		$("#divPageData").load(page3);  
		$("#divPageData").show();  
		return false;  
	});  
 }); 
 </script> 
<form method="post" name="unit_materialbudget_form" action="" id="unit_materialbudget_form">  
<table width="95%"> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<input type="hidden" id="idbudget" name="idbudget" size="10" value="<? echo $idbudget;?>" /> 
<tr> 
<td class="right">Nama Barang</td> 
<td>
<input type="text" id="product_idproduct" name="product_idproduct" size="5" maxlength="25" value="<? echo $product_idproduct;?>" />
<input type="text" id="productname" name="productname" size="25" maxlength="25" value="<? echo $productname;?>" />
</td> 
</tr> 
<tr> 
<td class="right">Harga</td> 
<td><input type="text" id="price" name="price" size="10" maxlength="25" value="<? echo $price;?>" /></td> 
</tr> 
<tr> 
<td class="right">Budget</td> 
<td><input type="text" id="budget_qty" name="budget_qty" size="10" maxlength="25" value="<? echo $budget_qty;?>" /></td> 
</tr> 
 
<input type="hidden" id="unit_idunit" name="unit_idunit" size="30" maxlength="25" value="<? echo $unit_idunit;?>" /> 
<tr> 
<td ><input class="button" type="submit" value="<? echo $status;?>"></td> 
<td ><input class="button" type="button" id="btnclose" value="Tutup Form"></td>  
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
