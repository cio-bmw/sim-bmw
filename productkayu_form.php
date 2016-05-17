  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data product"; 
	$status="Tambah"; 
	 
	 $sql = "SELECT IFNULL(max(CAST(idproduct AS UNSIGNED)),0)+1 id  FROM productkayu";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idproduct = $data[0];	 	
   
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from productkayu where idproduct = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idproduct=$data['idproduct']; 
		$productname=$data['productname']; 
		$uom_iduom=$data['uom_iduom']; 
		$category_idcat=$data['category_idcat']; 
		$supplier_idsupp=$data['supplier_idsupp']; 
		$location_idlocation=$data['location_idlocation']; 
		$salesprice=nf($data['salesprice']); 
		$costprice=nf($data['costprice']); 
		$stock=nf($data['stock']); 
		$stockwh=$data['stockwh']; 
		$limitstock=nf($data['limitstock']); 
		$limitstockwh=$data['limitstockwh']; 
		$status=$data['status']; 
		$active=$data['active']; 
		$boxqty=$data['boxqty']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data Master Kayu"; 
		
		
	} 
	$supplier=supplierinfo($supplier_idsupp);
		$suppname = $supplier['suppname'];
		$uom = uominfo($uom_iduom);
		$uomname = $uom['uomname'];
      $category = categoryinfo($category_idcat);
      $catname = $category['catname'];		
		
	
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#product").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "idproduct"){ 
      dataString = 'idproduct='+ cari;  
   } 
   else if (combo == "productname"){ 
      dataString = 'productname='+ cari; 
    } 
   else if (combo == "uom_iduom"){ 
      dataString = 'uom_iduom='+ cari; 
    } 
   else if (combo == "category_idcat"){ 
      dataString = 'category_idcat='+ cari; 
    } 
   else if (combo == "supplier_idsupp"){ 
      dataString = 'supplier_idsupp='+ cari; 
    } 
   else if (combo == "location_idlocation"){ 
      dataString = 'location_idlocation='+ cari; 
    } 
   else if (combo == "salesprice"){ 
      dataString = 'salesprice='+ cari; 
    } 
   else if (combo == "costprice"){ 
      dataString = 'costprice='+ cari; 
    } 
   else if (combo == "stock"){ 
      dataString = 'stock='+ cari; 
    } 
   else if (combo == "stockwh"){ 
      dataString = 'stockwh='+ cari; 
    } 
   else if (combo == "limitstock"){ 
      dataString = 'limitstock='+ cari; 
    } 
   else if (combo == "limitstockwh"){ 
      dataString = 'limitstockwh='+ cari; 
    } 
   else if (combo == "status"){ 
      dataString = 'status='+ cari; 
    } 
   else if (combo == "active"){ 
      dataString = 'active='+ cari; 
    } 
   else if (combo == "boxqty"){ 
      dataString = 'boxqty='+ cari; 
    } 
 
    $.ajax({ 
      url: "productkayu_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#productkayu_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan update data product ini?")){ 
    //     var vkode = $("input#idproduct").val(); //mengambil id dari input 
   //   var vAlamat = $("textarea#alamat").val(); 
   //   var vNoHP = $("input#nohp").val(); 
   //   var myRegExp=/^\+62[0-9]+$/; 
   //    
      // cek validasi form dahulu, semua field data harus diisi 
  //  if ((vkode.replace(/\s/g,"") == "") || (vAlamat.replace(/\s/g,"") == "") || (vNoHP.replace(/\s/g,"") == "")) { 
  //    alert("Kode Barang Tidak Boleh Kosong! Check box untuk menggunakan Kode Otomatis"); 
  //  $("input#idproduct").focus(); 
  //    return false; 
  //   } 
   
   //   // cek validasi no handphone 
   //   else if (!myRegExp.test(vNoHP)){ 
   //     alert ('No handphone harus angka dan diawali +62 (contoh: +62818040567890)'); 
   //     $("input#nohp").focus(); 
   //    return false; 
   //   } 
   //   else{   
    		$.ajax({ 
        	url: "productkayu_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 1) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil disimpan!"); 
                loadData(); //reload list data 
          		$("#divFormContent").load("product_form.php");   
              $("#divFormContent").hide(); 
              $("#btnhide").hide(); 
            } 
          	else 
          	{ 
          		alert("Data gagal di simpan!"); 
           	} 
        	} 
         }); 
        	} 
     	
    return false; 
   }); 
 }); 
 
