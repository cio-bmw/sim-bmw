<?
$user = empinfo($_SESSION['cookie_name']);
$nama = $user['empname'];

?>


<!doctype html>
<html lang=''>
<head>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="styles.css">
   <script src="script.js"></script>
   <title>CSS MenuMaker</title>
</head>
<body>
<div id='cssmenu'>

<ul>
<li><a href='index.php'><span>Home</span></a></li>

<? if($user['gp']==1) {  ?>
<li><a href="#">Gudang Pusat</a>
<ul>

<li><a href="#">Penerimaan Barang</a>
<ul>
<li ><a href="receivehdr.php" >Entry Penerimaan</a></li>
<li ><a href="receive_supplierrekap.php">Rekap Supplier</a></li>
<li ><a href="receive_productrekap.php">Rekap Barang</a></li>
</ul></li>

<li><a href="#">Pengeluaran Barang</a>
<ul>
<li ><a href="slshdrsektor.php">Entry Pengeluaan</a></li>
<li ><a href="slssektor_summary.php">Rekap Per Sektor</a></li>
<li ><a href="slssektor_sumproduct.php">Rekap Barang</a></li>
</ul></li>


<li><a href="#">Return Ke Gudang</a>
<ul>
<li ><a href="returnhdr.php">Entry Retur</a></li>
</ul></li>

<li><a href="#">Pembayaran Supplier</a>
<ul>
<li ><a href="receive_paymenthdr.php">Pembayaran</a></li>
<li ><a href="receive_paymenthdr.php">Rekap Pembayaran</a></li>
</ul></li>


<li><a href="#">Kas Gudang</a>
<ul>
<li ><a href="whcashout.php">Pengeluaran Kas</a></li>
<li ><a href="whcashin.php">Penerimaan Kas</a></li>
</ul></li>

<li><a href="#">Master Gudang</a>
<ul>
<li ><a href="product.php" >Master Barang</a></li>
<li ><a href="uom.php">Master Satuan</a></li>
<li ><a href="category.php">Master Kategori</a></li>
<li ><a href="supplier.php">Master Supplier</a></li>
<li ><a href="contractor.php">Master Kontraktor</a></li>
</ul>
</li>


<li><a href="#">Gudang Kayu</a>
<ul>
<li><a href="#">Penerimaan Kayu</a>
<ul>
<li><a href="receivehdrkayu.php">Entry Penerimaan</a></li>
</ul></li>


<li><a href="#">Master</a>
<ul><li><a href="productkayu.php">Master Kayu</a></li>
</ul></li>


</ul></li>


<li><a href="#">Executive Summary</a>
<ul>
<li ><a href="es_warehouse1.php">Summary Gudang</a></li>
<li ><a href="es_arsektor.php">Pengeluaran Sektor</a></li>
</ul></li>
</ul></li>

<? } ?>


<? if($user['gs']==1) {  ?>

<li><a href="#">Gudang Sektor</a>
<ul>
<li><a href="#">Penerimaan Barang Sektor</a>
<ul>
<li ><a href="receivehdrsektor.php" >Entry Penerimaan</a></li>
<li ><a href="receivesektor_supplierrekap.php">Rekap Supplier</a></li>
<li ><a href="receivesektor_sektorrekap.php">Rekap Sektor</a></li>
<li ><a href="receivesektor_productrekap.php">Rekap Barang</a></li>
</ul>
</li>

<li><a href="#">Pengeluaran Barang Sektor</a>
<ul>
<li><a href="slshdrunit.php">Pengeluaran Barang ke Unit</a></li>
<li><a href="slshdrunit_rekapmenu.php">Rekap Pengeluaran Barang ke Unit</a></li>
<li><a href="slshdrunit_dailyrekap.php">Rekap Pengeluaran Harian</a></li>
<li><a href="sektorstok.php">Stok Barang</a></li>

</ul></li>
</ul>
</li>
<? } ?>

