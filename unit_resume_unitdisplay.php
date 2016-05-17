 <script type="text/javascript">  
function pagination(page){ 
     var dataString; 
	  var cari = $("select#sektor_idsektor").val(); 
	
	   
     dataString = 'starting='+page+'&sektor_idsektor='+ cari+'&random='+Math.random();; 

  $.ajax({ 
    url:"unit_resume_unitdisplay.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data unit, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
      var dataString; 
	  var cari = $("select#sektor_idsektor").val(); 
	 
	   
     dataString = 'starting='+page+'&sektor_idsektor='+ cari+'&random='+Math.random();; 

 
  $.ajax({ 
    url: "unit_resume_unitdisplay.php", //file tempat pemrosesan permintaan (request) 
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
  $('#unit tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#unit tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
  $("a.detail").click(function(){ 
  window.location='unit_detail.php';
  }); 
	
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data unit ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("unit_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data unit berhasil di hapus!"); 
					} 
					else{ 
						alert("data unit gagal di hapus!"); 
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
 
$sektor_idsektor = $_GET['sektor_idsektor']; 
 
 
if ($sektor_idsektor=='%')  {
$sql = "select * from unit order by  kavling";
 } else { 
 $sql = "select * from unit where sektor_idsektor = '$sektor_idsektor'  order by  kavling";
 }
  
 
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = 10;//jumlah data yang ditampilkan per page(halaman) 
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
 <p class="judul">Resume Progress Unit</p>
 <table id="unit"> 
<tr>
<td colspan="6" align="center">DATA UMUM</td>
<td colspan="2" align="center">KONSTRUKSI</td>
<td colspan="4" align="center">SPK</td>
<td colspan="3" align="center">MATERIAL</td>
</tr> 
 
  <tr> 
 <th>ID</th>
 <th >Sektor</th>
<th>Kavling</th>
<th>tipe</th>
<th>L Tanah</th>
<th>Harga</th>
<th>Total</th>
<th>Harga/M2</th>
<th>SPK</th>
<th>BON</th>
<th>%</th>
<th>Progres(%)</th>
<th>RAB</th>
<th>Progres</th>
<th>%</th>

  </tr> 
		<?php 
		//menampilkan data unit 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ 
  		$sektor =sektorinfo($row['sektor_idsektor']);
  		$sektorname = $sektor['sektorname'];
      $idunit = $row['idunit'];   		
  		
$sql1 = "select sum(spkvalue) spk from unitspk where unit_idunit = '$idunit'";  		
$result1 = mysql_query($sql1);
$data1 = mysql_fetch_array($result1);
$totspk = $data1[0];


$sql2 = "select sum(qty*sales_price) mtrl from slsdtlunit a, slshdrunit b  where a.slshdrunit_idslshdr = b.idslshdr 
and unit_idunit = '$idunit'";  		
$result2 = mysql_query($sql2);
$data2 = mysql_fetch_array($result2);
$totmtrl = $data2[0];
  		
$totbiaya = $totspk + $totmtrl;  		

if ($row['luastanah'] <> '') {
$hargam2 = $totbiaya /$row['luastanah'];  
} 		
   		
$sql3 = "select sum(payvalue) bon from spkpaymentdtl a,unitspk  b where a.unitspk_idunitspk = b.idunitspk 
and unit_idunit = '$idunit'";  		
$result3 = mysql_query($sql3);
$data3 = mysql_fetch_array($result3);
$totbonspk = $data3[0];

if ($totsok <> '') {
$pctspk=nf($totbonspk/$totspk*100);
}

$sql4 = "select sum(budget_qty*price) rab from unit_materialbudget  where  unit_idunit = '$idunit'";  		
$result4 = mysql_query($sql4);
$data4 = mysql_fetch_array($result4);
$totrab = $data4[0];

if ($totrab <> '') {
$pctrab = nf($totmtrl / $totrab *100);
}
$sql5 = "select sum(bobotpct*progress) pctprogress from unitclbangun  where  unit_idunit = '$idunit'";  		
$result5 = mysql_query($sql5);
$data5 = mysql_fetch_array($result5);
$pctprogress = $data5[0]/100;

  		
  		
  		?>		 
       <tr> 
       
       
 <td><? echo $row['idunit'];?></td>

<td><? echo $sektorname;?></td>
<td><? echo $row['kavling'];?></td>
<td><? echo $row['tipe'];?></td>
<td><? echo $row['luastanah'];?></td>
<td class="right"><? echo nf($row['nkontrakuser']);?></td>
<td class="right"><? echo nf($totbiaya);?></td>
<td class="right"><? echo nf($hargam2);?></td>
<td class="right"><? echo nf($totspk);?></td>
<td class="right"><? echo nf($totbonspk);?></td>
<td class="right"><? echo nf($pctspk);?></td>
<td class="right"><? echo nf($pctprogress);?></td>
<td class="right"><? echo nf($totrab);?></td>
<td class="right"><? echo nf($totmtrl);?></td>
<td class="right"><? echo nf($pctrab);?></td>
        
       </tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="15"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="15"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="15">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
</body>	
</html>
	 </div>
</div>