$("#btnlovuom").click(function(){ 
 	pagelov="uom_lov.php"; 
		$("#divLOV").load(pagelov); 
		$("#divLOV").show(); 
		return false;
	}); 
	
$("#btnlovcat").click(function(){ 
	pagelov="category_lov.php"; 
		$("#divLOV").load(pagelov); 
		$("#divLOV").show(); 
		return false; 
	}); 
$("#btnlovsupp").click(function(){ 
   	pagelov="supplier_lov.php"; 
		$("#divLOV").load(pagelov); 
		$("#divLOV").show(); 
		return false; 
	}); 

function kodeotomatis() {
var vidproduct = $("input#productname");
document.document.getElementById('idproduct').value=vidproduct;
}


 
 </script> 
<form method="post" name="productkayu_form" action="" id="productkayu_form">  
<p class="judul">Memasukkan Data Master Kayu</p>
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">Kode Barang</td><td><input type="text" id="idproduct" name="idproduct" size="10" <? echo $readonly;?> value="<? echo $idproduct;?>" />
</td> 
</tr> 
<?php } else {?> 
<tr><td class="right">Kode Barang</td><td><input type="text" id="idproduct" name="idproduct" size="10" value="<? echo $idproduct;?>" />
</td> 
</tr> 
<?php }?> 
<tr> 
<td class="right">Nama Barang</td> 
<td><input type="text" id="productname" name="productname" size="30" maxlength="50" value="<? echo $productname;?> "/></td> 
</tr> 
<tr> 
<td class="right">Satuan</td> 
<td>
<input type="text" id="uom_iduom" name="uom_iduom" size="2" maxlength="25" value="<? echo $uom_iduom;?>" />
<input type="button" class="button" id="btnlovuom" value="...">
<input type="text" id="uomname" name="uomname" size="15" maxlength="15" value="<? echo $uomname;?>" readonly/>
</td> 
</tr> 
<tr> 
<td class="right">Kategori</td> 
<td>
<input type="text" id="category_idcat" name="category_idcat" size="2" maxlength="25" value="<? echo $category_idcat;?>" />
<input type="button" class="button" id="btnlovcat" value="...">
<input type="text" id="catname" name="catname" size="15" maxlength="15" value="<? echo $catname;?>" readonly/>
</td> 
</tr> 
<tr> 
<td class="right">Supplier</td> 
<td>
<input type="text" id="supplier_idsupp" name="supplier_idsupp" size="2" maxlength="25" value="<? echo $supplier_idsupp;?>" />
<input type="button" class="button" id="btnlovsupp" value="...">
<input type="text" id="suppname" name="suppname" size="15" maxlength="15" value="<? echo $suppname;?>" readonly/>
</td>
</tr> 

<tr> 
<td class="right">Harga Jual</td> 
<td><input class="right" type="text" id="salesprice" name="salesprice" size="10" maxlength="25" value="<? echo $salesprice;?>" /></td> 
</tr> 
<tr> 
<td class="right">Harga Beli</td> 
<td><input class="right"  type="text" id="costprice" name="costprice" size="10" maxlength="25" value="<? echo $costprice;?>" /></td> 
</tr> 
<tr> 
<td class="right">Stok</td> 
<td><input class="right"  type="text" id="stock" name="stock" size="10" maxlength="10" value="<? echo $stock;?>" /></td> 
</tr> 
<tr> 
<td class="right">Minimum Stok</td> 
<td><input class="right"  type="text" id="limitstock" name="limitstock" size="10" maxlength="25" value="<? echo $limitstock;?>" /></td> 
</tr> 

<tr> 
<td colspan="2"><input class="button" type="submit" value="<? echo $status;?>"</td> 
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
