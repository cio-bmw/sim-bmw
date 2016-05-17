 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data custpayhdr sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idcustpayhdr"){ 
    dataString = 'starting='+page+'&idcustpayhdr='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "pay_date"){ 
    dataString = 'starting='+page+'&pay_date='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "unit_idunit"){ 
    dataString = 'starting='+page+'&unit_idunit='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "emp_idemp"){ 
    dataString = 'starting='+page+'&emp_idemp='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"custpayhdr_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data custpayhdr, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idcustpayhdr"){ 
      dataString = 'idcustpayhdr='+ cari;  
   } 
   else if (combo == "pay_date"){ 
      dataString = 'pay_date='+ cari; 
    } 
   else if (combo == "unit_idunit"){ 
      dataString = 'unit_idunit='+ cari; 
    } 
   else if (combo == "emp_idemp"){ 
      dataString = 'emp_idemp='+ cari; 
    } 
 
  $.ajax({ 
    url: "custpayhdr_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#custpayhdr tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#custpayhdr tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data custpayhdr ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("custpayhdr_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data custpayhdr berhasil di hapus!"); 
					} 
					else{ 
						alert("data custpayhdr gagal di hapus!"); 
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
 
if (isset($_GET['idcustpayhdr']) and !empty($_GET['idcustpayhdr'])){ 
 $idcustpayhdr = $_GET['idcustpayhdr']; 
  $sql = "select * from custpayhdr where idcustpayhdr like '%$idcustpayhdr%' order by idcustpayhdr"; 
} 
else if (isset($_GET['pay_date']) and !empty($_GET['pay_date'])){ 
 $pay_date = $_GET['pay_date']; 
  $sql = "select * from custpayhdr where pay_date like '%$pay_date%' order by pay_date"; 
} 
else if (isset($_GET['unit_idunit']) and !empty($_GET['unit_idunit'])){ 
 $unit_idunit = $_GET['unit_idunit']; 
  $sql = "select * from custpayhdr where unit_idunit like '%$unit_idunit%' order by unit_idunit"; 
} 
else if (isset($_GET['emp_idemp']) and !empty($_GET['emp_idemp'])){ 
 $emp_idemp = $_GET['emp_idemp']; 
  $sql = "select * from custpayhdr where emp_idemp like '%$emp_idemp%' order by emp_idemp"; 
} 
else{ 
  $sql = "select * from custpayhdr"; 
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
	 
  <table id="custpayhdr"> 
  <tr> 
 <th>idcustpayhdr</th>
<th>pay_date</th>
<th>unit_idunit</th>
<th>emp_idemp</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data custpayhdr 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idcustpayhdr'];?></td>
<td><? echo $row['pay_date'];?></td>
<td><? echo $row['unit_idunit'];?></td>
<td><? echo $row['emp_idemp'];?></td>
 
        <td><a href="custpayhdr_form.php?action=update&id=<? echo $row['idcustpayhdr'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="custpayhdr_process.php?action=delete&id=<? echo $row['idcustpayhdr'];?>" class="delete"><input type="button" class="button" value="Delete"></a></td></tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
