<?
$user = empinfo($_SESSION['cookie_name']);
$nama = $user['empname'];

?>
<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>Blueprint: Horizontal Drop-Down Menu</title>
        <meta name="description" content="Blueprint: Horizontal Drop-Down Menu" />
        <meta name="keywords" content="horizontal menu, microsoft menu, drop-down menu, mega menu, javascript, jquery, simple menu" />
        <meta name="author" content="nokit" />
        <link rel="shortcut icon" href="../favicon.ico">
        <link rel="stylesheet" type="text/css" href="css/default.css" />
        <link rel="stylesheet" type="text/css" href="css/component.css" />
        <script src="js/modernizr.custom.js"></script>
    </head>
    <body>
        <div class="container">
        <div class="main">
                <nav id="cbp-hrmenu" class="cbp-hrmenu">
                    <ul>
                <li><a href="index.php">Home</a>
                <div class="cbp-hrsub">
                                <div class="cbp-hrsub-inner"> 
                                    <div>
                                        <h4>Daily Activity</h4>
                                        <ul>
                                            <li><a href="#">Inbox</a></li>
                                            <li><a href="todo.php">Todo List</a></li>
                                        </ul>
                                    
                                    </div>
                                </div><!-- /cbp-hrsub-inner -->
                            </div><!-- /cbp-hrsub -->
                </li>                   
                    
<? if($user['gs']==1) {  ?>                     
                            <li>
                            <a href="#">Gudang Sektor</a>
                            <div class="cbp-hrsub">
                                <div class="cbp-hrsub-inner"> 
                                    <div>
                                        <h4>Penerimaan Barang Sektor </h4>
                                        <ul>
                                        <li ><a href="receivehdrsektor.php" >Entry Penerimaan</a></li>
                                            <li ><a href="receivesektor_supplierrekap.php">Rekap Supplier</a></li>
                                            <li ><a href="receivesektor_sektorrekap.php">Rekap Sektor</a></li>
                                            <li ><a href="receivesektor_productrekap.php">Rekap Barang</a></li> 
                                        </ul>
                                    </div>
                                    <div>
                                    <h4>Pengeluaran Barang Sektor</h4>
                                        <ul>
                                            <ul>
                                            <li><a href="slshdrunit.php">Pengeluaran Barang ke Unit</a></li>
                                            <li><a href="slshdrunit_rekapmenu.php">Rekap Pengeluaran Barang ke Unit</a></li>
                                            <li><a href="slshdrunit_dailyrekap.php">Rekap Pengeluaran Harian</a></li>
                                            <li><a href="sektorstok.php">Stok Barang</a></li>
                                        </ul>
                                    </div>
                                    
                                    <div>
                                    <h4>Pembayaran Supplier</h4>
                                        <ul>
                                            <ul>
                                            <li ><a href="receive_paymenthdr.php">Pembayaran</a></li>
                                            <li ><a href="receive_paymenthdr.php">Rekap Pembayaran</a></li>
                                        </ul>
                                        <h4>Kas Gudang</h4>
                                        <ul>
                                            <ul>
                                            <li class='last'><a href="whcashout.php">Pengeluaran Kas</a></li>
                                            <li class='last'><a href="whcashin.php">Penerimaan Kas</a></li>
                                            </ul>
                                        </ul>                                       
                                        
                                    </div>
                                
                                                                        
                                    <div>
                                        <h4>Master Gudang</h4>
                                        <ul>
                                            <li ><a href="product.php" >Master Barang</a></li>
                                            <li ><a href="uom.php">Master Satuan</a></li>
                                            <li ><a href="category.php">Master Kategori</a></li>
                                            <li ><a href="supplier.php">Master Supplier</a></li>
                                            <li ><a href="contractor.php">Master Kontraktor</a></li>
                                        </ul>
                                    </div>
                                                                
                                    
                                </div><!-- /cbp-hrsub-inner -->
                            </div><!-- /cbp-hrsub -->
                        </li>
<? } ?>
                        
