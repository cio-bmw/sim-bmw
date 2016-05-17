  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data Barang"; 
	$status="Tambah"; 
   $sql = "SELECT IFNULL(max(idslsdtl),0)+1  FROM slsdtlunit";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idslsdtl = $data[0];	 
    
  	$slshdrunit_idslshdr=$_GET['id'];
   $product_idproduct=$_GET['product']; 	
  
   $qty =1;
     
   
   
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from slsdtlunit where idslsdtl = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idslsdtl=$data['idslsdtl']; 
		$cost_price=$data['cost_price']; 
		$qty=$data['qty']; 
		$sales_price=$data['sales_price']; 
		$slshdrunit_idslshdr=$data['slshdrunit_idslshdr']; 
		$product_idproduct=$data['product_idproduct']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data slsdtlunit"; 
	} 
	 $product = productinfo( $product_idproduct);
   $productname=$product['productname'];
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#product_idproduct").focus();  
  
  function loadData(){ 
	  var dataString; 
    var vidslshdr = $("input#idslshdr").val(); 
      dataString = 'id='+vidslshdr; 
   
 
    $.ajax({ 
      url: "slsdtlunit_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#slsdtlunit_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data slsdtlunit ini?")){ 
    var vproduct = $("input#product_idproduct").val(); 
    
      if (vproduct == "") { 
        alert("Kode Barang tidak boleh kosong !"); 
        $("input#product_idproduct").focus(); 
        return false; 
      } 
   //   // cek validasi no handphone 
   //   else if (!myRegExp.test(vNoHP)){ 
   //     alert ('No handphone harus angka dan diawali +62 (contoh: +62818040567890)'); 
   //     $("input#nohp").focus(); 
   //    return false; 
   //   } 
   //   else{   
    		$.ajax({ 
        	url: "slsdtlunit_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 1) // return nilai dari hasil proses 
          	{  
          	//  alert("Data berhasil disimpan!"); 
            
    page="slsdtlunit_form.php?id="+$("input#idslshdr").val();
		$("#divPageEntry").load(page); 
		$("#divPageEntry").show(); 
		
		page1="slsdtlunit_displaymini.php?id="+$("input#idslshdr").val();
		$("#divPageData").load(page1); 
		$("#divPageData").show(); 

		page2="slsdtlunit_dspproduct.php?id="+$("input#idslshdr").val()+"&sektor="+$("input#idsektor").val(); 
		$("#divLOV").load(page2); 
		$("#divLOV").show(); 


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
 }); 
 </script> 
<form method="post" name="slsdtlunit_form" action="" id="slsdtlunit_form">  
<table width="490px"> 
<tr><th colspan="5" name="judul" id="judul"><b><?php echo $judul; ?></b></th></tr> 
<tr>
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<td><input type="hidden" id="idslsdtl" name="idslsdtl" size="5" <? echo $readonly;?> value="<? echo $idslsdtl;?>" /></td> 
<?php } else {?> 
<td><input type="hidden" id="idslsdtl" name="idslsdtl" size="5" value="<? echo $idslsdtl;?>" /></td> 
<?php }?> 
</td> 
<td><input type="text" id="product_idproduct" name="product_idproduct" size="3" maxlength="25" value="<? echo $product_idproduct;?>" /></td> 
<td><input type="text" id="productname" name="productname" size="20" maxlength="45" value="<? echo $productname;?>"  readonly/></td> 
<td><input type="text" id="qty" name="qty" size="3" maxlength="25" value="<? echo $qty;?>" /></td> 
<td><input class="button" type="submit" value="<? echo $status;?>"</td> 
</tr> 

<input type="hidden" id="cost_price" name="cost_price" size="30" maxlength="25" value="<? echo $cost_price;?>" />
<input type="hidden" id="sales_price" name="sales_price" size="30" maxlength="25" value="<? echo $sales_price;?>" />
<input type="hidden" id="slshdrunit_idslshdr" name="slshdrunit_idslshdr" size="30" maxlength="25" value="<? echo $slshdrunit_idslshdr;?>" />
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</table> 
</form> 
