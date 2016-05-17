  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data taskreplay"; 
	$status="Simpan"; 
   $sql = "SELECT IFNULL(max(CAST(idtaskreplay AS UNSIGNED)),0)+1  FROM taskreplay";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idtaskreplay = $data[0];	 
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from taskreplay where idtaskreplay = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idtaskreplay=$data['idtaskreplay']; 
		$taskreplay=$data['taskreplay']; 
		$filename=$data['filename']; 
		$taskreplaydate=$data['taskreplaydate']; 
		$task_idtask=$data['task_idtask']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Simpan"; 
		$judul="Update data taskreplay"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#taskreplay").focus();  
  
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
	   
	  if (combo == "idtaskreplay"){ 
      dataString = 'idtaskreplay='+ cari;  
   } 
   else if (combo == "taskreplay"){ 
      dataString = 'taskreplay='+ cari; 
    } 
   else if (combo == "filename"){ 
      dataString = 'filename='+ cari; 
    } 
   else if (combo == "taskreplaydate"){ 
      dataString = 'taskreplaydate='+ cari; 
    } 
   else if (combo == "task_idtask"){ 
      dataString = 'task_idtask='+ cari; 
    } 
 
    $.ajax({ 
      url: "taskreplay_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#taskreplay_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data taskreplay ini?")){ 
    		$.ajax({ 
        	url: "taskreplay_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 2) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil diupdate!"); 
              loadData(); //reload list data 
          		$("#divPageEntry").load("taskreplay_form.php");   
              $("#divPageEntry").hide(); 
            } 
          else if(response.status == 1) { 
          	  alert("Data Baru berhasil disimpan!"); 
              loadData(); //reload list data 
         //   window.location="taskreplay_detail.php?id="+$("input#idslshdr").val(); 
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
  
		page3="taskreplay_display.php";  
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
<form method="post" name="taskreplay_form" action="" id="taskreplay_form">  
<p class="judul">Form Memasukkan / Edit Data taskreplay</p>  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">idtaskreplay</td><td><input type="text" id="idtaskreplay" name="idtaskreplay" size="10" <? echo $readonly;?> value="<? echo $idtaskreplay;?>" /></td> 
</tr> 
<?php } else {?> 
<tr><td class="right">idtaskreplay</td><td><input type="text" id="idtaskreplay" name="idtaskreplay" size="10" value="<? echo $idtaskreplay;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td class="right">taskreplay</td> 
<td><input type="text" id="taskreplay" name="taskreplay" size="30" maxlength="25" value="<? echo $taskreplay;?>" /></td> 
</tr> 
<tr> 
<td class="right">filename</td> 
<td><input type="text" id="filename" name="filename" size="30" maxlength="25" value="<? echo $filename;?>" /></td> 
</tr> 
<tr> 
<td class="right">taskreplaydate</td> 
<td><input type="text" id="taskreplaydate" name="taskreplaydate" size="30" maxlength="25" value="<? echo $taskreplaydate;?>" /></td> 
</tr> 
<tr> 
<td class="right">task_idtask</td> 
<td><input type="text" id="task_idtask" name="task_idtask" size="30" maxlength="25" value="<? echo $task_idtask;?>" /></td> 
</tr> 
<tr> 
<td ><input class="button" type="submit" value="<? echo $status;?>"></td> 
<td ><input class="button" type="button" id="btnclose" value="Tutup Form"></td>  
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
