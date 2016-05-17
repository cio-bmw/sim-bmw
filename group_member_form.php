  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data"; 
	$status="Simpan"; 
   $sql = "SELECT IFNULL(max(CAST(idgroup_member AS UNSIGNED)),0)+1  FROM group_member";  
   $result = mysql_query($sql);  
  $data  = mysql_fetch_array($result);  
  $idgroup_member = $data[0];	 
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from group_member where idgroup_member = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$group_id=$data['group_id']; 
		$member_id=$data['member_id']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Simpan"; 
		$judul="Edit Data"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#group_member").focus();  
  
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
	   
	  if (combo == "group_id"){ 
      dataString = 'group_id='+ cari;  
   } 
   else if (combo == "member_id"){ 
      dataString = 'member_id='+ cari; 
    } 
 
    $.ajax({ 
      url: "group_member_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#group_member_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data group_member ini?")){ 
    		$.ajax({ 
        	url: "group_member_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 2) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil diupdate!"); 
              loadData(); //reload list data 
          		$("#divPageEntry").load("group_member_form.php");   
              $("#divPageEntry").hide(); 
            } 
          else if(response.status == 1) { 
          	  alert("Data Baru berhasil disimpan!"); 
              loadData(); //reload list data 
         //   window.location="group_member_detail.php?id="+$("input#idslshdr").val(); 
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
  
		page3="group_member_display.php";  
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
<form method="post" name="group_member_form" action="" id="group_member_form">  
<p class="judul">Form Memasukkan / Edit Data group_member</p>  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">group_id</td><td><input type="text" id="group_id" name="group_id" size="10" <? echo $readonly;?> value="<? echo $group_id;?>" /></td> 
</tr> 
<?php } else {?> 
<tr><td class="right">group_id</td><td><input type="text" id="group_id" name="group_id" size="10" value="<? echo $group_id;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td class="right">member_id</td> 
<td><input type="text" id="member_id" name="member_id" size="30" maxlength="45" value="<? echo $member_id;?>" /></td> 
</tr> 
<tr> 
<td ><input class="button" type="submit" value="<? echo $status;?>"></td> 
<td ><input class="button" type="button" id="btnclose" value="Tutup Form"></td>  
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
