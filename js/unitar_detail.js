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
	 
	 	
	$("#btnlist").click(function(){ 
		window.location='unitar.php'; 
	}); 
	 
	$("#btnmundur").click(function(){ 
   window.open('unit_mundur.php?id='+$("input#idunit").val(),'_blank');	
 	window.location='unithistory.php'; 	 
	}); 
	 
   
	$("#btnexit").click(function(){ 
		window.location='index.php'; 
	}); 
	 
	$("#btnaddar").click(function(){ 

		page="unitar_displaymini.php?idunit="+$('input#idunit').val(); 
		$("#divPageData").load(page); 
		$("#divPageData").show(); 

		page1="unitar_form.php?idunit="+$('input#idunit').val();  
		$("#divPageEntry").load(page1); 
		$("#divPageEntry").show(); 
		
		page2="unitmstpayment_lov.php?idunit="+$('input#idunit').val(); 
		$("#divLOV").load(page2); 
		$("#divLOV").show(); 

		return false; 
	}); 
	  
	 
	//menangani jika user melakukan pilihan pada combo #pilihcari 
	
	//menampilkan list data unitar 
	loadData(); 
	 
  // fungsi untuk me-load tampilan list data unitar, data yang ditampilkan disesuaikan 
  // juga dengan input data pada bagian search 
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#idunit").val(); 
	  var vdsp = $("select#dsp").val(); 

      dataString = 'idunit='+ cari+'&dsp='+vdsp; 
   
 
   $.ajax({ 
     url: "unitar_display.php", 
     type: "GET", 
     data: dataString, 
 		success:function(data) 
		{ 
			$('#divPageData').html(data); 
 		} 
   }); 
 } 
  
 // melakukan pemrosesan data untuk bagian search (pencarian data) 
 $("form#formSearch").submit(function(){  
 alert('submit'); 
     loadData(); 

   return false; 
  }); 
   
}); 
