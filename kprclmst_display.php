 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data kprclmst sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
      if (combo == "idkprclmst"){ 
    dataString = 'starting='+page+'&idkprclmst='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "kprclmst"){ 
    dataString = 'starting='+page+'&kprclmst='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "kprpct"){ 
    dataString = 'starting='+page+'&kprpct='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"kprclmst_display.php", 
    data: dataString, 
        type:"GET", 
        success:function(data) 
        { 
            $('#divPageData').html(data); 
        } 
  }); 
} 
 
// fungsi untuk me-load tampilan list data kprclmst, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
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
    url: "kprclmst_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#kprclmst tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#kprclmst tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
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
        if(confirm("Apakah benar akan menghapus data kprclmst ini?")) 
        { 
            $.ajax({ 
                url:$(this).attr("href"),  
                type:"GET", 
                dataType: 'json', //respon yang diminta dalam format JSON 
                success:function(response) 
                { 
                    if(response.status == 1){ 
                        loadData(); 
                        $("#divFormEntry").load("kprclmst_form.php"); 
                        $("#divFormEntry").hide(); 
            alert("Data kprclmst berhasil di hapus!"); 
                    } 
                    else{ 
                        alert("data kprclmst gagal di hapus!"); 
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
 
if (isset($_GET['idkprclmst']) and !empty($_GET['idkprclmst'])){ 
 $idkprclmst = $_GET['idkprclmst']; 
  $sql = "select * from kprclmst where idkprclmst like '%$idkprclmst%' order by idkprclmst"; 
} 
else if (isset($_GET['kprclmst']) and !empty($_GET['kprclmst'])){ 
 $kprclmst = $_GET['kprclmst']; 
  $sql = "select * from kprclmst where kprclmst like '%$kprclmst%' order by kprclmst"; 
} 
else if (isset($_GET['kprpct']) and !empty($_GET['kprpct'])){ 
 $kprpct = $_GET['kprpct']; 
  $sql = "select * from kprclmst where kprpct like '%$kprpct%' order by kprpct"; 
} 
else{ 
  $sql = "select * from kprclmst"; 
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
     
<p class="judul">Master Check List KPR </p>
  <table id="kprclmst"> 
  <tr> 
 <th>Id</th>
<th>Check List</th>
<th>Persen</th>
<th>Kprtime</th>
<th>Urutan</th>
<th>Aksi</th> 
  </tr> 
        <?php 
        //menampilkan data kprclmst 
        if(mysql_num_rows($result)!=0){ 
        while($row = mysql_fetch_array($result)){ ?>         
       <tr> 
 <td><? echo $row['idkprclmst'];?></td>
<td><? echo $row['kprclmst'];?></td>
<td><? echo $row['kprpct'];?></td>
<td><? echo $row['kprtime'];?></td>
<td><? echo $row['kprseq'];?></td>
 
        <td width="100px">
        <a href="kprclmst_form.php?action=update&id=<? echo $row['idkprclmst'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>
       | <a href="kprclmst_process.php?action=delete&id=<? echo $row['idkprclmst'];?>" class="delete"><input type="button" class="button" value="Delete"></a> 
         </td> 
         </tr> 
        <?} //end while ?> 
         <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
       <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <? }else{ ?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
    </table> 