 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data kpr sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
      if (combo == "idkpr"){ 
    dataString = 'starting='+page+'&idkpr='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "kprname"){ 
    dataString = 'starting='+page+'&kprname='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"kpr_display.php", 
    data: dataString, 
        type:"GET", 
        success:function(data) 
        { 
            $('#divPageData').html(data); 
        } 
  }); 
} 
 
// fungsi untuk me-load tampilan list data kpr, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
      if (combo == "idkpr"){ 
      dataString = 'idkpr='+ cari;  
   } 
   else if (combo == "kprname"){ 
      dataString = 'kprname='+ cari; 
    } 
 
  $.ajax({ 
    url: "kpr_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#kpr tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#kpr tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
    $("a.edit").click(function(){ 
        page=$(this).attr("href"); 
        $("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
        $("#divPageData").show(); 
        $("#btnhide").show(); 
        return false; 
    }); 
     
    $("a.delete").click(function(){ 
        el=$(this); 
        if(confirm("Apakah benar akan menghapus data kpr ini?")) 
        { 
            $.ajax({ 
                url:$(this).attr("href"),  
                type:"GET", 
                dataType: 'json', //respon yang diminta dalam format JSON 
                success:function(response) 
                { 
                    if(response.status == 1){ 
                        loadData(); 
                        $("#divFormContent").load("kpr_form.php"); 
                        $("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data kpr berhasil di hapus!"); 
                    } 
                    else{ 
                        alert("data kpr gagal di hapus!"); 
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
 
if (isset($_GET['idkpr']) and !empty($_GET['idkpr'])){ 
 $idkpr = $_GET['idkpr']; 
  $sql = "select * from kpr where idkpr like '%$idkpr%' order by idkpr"; 
} 
else if (isset($_GET['kprname']) and !empty($_GET['kprname'])){ 
 $kprname = $_GET['kprname']; 
  $sql = "select * from kpr where kprname like '%$kprname%' order by kprname"; 
} 
else{ 
  $sql = "select * from kpr"; 
} 
 
if(isset($_GET['starting'])){ //starting page 
    $starting=$_GET['starting']; 
}else{ 
    $starting=0; 
} 
 
$recpage = 25;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class($sql,$starting,$recpage);        
$result = $obj->result; 
?> 
     
  <table id="kpr"> 
  <tr> 
 <th>idkpr</th>
<th>kprname</th>
<th>Aksi</th> 
  </tr> 
        <?php 
        //menampilkan data kpr 
        if(mysql_num_rows($result)!=0){ 
        while($row = mysql_fetch_array($result)){ ?>         
       <tr> 
 <td><? echo $row['idkpr'];?></td>
<td><? echo $row['kprname'];?></td>
 
        <td><a href="kpr_form.php?action=update&id=<? echo $row['idkpr'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="kpr_process.php?action=delete&id=<? echo $row['idkpr'];?>" class="delete"><input type="button" class="button" value="Delete"></a></td></tr> 
        <?} //end while ?> 
         <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
       <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
    </table> 