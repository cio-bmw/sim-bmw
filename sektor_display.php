 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data sektor sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idsektor"){ 
    dataString = 'starting='+page+'&idsektor='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "sektorname"){ 
    dataString = 'starting='+page+'&sektorname='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "address"){ 
    dataString = 'starting='+page+'&address='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "emp_idempmkt"){ 
    dataString = 'starting='+page+'&emp_idempmkt='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "emp_idempgdg"){ 
    dataString = 'starting='+page+'&emp_idempgdg='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "front_img"){ 
    dataString = 'starting='+page+'&front_img='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "map_img"){ 
    dataString = 'starting='+page+'&map_img='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "siteplan_img"){ 
    dataString = 'starting='+page+'&siteplan_img='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"sektor_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data sektor, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idsektor"){ 
      dataString = 'idsektor='+ cari;  
   } 
   else if (combo == "sektorname"){ 
      dataString = 'sektorname='+ cari; 
    } 
   else if (combo == "address"){ 
      dataString = 'address='+ cari; 
    } 
   else if (combo == "emp_idempmkt"){ 
      dataString = 'emp_idempmkt='+ cari; 
    } 
   else if (combo == "emp_idempgdg"){ 
      dataString = 'emp_idempgdg='+ cari; 
    } 
   else if (combo == "front_img"){ 
      dataString = 'front_img='+ cari; 
    } 
   else if (combo == "map_img"){ 
      dataString = 'map_img='+ cari; 
    } 
   else if (combo == "siteplan_img"){ 
      dataString = 'siteplan_img='+ cari; 
    } 
 
  $.ajax({ 
    url: "sektor_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#sektor tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#sektor tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data sektor ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("sektor_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data sektor berhasil di hapus!"); 
					} 
					else{ 
						alert("data sektor gagal di hapus!"); 
					} 
				} 
			}); 
		} 
		return false; 
	}); 

 $(".wmd-view-topscroll").scroll(function(){
        $(".wmd-view")
            .scrollLeft($(".wmd-view-topscroll").scrollLeft());
    });
    $(".wmd-view").scroll(function(){
        $(".wmd-view-topscroll")
            .scrollLeft($(".wmd-view").scrollLeft());
    });
	 
}); 
 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class.php'); 
 
