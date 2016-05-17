  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data unit"; 
	$status="Tambah"; 
   $sql = "SELECT IFNULL(max(idunit),0)+1  FROM unit";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idunit = $data[0];	 
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from unit where idunit = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idunit=$data['idunit']; 
		$kavling=$data['kavling']; 
		$tipe=$data['tipe']; 
		$luastanah=$data['luastanah']; 
		$owner=$data['owner']; 
		$address=$data['address']; 
		$phone=$data['phone']; 
		$sp3=$data['sp3']; 
		$realisasi=$data['realisasi']; 
		$stk=$data['stk']; 
		$bangun=$data['bangun']; 
		$pjb=$data['pjb'];
		$sph=$data['sph'];
		$jual=$data['jual']; 
		$latestimg=$data['latestimg']; 
		$latestimg2=$data['latestimg2']; 
		$nkontrakuser=$data['nkontrakuser']; 
		$nkontrakcont=$data['nkontrakcont']; 
		$startbangun=gettanggal($data['startbangun']); 
		$endbangun=gettanggal($data['endbangun']); 
		$kpr_idkpr=$data['kpr_idkpr']; 
		$sektor_idsektor=$data['sektor_idsektor']; 
		$contractor_idcontractor=$data['contractor_idcontractor']; 
		$addlb = $data['addlb'];
		$addlbvalue = $data['addlbvalue'];
		$addlt = $data['addlt'];
		$addltvalue = $data['addltvalue'];
		$gambar =  $data['gambar'];
		$spk =  $data['spk'];
		$shg =  $data['shg'];
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update Data Unit"; 
		$tglduedate =  $data['tglduedate'];
		$carabayar = $data['carabayar'];
		$ntotal = $nkontrakuser + $addlbvalue + $addltvalue;
	} 
		$sektor =sektorinfo($data['sektor_idsektor']);
  		$sektorname = $sektor['sektorname'];
  		
  		$kpr = kprinfo($data['kpr_idkpr']);
  		$kprname = $kpr['kprname'];
  		
  		$contractor = contractorinfo($data['contractor_idcontractor']);
  		$contractorname= $contractor['contractorname'];
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#unit").focus();  
  
  function loadData(){ 
  var dataString; 
	  var cari = $("select#carisektor").val(); 
	  var vkav= $('input#kav').val();
	  var vown = $('input#own').val();
	  var vdsp = $("select#dsp").val();
	 
     dataString = 'sektor_idsektor='+ cari+'&kav='+vkav+'&own='+vown+'&dsp='+vdsp;               
   
 

    $.ajax({ 
      url: "unit_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#unit_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data unit ini?")){ 
    		$.ajax({ 
        	url: "unit_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 1) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil disimpan !"); 
          	  
             loadData(); 
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
 
  function lovsektor() { 
  window.open("sektor_lovpopup.php","_blank"," left=450,top=200,height=400,width=400, status=yes,toolbar=no,menubar=no,location=no"); 
}
 function lovkpr() { 
  window.open("kpr_lov.php","_blank"," left=450,top=200,height=400,width=400, status=yes,toolbar=no,menubar=no,location=no"); 
}

 function lovcontractor() { 
  window.open("contractor_lov.php","_blank"," left=450,top=200,height=400,width=400, status=yes,toolbar=no,menubar=no,location=no"); 
}

 </script> 
<form method="post" name="unit_form" action="" id="unit_form">  
<table class="grid">
<tr><th colspan="4"><b><?php echo $judul; ?></b></th></tr> 

<tr><td>
<table width=100%> 

<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">ID Unit</td><td><input type="text" id="idunit" name="idunit" size="5" <? echo $readonly;?> value="<? echo $idunit;?>" /></td> 
</tr> 
<?php } else {?> 
<tr><td class="right">ID Unit</td><td><input type="text" id="idunit" name="idunit" size="5" value="<? echo $idunit;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td class="right">Sektor & ID Sektor</td> 
<td>
<input type="text" id="sektor_idsektor" name="sektor_idsektor" size="5" maxlength="35" value="<? echo $sektor_idsektor;?>" />
<input class="button" type="button" id="btnlovsektor" onClick="lovsektor()" value="..."/>
<input type="text" id="sektorname" name="sektorname" size="30" maxlength="35" value="<? echo $sektorname;?>" />

</td> 
</tr> 
<tr> 
<td class="right">Kavling</td> 
<td><input type="text" id="kavling" name="kavling" size="30" maxlength="25" value="<? echo $kavling;?>" /></td> 
</tr> 
<tr> 
<td class="right">Luas Bangunan</td> 
<td><input type="text" id="tipe" name="tipe" size="10" maxlength="25" value="<? echo $tipe;?>" />
Luas Tanah : <input type="text" id="luastanah" name="luastanah" size="10" maxlength="25" value="<? echo $luastanah;?>" />
</td> 
</tr> 
<tr> 
<td class="right">Pemilik</td> 
<td><input type="text" id="owner" name="owner" size="30" maxlength="25" value="<? echo $owner;?>" /></td> 
</tr> 
<tr> 
<td class="right">Alamat</td> 
<td><textarea id="address" name="address" cols="40"><? echo $address;?></textarea></td> 
</tr> 
<tr> 
<td class="right">Telp./HP</td> 
<td><input type="text" id="phone" name="phone" size="30" maxlength="25" value="<? echo $phone;?>" /></td> 
</tr> 
<tr> 
<td class="right">Tanggal Jatuh Tempo</td> 
<td><input type="text" id="tglduedate" name="tglduedate" size="5" maxlength="25" value="<? echo $tglduedate;?>" /></td> 
</tr> 

<tr> 
<td class="right">Harga Jual</td> 
<td><input class="right" type="text" id="nkontrakuser" name="nkontrakuser" size="15" maxlength="25" value="<? echo $nkontrakuser;?>" /></td> 
</tr> 

<tr> 
<td class="right">Tambahan LB</td> 
<td>
<input class="right" type="text" id="addlb" name="addlb" size="5" maxlength="25" value="<? echo $addlb;?>" />(m2) &nbsp;&nbsp;Nilai (Rp)
<input class="right" type="text" id="addlbvalue" name="addlbvalue" size="15" maxlength="25" value="<? echo $addlbvalue;?>" />
</td> 
</tr> 

<tr> 
<td class="right">Tambahan LT</td> 
<td>
<input class="right" type="text" id="addlt" name="addlt" size="5" maxlength="25" value="<? echo $addlt;?>" />(m2) &nbsp;&nbsp;Nilai (Rp)
<input class="right" type="text" id="addltvalue" name="addltvalue" size="15" maxlength="25" value="<? echo $addltvalue;?>" />
</td> 
</tr> 
<tr> 
<td class="right">Total</td> 
<td><input class="right" type="text" id="ntotal" name="ntotal" size="15" maxlength="25" value="<? echo $ntotal;?>" /></td> 
</tr> 
<tr>
<td colspan="2"><input class="button" type="submit" value="<? echo $status;?>"</td> 
</tr>


</table>
</td>
<td  width="50%">
<table width="100%">
<tr>
<td>Cara Bayar</td>
<td>
<select id="carabayar" name="carabayar">
<?
echo "<option value=\"KPR\""; if($carabayar == "KPR") echo "selected"; echo ">KPR</option>";
echo "<option value=\"Cash\""; if($carabayar == "Cash") echo "selected"; echo ">Cash</option>";
?>
</select>
</td>
</tr>
</table>
</td>
</tr></table>
</td>
</tr>
</table>


<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
<br><br><br>