<? if($user['tch']==1) {  ?>                        
                        <li>
                            <a href="#">Teknik</a>
                            <div class="cbp-hrsub">
                                <div class="cbp-hrsub-inner">
                                    <div>
                                        <h4>Unit</h4>
                                        <ul>
                                            <li><a href="unit_materialbudget_menu.php">RAB Unit</a></li>
                                            <li><a href="unitclbangun.php">Progres Pembangunan</a></li>
                                            <li><a href="clbangun.php">Master Check Bangun</a></li>
                                            <li><a href="unit_resume_menu.php">Resume</a></li>
                                        </ul>
                                    </div>
                                    <div>
                                        <h4>Kontraktor</h4>
                                        <ul>
                                            <li><a href="unitspk.php">SPK</a></li>
                                            <li><a href="unitspk_rekappayment.php">Rekap Pembayaran SPK</a></li>    
                                    </ul>
                                    </div>
                                    <div>
                                        <h4>Master</h4>
                                        <ul>
                                        <li><a href="tipe.php">Type RAB</a></li>
                                        <li><a href="clbangun.php">Check List Master</a></li>
                                        <li><a href="contractor.php">Kontraktor</a></li>
                                        <li><a href="spkcat.php">Kategori SPK</a></li>
                                    </ul>
                                    </div>
                                    
                                    
                                    
                                    <div>
                                        <h4>Design</h4>
                                        <ul>
                                            <li><a href="project.php">Project</a></li>
                                            <li><a href="unitspk_rekappayment.php">Rekap Pembayaran SPK</a></li>    
                                    </ul>
                                    </div>                                  
                                    
                                </div><!-- /cbp-hrsub-inner -->
                            </div><!-- /cbp-hrsub -->
                        </li>
<? } ?>
<? if($user['mkt']==1) {  ?>                        
                        
                        <li>
                            <a href="#">Marketing</a>
                            <div class="cbp-hrsub">
                                <div class="cbp-hrsub-inner"> 
                                    <div>
                                        <h4>Prospek</h4>
                                        <ul>
                                            <li><a href="prospek.php">Prospek / Leads</a></li>
                                            <li><a href="marketing.php">Marketing Team</a></li>
                                            
                                        </ul>
                                    
                                    </div>
                                    <div>
                                        <h4>Master</h4>
                                        <ul>
                                            <li><a href="sektor.php">Data Sektor</a></li>
                                            <li><a href="unit.php">Data Unit</a></li>
                                            <li><a href="amclist.php">AM Check List</a></li>
                                    </ul>
                                            
                                    </div>
                                </div><!-- /cbp-hrsub-inner -->
                            </div><!-- /cbp-hrsub -->
                        </li>
<? } ?>

<? if($user['kpr']==1) {  ?>                        
                    <li>
                            <a href="#">K P R</a>
                            <div class="cbp-hrsub">
                                <div class="cbp-hrsub-inner"> 
                                    <div>
                                        <h4>KPR Progress</h4>
                                        <ul>
                                            <li><a href="kprcheckhdr.php">Unit Progress</a></li>
                                            <li><a href="kprclmst.php">Master CheckList</a></li>
                                        </ul>
                                    
                                    </div>
                                    <div>
                                        <h4>Master</h4>
                                        <ul>
                                            <li><a href="bank.php">Master Bank</a></li>
                                            <li><a href="notaris.php">Master Notaris</a></li>
                                        </ul>
                                    
                                    </div>
                                
                                </div><!-- /cbp-hrsub-inner -->
                            </div><!-- /cbp-hrsub -->
                        </li>
<? } ?>                     

