<script type="text/javascript">
    function pagination(page) {
        var cari = $("select#sektor_idsektor").val();
        var vdsp = $("select#dsp").val();
        var vkav = $("input#kavling").val();


        dataString = 'starting=' + page + '&sektor_idsektor=' + cari + '&random=' + Math.random() + '&dsp=' + vdsp + '&kav=' + vkav;

        $.ajax({
            url: "unitar_unitdisplay.php",
            data: dataString,
            type: "GET",
            success: function (data) {
                $('#divPageData').html(data);
            }
        });
    }

    // fungsi untuk me-load tampilan list data unit, data yang ditampilkan disesuaikan
    // juga dengan input data pada bagian search
    function loadData() {
        var dataString;
        var cari = $("select#sektor_idsektor").val();
        var vdsp = $("select#dsp").val();
        var vkav = $("input#kavling").val();

        dataString = 'sektor_idsektor=' + vsektor + '&dsp=' + vdsp + '&kav=' + vkav;


        $.ajax({
            url: "unitar_unitdisplay.php", //file tempat pemrosesan permintaan (request)
            type: "GET",
            data: dataString,
            success: function (data) {
                $('#divPageData').html(data);
            }
        });
    }

    $(function () {
        // membuat warna tampilan baris data pada tabel menjadi selang-seling
        $('#unit tr:even:not(#nav):not(#total)').addClass('even');
        $('#unit tr:odd:not(#nav):not(#total)').addClass('odd');

        $("a.detail").click(function () {

            window.location = 'unitar_detail.php';
        });


        $("a.edit").click(function () {
            page = $(this).attr("href");
            $("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data
            $("#divPageData").show();
            $("#btnhide").show();
            return false;
        });

        $("a.delete").click(function () {
            el = $(this);
            if (confirm("Apakah benar akan menghapus data unit ini?")) {
                $.ajax({
                    url: $(this).attr("href"),
                    type: "GET",
                    dataType: 'json', //respon yang diminta dalam format JSON
                    success: function (response) {
                        if (response.status == 1) {
                            loadData();
                            $("#divFormContent").load("unit_form.php");
                            $("#divFormContent").hide();
                            $("#btnhide").hide();
                            alert("Data unit berhasil di hapus!");
                        }
                        else {
                            alert("data unit gagal di hapus!");
                        }
                    }
                });
            }
            return false;
        });
        $(".wmd-view-topscroll").scroll(function () {
            $(".wmd-view")
                .scrollLeft($(".wmd-view-topscroll").scrollLeft());
        });
        $(".wmd-view").scroll(function () {
            $(".wmd-view-topscroll")
                .scrollLeft($(".wmd-view").scrollLeft());
        });

    });

</script>

<?php
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php');
include_once('pagination_class.php');

$sektor_idsektor = $_GET['sektor_idsektor'];
$idkpr = $_GET['idkpr'];
$idcontractor = $_GET['idcontractor'];
$dsp = $_GET['dsp'];
$kav = $_GET['kav'];

if ($sektor_idsektor == '%') {
    $sql = "select * from unit where kavling like '%$kav%'
 order by  sektor_idsektor, kavling";
} else {
    $sql = "select * from unit where sektor_idsektor = '$sektor_idsektor' and kavling like '%$kav%'  order by  kavling";
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
<html>
<body>
<p class="judul">Daftar Piutang Unit</p>
<table id="unit" class="grid">
    <tr>
        <th>Aksi</th>
        <th>No.</th>
        <th>Sektor</th>
        <th>Kavling</th>
        <th>Tipe</th>
        <th>Luas Tanah</th>
        <th>Pembeli</th>
        <th>Tel./HP</th>
        <th>Piutang</th>
        <th>Dibayar</th>
        <th>Sisa</th>
    </tr>
    <?php
    //menampilkan data unit
    if (mysql_num_rows($result) != 0) {
        $no = $starting + 1;
        while ($row = mysql_fetch_array($result)) {
            $sektor = sektorinfo($row['sektor_idsektor']);
            $sektorname = $sektor['sektorname'];
            $idunit = $row['idunit'];

            $sql1 = "select sum(value) total from unitar where unit_idunit = '$idunit'";
            $result1 = mysql_query($sql1);
            $data = mysql_fetch_array($result1);
            $piutang = $data[0];

            $sql2 = "select sum(pay_value) bayar from unitarpayment where unit_idunit = '$idunit'";
            $result2 = mysql_query($sql2);
            $data = mysql_fetch_array($result2);
            $bayar = $data[0];

            $sisa = $piutang - $bayar;

            ?>
            <tr>
                <td width="75px">

                    <a href="unitar_detail.php?idunit=<? echo $row['idunit']; ?>" class="detail"> <input type="button"
                                                                                                         class="button"
                                                                                                         value="AR Detail"></a>

                </td>


                <td class="right"><? echo $no; ?></td>
                <td><? echo $sektorname; ?></td>
                <td><? echo $row['kavling']; ?></td>
                <td><? echo $row['tipe']; ?></td>
                <td><? echo $row['luastanah']; ?></td>
                <td><? echo $row['owner']; ?></td>
                <td><? echo $row['phone']; ?></td>

                <td class="right"><? echo nf($piutang); ?></td>
                <td class="right"><? echo nf($bayar); ?></td>
                <td class="right"><? echo nf($sisa); ?></td>

            </tr>
            <?
            $piutangall = $piutangall + $piutang;
            $bayarall = $bayarall + $bayar;
            $sisaall = $piutangall - $bayarall;
            $no++;
        } //end while
        ?>

        <tr>
            <td colspan="8">Total</td>
            <td class="right"><? echo nf($piutangall); ?></td>
            <td class="right"><? echo nf($bayarall); ?></td>
            <td class="right"><? echo nf($sisaall); ?></td>
        </tr>
        <tr id="nav">
            <td colspan="10"><?php echo $obj->anchors; ?></td>
        </tr>
        <tr id="total">
            <td colspan="10"><?php echo $obj->total; ?></td>
        </tr>
    <? } else {
        ?>
        <tr>
            <td align="center" colspan="10">Data tidak ditemukan!</td>
        </tr>
    <? } ?>
</table>
</body>
</html>
