<script type="text/javascript">

    // fungsi ini untuk menampilkan list data unitarpayment sesuai halaman (page) yang dipilih.
    // list data yang ditampilkan disesuaikan juga dengan input data pada bagian search.
    function pagination(page) {
        var dataString;
        var cari = $("select#idsektor").val();
        var vstart = $("input#startdate").val();
        var vend = $("input#enddate").val();
        var vdsp = $("select#dsp").val();
        var vkav = $("input#kavling").val();
        var vidpayment = $("select#idpayment").val();

        dataString = 'starting=' + page + '&random=' + Math.random() + '&sektor=' + cari + '&start=' + vstart + '&end=' + vend + '&dsp=' + vdsp + '&kav=' + vkav + '&idpayment=' + vidpayment;


        $.ajax({
            url: "unitarpayment_display.php",
            data: dataString,
            type: "GET",
            success: function (data) {
                $('#divPageData').html(data);
            }
        });
    }

    // fungsi untuk me-load tampilan list data unitarpayment, data yang ditampilkan disesuaikan
    // juga dengan input data pada bagian search
    function loadData() {
        var dataString;
        var cari = $("select#idsektor").val();
        var vstart = $("input#startdate").val();
        var vend = $("input#enddate").val();
        var vdsp = $("select#dsp").val();
        var vkav = $("input#kavling").val();
        var vidpayment = $("select#idpayment").val();

        dataString = 'sektor=' + cari + '&start=' + vstart + '&end=' + vend + '&dsp=' + vdsp + '&kav=' + vkav + '&idpayment=' + vidpayment;


        $.ajax({
            url: "unitarpayment_display.php", //file tempat pemrosesan permintaan (request)
            type: "GET",
            data: dataString,
            success: function (data) {
                $('#divPageData').html(data);
            }
        });
    }

    $(function () {
        // membuat warna tampilan baris data pada tabel menjadi selang-seling
        $('#unitarpayment tr:even:not(#nav):not(#total)').addClass('even');
        $('#unitarpayment tr:odd:not(#nav):not(#total)').addClass('odd');

        $("a.edit").click(function () {
            page = $(this).attr("href");
            $("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data
            $("#divPageData").show();
            $("#btnhide").show();
            return false;
        });

        $("a.delete").click(function () {
            el = $(this);
            if (confirm("Apakah benar akan menghapus data unitarpayment ini?")) {
                $.ajax({
                    url: $(this).attr("href"),
                    type: "GET",
                    dataType: 'json', //respon yang diminta dalam format JSON
                    success: function (response) {
                        if (response.status == 1) {
                            loadData();
                            $("#divFormContent").load("unitarpayment_form.php");
                            $("#divFormContent").hide();
                            $("#btnhide").hide();
                            alert("Data unitarpayment berhasil di hapus!");
                        }
                        else {
                            alert("data unitarpayment gagal di hapus!");
                        }
                    }
                });
            }
            return false;
        });

        $("#cetak").click(function () {
            window.open("unitarpayment_kwitansi.php?id=" + $("input#idunitarpayment").val(), "_blank");
        });
    });

</script>

<?php
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php');
include_once('pagination_class.php');
$idsektor = $_GET['sektor'];
$startdate = settanggal($_GET['start']);
$enddate = settanggal($_GET['end']);
$dsp = $_GET['dsp'];
$kav = $_GET['kav'];
$idpayment = $_GET['idpayment'];


if ($idsektor == '%') {
    $sql = "select * from unitarpayment a, unit b where a.unit_idunit = b.idunit
and pay_date between '$startdate' and '$enddate' and kavling like '%$kav%' and unitmstpayment_idpayment like '%$idpayment%' 
order by pay_date,sektor_idsektor,kavling";
} else {
    $sql = "select * from unitarpayment a, unit b where a.unit_idunit = b.idunit
and b.sektor_idsektor =  '$idsektor' 
and pay_date between '$startdate' and '$enddate' and kavling like '%$kav%' and unitmstpayment_idpayment like '%$idpayment%'
order by pay_date,sektor_idsektor,kavling";
}


if (isset($_GET['starting'])) { //starting page
    $starting = $_GET['starting'];
} else {
    $starting = 0;
}

$recpage = $dsp;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class($sql, $starting, $recpage);
$result = $obj->result;
?>
<p class="judul">Pembayaran Piutang Unit</p>
<table id="unitarpayment" class="grid">
    <tr>
        <th>No. Dok</th>
        <th>Tanggal</th>
        <th>Sektor</th>
        <th>Kavling</th>
        <th>Dibayar Oleh</th>
        <th>Keterangan</th>
        <th>Jumlah</th>
        <th>Catatan</th>
        <th>Transfer</th>
        <th>Aksi</th>
    </tr>
    <?php
    //menampilkan data unitarpayment
    if (mysql_num_rows($result) != 0) {
        $no = 1;
        while ($row = mysql_fetch_array($result)) {
            $payment = unitmstpaymentinfo($row['unitmstpayment_idpayment']);
            $paymentdesc = $payment['paymentdesc'];
            $unit = unitinfo($row['unit_idunit']);
            $kavling = $unit['kavling'];
            $idsektor = $unit['sektor_idsektor'];
            $sektor = sektorinfo($idsektor);
            $sektorname = $sektor['sektorname'];
            ?>
            <tr>
                <td><? echo $no; ?></td>
                <td><? echo gettanggal($row['pay_date']); ?></td>
                <td><? echo $sektorname; ?></td>
                <td><? echo $kavling; ?></td>
                <td><? echo $row['pay_name']; ?></td>
                <td><? echo $paymentdesc; ?></td>
                <td class="right"><? echo nf($row['pay_value']); ?></td>
                <td><? echo $row['pay_note']; ?></td>
                <td><? echo $row['transfer']; ?></td>
                <td width="137">
                    <a href="unitarpayment_kwitansi.php?id=<? echo $row['idunitarpayment']; ?>"
                       class="button"><input class="button-green" type="button" value="Cetak"></a>
                    <a href="unitarpayment_form.php?action=update&id=<? echo $row['idunitarpayment']; ?>"
                       class="edit"><input type="button" class="button" value="Edit"></a>
                    <a href="unitarpayment_process.php?action=delete&id=<? echo $row['idunitarpayment']; ?>"
                       class="delete"><input type="button" class="button-red" value="Delete"></a>
                </td>
            </tr>
            <?
            $total = $total + $row['pay_value'];
            $no++;
        } //end while
        ?>
        <tr>
            <td colspan="6">Total</td>
            <td class="right"><? echo nf($total); ?> </td>
            <td colspan="5"></td>
        </tr>
        <tr id="nav">
            <td colspan="9"><?php echo $obj->anchors; ?></td>
        </tr>
        <tr id="total">
            <td colspan="9"><?php echo $obj->total; ?></td>
        </tr>
    <? } else {
        ?>
        <tr>
            <td align="center" colspan="9">Data tidak ditemukan!</td>
        </tr>
    <? } ?>
</table>
