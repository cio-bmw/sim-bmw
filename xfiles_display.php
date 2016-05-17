 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data xfiles sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idxfiles"){ 
    dataString = 'starting='+page+'&idxfiles='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "xfilesname"){ 
    dataString = 'starting='+page+'&xfilesname='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "xfilesdesc"){ 
    dataString = 'starting='+page+'&xfilesdesc='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "xfilesdate"){ 
    dataString = 'starting='+page+'&xfilesdate='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "emp_idemp"){ 
    dataString = 'starting='+page+'&emp_idemp='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"xfiles_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data xfiles, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idxfiles"){ 
      dataString = 'idxfiles='+ cari;  
   } 
   else if (combo == "xfilesname"){ 
      dataString = 'xfilesname='+ cari; 
    } 
   else if (combo == "xfilesdesc"){ 
      dataString = 'xfilesdesc='+ cari; 
    } 
   else if (combo == "xfilesdate"){ 
      dataString = 'xfilesdate='+ cari; 
    } 
   else if (combo == "emp_idemp"){ 
      dataString = 'emp_idemp='+ cari; 
    } 
 
  $.ajax({ 
    url: "xfiles_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#xfiles tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#xfiles tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data xfiles ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("xfiles_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data xfiles berhasil di hapus!"); 
					} 
					else{ 
						alert("data xfiles gagal di hapus!"); 
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
 
if (isset($_GET['idxfiles']) and !empty($_GET['idxfiles'])){ 
 $idxfiles = $_GET['idxfiles']; 
  $sql = "select * from xfiles where idxfiles like '%$idxfiles%' order by idxfiles"; 
} 
else if (isset($_GET['xfilesname']) and !empty($_GET['xfilesname'])){ 
 $xfilesname = $_GET['xfilesname']; 
  $sql = "select * from xfiles where xfilesname like '%$xfilesname%' order by xfilesname"; 
} 
else if (isset($_GET['xfilesdesc']) and !empty($_GET['xfilesdesc'])){ 
 $xfilesdesc = $_GET['xfilesdesc']; 
  $sql = "select * from xfiles where xfilesdesc like '%$xfilesdesc%' order by xfilesdesc"; 
} 
else if (isset($_GET['xfilesdate']) and !empty($_GET['xfilesdate'])){ 
 $xfilesdate = $_GET['xfilesdate']; 
  $sql = "select * from xfiles where xfilesdate like '%$xfilesdate%' order by xfilesdate"; 
} 
else if (isset($_GET['emp_idemp']) and !empty($_GET['emp_idemp'])){ 
 $emp_idemp = $_GET['emp_idemp']; 
  $sql = "select * from xfiles where emp_idemp like '%$emp_idemp%' order by emp_idemp"; 
} 
else{ 
  $sql = "select * from xfiles"; 
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
	 
  <table id="xfiles"> 
  <tr> 
 <th>idxfiles</th>
<th>xfilesname</th>
<th>xfilesdesc</th>
<th>xfilesdate</th>
<th>emp_idemp</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data xfiles 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idxfiles'];?></td>
<td><? echo $row['xfilesname'];?></td>
<td><? echo $row['xfilesdesc'];?></td>
<td><? echo $row['xfilesdate'];?></td>
<td><? echo $row['emp_idemp'];?></td>
 
        <td><a href="xfiles_form.php?action=update&id=<? echo $row['idxfiles'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="xfiles_process.php?action=delete&id=<? echo $row['idxfiles'];?>" class="delete"><input type="button" class="button" value="Delete"></a></td></tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
