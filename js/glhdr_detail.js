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
  $("#btntambah").click(function(){ 
  var vstatus = $("input#gl_status").val();	
	
	if  (vstatus == 'posted') {
	alert('Data Sudah Posting tidak bisa di Edit, unposting dulu');	
	return false;
	} else {	
	  
  
  
		page1="gldtl_form.php?id="+$("input#idglhdr").val(); 
		$("#divPageEntry").load(page1); 
		$("#divPageEntry").show(); 
   
		page2="gldtl_lovacc.php"; 
		$("#divLOV").load(page2); 
		$("#divLOV").show(); 
   
		page3="gldtl_display.php?id="+$("input#idglhdr").val(); 
		$("#divPageData").load(page3); 
		$("#divPageData").show(); 
		return false; 
}	
	}); 
	
	$("#btntampil").click(function(){ 
		$("#divLOV").hide(); 
		$("#divPageEntry").hide(); 
   }); 
	
   
	$("#btnexit").click(function(){ 
		window.location='index.php'; 
	}); 
	 
	$("#btnlist").click(function(){ 
		window.location='glhdr.php'; 
	}); 
	 
//   $("#btnconfirm").click(function(){  
//	if (confirm("Apakah benar akan Posting Data Transaksi Ini?")){  
//	    window.open("glhdr_confirm.php?id="+$("input#idglhdr").val(),"_blank"); }  
//	    else { 
//    alert('Anda membatalkan Posting Data');	 
//   } 
//  	window.location='glhdr.php';
//
//	});  
	
	
	$("#btnreopen").click(function(){  
	if (confirm("Apakah benar akan membatalkan Konfirmasi Penerimaan Barang ini?")){  
    window.open('slsdtlsektor_reopen.php?id='+$("input#idslshdr").val(),'_blank');	 } 
    else { 
    alert('Anda Tidak Jadi membatalkan Confirmasi Data');	 
    	} 
	window.location='glhdr.php'; 	 
	});  
	//menangani jika user melakukan pilihan pada combo #pilihcari 
	$("select#pilihcari").change(function(){  
  	if ($(this).val() == "idglhdr"){ 
  	  $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "gl_date"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "gl_desc"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "gl_refno"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
   else{ 
     $("td#kolompilih").show(); 
   } 
	}); 
	 
	//menampilkan list data glhdr 
	loadData(); 
	 
  // fungsi untuk me-load tampilan list data glhdr, data yang ditampilkan disesuaikan 
  // juga dengan input data pada bagian search 
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#idglhdr").val(); 
	   
   dataString = 'id='+ cari;  
   
 
   $.ajax({ 
     url: "gldtl_display.php", 
     type: "GET", 
     data: dataString, 
 		success:function(data) 
		{ 
			$('#divPageData').html(data); 
 		} 
   }); 
 } 
  
 // melakukan pemrosesan data untuk bagian search (pencarian data) 
 $("form#glhdr_detail").submit(function(){  
 $("#divLOV").hide(); 
  loadData(); 
     
   return false; 
  }); 
   
}); 
