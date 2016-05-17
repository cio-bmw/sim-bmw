<? 
session_start();
$cookiename = $_SESSION['cookie_name'];
$cookieempname  =$_SESSION['cookie_empname'];
require_once ('login.php');
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	
	<title>BMW cyber office</title>
	
	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen, projection"/>
	<!--[if lte IE 7]>
        <link rel="stylesheet" type="text/css" href="css/ie.css" media="screen" />
    <![endif]-->

	<script type="text/javascript" src="js/jquery-1.3.1.min.js"></script>	
	<script type="text/javascript" language="javascript" src="js/jquery.dropdownPlain.js"></script>
	<script type="text/javascript" language="javascript" src="js/publicchat.js"></script>

</head>

<body>

	<div>
	
        <img src="images/logo.png" alt="powered by technosoft Indonesia" />
	     <ul class="dropdown" width=1000px>
	     
        	<li><a href="#">Master</a>
        		<ul class="sub_menu">
        		<li><a href="tipe.php">tipe</a></li>
        		<li><a href="tipe_materialbudget.php">Material Budget tipe</a></li>
        		
        		  <li><a href="unitstatus.php">Master Status Unit</a></li>
        		 <li><a href="contractor.php">Master Kontraktor</a></li>
        		 <li><a href="unitmstpayment.php">Master Pembayaran Unit</a></li>
        		 <li><a href="kpr.php">Master KPR</a></li>
        		 <li><a href="emp.php">Master User</a></li>
        		 <li><a href="doccat.php">Dokument Kategory</a></li>
        		   		
        		</ul>
        	</li>
        	
        	<li><a href="#">Head Office</a>
        		<ul class="sub_menu">
        		<li><a href="executive_summary.php">Executive Summary</a></li>
        		   <li><a href="sektor.php">Sektor</a></li>
        	    <li><a href="unit.php">Unit</a></li>
        	   
        	        	
        			
        		</ul>
        	</li>
        	
	      <li><a href="#">Accounting</a>
        		<ul class="sub_menu">
        		    <li><a href="#">RAB Sektor</a>
        		        <ul class="sub_menu">
        	   				 <li><a href="sektorrabtxn.php">Belanja Sektor (RAB)</a></li>
            				 <li><a href="sektorrab.php">RAB Sektor</a></li>
            				 <li><a href="rabmst.php">Master RAB</a></li>
            				 <li><a href="rabcat.php">Category RAB</a></li>
        		        </ul>
        		    </li>
        		
        		     <li><a href="#">Piutang Unit</a>
        		        <ul class="sub_menu">
          		 			<li><a href="unitarpayment.php">Pembayaran Unit</a></li>
          		 			<li><a href="unitar.php">Piutang Unit</a></li>
          		 			<li><a href="unitar_all.php">Piutang Semua</a></li>
          		 			<li><a href="unitar_rekap.php">Rekap Piutang</a></li>
          		 			
          		 			
          		    </ul>
        		    </li> 
          		 <li><a href="#">Kas Kecil</a>
        		        <ul class="sub_menu">
        						<li><a href="cashin.php">Penerimaan Cash Kecil</a></li>
        						<li><a href="cashouthdr.php">Pengeluaran Cash Kecil</a></li>
        						<li><a href="cashbook.php">Buku Kas</a></li>
        			     </ul>
        		    </li>
        		
        			
 
        		</ul>
        	</li>        	
        	
        	<li><a href="#">Sektor</a>
        		<ul class="sub_menu">
        		 <li><a href="unit_materialbudget_menu.php">Budget Material Unit</a></li>
        		 <li><a href="unit_materialrekap_menu.php">Rekap Material Unit</a></li>
   		 
        		 <li><a href="slshdrunit.php">Pengeluaran Barang ke Unit</a></li>
        		   <li><a href="receivehdrsektor.php">Penerimaan Barang</a></li>
        		   <li><a href="sektorstok.php">Stok Barang</a></li>
        			
        		</ul>
        	</li>
        	<li><a href="#">Gudang Pusat</a>
        		<ul class="sub_menu">
      		    <li><a href="es_warehouse.php">Executive Summary</a></li>
        		 
        		   <li><a href="receivehdr.php">Penerimaan Barang</a></li>
        		   <li><a href="slshdrsektor.php">Pengeluaran barang</a></li>
        		     <li><a href="receive_dailyrekap.php">Rekap penerimaan Barang</a></li>
        		       <li><a href="slssektor_dailyrekap.php">Rekap Pengeluaran Barang</a></li>
        		        
        		    
        		
        		 <li><a href="#">Kas Gudang</a>
        		        <ul class="sub_menu">
		        		    <li><a href="whcashouthdr.php">Pengeluaran Kas</a></li>
      	  		       <li><a href="whcashin.php">Penerimaan Kas</a></li>
        		    	    <li><a href="whcashbook.php">Buku Kas</a></li>
        		               		        
        		       </ul>
        		    </li>
        		   
        		    
        
        		     <li><a href="#">Master</a>
        		        <ul class="sub_menu">
        		         <li><a href="product.php">Master Barang</a></li>
        		        <li><a href="uom.php">Satuan Barang</a></li>
        		        <li><a href="category.php">Kategori barang</a></li>
        		        <li><a href="supplier.php">Master Supplier</a></li>
        		               		        
        		       </ul>
        		    </li>
        		   
        			</ul>
        	</li>
        	        	
     
        	<li><a href="logout.php">Logout</a></li>
  	     
        	
        </ul>
	</div> 
</body>

</html>