<? if($user['acc']==1) {  ?>
                    <li>
                            <a href="#">Accounting</a>
                            <div class="cbp-hrsub">
                                <div class="cbp-hrsub-inner"> 
                                     <div>
                                        <h4>RAB Sektor</h4>
                                        <ul>
                                            <li><a href="sektorrabtxn.php" >Entry Transaksi</a></li>
                                            <li><a href="sektorrab.php" >Data RAB Sektor</a></li>
                                            <li><a href="rabmst.php" >Master RAB</a></li>
                                            <li><a href="rabcat.php"  >Kategory RAB</a></li>
                                        </ul>
                                        <h4>Bank</h4>
                                        <ul>
                                            <li><a href="bankbook.php" >Buku Bank</a></li>
                                            <li><a href="bank.php" >Master Bank</a></li>
                                    
                                        </ul>
                                    </div>
                        
                                    <div>
                                        <h4>Piutang Unit</h4>
                                        <ul>
                                            <li><a href="unitarpayment.php">Pembayaran Unit</a></li>
                                            <li><a href="unitar.php">Piutang Unit</a></li>
                                            <li><a href="unitar_all.php">Piutang Semua</a></li>
                                            <li><a href="unitar_rekap.php">Rekap Piutang</a></li>
                                            <li><a href="unitmstpayment.php">Master Pembayaran Unit</a></li>
                                            <li><a href="unithistory.php">History User Mundur</a></li>
                                            
                                        </ul>
                                    </div>

                                       <div>
                                        <h4>General Ladger</h4>
                                        <ul>
                                            <li><a href="glhdr.php" >Jurnal Entry</a></li>
                                            <li><a href="glsummary.php" >Buku Besar</a></li>
                                            <li><a href="accbudget.php" >Saldo Account</a></li>
                                             <li><a href="companysetting.php" >Setting Unit Account</a></li>
                                            <li><a href="acc.php" >Master Account</a></li>
                                        </ul>
                                        <h4>Laporan</h4>
                                        <ul>
                                            <li><a href="plhdr_lap.php" >Laba Rugi</a></li>
                                            <li><a href="cashflow_lap.php" >Arus Kas</a></li>
                                    
                                        </ul>
                                        <h4>Seting Laporan</h4>
                                        <ul>
                                            <li><a href="plhdr.php" >Laba Rugi</a></li>
                                        </ul>
                                    </div>
                                    <div>
                                        <h4>Kontraktor</h4>
                                        <ul>
                                            <li ><a href="spkpaymenthdr.php">Pembayaran Kontraktor</a></li>
                                            <li ><a href="spkpaymentdtl.php">Daftar Pembayaran SPK</a></li>
                                            <li ><a href="unitspk_rekappayment.php">Rekap Pembayaran SPK</a></li>   
                                        </ul>
                                    </div>
                                    <div>
                                        <h4>Kas</h4>
                                        <ul>
                                            <li><a href="txndaily.php">Transaksi Kas</a></li>
                                            <li><a href="txnpos.php">Pos Transaksi</a></li>
                                            <li><a href="txnalokasi.php">Alokasi Transaksi</a></li>
                                        </ul>
                                    </div>




<? } ?>

<? if($user['sms']==1) {  ?>
                    <li>
                            <a href="#">SMS Center</a>
                            <div class="cbp-hrsub">
                                <div class="cbp-hrsub-inner"> 
                                    <div>
                                        <h4>SMS Center</h4>
                                        <ul>
                                            <li><a href="inbox.php">Inbox</a></li>
                                            <li><a href="outbox.php">Outbox</a></li>
                                            <li><a href="sentitems.php">Sent Items</a></li>
                                            <li><a href="groups.php">Group</a></li>
                                            <li><a href="members.php">Member</a></li>
                                            <li><a href="group_member.php">Group Member</a></li>
                                        </ul>
                                    
                                    </div>

                                </div><!-- /cbp-hrsub-inner -->
                            </div><!-- /cbp-hrsub -->
                        </li>


<? } ?>
<? if($user['adm']==1) {  ?>
                    <li>
                            <a href="#">Administrator</a>
                            <div class="cbp-hrsub">
                                <div class="cbp-hrsub-inner"> 
                                    <div>
                                        <h4>Learning &amp; Games</h4>
                                        <ul>
                                            <li><a href="emp.php">User</a></li>
                                            
                                        </ul>
                                    
                                    </div>
                                    
                                </div><!-- /cbp-hrsub-inner -->
                            </div><!-- /cbp-hrsub -->
                        </li>
<? } ?>             

    <li class="single">
                        <ul><li><a href="logout.php">Logout</a></li></ul>
                        </li>
<li class="single">
                        <ul>
                    <li><i><font color="#FFFF08">  Nice Day <? echo $nama; ?></font></i></li>
                   </ul>
                   </li>
                    </ul>
                </nav>
            </div>
        </div>
        <script src="js/cbpHorizontalMenu.min.js"></script>
        <script>
            $(function() {
                cbpHorizontalMenu.init();
            });
        </script>
    </body>
</html>