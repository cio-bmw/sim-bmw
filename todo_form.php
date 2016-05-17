  <?  
session_start();
require_once ('config.php'); 

$user = empinfo($_SESSION['cookie_name']);
$namauser = $user['empname'];
$iduser = $user['idemp'];
   
	$action="add"; 
	$judul="Penambahan Data todo"; 
	$status="Simpan"; 
   $emp_idemp = $iduser;
   $startdate = date('d-m-Y');
   $enddate = date('d-m-Y'); 
   $todostatus = 'open';
  
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from todo where idtodo = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idtodo=$data['idtodo']; 
		$todo=$data['todo']; 
		$startdate=$data['startdate']; 
		$enddate=$data['enddate']; 
		$todostatus=$data['todostatus']; 
		$emp_idemp=$data['emp_idemp']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Simpan"; 
		$judul="Update data todo"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#todo").focus();  
  
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
	   
	  if (combo == "idtodo"){ 
      dataString = 'idtodo='+ cari;  
   } 
   else if (combo == "todo"){ 
      dataString = 'todo='+ cari; 
    } 
   else if (combo == "startdate"){ 
      dataString = 'startdate='+ cari; 
    } 
   else if (combo == "enddate"){ 
      dataString = 'enddate='+ cari; 
    } 
   else if (combo == "todostatus"){ 
      dataString = 'todostatus='+ cari; 
    } 
   else if (combo == "emp_idemp"){ 
      dataString = 'emp_idemp='+ cari; 
    } 
 
    $.ajax({ 
      url: "todo_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#todo_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data todo ini?")){ 
    		$.ajax({ 
        	url: "todo_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 2) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil diupdate!"); 
              loadData(); //reload list data 
          		$("#divPageEntry").load("todo_form.php");   
              $("#divPageEntry").hide(); 
            } 
          else if(response.status == 1) { 
          	  alert("Data Baru berhasil disimpan!"); 
              loadData(); //reload list data 
         //   window.location="todo_detail.php?id="+$("input#idslshdr").val(); 
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
  
		page3="todo_display.php";  
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
<form method="post" name="todo_form" action="" id="todo_form">  
<p class="judul">Form Memasukkan / Edit Data todo</p>  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">idtodo</td><td><input type="text" id="idtodo" name="idtodo" size="10" <? echo $readonly;?> value="<? echo $idtodo;?>" /></td> 
</tr> 
<?php } else {?> 
<tr><td class="right">idtodo</td><td><input type="text" id="idtodo" name="idtodo" size="10" value="<? echo $idtodo;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td class="right">todo</td> 
<td><input type="text" id="todo" name="todo" size="30" maxlength="25" value="<? echo $todo;?>" /></td> 
</tr> 
<tr> 
<td class="right">startdate</td> 
<td><input type="text" id="startdate" name="startdate" size="10" maxlength="25" value="<? echo $startdate;?>" /></td> 
</tr> 
<tr> 
<td class="right">enddate</td> 
<td><input type="text" id="enddate" name="enddate" size="10" maxlength="25" value="<? echo $enddate;?>" /></td> 
</tr> 
<tr> 
<td class="right">todostatus</td> 
<td><input type="text" id="todostatus" name="todostatus" size="30" maxlength="25" value="<? echo $todostatus;?>" /></td> 
</tr> 
<tr> 
<td class="right">emp_idemp</td> 
<td><input type="text" id="emp_idemp" name="emp_idemp" size="30" maxlength="25" value="<? echo $emp_idemp;?>" /></td> 
</tr> 
<tr> 
<td ><input class="button" type="submit" value="<? echo $status;?>"></td> 
<td ><input class="button" type="button" id="btnclose" value="Tutup Form"></td>  
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
