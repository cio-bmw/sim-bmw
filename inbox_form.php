  <?  
  include_once("config.php"); 
   
    $action="add"; 
    $judul="Penambahan Data"; 
    $status="Simpan"; 
   $sql = "SELECT IFNULL(max(CAST(idinbox AS UNSIGNED)),0)+1  FROM inbox";  
   $result = mysql_query($sql);  

  $idinbox = $data[0];   
    if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
    { 
        $str="select * from inbox where idinbox = '$_GET[id]'"; 
        $res=mysql_query($str) or die("query gagal dijalankan"); 
        $data=mysql_fetch_assoc($res); 
        $UpdatedInDB=$data['UpdatedInDB']; 
        $ReceivingDateTime=$data['ReceivingDateTime']; 
        $Text=$data['Text']; 
        $SenderNumber=$data['SenderNumber']; 
        $Coding=$data['Coding']; 
        $UDH=$data['UDH']; 
        $SMSCNumber=$data['SMSCNumber']; 
        $Class=$data['Class']; 
        $TextDecoded=$data['TextDecoded']; 
        $ID=$data['ID']; 
        $RecipientID=$data['RecipientID']; 
        $Processed=$data['Processed']; 
        $action="update"; 
        $readonly="readonly=readonly"; 
        $status="Simpan"; 
        $judul="Edit Data"; 
    } 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#inbox").focus();  
  
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
       
      if (combo == "UpdatedInDB"){ 
      dataString = 'UpdatedInDB='+ cari;  
   } 
   else if (combo == "ReceivingDateTime"){ 
      dataString = 'ReceivingDateTime='+ cari; 
    } 
   else if (combo == "Text"){ 
      dataString = 'Text='+ cari; 
    } 
   else if (combo == "SenderNumber"){ 
      dataString = 'SenderNumber='+ cari; 
    } 
   else if (combo == "Coding"){ 
      dataString = 'Coding='+ cari; 
    } 
   else if (combo == "UDH"){ 
      dataString = 'UDH='+ cari; 
    } 
   else if (combo == "SMSCNumber"){ 
      dataString = 'SMSCNumber='+ cari; 
    } 
   else if (combo == "Class"){ 
      dataString = 'Class='+ cari; 
    } 
   else if (combo == "TextDecoded"){ 
      dataString = 'TextDecoded='+ cari; 
    } 
   else if (combo == "ID"){ 
      dataString = 'ID='+ cari; 
    } 
   else if (combo == "RecipientID"){ 
      dataString = 'RecipientID='+ cari; 
    } 
   else if (combo == "Processed"){ 
      dataString = 'Processed='+ cari; 
    } 
 
    $.ajax({ 
      url: "inbox_display.php", 
      type: "GET", 
      data: dataString, 
        success:function(data) 
        { 
            $('#divPageData').html(data); 
        } 
    }); 
  } 
 
  $("form#inbox_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data inbox ini?")){ 
            $.ajax({ 
            url: "inbox_process.php", 
            type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
            data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
            dataType: 'json', //respon yang diminta dalam format JSON 
            success:function(response){ 
            if(response.status == 2) // return nilai dari hasil proses 
            {  
              alert("Data berhasil diupdate!"); 
              loadData(); //reload list data 
                $("#divPageEntry").load("inbox_form.php");   
              $("#divPageEntry").hide(); 
            } 
          else if(response.status == 1) { 
              alert("Data Baru berhasil disimpan!"); 
              loadData(); //reload list data 
         //   window.location="inbox_detail.php?id="+$("input#idslshdr").val(); 
                            } 
            else 
            { 
                alert("Data gagal di simpan!"); 
            } 
            } 
         }); 
     //     return false; 
        } 
     //} 
     return false; 
   }); 
 $("#btnclose").click(function(){  
        $("#divPageEntry").hide();  
      $("#divLOV").hide();  
  
        page3="inbox_display.php";  
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
<form method="post" name="inbox_form" action="" id="inbox_form">  
<p class="judul">Form Memasukkan / Edit Data inbox</p>  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">UpdatedInDB</td><td><input type="text" id="UpdatedInDB" name="UpdatedInDB" size="10" <? echo $readonly;?> value="<? echo $UpdatedInDB;?>" /></td> 
</tr> 
<?php } else {?> 
<tr><td class="right">UpdatedInDB</td><td><input type="text" id="UpdatedInDB" name="UpdatedInDB" size="10" value="<? echo $UpdatedInDB;?>" /></td> 
</tr> 
<?php }?> 

<tr> 
<td class="right">ID</td> 
<td><input type="text" id="ID" name="ID" size="30" maxlength="45" value="<? echo $ID;?>" /></td> 
</tr> 

<tr> 
<td class="right">SenderNumber</td> 
<td><input type="text" id="SenderNumber" name="SenderNumber" size="30" maxlength="45" value="<? echo $SenderNumber;?>" /></td> 
</tr>
 
 <tr> 
<td class="right">TextDecoded</td> 
<td><input type="text" id="TextDecoded" name="TextDecoded" size="30" maxlength="45" value="<? echo $TextDecoded;?>" /></td> 
</tr> 



<tr> 
<td ><input class="button" type="submit" value="<? echo $status;?>"></td> 
<td ><input class="button" type="button" id="btnclose" value="Tutup Form"></td>  
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 