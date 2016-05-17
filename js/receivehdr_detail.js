$(document).ready(function(){ 
function getURLParameter(name) {
  return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search)||[,""])[1].replace(/\+/g, '%20'))||null
} 
	 
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
   
 	
	$("form#formheader").submit(function(){  
   var cari = $("input#idrjhdrs").val(); 
   });
   
	 $("#btnproduct").click(function(){ 
	  	page="receivedtl_display.php?id="+$("input#idreceivehdr").val();
		$("#divPageData").load(page); 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	
 
	
	 $("#btnback").click(function(){ 
	window.location='receivehdr.php';
	//	page="rjhdrs_form.php"; 
	//	$("#divPageData").load(page); 
	//	$("#divPageData").show(); 
	//	$("#btnhide").show(); 
	//	return false; 
	}); 
   
	$("#btnexit").click(function(){ 
		window.location='index.php'; 
	});  
	
		 
	//menampilkan list data pelanggan 
	loadData(); 
	 
  // fungsi untuk me-load tampilan list data pelanggan, data yang ditampilkan disesuaikan 
  // juga dengan input data pada bagian search 
  function loadData(){ 
	var dataString; 
	
   $.ajax({ 
     url: "receivedtl_display.php?id="+$("input#idreceivehdr").val(), 
     type: "GET", 
     data: dataString, 
 		success:function(data) 
		{ 
			$('#divPageData').html(data); 
 		} 
   }); 
 } 
  
 // melakukan pemrosesan data untuk bagian search (pencarian data) 
 
     loadData(); 
     
$("form#formSearch").submit(function(){  
  
     loadData(); 
     return false; 
    
});      
     
     
}); 
