$(document).ready(function(){ 
function getURLParameter(name) {
  return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search)||[,""])[1].replace(/\+/g, '%20'))||null
} 
 var myvar = getURLParameter('id');
 var param = 'id=' +  myvar;
 	 
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
  
 var cari = $("input#idreceivehdr").val(); 
   var check = $("input#rcv_status").val();
   
		page="receivedtlsektor_form.php?id="+cari;  
		$("#divPageEntry").load(page); 
		$("#divPageEntry").show(); 
		
		page1="receivedtlsektor_dspproduct.php?id="+cari; 
		$("#divLOV").load(page1); 
		$("#divLOV").show(); 
		
		//$("#btnhide").show(); 
		page2="receivedtlsektor_displaymini.php?id="+cari;
		$("#divPageData").load(page2); 
		$("#divPageData").show(); 

				
		
		
		return false; 
	}); 
	
    $("#btntampil").click(function(){ 
  
 var cari = $("input#idreceivehdr").val(); 
   var check = $("input#rcv_status").val();
   
		page="receivedtlsektor_form.php?id="+cari;  
		$("#divPageEntry").load(page); 
		$("#divPageEntry").hide(); 
		
		page1="receivedtlsektor_dspproduct.php?id="+cari; 
		$("#divLOV").load(page1); 
		$("#divLOV").hide(); 
		
		//$("#btnhide").show(); 
		page2="receivedtlsektor_display.php?id="+cari;
		$("#divPageData").load(page2); 
		$("#divPageData").show(); 

				
		
		
		return false; 
	}); 	
	
   
   $("#btnlist").click(function(){ 
		window.location='receivehdrsektor.php'; 
	}); 

   $("#btnconfirm").click(function(){
 	window.open('receivehdrsektor_confirm.php?id='+$("input#idreceivehdr").val(),'_blank');	
 	window.location='receivehdrsektor.php'; 
	}); 

 $("#btnreopen").click(function(){
 	window.open('receivehdrsektor_reopen.php?id='+$("input#idreceivehdr").val(),'_blank');	
 	window.location='receivehdrsektor.php'; 
	}); 

	
	$("#btnexit").click(function(){ 
		window.location='index.php'; 
	}); 
	 
	$("#btnhide").click(function(){ 
		loadData(); 
	}); 
	 
	//menangani jika user melakukan pilihan pada combo #pilihcari 
	$("select#pilihcari").change(function(){  
  	if ($(this).val() == "idreceivedtl"){ 
  	  $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "qty"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "receive_price"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "dtl_ppn"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "receive_priceppn"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "receive_pricedisc"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "dtl_percent"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "dtl_discount"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "batch_no"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "exp_date"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "receivehdrsektor_idreceivehdr"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "product_idproduct"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
   else{ 
     $("td#kolompilih").show(); 
   } 
	}); 
	 
	//menampilkan list data receivedtlsektor 
	loadData(); 
	 
  // fungsi untuk me-load tampilan list data receivedtlsektor, data yang ditampilkan disesuaikan 
  // juga dengan input data pada bagian search 
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "idreceivedtl"){ 
      dataString = 'idreceivedtl='+ cari;  
   } 
   else if (combo == "qty"){ 
      dataString = 'qty='+ cari; 
    } 
   else if (combo == "receive_price"){ 
      dataString = 'receive_price='+ cari; 
    } 
   else if (combo == "dtl_ppn"){ 
      dataString = 'dtl_ppn='+ cari; 
    } 
   else if (combo == "receive_priceppn"){ 
      dataString = 'receive_priceppn='+ cari; 
    } 
   else if (combo == "receive_pricedisc"){ 
      dataString = 'receive_pricedisc='+ cari; 
    } 
   else if (combo == "dtl_percent"){ 
      dataString = 'dtl_percent='+ cari; 
    } 
   else if (combo == "dtl_discount"){ 
      dataString = 'dtl_discount='+ cari; 
    } 
   else if (combo == "batch_no"){ 
      dataString = 'batch_no='+ cari; 
    } 
   else if (combo == "exp_date"){ 
      dataString = 'exp_date='+ cari; 
    } 
   else if (combo == "receivehdrsektor_idreceivehdr"){ 
      dataString = 'receivehdrsektor_idreceivehdr='+ cari; 
    } 
   else if (combo == "product_idproduct"){ 
      dataString = 'product_idproduct='+ cari; 
    } 
 
   $.ajax({ 
     url: "receivedtlsektor_display.php", 
     type: "GET", 
     data: param, 
 		success:function(data) 
		{ 
			$('#divPageData').html(data); 
 		} 
   }); 
 } 
  
 // melakukan pemrosesan data untuk bagian search (pencarian data) 
 $("form#formSearch").submit(function(){  
   var cari = $("input#fieldcari").val(); 
   var combo = $("select#pilihcari").val(); 
   if (cari.replace(/\s/g,"") != ""){ // mengecek field text kosong atau tidak) 
       loadData(); 
   } 
   else if ((cari.replace(/\s/g,"") == "") && (combo != "semua") ){ 
     alert("Maaf, field harus diisi!"); 
     $("input#fieldcari").focus(); 
   } 
   else{ 
     loadData(); 
   } 
   return false; 
  }); 
   
}); 
