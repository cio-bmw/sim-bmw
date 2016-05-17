<script type="text/javascript">
    function pagination(page) {
        var dataString;
        var cari = $("select#sektor_idsektor").val();


        dataString = 'starting=' + page + '&sektor_idsektor=' + cari + '&random=' + Math.random();
        ;

        $.ajax({
            url: "slshdrunit_unitdisplay.php",
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


        dataString = 'starting=' + page + '&sektor_idsektor=' + cari + '&random=' + Math.random();
        ;


        $.ajax({
            url: "slshdrunit_unitdisplay.php", //file tempat pemrosesan permintaan (request)
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
            page = $(this).attr("href");
            $("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data
            $("#divPageData").show();
            return false;

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
$sektor = sektorinfo($sektor_idsektor);
$sektorname = $sektor['sektorname'];


if ($sektor_idsektor == '%') {
    $sql = "select * from unit where bangun ='proses' order by  kavling";
} else {
    $sql = "select * from unit where sektor_idsektor = '$sektor_idsektor'
  and bangun = 'proses' order by  kavling";
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
    <div class="scroll-div1" style=" width: 2800px;">
    </div>
</div>
<div class="wmd-view" style="height: 500px;">
    <div class="scroll-div2" style=" width: 2800px; ">
        <html>
        <body>
        <p class="judul">Rekap Pengeluaran Barang Ke Unit Sektor <? echo $sektorname; ?></p>
        <table id="unit" class="grid">
            <tr>
                <th>Aksi</th>
                <th>Unit</th>
                <th colspan=2>Sektor</th>
                <th>Kavling</th>
                <th>Tipe</th>
                <th>Luas Tanah</th>
                <th>Progress</th>
                <th>Budget</th>
                <th>Kontraktor</th>
                <th>Pemilik</th>
            </tr>
            <?php
            //menampilkan data unit
            if (mysql_num_rows($result) != 0) {
                while ($row = mysql_fetch_array($result)) {
                    $sektor = sektorinfo($row['sektor_idsektor']);
                    $sektorname = $sektor['sektorname'];

                    $contractor = contractorinfo($row['contractor_idcontractor']);
                    $contractorname = $contractor['contractorname'];

                    $idunit = $row['idunit'];

                    $sqlb = "SELECT sum(price*budget_qty) budget FROM unit_materialbudget where unit_idunit ='$idunit' ";
                    $resultb = mysql_query($sqlb);
                    $datab = mysql_fetch_array($resultb);
                    $budget = $datab[0];


                    $sqlp = "SELECT sum(sales_price*qty) jprogress FROM slsdtlunit a, slshdrunit b where a.slshdrunit_idslshdr =b.idslshdr and unit_idunit ='$idunit' ";
                    $resultp = mysql_query($sqlp);
                    $datap = mysql_fetch_array($resultp);
                    $jprogress = $datap[0];

                    ?>
                    <tr>
                        <td width=75px>
                            <a href="slsdtlunit_rekap.php?action=update&id=<? echo $row['idunit']; ?>" class="detail">
                                <input type="button" class="button" value="Breakdown"></a>
                        </td>
                        <td><? echo $row['idunit']; ?></td>
                        <td><? echo $row['sektor_idsektor']; ?></td>
                        <td><? echo $sektorname; ?></td>
                        <td><? echo $row['kavling']; ?></td>
                        <td><? echo $row['tipe']; ?></td>
                        <td><? echo $row['luastanah']; ?></td>
                        <td class="right"><? echo nf($jprogress); ?></td>
                        <td class="right"><? echo nf($budget); ?></td>
                        <td><? echo $contractorname; ?></td>
                        <td><? echo $row['owner']; ?></td>
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
