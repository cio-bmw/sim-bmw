 <script type="text/javascript">  
function pagination(page){ 
     var dataString; 
	  var cari = $("select#sektor_idsektor").val(); 
	
	   
     dataString = 'starting='+page+'&sektor_idsektor='+ cari+'&random='+Math.random();; 

  $.ajax({ 
    url:"unit_progress_unitdisplay.php", 
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
    url: "unit_progress_unitdisplay.php", //file tempat pemrosesan permintaan (request) 
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
$sql = "select * from unit where bangun ='proses' order by  kavling"; 
 } else { 
 $sql = "select * from unit where sektor_idsektor = '$sektor_idsektor' 
  and bangun = 'proses' order by  kavling";
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
<html>    
<body>	 
 <table id="unit" class="grid"> 
  <tr> 
  <th>Aksi</th> 
 <th colspan=2>Sektor</th>
 <th>Unit</th>
<th>Kavling</th>
<th>Type</th>
<th>Luas Tanah</th>
<th>Pemilik</th>
<th>Progres (%)</th>

  </tr> 
		<?php 
		//menampilkan data unit 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ 
  		$sektor =sektorinfo($row['sektor_idsektor']);
  		$sektorname = $sektor['sektorname'];
       $idunit = $row['idunit'];  		
  		
      $sqlp = "select IFNULL(sum(bobotpct),0) pct from unitclbangun  where unit_idunit = '$idunit' and clstatus='sudah'";  		
      $resultp = mysql_query($sqlp);
      $datap = mysql_fetch_array($resultp);
      $progress = $datap[0];    		
  		
  		
  		?>		 
       <tr> 
       <td width=75px>
        <a href="unit_progress_detail.php?action=update&id=<? echo $row['idunit'];?>" class="detail"> <input type="button" class="button" value="Progres Detail"></a>   
              
      </td>
       
       
<td><? echo $row['sektor_idsektor'];?></td>
<td><? echo $sektorname;?></td>
 <td><? echo $row['idunit'];?></td>
<td><? echo $row['kavling'];?></td>
<td><? echo $row['tipe'];?></td>
<td><? echo $row['luastanah'];?></td>
<td><? echo $row['owner'];?></td>
<td><? echo $progress;?></td>
 
        
       </tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="9"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="9"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="9">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
</body>	
</html>
	
