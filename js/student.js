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
		page="student_form.php"; 
		$("#divPageData").load(page); 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
   
	$("#btnexit").click(function(){ 
		window.location='index.php'; 
	}); 
	 
	$("#btnhide").click(function(){ 
		loadData(); 
	}); 
	 
	//menangani jika user melakukan pilihan pada combo #pilihcari 
	$("select#pilihcari").change(function(){  
  	if ($(this).val() == "id"){ 
  	  $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "nis"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "full_name"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "call_name"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "class"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "sex"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "birth_place"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "birth_date"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "lang_day"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "religion"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "nation"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "child_status"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "child_no"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "kandung_qty"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "tiri_qty"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "angkat_qty"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "address"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "desa"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "kecamatan"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "kabupaten"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "phone_no"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "stay_with"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "stay_distance"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "blood"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "ever_sick"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "weight"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "height"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "ijazah_no"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "skhun_no"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "nisn"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "npsn"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "end_year"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "graduated_from"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "leave_reason"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "fname"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "faddress"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "fdesa"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "fkecamatan"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "fkabupaten"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "fbirth_place"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "fbirth_date"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "freligion"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "fphone"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "fnation"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "feducation"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "fjob"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "fmonth_payment"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "fstatus"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "mname"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "maddress"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "mdesa"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "mkecamatan"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "mkabupaten"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "mbirth_place"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "mbirth_date"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "mreligion"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "mphone"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "mnation"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "meducation"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "mjob"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "mmonth_payment"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "mstatus"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "wname"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "waddress"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "wdesa"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "wkecamatan"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "wkabupaten"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "wbirth_place"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "wbirth_date"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "wreligion"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "wphone"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "wnation"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "weducation"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "wjob"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "wmonth_payment"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "wstatus"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "hobi_art"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "hobi_sport"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "hobi_org"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "hobi_other"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "beasiswa1"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "beasiswa2"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "beasiswa3"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "out_date"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "lulus"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "lulus_year"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "last_ijasah"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "stl_no"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "nilai akhir"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "terima_date"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "masuk_date"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "lanjutke"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "kerjadi"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "ekstra1"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "ekstra2"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "ekstra3"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "social_guard"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
   else{ 
     $("td#kolompilih").show(); 
   } 
	}); 
	 
	//menampilkan list data student 
	loadData(); 
	 
  // fungsi untuk me-load tampilan list data student, data yang ditampilkan disesuaikan 
  // juga dengan input data pada bagian search 
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "id"){ 
      dataString = 'id='+ cari;  
   } 
   else if (combo == "nis"){ 
      dataString = 'nis='+ cari; 
    } 
   else if (combo == "full_name"){ 
      dataString = 'full_name='+ cari; 
    } 
   else if (combo == "call_name"){ 
      dataString = 'call_name='+ cari; 
    } 
   else if (combo == "class"){ 
      dataString = 'class='+ cari; 
    } 
   else if (combo == "sex"){ 
      dataString = 'sex='+ cari; 
    } 
   else if (combo == "birth_place"){ 
      dataString = 'birth_place='+ cari; 
    } 
   else if (combo == "birth_date"){ 
      dataString = 'birth_date='+ cari; 
    } 
   else if (combo == "lang_day"){ 
      dataString = 'lang_day='+ cari; 
    } 
   else if (combo == "religion"){ 
      dataString = 'religion='+ cari; 
    } 
   else if (combo == "nation"){ 
      dataString = 'nation='+ cari; 
    } 
   else if (combo == "child_status"){ 
      dataString = 'child_status='+ cari; 
    } 
   else if (combo == "child_no"){ 
      dataString = 'child_no='+ cari; 
    } 
   else if (combo == "kandung_qty"){ 
      dataString = 'kandung_qty='+ cari; 
    } 
   else if (combo == "tiri_qty"){ 
      dataString = 'tiri_qty='+ cari; 
    } 
   else if (combo == "angkat_qty"){ 
      dataString = 'angkat_qty='+ cari; 
    } 
   else if (combo == "address"){ 
      dataString = 'address='+ cari; 
    } 
   else if (combo == "desa"){ 
      dataString = 'desa='+ cari; 
    } 
   else if (combo == "kecamatan"){ 
      dataString = 'kecamatan='+ cari; 
    } 
   else if (combo == "kabupaten"){ 
      dataString = 'kabupaten='+ cari; 
    } 
   else if (combo == "phone_no"){ 
      dataString = 'phone_no='+ cari; 
    } 
   else if (combo == "stay_with"){ 
      dataString = 'stay_with='+ cari; 
    } 
   else if (combo == "stay_distance"){ 
      dataString = 'stay_distance='+ cari; 
    } 
   else if (combo == "blood"){ 
      dataString = 'blood='+ cari; 
    } 
   else if (combo == "ever_sick"){ 
      dataString = 'ever_sick='+ cari; 
    } 
   else if (combo == "weight"){ 
      dataString = 'weight='+ cari; 
    } 
   else if (combo == "height"){ 
      dataString = 'height='+ cari; 
    } 
   else if (combo == "ijazah_no"){ 
      dataString = 'ijazah_no='+ cari; 
    } 
   else if (combo == "skhun_no"){ 
      dataString = 'skhun_no='+ cari; 
    } 
   else if (combo == "nisn"){ 
      dataString = 'nisn='+ cari; 
    } 
   else if (combo == "npsn"){ 
      dataString = 'npsn='+ cari; 
    } 
   else if (combo == "end_year"){ 
      dataString = 'end_year='+ cari; 
    } 
   else if (combo == "graduated_from"){ 
      dataString = 'graduated_from='+ cari; 
    } 
   else if (combo == "leave_reason"){ 
      dataString = 'leave_reason='+ cari; 
    } 
   else if (combo == "fname"){ 
      dataString = 'fname='+ cari; 
    } 
   else if (combo == "faddress"){ 
      dataString = 'faddress='+ cari; 
    } 
   else if (combo == "fdesa"){ 
      dataString = 'fdesa='+ cari; 
    } 
   else if (combo == "fkecamatan"){ 
      dataString = 'fkecamatan='+ cari; 
    } 
   else if (combo == "fkabupaten"){ 
      dataString = 'fkabupaten='+ cari; 
    } 
   else if (combo == "fbirth_place"){ 
      dataString = 'fbirth_place='+ cari; 
    } 
   else if (combo == "fbirth_date"){ 
      dataString = 'fbirth_date='+ cari; 
    } 
   else if (combo == "freligion"){ 
      dataString = 'freligion='+ cari; 
    } 
   else if (combo == "fphone"){ 
      dataString = 'fphone='+ cari; 
    } 
   else if (combo == "fnation"){ 
      dataString = 'fnation='+ cari; 
    } 
   else if (combo == "feducation"){ 
      dataString = 'feducation='+ cari; 
    } 
   else if (combo == "fjob"){ 
      dataString = 'fjob='+ cari; 
    } 
   else if (combo == "fmonth_payment"){ 
      dataString = 'fmonth_payment='+ cari; 
    } 
   else if (combo == "fstatus"){ 
      dataString = 'fstatus='+ cari; 
    } 
   else if (combo == "mname"){ 
      dataString = 'mname='+ cari; 
    } 
   else if (combo == "maddress"){ 
      dataString = 'maddress='+ cari; 
    } 
   else if (combo == "mdesa"){ 
      dataString = 'mdesa='+ cari; 
    } 
   else if (combo == "mkecamatan"){ 
      dataString = 'mkecamatan='+ cari; 
    } 
   else if (combo == "mkabupaten"){ 
      dataString = 'mkabupaten='+ cari; 
    } 
   else if (combo == "mbirth_place"){ 
      dataString = 'mbirth_place='+ cari; 
    } 
   else if (combo == "mbirth_date"){ 
      dataString = 'mbirth_date='+ cari; 
    } 
   else if (combo == "mreligion"){ 
      dataString = 'mreligion='+ cari; 
    } 
   else if (combo == "mphone"){ 
      dataString = 'mphone='+ cari; 
    } 
   else if (combo == "mnation"){ 
      dataString = 'mnation='+ cari; 
    } 
   else if (combo == "meducation"){ 
      dataString = 'meducation='+ cari; 
    } 
   else if (combo == "mjob"){ 
      dataString = 'mjob='+ cari; 
    } 
   else if (combo == "mmonth_payment"){ 
      dataString = 'mmonth_payment='+ cari; 
    } 
   else if (combo == "mstatus"){ 
      dataString = 'mstatus='+ cari; 
    } 
   else if (combo == "wname"){ 
      dataString = 'wname='+ cari; 
    } 
   else if (combo == "waddress"){ 
      dataString = 'waddress='+ cari; 
    } 
   else if (combo == "wdesa"){ 
      dataString = 'wdesa='+ cari; 
    } 
   else if (combo == "wkecamatan"){ 
      dataString = 'wkecamatan='+ cari; 
    } 
   else if (combo == "wkabupaten"){ 
      dataString = 'wkabupaten='+ cari; 
    } 
   else if (combo == "wbirth_place"){ 
      dataString = 'wbirth_place='+ cari; 
    } 
   else if (combo == "wbirth_date"){ 
      dataString = 'wbirth_date='+ cari; 
    } 
   else if (combo == "wreligion"){ 
      dataString = 'wreligion='+ cari; 
    } 
   else if (combo == "wphone"){ 
      dataString = 'wphone='+ cari; 
    } 
   else if (combo == "wnation"){ 
      dataString = 'wnation='+ cari; 
    } 
   else if (combo == "weducation"){ 
      dataString = 'weducation='+ cari; 
    } 
   else if (combo == "wjob"){ 
      dataString = 'wjob='+ cari; 
    } 
   else if (combo == "wmonth_payment"){ 
      dataString = 'wmonth_payment='+ cari; 
    } 
   else if (combo == "wstatus"){ 
      dataString = 'wstatus='+ cari; 
    } 
   else if (combo == "hobi_art"){ 
      dataString = 'hobi_art='+ cari; 
    } 
   else if (combo == "hobi_sport"){ 
      dataString = 'hobi_sport='+ cari; 
    } 
   else if (combo == "hobi_org"){ 
      dataString = 'hobi_org='+ cari; 
    } 
   else if (combo == "hobi_other"){ 
      dataString = 'hobi_other='+ cari; 
    } 
   else if (combo == "beasiswa1"){ 
      dataString = 'beasiswa1='+ cari; 
    } 
   else if (combo == "beasiswa2"){ 
      dataString = 'beasiswa2='+ cari; 
    } 
   else if (combo == "beasiswa3"){ 
      dataString = 'beasiswa3='+ cari; 
    } 
   else if (combo == "out_date"){ 
      dataString = 'out_date='+ cari; 
    } 
   else if (combo == "lulus"){ 
      dataString = 'lulus='+ cari; 
    } 
   else if (combo == "lulus_year"){ 
      dataString = 'lulus_year='+ cari; 
    } 
   else if (combo == "last_ijasah"){ 
      dataString = 'last_ijasah='+ cari; 
    } 
   else if (combo == "stl_no"){ 
      dataString = 'stl_no='+ cari; 
    } 
   else if (combo == "nilai akhir"){ 
      dataString = 'nilai akhir='+ cari; 
    } 
   else if (combo == "terima_date"){ 
      dataString = 'terima_date='+ cari; 
    } 
   else if (combo == "masuk_date"){ 
      dataString = 'masuk_date='+ cari; 
    } 
   else if (combo == "lanjutke"){ 
      dataString = 'lanjutke='+ cari; 
    } 
   else if (combo == "kerjadi"){ 
      dataString = 'kerjadi='+ cari; 
    } 
   else if (combo == "ekstra1"){ 
      dataString = 'ekstra1='+ cari; 
    } 
   else if (combo == "ekstra2"){ 
      dataString = 'ekstra2='+ cari; 
    } 
   else if (combo == "ekstra3"){ 
      dataString = 'ekstra3='+ cari; 
    } 
   else if (combo == "social_guard"){ 
      dataString = 'social_guard='+ cari; 
    } 
 
   $.ajax({ 
     url: "student_display.php", 
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
