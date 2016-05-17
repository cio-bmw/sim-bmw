<script type="text/javascript">
    function pagination(page) {
        var dataString;
        var cari = $("select#carisektor").val();
        /*var vdsp = $("select#dsp").val();
        var vcb = $("select#carabayar").val();*/


        dataString = 'starting=' + page + '&sektor_idsektor=' + cari + '&dsp=' + vdsp + '&cb=' + vcb + '&random=' + Math.random();
        ;

        $.ajax({
            url: "unitmarketing_display.php",
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
        var vkav = $('input#kav').val();
        var vown = $('input#own').val();
        dataString = 'sektor_idsektor=' + cari + '&kav=' + vkav + '&own=' + vown + '&cb=' + vcb;


        $.ajax({
            url: "unit_display.php", //file tempat pemrosesan permintaan (request)
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
$kav = $_GET['kav'];
$own = $_GET['own'];
$dsp = $_GET['dsp'];
$cb = $_GET['cb'];

if ($sektor_idsektor == '%') {
    $sql = "select * from unit where sektor_idsektor like '%$sektor_idsektor%'
and kavling like '%$kav%' and owner like '%$own%' and carabayar='$cb'  
order by  kavling";
} else {
    $sql = "select * from unit where sektor_idsektor = '$sektor_idsektor'
 and kavling like '%$kav%' and owner like '%$own%' and carabayar='$cb'
 order by  kavling";
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
<table id="unit">
    <tr>
        <th>Aksi</th>
        <!-- <th>ID Unit</th> -->
        <th colspan=2>Sektor & ID Sektor</th>
        <th>Kavling</th>
        <th>Tipe</th>
        <th>Luas Tanah</th>
        <th>Customer</th>
        <th>Alamat</th>
        <th>Telp./HP</th>
        <th>Harga</th>
        <th>KPR/Cash</th>


    </tr>
    <?php
    //menampilkan data unit
    if (mysql_num_rows($result) != 0) {
        while ($row = mysql_fetch_array($result)) {
            $sektor = sektorinfo($row['sektor_idsektor']);
            $sektorname = $sektor['sektorname'];

            ?>
            <tr>
                <td width=105px>
                    <a href="unit_form.php?action=update&id=<? echo $row['idunit']; ?>" class="edit"> <input
                            type="button" class="button" value="Edit"></a>
                    | <a href="unit_process.php?action=delete&id=<? echo $row['idunit']; ?>" class="delete"><input
                            type="button" class="button" value="Delete"></a></td>


                <!-- <td><? echo $row['idunit']; ?></td> -->

                <td><? echo $row['sektor_idsektor']; ?></td>
                <td><? echo $sektorname; ?></td>
                <td><? echo $row['kavling']; ?></td>
                <td><? echo $row['tipe']; ?></td>
                <td><? echo $row['luastanah']; ?></td>
                <td><? echo $row['owner']; ?></td>
                <td><? echo $row['address']; ?></td>
                <td><? echo $row['phone']; ?></td>
                <td class="right"><? echo nf($row['nkontrakuser']); ?></td>
                <td><? echo $row['carabayar']; ?></td>

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
