 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data pelanggan sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idpesan"){ 
    dataString = 'starting='+page+'&idpesan='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "pesan"){ 
    dataString = 'starting='+page+'&pesan='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"msgmaster_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data pelanggan, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idpesan"){ 
      dataString = 'idpesan='+ cari;  
   } 
   else if (combo == "pesan"){ 
      dataString = 'pesan='+ cari; 
    } 
 
  $.ajax({ 
    url: "msgmaster_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#msgmaster tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#msgmaster tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data msgmaster ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("msgmaster_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data msgmaster berhasil di hapus!"); 
					} 
					else{ 
						alert("data msgmaster gagal di hapus!"); 
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
$sql = "select * from msgmaster"; 
$result = mysql_query($sql);
 
?> 
	 
  <table id="msgmaster"> 
		<?php 
		//menampilkan data pelanggan 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
       <td><? echo $row['msgfrom'].' => '.$row['pesan'];?></td>
      </tr> 
  		<?} //end while ?> 
	
    <?}else{?> 
   <tr><td align="center" colspan="2">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
