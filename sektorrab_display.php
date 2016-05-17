 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data sektorrab sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var vcari = $("select#carisektor").val(); 
  
  dataString = 'starting='+page+'&idsektor='+vcari+'&random='+Math.random(); 
    
  $.ajax({ 
    url:"sektorrab_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data sektorrab, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var vcari = $("select#carisektor").val(); 
  
  dataString = 'idsektor='+ vcari;  
  
 
  $.ajax({ 
    url: "sektorrab_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#sektorrab tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#sektorrab tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data sektorrab ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("sektorrab_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data sektorrab berhasil di hapus!"); 
					} 
					else{ 
						alert("data sektorrab gagal di hapus!"); 
					} 
				} 
			}); 
		} 
		return false; 
	}); 
	$("#btnimport").click(function(){ 
	    window.open("sektorrab_import.php?id="+$("select#carisektor").val(),"_blank"); 
	loadData();    
	});  
	
	$("#btncetak").click(function(){ 
	    window.open("sektorrab_pdf.php?id="+$("select#carisektor").val(),"_blank"); 
	loadData();    
	});  
}); 
 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class.php'); 
$sektor_idsektor = $_GET['id']; 
$sektor=sektorinfo($_GET['id']);
$sektorname = $sektor['sektorname'];
?> 

<table>
 <tr><td> 
RAB Sektor &nbsp; <? echo $sektorname; ?>
</td>
<td width="100px">
<input type="button" id="btncetak" value="Cetak RAB">
</td>
<td width="100px">
<input type="button" id="btnimport" value="Import RAB">
</td>
</tr>  

<?
$totalallcat=0; $totalallacc=0;

$sql0 = "select * from rabcat";
$result0 = mysql_query($sql0);
while($row0= mysql_fetch_array($result0)) { 
$idrabcat = $row0['idrabcat'];
?>

<tr>
<td colspan="3"><b>
<? echo $row0['rabcatname']; ?></b>
</td>
</tr>
 <tr><td colspan="3">
 
 
<? 
$sql = "select * from sektorrab a, rabmst b 
where a.rabmst_idrabmst = b.idrabmst and 
b.rabcat_idrabcat = '$idrabcat' and 
sektor_idsektor ='$sektor_idsektor' order by rabmst_idrabmst"; 


$sektor=sektorinfo($_GET['id']);
$sektorname = $sektor['sektorname'];
 
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = 25;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class($sql,$starting,$recpage);		 
$result = $obj->result; 
?> 
	 
  <table id="sektorrab" class="grid"> 

  
  
  <tr> 
 <th width="20px">No <? echo $_GET['idsektor']; ?></th>
<th >Keterangan</th>
<th width="100px">volume</th>
<th width="100px">hargasat</th>
<th width="100px">Total</th>
<th width="100px">Akumulasi</th>
<th width="30px">%</th>
<th width="100px">Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data sektorrab 
		if(mysql_num_rows($result)!=0){ 
		$no=1;
		$totalcat = 0; $totalacc =0;
  		while($row = mysql_fetch_array($result)){ 
$idrabmst = $row['rabmst_idrabmst'];  		
$rabmst = rabmstinfo($row['rabmst_idrabmst']);
$rabdesc = $rabmst['rabdesc'];  
	

//$sql1 = "select IFNULL(sum(costprice),0) jml from sektorcostdtl a, sektorcosthdr b
//where a.sektorcosthdr_idsektorcosthdr = b.idsektorcosthdr and 
//a.rabmst_idrabmst = '$idrabmst' and b.sektor_idsektor = '$sektor_idsektor' "; 

$sql1 = "select IFNULL(sum(txnvalue),0) jml from sektorrabtxn
where rabmst_idrabmst = '$idrabmst' and sektor_idsektor = '$sektor_idsektor' "; 
$data1  = mysql_fetch_array(mysql_query($sql1));  
$jumlah = $data1[0];	 

$total = $row['volume']*$row['hargasat'];	 		
//$pct = $jumlah/$total*100;
$totalcat = $totalcat + $total; 
$totalacc = $totalacc + $jumlah;

$totalallcat = $totalallcat + $total;
$totalallacc = $totalallacc + $jumlah;

$pct = $jumlah/$total*100;
  		?>		 
       <tr> 
 <td width="20px"><? echo $no;?></td>

<td><? echo $rabdesc;?></td>
<td class="right" width="100px"><? echo nf($row['volume']);?></td>
<td class="right" width="100px"><? echo nf($row['hargasat']);?></td>
<td class="right" width="100px"><? echo nf($total);?></td>

<? if ($pct < 50) { ?>
<td  class="right" width="100px" bgcolor="#41FF08"><? echo nf($jumlah);?></td>
<? } elseif ($pct < 90 and $pct > 51) { ?>
<td  class="right" width="100px"  bgcolor="#FFFF05"><? echo nf($jumlah);?></td>	
<?	} else { ?>
<td  class="right" width="100px"  bgcolor="#FF0000"><? echo nf($jumlah);?></td>	
<? } ?>
<td  class="right" width="30px"><? echo nf($pct);?></td>

 
        <td width="170px">
        <a href="sektorrab_breakdown.php?rab=<? echo $idrabmst;?>&sektor=<? echo $sektor_idsektor;?>" class="edit"> <input type="button" class="button" value="Detail"></a>   
       | <a href="sektorrab_form.php?action=update&ids=<? echo $row['idsektorrab'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="sektorrab_process.php?action=delete&ids=<? echo $row['idsektorrab'];?>" class="delete"><input type="button" class="button" value="Delete"></a>
       
       </td></tr> 
  		<?  
  		$no++;
  		
  		} 		
  		//end while ?> 
  		
<tr><td  class="right" width="30px" colspan="5"><? echo nf($totalcat);?></td><td class="right"><? echo nf($totalacc);?></td></tr>
  
	    <?}else{?> 
   <tr><td align="center" colspan="7">Data tidak ditemukan!</td></tr> 
    <?}?> 
    
    	</table> 
<? } ?>
</td></tr>
</table>
<table class="grid">
<tr><td  class="right" width="30px" colspan="3"><? echo nf($totalallcat);?></td><td class="right"><? echo nf($totalallacc);?></td></tr>
</table>
