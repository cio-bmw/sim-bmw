 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data accbudget sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idaccbudget"){ 
    dataString = 'starting='+page+'&idaccbudget='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "tahun"){ 
    dataString = 'starting='+page+'&tahun='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "bulan"){ 
    dataString = 'starting='+page+'&bulan='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "budget"){ 
    dataString = 'starting='+page+'&budget='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "acc_idacc"){ 
    dataString = 'starting='+page+'&acc_idacc='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "saldoawal"){ 
    dataString = 'starting='+page+'&saldoawal='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "saldo"){ 
    dataString = 'starting='+page+'&saldo='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"accbudget_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data accbudget, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idaccbudget"){ 
      dataString = 'idaccbudget='+ cari;  
   } 
   else if (combo == "tahun"){ 
      dataString = 'tahun='+ cari; 
    } 
   else if (combo == "bulan"){ 
      dataString = 'bulan='+ cari; 
    } 
   else if (combo == "budget"){ 
      dataString = 'budget='+ cari; 
    } 
   else if (combo == "acc_idacc"){ 
      dataString = 'acc_idacc='+ cari; 
    } 
   else if (combo == "saldoawal"){ 
      dataString = 'saldoawal='+ cari; 
    } 
   else if (combo == "saldo"){ 
      dataString = 'saldo='+ cari; 
    } 
 
  $.ajax({ 
    url: "accbudget_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#accbudget tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#accbudget tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
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
		if(confirm("Apakah benar akan menghapus data accbudget ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormEntry").load("accbudget_form.php"); 
						$("#divFormEntry").hide(); 
            alert("Data accbudget berhasil di hapus!"); 
					} 
					else{ 
						alert("data accbudget gagal di hapus!"); 
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
 
if (isset($_GET['idaccbudget']) and !empty($_GET['idaccbudget'])){ 
 $idaccbudget = $_GET['idaccbudget']; 
  $sql = "select * from accbudget where idaccbudget like '%$idaccbudget%' order by idaccbudget"; 
} 
else if (isset($_GET['tahun']) and !empty($_GET['tahun'])){ 
 $tahun = $_GET['tahun']; 
  $sql = "select * from accbudget where tahun like '%$tahun%' order by tahun"; 
} 
else if (isset($_GET['bulan']) and !empty($_GET['bulan'])){ 
 $bulan = $_GET['bulan']; 
  $sql = "select * from accbudget where bulan like '%$bulan%' order by bulan"; 
} 
else if (isset($_GET['budget']) and !empty($_GET['budget'])){ 
 $budget = $_GET['budget']; 
  $sql = "select * from accbudget where budget like '%$budget%' order by budget"; 
} 
else if (isset($_GET['acc_idacc']) and !empty($_GET['acc_idacc'])){ 
 $acc_idacc = $_GET['acc_idacc']; 
  $sql = "select * from accbudget where acc_idacc like '%$acc_idacc%' order by acc_idacc"; 
} 
else if (isset($_GET['saldoawal']) and !empty($_GET['saldoawal'])){ 
 $saldoawal = $_GET['saldoawal']; 
  $sql = "select * from accbudget where saldoawal like '%$saldoawal%' order by saldoawal"; 
} 
else if (isset($_GET['saldo']) and !empty($_GET['saldo'])){ 
 $saldo = $_GET['saldo']; 
  $sql = "select * from accbudget where saldo like '%$saldo%' order by saldo"; 
} 
else{ 
  $sql = "select * from accbudget"; 
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
	 
<p class="judul">Daftar Budget Account </p> 
  <table id="accbudget"> 
  <tr> 
 <th>Id</th>
<th>Tahun</th>
<th>Bulan</th>
<th>No Account</th>
<th>Nama Account</th>
<th>Budget</th>
<th>Saldo awal</th>
<th>Saldo</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data accbudget 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){
$acc = accinfo($row['acc_idacc']);
$accname = $acc['accname'];  			
  			 ?>		 
       <tr> 
 <td><? echo $row['idaccbudget'];?></td>
<td><? echo $row['tahun'];?></td>
<td><? echo $row['bulan'];?></td>
<td><? echo $row['acc_idacc'];?></td>
<td><? echo $accname;?></td>
<td class="right" ><? echo nf($row['budget']);?></td>
<td class="right"><? echo nf($row['saldoawal']);?></td>
<td class="right"><? echo nf($row['saldo']);?></td>
 
        <td width="100px"> 
      <a href="accbudget_form.php?action=update&id=<? echo $row['idaccbudget'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="accbudget_process.php?action=delete&id=<? echo $row['idaccbudget'];?>" class="delete"><input type="button" class="button" value="Delete"></a> 
         </td> 
         </tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <? }else{ ?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