<? if($user['mkt']==1) {  ?>
<li><a href="#">Marketing</a>
<ul>
<li><a href="#">Buku Tamu</a>
<ul>
<li><a href="bukutamu.php">Buku Tamu</a></li>
<li><a href="presentasi.php">Presentasi</a></li>
</ul></li>


<li><a href="#">Master</a>
<ul>
<li><a href="sektor.php">Data Sektor</a></li>
<li><a href="unit.php">Data Unit</a></li>
<li><a href="amclist.php">AM Check List</a></li>
</ul></li>

<li><a href="#">Executive Summary</a>
<ul>
<li><a href="sektor.php">Sektor Summary</a></li>
<li><a href="es_sektor.php">Sektor Graphic Progress</a></li>
</ul></li>
</ul></li>
<? } ?>

<? if($user['tch']==1) {  ?>
<li><a href="#">Tehnik</a>
<ul>
<li><a href="#">Unit</a>
<ul>
<li><a href="unit_materialbudget_menu.php">RAB Unit</a></li>
<li><a href="unit_resume_menu.php">Resume</a></li>

</ul></li>
<li><a href="#">Kontraktor</a>
<ul>

<li><a href="unitspk.php">SPK</a></li>
<li><a href="unitspk_rekappayment.php">Rekap Pembayaran SPK</a></li>

</ul></li>



<li><a href="#">Master</a>
<ul><li><a href="tipe.php">Type RAB</a></li>
<li><a href="clbangun.php">Check List Master</a></li>
<li><a href="contractor.php">Kontraktor</a></li>
<li><a href="spkcat.php">Kategori SPK</a></li>
</ul></li>
</ul></li>
<? } ?>

<? if($user['acc']==1) {  ?>
<li><a href="#">Accounting</a>
<ul>
<li><a href="#">RAB Sektor</a>
<ul>
<li><a href="sektorrabtxn.php" >Entry Transaksi</a></li>
<li><a href="sektorrab.php" >Data RAB Sektor</a></li>
<li><a href="rabmst.php" >Master RAB</a></li>
<li><a href="rabcat.php"  >Kategory RAB</a></li>
</ul>
</li>

<li><a href="#">Piutang Unit</a>
<ul>
		<li><a href="unitarpayment.php">Pembayaran Unit</a></li>
  		<li><a href="unitar.php">Piutang Unit</a></li>
  		<li><a href="unitar_all.php">Piutang Semua</a></li>
  		<li><a href="unitar_rekap.php">Rekap Piutang</a></li>
</ul>
</li>

<li><a href="#">General Ledger</a>
<ul>
		<li><a href="glhdr.php">General Ledger</a></li>
  		<li><a href="acc.php">Account</a></li>
  		<li><a href="groupacc.php">Grup Account</a></li>
  		<li><a href="pl.php">Profit & loss</a></li>
</ul>
</li>



<li><a href="#">Kontraktor</a>
<ul>
<li ><a href="spkpaymenthdr.php">Pembayaran Kontraktor</a></li>
<li ><a href="spkpaymentdtl.php">Daftar Pembayaran SPK</a></li>
<li ><a href="unitspk_rekappayment.php">Rekap Pembayaran SPK</a></li>
</ul></li>



<li><a href="#">Kas</a>
<ul>
		<li><a href="txndaily.php">Transaksi Kas</a></li>
 		<li><a href="txnpos.php">Pos Transaksi</a></li>
 		<li><a href="txnalokasi.php">Alokasi Transaksi</a></li>
</ul>
</li>

<li><a href="#">Master</a>
<ul>
<li><a href="unitmstpayment.php">Master Pembayaran Unit</a></li>
</ul>
</li>

</ul></li>

<? } ?>

<? if($user['kpr']==1) {  ?>
<li><a href="#">KPR</a>
<ul>
<li><a href="kprcheckhdr.php">Check List KPR</a></li>
<li><a href="kprclmst.php">Master Check List</a></li>
</ul>

</li>
<? } ?>

<? if($user['adm']==1) {  ?>
<li><a href="#">Administrator</a>
<ul>
<li><a href="emp.php">User</a></li>
</ul>

</li>
<? } ?>

   <li><a href="logout.php">Logout</a></li>
   <li><a href='#'><span><? echo 'Hello '.$nama; ?></span></a></li>
  
</ul>
</div>

</body>
<html>
