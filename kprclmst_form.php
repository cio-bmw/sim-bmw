  <?  
  include_once("config.php"); 
   
    $action="add"; 
    $judul="Penambahan Data kprclmst"; 
    $status="Simpan"; 
   $sql = "SELECT IFNULL(max(CAST(idkprclmst AS UNSIGNED)),0)+1  FROM kprclmst";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idkprclmst = $data[0];   
    if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
    { 
        $str="select * from kprclmst where idkprclmst = '$_GET[id]'"; 
        $res=mysql_query($str) or die("query gagal dijalankan"); 
        $data=mysql_fetch_assoc($res); 
        $idkprclmst=$data['idkprclmst']; 
        $kprclmst=$data['kprclmst']; 
        $kprpct=$data['kprpct']; 
        $kprtime=$data['kprtime'];
        $kprseq=$data['kprseq'];
        $action="update"; 
        $readonly="readonly=readonly"; 
        $status="Simpan"; 
        $judul="Update data kprclmst"; 
    } 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#kprclmst").focus();  
  
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
       
      if (combo == "idkprclmst"){ 
      dataString = 'idkprclmst='+ cari;  
   } 
   else if (combo == "kprclmst"){ 
      dataString = 'kprclmst='+ cari; 
    } 
   else if (combo == "kprpct"){ 
      dataString = 'kprpct='+ cari; 
    } 
 
    $.ajax({ 
      url: "kprclmst_display.php", 
      type: "GET", 
      data: dataString, 
        success:function(data) 
        { 
            $('#divPageData').html(data); 
        } 
    }); 
  } 
 
  $("form#kprclmst_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data kprclmst ini?")){ 
            $.ajax({ 
            url: "kprclmst_process.php", 
            type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
            data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
            dataType: 'json', //respon yang diminta dalam format JSON 
            success:function(response){ 
            if(response.status == 2) // return nilai dari hasil proses 
            {  
              alert("Data berhasil diupdate!"); 
              loadData(); //reload list data 
                $("#divPageEntry").load("kprclmst_form.php");   
              $("#divPageEntry").hide(); 
            } 
          else if(response.status == 1) { 
              alert("Data Baru berhasil disimpan!"); 
              loadData(); //reload list data 
         //   window.location="kprclmst_detail.php?id="+$("input#idslshdr").val(); 
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
  
        page3="kprclmst_display.php";  
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
                jQuery('input[name=rcv_date]').datepicker({changeYear:true, changeMonth:true, yearRange:"1990:2025",dateFormat: "dd-mm-yyyy"});
            })          
</script>    
<form method="post" name="kprclmst_form" action="" id="kprclmst_form">  
<p class="judul">Form Memasukkan / Edit Data Master Check List KPR</p>
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">Id</td><td><input type="text" id="idkprclmst" name="idkprclmst" size="10" <? echo $readonly;?> value="<? echo $idkprclmst;?>" /></td>
</tr> 
<?php } else {?> 
<tr><td class="right">Id</td><td><input type="text" id="idkprclmst" name="idkprclmst" size="10" value="<? echo $idkprclmst;?>" /></td>
</tr> 
<?php }?> 
<tr> 
<td class="right">Check List</td>
<td><input type="text" id="kprclmst" name="kprclmst" size="30" maxlength="25" value="<? echo $kprclmst;?>" /></td> 
</tr> 
<tr> 
<td class="right">Persen</td>
<td><input type="text" id="kprpct" name="kprpct" size="10" maxlength="25" value="<? echo $kprpct;?>" /></td>
</tr> 
<tr> 
<td class="right">Kprtime</td>
<td><input type="text" id="kprtime" name="kprtime" size="10" maxlength="25" value="<? echo $kprseq;?>" /></td>
</tr> 
<tr> 
<td class="right">urutan</td>
<td><input type="text" id="kprseq" name="kprseq" size="10" maxlength="25" value="<? echo $kprseq;?>" /></td>
</tr> 
<tr> 
<td ><input class="button" type="submit" value="<? echo $status;?>"></td> 
<td ><input class="button" type="button" id="btnclose" value="Tutup Form"></td>  
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 