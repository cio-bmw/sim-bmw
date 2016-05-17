$(document).ready(function(){ 
	 
	//menangkap error dan men-set parameter global (timeout, dll) 
	$.ajaxSetup({ 
	  timeout: 10000, 
	  cache: false, 
		error:function(x,e){ 
			if(x.status==0){ 
			alert('Anda sedang offline! Silahkan cek koneksi anda!'); 
			}else if(x.status==404){ 
			alert('Permintaan URL tidak ditemukan!'); 
			}else if(x.status==500){ 
			alert('Internal Server Error!'); 
			}else if(e=='parsererror'){ 
			alert('Error.Parsing JSON Request failed!'); 
			}else if(e=='timeout'){ 
			alert('Request Time out!'); 
			}else { 
			alert('Error tidak diketahui: '+x.responseText); 
			} 
		} 
	}); 
	 
	// menampilkan image untuk menandakan proses Ajax sedang berlangsung atau telah selesai  
	$('#divLoading').ajaxStart(function(){ 
		$(this).fadeIn(); 
		$(this).html("<table><tr><td><img src='images/ajax-loader.gif' /></td></tr></table>"); 
	}).ajaxStop(function(){ 
		$(this).fadeOut(); 
	}); 
	 
	$("#btnhide").hide(); 
   
  // ketika tombol tambah di-klik, maka formpelanggan akan ditampilkan pada bagian #divFormContent 
  $("#btnsum").click(function(){ 
 		page="slssektor_dailysummary.php?startdate="+$("input#startdate").val()+"&enddate="+$("input#enddate").val(); 
		$("#divPageData").load(page); 
		$("#divPageData").show(); 
		return false; 
	}); 
   
	$("#btnexit").click(function(){ 
		window.location='index.php'; 
	}); 
	 
	$("#btnhide").click(function(){ 
		loadData(); 
	}); 
	 
    $("#btnsumproduct").click(function(){ 
 		page="slssektor_dailyproduct.php?startdate="+$("input#startdate").val()+"&enddate="+$("input#enddate").val(); 
		$("#divPageData").load(page); 
		$("#divPageData").show(); 
		return false; 
	}); 	 
	 
	//menangani jika user melakukan pilihan pada combo #pilihcari 
	
	 
	//menampilkan list data receivehdr 
	loadData(); 
	 
  // fungsi untuk me-load tampilan list data receivehdr, data yang ditampilkan disesuaikan 
  // juga dengan input data pada bagian search 
  function loadData(){ 
 var dataString; 
  var vidsektor = $("select#idsektor").val(); 
  var vmodel = $("select#model").val(); 
  var vdsp = $("select#dsp").val(); 

  var vstartdate = $("input#startdate").val(); 
  var venddate = $("input#enddate").val(); 
  
   
 dataString = 'dsp='+vdsp+'&sektor='+vidsektor+'&startdate='+vstartdate+'&enddate='+venddate+'&model='+vmodel; 

 
   $.ajax({ 
     url: "slssektor_dailyproduct.php", 
     type: "GET", 
     data: dataString, 
 		success:function(data) 
		{ 
			$('#divPageData').html(data); 
 		} 
   }); 
 } 
  
 // melakukan pemrosesan data untuk bagian search (pencarian data) 
    
}); 
