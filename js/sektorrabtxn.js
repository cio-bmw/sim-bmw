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
		page="sektorrabtxn_form.php"; 
		$("#divPageData").load(page); 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
   
	$("#btnexit").click(function(){ 
		window.location='index.php'; 
	}); 
	 
$("#btncetak").click(function(){ 
 var cari = $("input#fieldcari").val(); 
  var vrabcat = $("select#idrabcat").val(); 
  var vrabmst = $("select#idrabmst").val(); 
  var vsektor = $("select#idsektor").val(); 
  var vstartdate = $("input#startdate").val(); 
   var venddate = $("input#enddate").val(); 
 

	    window.open('sektorrabtxn_pdf.php?sektor='+vsektor+'&rabcat='+vrabcat+'&rabmst='+vrabmst+'&start='+vstartdate+'&end='+venddate,"_blank"); 
	});  
		 
	$("#btnhide").click(function(){ 
		loadData(); 
	}); 
	 
	//menangani jika user melakukan pilihan pada combo #pilihcari 
	$("select#pilihcari").change(function(){  
  	if ($(this).val() == "idtxn"){ 
  	  $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "txndate"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "txnvalue"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "txndesc"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "sektor_idsektor"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "rabmst_idrabmst"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
   else{ 
     $("td#kolompilih").show(); 
   } 
	}); 
	 
	//menampilkan list data sektorrabtxn 
	loadData(); 
	 
  // fungsi untuk me-load tampilan list data sektorrabtxn, data yang ditampilkan disesuaikan 
  // juga dengan input data pada bagian search 
  function loadData(){ 
	  var dataString; 
   var cari = $("input#fieldcari").val(); 
  var vrabcat = $("select#idrabcat").val(); 
  var vrabmst = $("select#idrabmst").val(); 
  var vsektor = $("select#idsektor").val(); 
  var vstartdate = $("input#startdate").val(); 
   var venddate = $("input#enddate").val(); 
 
  
   
	  
   dataString = 'sektor='+vsektor+'&txn='+cari+'&rabcat='+vrabcat+'&rabmst='+vrabmst+'&start='+vstartdate+'&end='+venddate;
 
 
   $.ajax({ 
     url: "sektorrabtxn_display.php", 
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
   var cari = $("input#fieldcari").val();
   var end = $("input#enddate").val();
   var start = $("input#startdate").val();
    
   var combo = $("select#pilihcari").val();
   
    if ((start.replace(/\s/g,"") != "") && (end.replace(/\s/g,"") = "")) {
    	 alert("Maaf, Tgl awal dan akhir  harus diisi!"); 
     $("input#endfieldcari").focus(); 
    	}   
    
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
