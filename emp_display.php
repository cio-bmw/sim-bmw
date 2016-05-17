 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data emp sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idemp"){ 
    dataString = 'starting='+page+'&idemp='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "empasswd"){ 
    dataString = 'starting='+page+'&empasswd='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "empname"){ 
    dataString = 'starting='+page+'&empname='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "empphone"){ 
    dataString = 'starting='+page+'&empphone='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "gp"){ 
    dataString = 'starting='+page+'&gp='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "gs"){ 
    dataString = 'starting='+page+'&gs='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "mkt"){ 
    dataString = 'starting='+page+'&mkt='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "tch"){ 
    dataString = 'starting='+page+'&tch='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "acc"){ 
    dataString = 'starting='+page+'&acc='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "kpr"){ 
    dataString = 'starting='+page+'&kpr='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "adm"){ 
    dataString = 'starting='+page+'&adm='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"emp_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data emp, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idemp"){ 
      dataString = 'idemp='+ cari;  
   } 
   else if (combo == "empasswd"){ 
      dataString = 'empasswd='+ cari; 
    } 
   else if (combo == "empname"){ 
      dataString = 'empname='+ cari; 
    } 
   else if (combo == "empphone"){ 
      dataString = 'empphone='+ cari; 
    } 
   else if (combo == "gp"){ 
      dataString = 'gp='+ cari; 
    } 
   else if (combo == "gs"){ 
      dataString = 'gs='+ cari; 
    } 
   else if (combo == "mkt"){ 
      dataString = 'mkt='+ cari; 
    } 
   else if (combo == "tch"){ 
      dataString = 'tch='+ cari; 
    } 
   else if (combo == "acc"){ 
      dataString = 'acc='+ cari; 
    } 
   else if (combo == "kpr"){ 
      dataString = 'kpr='+ cari; 
    } 
   else if (combo == "adm"){ 
      dataString = 'adm='+ cari; 
    } 
 
  $.ajax({ 
    url: "emp_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#emp tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#emp tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
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
		if(confirm("Apakah benar akan menghapus data emp ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormEntry").load("emp_form.php"); 
						$("#divFormEntry").hide(); 
            alert("Data emp berhasil di hapus!"); 
					} 
					else{ 
						alert("data emp gagal di hapus!"); 
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
 
if (isset($_GET['idemp']) and !empty($_GET['idemp'])){ 
 $idemp = $_GET['idemp']; 
  $sql = "select * from emp where idemp like '%$idemp%' order by idemp"; 
} 
else if (isset($_GET['empasswd']) and !empty($_GET['empasswd'])){ 
 $empasswd = $_GET['empasswd']; 
  $sql = "select * from emp where empasswd like '%$empasswd%' order by empasswd"; 
} 
else if (isset($_GET['empname']) and !empty($_GET['empname'])){ 
 $empname = $_GET['empname']; 
  $sql = "select * from emp where empname like '%$empname%' order by empname"; 
} 
else if (isset($_GET['empphone']) and !empty($_GET['empphone'])){ 
 $empphone = $_GET['empphone']; 
  $sql = "select * from emp where empphone like '%$empphone%' order by empphone"; 
} 
else if (isset($_GET['gp']) and !empty($_GET['gp'])){ 
 $gp = $_GET['gp']; 
  $sql = "select * from emp where gp like '%$gp%' order by gp"; 
} 
else if (isset($_GET['gs']) and !empty($_GET['gs'])){ 
 $gs = $_GET['gs']; 
  $sql = "select * from emp where gs like '%$gs%' order by gs"; 
} 
else if (isset($_GET['mkt']) and !empty($_GET['mkt'])){ 
 $mkt = $_GET['mkt']; 
  $sql = "select * from emp where mkt like '%$mkt%' order by mkt"; 
} 
else if (isset($_GET['tch']) and !empty($_GET['tch'])){ 
 $tch = $_GET['tch']; 
  $sql = "select * from emp where tch like '%$tch%' order by tch"; 
} 
else if (isset($_GET['acc']) and !empty($_GET['acc'])){ 
 $acc = $_GET['acc']; 
  $sql = "select * from emp where acc like '%$acc%' order by acc"; 
} 
else if (isset($_GET['kpr']) and !empty($_GET['kpr'])){ 
 $kpr = $_GET['kpr']; 
  $sql = "select * from emp where kpr like '%$kpr%' order by kpr"; 
} 
else if (isset($_GET['adm']) and !empty($_GET['adm'])){ 
 $adm = $_GET['adm']; 
  $sql = "select * from emp where adm like '%$adm%' order by adm"; 
} 
else{ 
  $sql = "select * from emp"; 
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
	 
<p class="judul">Daftar Karyawan</p> 
  <table id="emp"> 
  <tr> 
 <th>ID Karyawan</th>
<th>Password</th>
<th>Nama Karyawan</th>
<th>Telp./HP</th>
<th>gp</th>
<th>gs</th>
<th>mkt</th>
<th>tch</th>
<th>acc</th>
<th>kpr</th>
<th>adm</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data emp 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idemp'];?></td>
<td><? echo $row['empasswd'];?></td>
<td><? echo $row['empname'];?></td>
<td><? echo $row['empphone'];?></td>
<td><? echo $row['gp'];?></td>
<td><? echo $row['gs'];?></td>
<td><? echo $row['mkt'];?></td>
<td><? echo $row['tch'];?></td>
<td><? echo $row['acc'];?></td>
<td><? echo $row['kpr'];?></td>
<td><? echo $row['adm'];?></td>
 
        <td width="175px"> 
         <a href="emp_detail.php?action=detail&id=<? echo $row['idemp'];?>" class="detail"> <input type="button" class="button" value="Detail"></a>   
       |  <a href="emp_form.php?action=update&id=<? echo $row['idemp'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="emp_process.php?action=delete&id=<? echo $row['idemp'];?>" class="delete"><input type="button" class="button" value="Delete"></a> 
         </td> 
         </tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <? }else{ ?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
