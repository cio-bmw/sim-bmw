 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data inbox sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
      if (combo == "UpdatedInDB"){ 
    dataString = 'starting='+page+'&UpdatedInDB='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "ReceivingDateTime"){ 
    dataString = 'starting='+page+'&ReceivingDateTime='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "Text"){ 
    dataString = 'starting='+page+'&Text='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "SenderNumber"){ 
    dataString = 'starting='+page+'&SenderNumber='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "Coding"){ 
    dataString = 'starting='+page+'&Coding='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "UDH"){ 
    dataString = 'starting='+page+'&UDH='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "SMSCNumber"){ 
    dataString = 'starting='+page+'&SMSCNumber='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "Class"){ 
    dataString = 'starting='+page+'&Class='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "TextDecoded"){ 
    dataString = 'starting='+page+'&TextDecoded='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "ID"){ 
    dataString = 'starting='+page+'&ID='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "RecipientID"){ 
    dataString = 'starting='+page+'&RecipientID='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "Processed"){ 
    dataString = 'starting='+page+'&Processed='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"inbox_display.php", 
    data: dataString, 
        type:"GET", 
        success:function(data) 
        { 
            $('#divPageData').html(data); 
        } 
  }); 
} 
 
// fungsi untuk me-load tampilan list data inbox, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
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
    url: "inbox_display.php", //file tempat pemrosesan permintaan (request) 
    type: "GET", 
    data: dataString, 
        success:function(data) 
        { 
            $('#divPageData').html(data); 
        } 
  }); 
} 
   
$(function(){  
  // membuat warna tampilan baris data pada tabel menjadi selang-seling 
  $('#inbox tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#inbox tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
    $("a.edit").click(function(){ 
        page=$(this).attr("href"); 
        $("#divPageData").load(page); 
        $("#divPageData").show(); 
        return false; 
    }); 
     
    $("a.detail").click(function(){ 
        window.location=$(this).attr("href"); 
        return false; 
    }); 
     
    $("a.delete").click(function(){ 
        el=$(this); 
        if(confirm("Apakah benar akan menghapus data inbox ini?")) 
        { 
            $.ajax({ 
                url:$(this).attr("href"),  
                type:"GET", 
                dataType: 'json', //respon yang diminta dalam format JSON 
                success:function(response) 
                { 
                    if(response.status == 1){ 
                        loadData(); 
                        $("#divFormEntry").load("inbox_form.php"); 
                        $("#divFormEntry").hide(); 
            alert("Data inbox berhasil di hapus!"); 
                    } 
                    else{ 
                        alert("data inbox gagal di hapus!"); 
                    } 
                } 
            }); 
        } 
        return false; 
    }); 
     
}); 
 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class.php'); 
 
if (isset($_GET['UpdatedInDB']) and !empty($_GET['UpdatedInDB'])){ 
 $UpdatedInDB = $_GET['UpdatedInDB']; 
  $sql = "select * from inbox where UpdatedInDB like '%$UpdatedInDB%' order by UpdatedInDB"; 
} 
else if (isset($_GET['ReceivingDateTime']) and !empty($_GET['ReceivingDateTime'])){ 
 $ReceivingDateTime = $_GET['ReceivingDateTime']; 
  $sql = "select * from inbox where ReceivingDateTime like '%$ReceivingDateTime%' order by ReceivingDateTime"; 
} 
else if (isset($_GET['Text']) and !empty($_GET['Text'])){ 
 $Text = $_GET['Text']; 
  $sql = "select * from inbox where Text like '%$Text%' order by Text"; 
} 
else if (isset($_GET['SenderNumber']) and !empty($_GET['SenderNumber'])){ 
 $SenderNumber = $_GET['SenderNumber']; 
  $sql = "select * from inbox where SenderNumber like '%$SenderNumber%' order by SenderNumber"; 
} 
else if (isset($_GET['Coding']) and !empty($_GET['Coding'])){ 
 $Coding = $_GET['Coding']; 
  $sql = "select * from inbox where Coding like '%$Coding%' order by Coding"; 
} 
else if (isset($_GET['UDH']) and !empty($_GET['UDH'])){ 
 $UDH = $_GET['UDH']; 
  $sql = "select * from inbox where UDH like '%$UDH%' order by UDH"; 
} 
else if (isset($_GET['SMSCNumber']) and !empty($_GET['SMSCNumber'])){ 
 $SMSCNumber = $_GET['SMSCNumber']; 
  $sql = "select * from inbox where SMSCNumber like '%$SMSCNumber%' order by SMSCNumber"; 
} 
else if (isset($_GET['Class']) and !empty($_GET['Class'])){ 
 $Class = $_GET['Class']; 
  $sql = "select * from inbox where Class like '%$Class%' order by Class"; 
} 
else if (isset($_GET['TextDecoded']) and !empty($_GET['TextDecoded'])){ 
 $TextDecoded = $_GET['TextDecoded']; 
  $sql = "select * from inbox where TextDecoded like '%$TextDecoded%' order by TextDecoded"; 
} 
else if (isset($_GET['ID']) and !empty($_GET['ID'])){ 
 $ID = $_GET['ID']; 
  $sql = "select * from inbox where ID like '%$ID%' order by ID"; 
} 
else if (isset($_GET['RecipientID']) and !empty($_GET['RecipientID'])){ 
 $RecipientID = $_GET['RecipientID']; 
  $sql = "select * from inbox where RecipientID like '%$RecipientID%' order by RecipientID"; 
} 
else if (isset($_GET['Processed']) and !empty($_GET['Processed'])){ 
 $Processed = $_GET['Processed']; 
  $sql = "select * from inbox where Processed like '%$Processed%' order by Processed"; 
} 
else{ 
  $sql = "select * from inbox"; 
} 
 
if(isset($_GET['starting'])){ //starting page 
    $starting=$_GET['starting']; 
}else{ 
    $starting=0; 
} 
 
$recpage = 15;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class($sql,$starting,$recpage);        
$result = $obj->result; 
?> 
     
<p class="judul">Daftar inbox </p> 
  <table id="inbox"   style="min-width:500px;"> 
  <tr> 
<th>ID</th>
<th>SenderNumber</th>
<th>TextDecoded</th>
<th>Aksi</th> 


  </tr> 
        <?php 
        //menampilkan data inbox 
        if(mysql_num_rows($result)!=0){ 
        while($row = mysql_fetch_array($result)){ ?>         
       <tr> 

 <td><? echo $row['ID'];?></td>
<td><? echo $row['SenderNumber'];?></td>
<td><? echo $row['TextDecoded'];?></td>
 
        <td width="150px"> 
         <a href="inbox_detail.php?action=detail&id=<? echo $row['idinbox'];?>" class="detail"> <input type="button" class="button" value="Detail"></a>   
       |  <a href="inbox_form.php?action=update&id=<? echo $row['idinbox'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="inbox_process.php?action=delete&id=<? echo $row['idinbox'];?>" class="delete"><input type="button" class="button" value="Delete"></a> 
         </td> 
         </tr> 
        <?} //end while ?> 
         <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
       <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <? }else{ ?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
    </table> 