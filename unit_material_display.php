<script type="text/javascript">
    function pagination(page) {
        var cari = $("select#carisektor").val();
        dataString = 'starting=' + page + '&sektor_idsektor=' + cari + '&random=' + Math.random();

        $.ajax({
            url: "unit_material_display.php",
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
        var cari = $("select#carisektor").val();
        dataString = 'sektor_idsektor=' + cari;

        $.ajax({
            url: "unit_material_display.php", //file tempat pemrosesan permintaan (request)
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
            window.location = 'unit_detail.php';
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

if ($sektor_idsektor == '%') {
    $sql = "select * from unit where sektor_idsektor like '%$sektor_idsektor%'
 and contractor_idcontractor like '%$idcontractor%' order by  kavling";
} else {
    $sql = "select * from unit where sektor_idsektor = '$sektor_idsektor'
 and contractor_idcontractor like '%$idcontractor%' order by  kavling";
}


if (isset($_GET['starting'])) { //starting page
    $starting = $_GET['starting'];
} else {
    $starting = 0;
}

$recpage = 10;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class($sql, $starting, $recpage);
$result = $obj->result;
?>
<div class="wmd-view-topscroll">
    <div class="scroll-div1" style=" width: 2500px;">
    </div>
</div>
<div class="wmd-view" style="height: 500px;">
    <div class="scroll-div2" style=" width: 2500px; ">
        <html>
        <body>
        <table id="unit">
            <tr>
                <th>Aksi</th>
                <th>ID Unit</th>
                <th colspan=2>Sektor</th>
                <th>Kavling</th>
                <th>Tipe</th>
                <th>Luas Tanah</th>
                <th>Owner</th>
                <th>Alamat</th>
                <th>Tel./HP</th>
                <th>SP3</th>
                <th>Realisasi</th>
                <th>STK</th>
                <th>Bangun</th>
                <th>Jual</th>
                <th>Gambar Terakhir 1</th>
                <th>Gambar Terakhir 2</th>
                <th>Nota Kontrak User</th>
                <th>Nota Kontrak Kontraktor</th>
                <th>Mulai Bangun</th>
                <th>Selesai Bangun</th>
                <th>ID KPR</th>
                <th>ID Kontraktor</th>
            </tr>
            <?php
            //menampilkan data unit
            if (mysql_num_rows($result) != 0) {
                while ($row = mysql_fetch_array($result)) {
                    $sektor = sektorinfo($row['sektor_idsektor']);
                    $sektorname = $sektor['sektorname'];

                    ?>
                    <tr>
                        <td width=60px>
                            <a href="unit_materialbudget_detail.php?id=<? echo $row['idunit']; ?>" class="detail">
                                <input type="button" class="button" value="Detail"></a>
                        </td>


                        <td><? echo $row['idunit']; ?></td>

                        <td><? echo $row['sektor_idsektor']; ?></td>
                        <td><? echo $sektorname; ?></td>
                        <td><? echo $row['kavling']; ?></td>
                        <td><? echo $row['tipe']; ?></td>
                        <td><? echo $row['luastanah']; ?></td>
                        <td><? echo $row['owner']; ?></td>
                        <td><? echo $row['address']; ?></td>
                        <td><? echo $row['phone']; ?></td>
                        <td><? echo $row['sp3']; ?></td>
                        <td><? echo $row['realisasi']; ?></td>
                        <td><? echo $row['stk']; ?></td>
                        <td><? echo $row['bangun']; ?></td>
                        <td><? echo $row['jual']; ?></td>
                        <td><? echo $row['latestimg']; ?></td>
                        <td><? echo $row['latestimg2']; ?></td>
                        <td><? echo $row['nkontrakuser']; ?></td>
                        <td><? echo $row['nkontrakcont']; ?></td>
                        <td><? echo $row['startbangun']; ?></td>
                        <td><? echo $row['endbangun']; ?></td>
                        <td><? echo $row['kpr_idkpr']; ?></td>

                        <td><? echo $row['contractor_idcontractor']; ?></td>


                    </tr>
                <? } //end while
                ?>
                <tr id="nav">
                    <td colspan="5"><?php echo $obj->anchors; ?></td>
                </tr>
                <tr id="total">
                    <td colspan="5"><?php echo $obj->total; ?></td>
                </tr>
            <? } else {
                ?>
                <tr>
                    <td align="center" colspan="5">Data tidak ditemukan!</td>
                </tr>
            <? } ?>
        </table>
        </body>
        </html>
    </div>
</div>
