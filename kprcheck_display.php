 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data kprcheck sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
      if (combo == "idkprcheck"){ 
    dataString = 'starting='+page+'&idkprcheck='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "startdate"){ 
    dataString = 'starting='+page+'&startdate='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "enddate"){ 
    dataString = 'starting='+page+'&enddate='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "unit_idunit"){ 
    dataString = 'starting='+page+'&unit_idunit='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "kprclmst_idkprclmst"){ 
    dataString = 'starting='+page+'&kprclmst_idkprclmst='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"kprcheck_display.php", 
    data: dataString, 
        type:"GET", 
        success:function(data) 
        { 
            $('#divPageData').html(data); 
        } 
  }); 
} 
 
// fungsi untuk me-load tampilan list data kprcheck, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
      if (combo == "idkprcheck"){ 
      dataString = 'idkprcheck='+ cari;  
   } 
   else if (combo == "startdate"){ 
      dataString = 'startdate='+ cari; 
    } 
   else if (combo == "enddate"){ 
      dataString = 'enddate='+ cari; 
    } 
   else if (combo == "unit_idunit"){ 
      dataString = 'unit_idunit='+ cari; 
    } 
   else if (combo == "kprclmst_idkprclmst"){ 
      dataString = 'kprclmst_idkprclmst='+ cari; 
    } 
 
  $.ajax({ 
    url: "kprcheck_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#kprcheck tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#kprcheck tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
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
        if(confirm("Apakah benar akan menghapus data kprcheck ini?")) 
        { 
            $.ajax({ 
                url:$(this).attr("href"),  
                type:"GET", 
                dataType: 'json', //respon yang diminta dalam format JSON 
                success:function(response) 
                { 
                    if(response.status == 1){ 
                        loadData(); 
                        $("#divFormEntry").load("kprcheck_form.php"); 
                        $("#divFormEntry").hide(); 
            alert("Data kprcheck berhasil di hapus!"); 
                    } 
                    else{ 
                        alert("data kprcheck gagal di hapus!"); 
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
 
if (isset($_GET['idkprcheck']) and !empty($_GET['idkprcheck'])){ 
 $idkprcheck = $_GET['idkprcheck']; 
  $sql = "select * from kprcheck where idkprcheck like '%$idkprcheck%' order by idkprcheck"; 
} 
else if (isset($_GET['startdate']) and !empty($_GET['startdate'])){ 
 $startdate = $_GET['startdate']; 
  $sql = "select * from kprcheck where startdate like '%$startdate%' order by startdate"; 
} 
else if (isset($_GET['enddate']) and !empty($_GET['enddate'])){ 
 $enddate = $_GET['enddate']; 
  $sql = "select * from kprcheck where enddate like '%$enddate%' order by enddate"; 
} 
else if (isset($_GET['unit_idunit']) and !empty($_GET['unit_idunit'])){ 
 $unit_idunit = $_GET['unit_idunit']; 
  $sql = "select * from kprcheck where unit_idunit like '%$unit_idunit%' order by unit_idunit"; 
} 
else if (isset($_GET['kprclmst_idkprclmst']) and !empty($_GET['kprclmst_idkprclmst'])){ 
 $kprclmst_idkprclmst = $_GET['kprclmst_idkprclmst']; 
  $sql = "select * from kprcheck where kprclmst_idkprclmst like '%$kprclmst_idkprclmst%' order by kprclmst_idkprclmst"; 
} 
else{ 
  $sql = "select * from kprcheck"; 
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
     
<p class="judul">Daftar kprcheck </p> 
  <table id="kprcheck"> 
  <tr> 
 <th>Id</th>
 <th>Unit</th>
<th>Mulai</th>
<th>Selesai</th>

<th>Aksi</th> 
  </tr> 
        <?php 
        //menampilkan data kprcheck 
        if(mysql_num_rows($result)!=0){ 
        while($row = mysql_fetch_array($result)){ ?>         
       <tr> 
 <td><? echo $row['idkprcheck'];?></td>
 <td><? echo $row['unit_idunit'];?></td>
<td><? echo $row['startdate'];?></td>
<td><? echo $row['enddate'];?></td>

 
        <td width="175px"> 
         <a href="kprcheck_detail.php?action=detail&id=<? echo $row['idkprcheck'];?>" class="detail"> <input type="button" class="button" value="Detail"></a>   
       |  <a href="kprcheck_form.php?action=update&id=<? echo $row['idkprcheck'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="kprcheck_process.php?action=delete&id=<? echo $row['idkprcheck'];?>" class="delete"><input type="button" class="button" value="Delete"></a> 
         </td> 
         </tr> 
        <?} //end while ?> 
         <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
       <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <? }else{ ?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
    </table> 