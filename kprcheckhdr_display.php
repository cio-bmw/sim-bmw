 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data kprcheckhdr sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idkprcheckhdr"){ 
    dataString = 'starting='+page+'&idkprcheckhdr='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "startdate"){ 
    dataString = 'starting='+page+'&startdate='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "pic"){ 
    dataString = 'starting='+page+'&pic='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "bankname"){ 
    dataString = 'starting='+page+'&bankname='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "notaris"){ 
    dataString = 'starting='+page+'&notaris='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "unit_idunit"){ 
    dataString = 'starting='+page+'&unit_idunit='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"kprcheckhdr_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data kprcheckhdr, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idkprcheckhdr"){ 
      dataString = 'idkprcheckhdr='+ cari;  
   } 
   else if (combo == "startdate"){ 
      dataString = 'startdate='+ cari; 
    } 
   else if (combo == "pic"){ 
      dataString = 'pic='+ cari; 
    } 
   else if (combo == "bankname"){ 
      dataString = 'bankname='+ cari; 
    } 
   else if (combo == "notaris"){ 
      dataString = 'notaris='+ cari; 
    } 
   else if (combo == "unit_idunit"){ 
      dataString = 'unit_idunit='+ cari; 
    } 
 
  $.ajax({ 
    url: "kprcheckhdr_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#kprcheckhdr tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#kprcheckhdr tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
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
		if(confirm("Apakah benar akan menghapus data kprcheckhdr ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormEntry").load("kprcheckhdr_form.php"); 
						$("#divFormEntry").hide(); 
            alert("Data kprcheckhdr berhasil di hapus!"); 
					} 
					else{ 
						alert("data kprcheckhdr gagal di hapus!"); 
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
 

  $sql = "select * from kprcheckhdr order by idkprcheckhdr desc"; 
 
 
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = 15;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class($sql,$starting,$recpage);		 
$result = $obj->result; 
?> 
	 
<p class="judul">Daftar kprcheckhdr </p> 
  <table id="kprcheckhdr"> 
  <tr> 
 <th>idkprcheckhdr</th>
<th>startdate</th>
<th>pic</th>
<th>bankname</th>
<th>notaris</th>
<th>unit_idunit</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data kprcheckhdr 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idkprcheckhdr'];?></td>
<td><? echo gettanggal($row['startdate']);?></td>
<td><? echo $row['pic'];?></td>
<td><? echo $row['bankname'];?></td>
<td><? echo $row['notaris'];?></td>
<td><? echo $row['unit_idunit'];?></td>
 
        <td width="175px"> 
         <a href="kprcheckhdr_detail.php?action=detail&id=<? echo $row['idkprcheckhdr'];?>" class="detail"> <input type="button" class="button" value="Detail"></a>   
       |  <a href="kprcheckhdr_form.php?action=update&id=<? echo $row['idkprcheckhdr'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="kprcheckhdr_process.php?action=delete&id=<? echo $row['idkprcheckhdr'];?>" class="delete"><input type="button" class="button" value="Delete"></a> 
         </td> 
         </tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <? }else{ ?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
