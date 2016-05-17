  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data"; 
	$status="Simpan"; 
   $sql = "SELECT IFNULL(max(CAST(idmembers AS UNSIGNED)),0)+1  FROM members";  
   $result = mysql_query($sql);  
  $data  = mysql_fetch_array($result);  
  $idmembers = $data[0];	 
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from members where idmembers = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$member_id=$data['member_id']; 
		$hp_no=$data['hp_no']; 
		$name=$data['name']; 
		$address=$data['address']; 
		$title=$data['title']; 
		$pilih=$data['pilih']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Simpan"; 
		$judul="Edit Data"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#members").focus();  
  
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
	   
	  if (combo == "member_id"){ 
      dataString = 'member_id='+ cari;  
   } 
   else if (combo == "hp_no"){ 
      dataString = 'hp_no='+ cari; 
    } 
   else if (combo == "name"){ 
      dataString = 'name='+ cari; 
    } 
   else if (combo == "address"){ 
      dataString = 'address='+ cari; 
    } 
   else if (combo == "title"){ 
      dataString = 'title='+ cari; 
    } 
   else if (combo == "pilih"){ 
      dataString = 'pilih='+ cari; 
    } 
 
    $.ajax({ 
      url: "members_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#members_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data members ini?")){ 
    		$.ajax({ 
        	url: "members_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 2) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil diupdate!"); 
              loadData(); //reload list data 
          		$("#divPageEntry").load("members_form.php");   
              $("#divPageEntry").hide(); 
            } 
          else if(response.status == 1) { 
          	  alert("Data Baru berhasil disimpan!"); 
              loadData(); //reload list data 
         //   window.location="members_detail.php?id="+$("input#idslshdr").val(); 
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
  
		page3="members_display.php";  
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
<form method="post" name="members_form" action="" id="members_form">  
<p class="judul">Form Memasukkan / Edit Data members</p>  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">member_id</td><td><input type="text" id="member_id" name="member_id" size="10" <? echo $readonly;?> value="<? echo $member_id;?>" /></td> 
</tr> 
<?php } else {?> 
<tr><td class="right">member_id</td><td><input type="text" id="member_id" name="member_id" size="10" value="<? echo $member_id;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td class="right">hp_no</td> 
<td><input type="text" id="hp_no" name="hp_no" size="30" maxlength="45" value="<? echo $hp_no;?>" /></td> 
</tr> 
<tr> 
<td class="right">name</td> 
<td><input type="text" id="name" name="name" size="30" maxlength="45" value="<? echo $name;?>" /></td> 
</tr> 
<tr> 
<td class="right">address</td> 
<td><input type="text" id="address" name="address" size="30" maxlength="45" value="<? echo $address;?>" /></td> 
</tr> 
<tr> 
<td class="right">title</td> 
<td><input type="text" id="title" name="title" size="30" maxlength="45" value="<? echo $title;?>" /></td> 
</tr> 
<tr> 
<td class="right">pilih</td> 
<td><input type="text" id="pilih" name="pilih" size="30" maxlength="45" value="<? echo $pilih;?>" /></td> 
</tr> 
<tr> 
<td ><input class="button" type="submit" value="<? echo $status;?>"></td> 
<td ><input class="button" type="button" id="btnclose" value="Tutup Form"></td>  
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
