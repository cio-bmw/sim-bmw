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
	 
   
  // ketika tombol tambah di-klik, maka formpelanggan akan ditampilkan pada bagian #divFormContent 
  $("#btntambah").click(function(){ 
		page1="unitclbangun_form.php?spk="+$("input#idunitspk").val()+"&unit="+$("input#unit_idunit").val(); 
		$("#divPageEntry").load(page1); 
		$("#divPageEntry").show(); 
		
		page2="clbangun_lov.php?cat="+$("input#spkcat_idspkcat").val(); 
		$("#divLOV").load(page2); 
		$("#divLOV").show(); 
		
	page3 = "unitclbangun_displaymini.php?spk="+$("input#idunitspk").val()+"&unit="+$("input#unit_idunit").val(); 
    $("#divPageData").load(page3);
    $("#divPageData").show();
     
    
		return false; 
	}); 
   
   $("#btnlist").click(function(){ 
		window.location='unitspk.php'; 
	}); 
	
	 $("#btntampil").click(function(){ 
		page1="unitclbangun_display.php?spk="+$("input#idunitspk").val()+"&unit="+$("input#unit_idunit").val(); 
		$("#divPageData").load(page1); 
		$("#divPageData").show();
		
      $("#divPageEntry").hide();
      $("#divLOV").hide();
		 		
		 
	}); 
	 
	$("#btnexit").click(function(){ 
		window.location='index.php'; 
	}); 
	 
	 $("#btnimport").click(function(){ 
	   window.open("unitspk_import.php?id="+$("input#idunitspk").val()+"&unit="+$("input#unit_idunit").val()+"&spk="+$("input#spkcat_idspkcat").val(),"_blank"); 
	   window.location='unitspk_detail.php?id='+$("input#idunitspk").val(); 

	}); 
		 
	 $("#btncetak").click(function(){ 
     window.open("unitclbangun_pdf.php?id="+$("input#idunitspk").val()+"&unit="+$("input#unit_idunit").val()+"&spk="+$("input#spkcat_idspkcat").val(),"_blank"); 
	}); 

	//menangani jika user melakukan pilihan pada combo #pilihcari 
	$("select#pilihcari").change(function(){  
  	if ($(this).val() == "idunitspk"){ 
  	  $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "spkno"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "spkdesc1"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "spkdesc2"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "spkvalue"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "spkcat_idspkcat"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "unit_idunit"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "contractor_idcontractor"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
   else{ 
     $("td#kolompilih").show(); 
   } 
	}); 
	 
	//menampilkan list data unitspk 
	loadData(); 
	 
  // fungsi untuk me-load tampilan list data unitspk, data yang ditampilkan disesuaikan 
  // juga dengan input data pada bagian search 
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#idunitspk").val(); 
	   dataString = 'spk='+ cari;  
  
     $.ajax({ 
     url: "unitclbangun_display.php", 
     type: "GET", 
     data: dataString, 
 		success:function(data) 
		{ 
			$('#divPageData').html(data); 
 		} 
   }); 
 } 
  
 // melakukan pemrosesan data untuk bagian search (pencarian data) 
 $("form#unitspk").submit(function(){  
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
