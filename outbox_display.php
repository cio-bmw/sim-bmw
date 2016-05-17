 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data outbox sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
      if (combo == "UpdatedInDB"){ 
    dataString = 'starting='+page+'&UpdatedInDB='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "InsertIntoDB"){ 
    dataString = 'starting='+page+'&InsertIntoDB='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "SendingDateTime"){ 
    dataString = 'starting='+page+'&SendingDateTime='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "Text"){ 
    dataString = 'starting='+page+'&Text='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "DestinationNumber"){ 
    dataString = 'starting='+page+'&DestinationNumber='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "Coding"){ 
    dataString = 'starting='+page+'&Coding='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "UDH"){ 
    dataString = 'starting='+page+'&UDH='+cari+'&random='+Math.random(); 
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
   else if (combo == "MultiPart"){ 
    dataString = 'starting='+page+'&MultiPart='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "RelativeValidity"){ 
    dataString = 'starting='+page+'&RelativeValidity='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "SenderID"){ 
    dataString = 'starting='+page+'&SenderID='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "SendingTimeOut"){ 
    dataString = 'starting='+page+'&SendingTimeOut='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "DeliveryReport"){ 
    dataString = 'starting='+page+'&DeliveryReport='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "CreatorID"){ 
    dataString = 'starting='+page+'&CreatorID='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"outbox_display.php", 
    data: dataString, 
        type:"GET", 
        success:function(data) 
        { 
            $('#divPageData').html(data); 
        } 
  }); 
} 
 
// fungsi untuk me-load tampilan list data outbox, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
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
    url: "outbox_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#outbox tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#outbox tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
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
        if(confirm("Apakah benar akan menghapus data outbox ini?")) 
        { 
            $.ajax({ 
                url:$(this).attr("href"),  
                type:"GET", 
                dataType: 'json', //respon yang diminta dalam format JSON 
                success:function(response) 
                { 
                    if(response.status == 1){ 
                        loadData(); 
                        $("#divFormEntry").load("outbox_form.php"); 
                        $("#divFormEntry").hide(); 
            alert("Data outbox berhasil di hapus!"); 
                    } 
                    else{ 
                        alert("data outbox gagal di hapus!"); 
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
  $sql = "select * from outbox where UpdatedInDB like '%$UpdatedInDB%' order by UpdatedInDB"; 
} 
else if (isset($_GET['InsertIntoDB']) and !empty($_GET['InsertIntoDB'])){ 
 $InsertIntoDB = $_GET['InsertIntoDB']; 
  $sql = "select * from outbox where InsertIntoDB like '%$InsertIntoDB%' order by InsertIntoDB"; 
} 
else if (isset($_GET['SendingDateTime']) and !empty($_GET['SendingDateTime'])){ 
 $SendingDateTime = $_GET['SendingDateTime']; 
  $sql = "select * from outbox where SendingDateTime like '%$SendingDateTime%' order by SendingDateTime"; 
} 
else if (isset($_GET['Text']) and !empty($_GET['Text'])){ 
 $Text = $_GET['Text']; 
  $sql = "select * from outbox where Text like '%$Text%' order by Text"; 
} 
else if (isset($_GET['DestinationNumber']) and !empty($_GET['DestinationNumber'])){ 
 $DestinationNumber = $_GET['DestinationNumber']; 
  $sql = "select * from outbox where DestinationNumber like '%$DestinationNumber%' order by DestinationNumber"; 
} 
else if (isset($_GET['Coding']) and !empty($_GET['Coding'])){ 
 $Coding = $_GET['Coding']; 
  $sql = "select * from outbox where Coding like '%$Coding%' order by Coding"; 
} 
else if (isset($_GET['UDH']) and !empty($_GET['UDH'])){ 
 $UDH = $_GET['UDH']; 
  $sql = "select * from outbox where UDH like '%$UDH%' order by UDH"; 
} 
else if (isset($_GET['Class']) and !empty($_GET['Class'])){ 
 $Class = $_GET['Class']; 
  $sql = "select * from outbox where Class like '%$Class%' order by Class"; 
} 
else if (isset($_GET['TextDecoded']) and !empty($_GET['TextDecoded'])){ 
 $TextDecoded = $_GET['TextDecoded']; 
  $sql = "select * from outbox where TextDecoded like '%$TextDecoded%' order by TextDecoded"; 
} 
else if (isset($_GET['ID']) and !empty($_GET['ID'])){ 
 $ID = $_GET['ID']; 
  $sql = "select * from outbox where ID like '%$ID%' order by ID"; 
} 
else if (isset($_GET['MultiPart']) and !empty($_GET['MultiPart'])){ 
 $MultiPart = $_GET['MultiPart']; 
  $sql = "select * from outbox where MultiPart like '%$MultiPart%' order by MultiPart"; 
} 
else if (isset($_GET['RelativeValidity']) and !empty($_GET['RelativeValidity'])){ 
 $RelativeValidity = $_GET['RelativeValidity']; 
  $sql = "select * from outbox where RelativeValidity like '%$RelativeValidity%' order by RelativeValidity"; 
} 
else if (isset($_GET['SenderID']) and !empty($_GET['SenderID'])){ 
 $SenderID = $_GET['SenderID']; 
  $sql = "select * from outbox where SenderID like '%$SenderID%' order by SenderID"; 
} 
else if (isset($_GET['SendingTimeOut']) and !empty($_GET['SendingTimeOut'])){ 
 $SendingTimeOut = $_GET['SendingTimeOut']; 
  $sql = "select * from outbox where SendingTimeOut like '%$SendingTimeOut%' order by SendingTimeOut"; 
} 
else if (isset($_GET['DeliveryReport']) and !empty($_GET['DeliveryReport'])){ 
 $DeliveryReport = $_GET['DeliveryReport']; 
  $sql = "select * from outbox where DeliveryReport like '%$DeliveryReport%' order by DeliveryReport"; 
} 
else if (isset($_GET['CreatorID']) and !empty($_GET['CreatorID'])){ 
 $CreatorID = $_GET['CreatorID']; 
  $sql = "select * from outbox where CreatorID like '%$CreatorID%' order by CreatorID"; 
} 
else{ 
  $sql = "select * from outbox"; 
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
     
<p class="judul">Daftar outbox </p> 
  <table id="outbox"   style="min-width:500px;"> 
  <tr> 
 <th>SendingDateTime</th>
<th>SendingNumber</th>
<th>TextDecoded</th>
<th>Aksi</th> 


  </tr> 
        <?php 
        //menampilkan data outbox 
        if(mysql_num_rows($result)!=0){ 
        while($row = mysql_fetch_array($result)){ ?>         
       <tr> 
  <td><? echo $row['SendingDateTime'];?></td>
<td><? echo $row['SendingNumber'];?></td>
<td><? echo $row['TextDecoded'];?></td>

 
        <td width="150px"> 
         <a href="outbox_detail.php?action=detail&id=<? echo $row['idoutbox'];?>" class="detail"> <input type="button" class="button" value="Detail"></a>   
       |  <a href="outbox_form.php?action=update&id=<? echo $row['idoutbox'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="outbox_process.php?action=delete&id=<? echo $row['idoutbox'];?>" class="delete"><input type="button" class="button" value="Delete"></a> 
         </td> 
         </tr> 
        <?} //end while ?> 
         <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
       <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <? }else{ ?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
    </table> 