if (isset($_GET['idsektor']) and !empty($_GET['idsektor'])){ 
 $idsektor = $_GET['idsektor']; 
  $sql = "select * from sektor where idsektor like '%$idsektor%' order by idsektor"; 
} 
else if (isset($_GET['sektorname']) and !empty($_GET['sektorname'])){ 
 $sektorname = $_GET['sektorname']; 
  $sql = "select * from sektor where sektorname like '%$sektorname%' order by sektorname"; 
} 
else if (isset($_GET['address']) and !empty($_GET['address'])){ 
 $address = $_GET['address']; 
  $sql = "select * from sektor where address like '%$address%' order by address"; 
} 
else if (isset($_GET['emp_idempmkt']) and !empty($_GET['emp_idempmkt'])){ 
 $emp_idempmkt = $_GET['emp_idempmkt']; 
  $sql = "select * from sektor where emp_idempmkt like '%$emp_idempmkt%' order by emp_idempmkt"; 
} 
else if (isset($_GET['emp_idempgdg']) and !empty($_GET['emp_idempgdg'])){ 
 $emp_idempgdg = $_GET['emp_idempgdg']; 
  $sql = "select * from sektor where emp_idempgdg like '%$emp_idempgdg%' order by emp_idempgdg"; 
} 
else if (isset($_GET['front_img']) and !empty($_GET['front_img'])){ 
 $front_img = $_GET['front_img']; 
  $sql = "select * from sektor where front_img like '%$front_img%' order by front_img"; 
} 
else if (isset($_GET['map_img']) and !empty($_GET['map_img'])){ 
 $map_img = $_GET['map_img']; 
  $sql = "select * from sektor where map_img like '%$map_img%' order by map_img"; 
} 
else if (isset($_GET['siteplan_img']) and !empty($_GET['siteplan_img'])){ 
 $siteplan_img = $_GET['siteplan_img']; 
  $sql = "select * from sektor where siteplan_img like '%$siteplan_img%' order by siteplan_img"; 
} 
else{ 
  $sql = "select * from sektor"; 
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

<div class="wmd-view-topscroll">
    <div class="scroll-div1" style=" width: 2800px;">
    </div>
</div>
<div class="wmd-view" style="height: 500px;">
    <div class="scroll-div2" style=" width: 2800px; ">
<html>    
<body>	 
<p class="judul">Daftar Sektor </p>
	 
  <table id="sektor"> 
  <tr> 
 <th>Kode</th>
<th>Nama Sektor</th>
<th>Aksi</th> 
<th>Jumlah Unit</th>
<th>Terjual</th>
<th>PJB</th>
<th>Gambar</th>
<th>SPK</th>
<th>SP3</th>
<th>Bangun</th>
<th>SPH</th>
<th>KPR</th>
<th>STK</th>
<th>SHG</th>

<th>Alamat</th>
<th>PIC Marketing</th>
<th>PIC Gudang</th>

  </tr> 
		<?php 
		//menampilkan data sektor 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){
  			
$sqlj="select count(*) jml from unit where sektor_idsektor ='".$row['idsektor']."'";
$resultj= mysql_query($sqlj);
$dataj= mysql_fetch_array($resultj);  			
$jmlunit = $dataj['jml'];  		

$sqls="select count(*) jml from unit where jual='sudah'  and sektor_idsektor ='".$row['idsektor']."'";
$results= mysql_query($sqls);
$datas= mysql_fetch_array($results);  			
$unitsale = $datas['jml'];  		

$sqlp="select count(*) jml from unit where pjb='sudah'  and sektor_idsektor ='".$row['idsektor']."'";
$resultp= mysql_query($sqlp);
$datap= mysql_fetch_array($resultp);  			
$pjb = $datap['jml'];  		

$sqlg="select count(*) jml from unit where gambar='sudah'  and sektor_idsektor ='".$row['idsektor']."'";
$resultg= mysql_query($sqlg);
$datag= mysql_fetch_array($resultg);  			
$gambar = $datag['jml'];  		

$sqlk="select count(*) jml from unit where spk='sudah'  and sektor_idsektor ='".$row['idsektor']."'";
$resultk= mysql_query($sqlk);
$datak= mysql_fetch_array($resultk);  			
$spk = $datak['jml'];  		

$sql3="select count(*) jml from unit where sp3='sudah'  and sektor_idsektor ='".$row['idsektor']."'";
$result3= mysql_query($sql3);
$data3= mysql_fetch_array($result3);  			
$sp3 = $data3['jml'];  		

$sqlb="select count(*) jml from unit where bangun='proses' and sektor_idsektor ='".$row['idsektor']."'";
$resultb= mysql_query($sqlb);
$datab= mysql_fetch_array($resultb);  			
$bangun = $datab['jml'];  		

$sqlh="select count(*) jml from unit where sph='sudah'  and sektor_idsektor ='".$row['idsektor']."'";
$resulth= mysql_query($sqlh);
$datah= mysql_fetch_array($resulth);  			
$sph = $datah['jml'];  		

$sqlr="select count(*) jml from unit where sph='sudah'  and sektor_idsektor ='".$row['idsektor']."'";
$resultr= mysql_query($sqlr);
$datar= mysql_fetch_array($resultr);  			
$kpr = $datar['jml'];  		

$sqlt="select count(*) jml from unit where sph='sudah'  and sektor_idsektor ='".$row['idsektor']."'";
$resultt= mysql_query($sqlt);
$datat= mysql_fetch_array($resultt);  			
$stk = $datat['jml'];  		
	
$sqlhg="select count(*) jml from unit where sph='sudah'  and sektor_idsektor ='".$row['idsektor']."'";
$resulthg= mysql_query($sqlhg);
$datahg= mysql_fetch_array($resulthg);  			
$shg = $datahg['jml'];  		

	
	
	
	 ?>		 
       <tr> 
 <td><? echo $row['idsektor'];?></td>
<td><? echo $row['sektorname'];?></td>
        <td>
        <a href="sektor_detail.php?action=update&id=<? echo $row['idsektor'];?>" class="detail"> <input type="button" class="button" value="Detail"></a>   
       | <a href="sektor_form.php?action=update&id=<? echo $row['idsektor'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="sektor_process.php?action=delete&id=<? echo $row['idsektor'];?>" class="delete"><input type="button" class="button" value="Delete"></a></td>
<td class="right"><? echo $jmlunit;?></td>
<td class="right"><? echo $unitsale;?></td>
<td class="right"><? echo $pjb;?></td>
<td class="right"><? echo $gambar;?></td>
<td class="right"><? echo $spk;?></td>
<td class="right"><? echo $sp3;?></td>
<td class="right"><? echo $bangun;?></td>
<td class="right"><? echo $sph;?></td>
<td class="right"><? echo $kpr;?></td>
<td class="right"><? echo $stk;?></td>
<td class="right"><? echo $shg;?></td>



<td><? echo $row['address'];?></td>
<td><? echo $row['emp_idempmkt'];?></td>
<td><? echo $row['emp_idempgdg'];?></td>

 
       
       </tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
	</body>	
</html>
	 </div>
</div>
