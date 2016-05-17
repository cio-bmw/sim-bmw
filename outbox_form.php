  <?  
  include_once("config.php"); 
   
    $action="add"; 
    $judul="Penambahan Data"; 
    $status="Simpan"; 
   $sql = "SELECT IFNULL(max(CAST(idoutbox AS UNSIGNED)),0)+1  FROM outbox";  
   $result = mysql_query($sql);  

  $idoutbox = $data[0];  
    if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
    { 
        $str="select * from outbox where idoutbox = '$_GET[id]'"; 
        $res=mysql_query($str) or die("query gagal dijalankan"); 
        $data=mysql_fetch_assoc($res); 
        $UpdatedInDB=$data['UpdatedInDB']; 
        $InsertIntoDB=$data['InsertIntoDB']; 
        $SendingDateTime=$data['SendingDateTime']; 
        $Text=$data['Text']; 
        $DestinationNumber=$data['DestinationNumber']; 
        $Coding=$data['Coding']; 
        $UDH=$data['UDH']; 
        $Class=$data['Class']; 
        $TextDecoded=$data['TextDecoded']; 
        $ID=$data['ID']; 
        $MultiPart=$data['MultiPart']; 
        $RelativeValidity=$data['RelativeValidity']; 
        $SenderID=$data['SenderID']; 
        $SendingTimeOut=$data['SendingTimeOut']; 
        $DeliveryReport=$data['DeliveryReport']; 
        $CreatorID=$data['CreatorID']; 
        $action="update"; 
        $readonly="readonly=readonly"; 
        $status="Simpan"; 
        $judul="Edit Data"; 
    } 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#outbox").focus();  
  
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
   else if (combo == "InsertIntoDB"){ 
      dataString = 'InsertIntoDB='+ cari; 
    } 
   else if (combo == "SendingDateTime"){ 
      dataString = 'SendingDateTime='+ cari; 
    } 
   else if (combo == "Text"){ 
      dataString = 'Text='+ cari; 
    } 
   else if (combo == "DestinationNumber"){ 
      dataString = 'DestinationNumber='+ cari; 
    } 
   else if (combo == "Coding"){ 
      dataString = 'Coding='+ cari; 
    } 
   else if (combo == "UDH"){ 
      dataString = 'UDH='+ cari; 
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
   else if (combo == "MultiPart"){ 
      dataString = 'MultiPart='+ cari; 
    } 
   else if (combo == "RelativeValidity"){ 
      dataString = 'RelativeValidity='+ cari; 
    } 
   else if (combo == "SenderID"){ 
      dataString = 'SenderID='+ cari; 
    } 
   else if (combo == "SendingTimeOut"){ 
      dataString = 'SendingTimeOut='+ cari; 
    } 
   else if (combo == "DeliveryReport"){ 
      dataString = 'DeliveryReport='+ cari; 
    } 
   else if (combo == "CreatorID"){ 
      dataString = 'CreatorID='+ cari; 
    } 
 
    $.ajax({ 
      url: "outbox_display.php", 
      type: "GET", 
      data: dataString, 
        success:function(data) 
        { 
            $('#divPageData').html(data); 
        } 
    }); 
  } 
 
  $("form#outbox_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data outbox ini?")){ 
            $.ajax({ 
            url: "outbox_process.php", 
            type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
            data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
            dataType: 'json', //respon yang diminta dalam format JSON 
            success:function(response){ 
            if(response.status == 2) // return nilai dari hasil proses 
            {  
              alert("Data berhasil diupdate!"); 
              loadData(); //reload list data 
                $("#divPageEntry").load("outbox_form.php");   
              $("#divPageEntry").hide(); 
            } 
          else if(response.status == 1) { 
              alert("Data Baru berhasil disimpan!"); 
              loadData(); //reload list data 
         //   window.location="outbox_detail.php?id="+$("input#idslshdr").val(); 
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
  
        page3="outbox_display.php";  
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
<form method="post" name="outbox_form" action="" id="outbox_form">  
<p class="judul">Form Memasukkan / Edit Data outbox</p>  
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
<td class="right">SendingDateTime</td> 
<td><input type="text" id="SendingDateTime" name="SendingDateTime" size="30" maxlength="45" value="<? echo $SendingDateTime;?>" /></td> 
</tr>
 

<tr> 
<td class="right">SendingNumber</td>
<td><input type="text" id="SendingNumber" name="SendingNumber" size="30" maxlength="45" value="<? echo $SendingNumber;?>" /></td>
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