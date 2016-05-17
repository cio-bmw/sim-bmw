<?
$idreceivehdr = $_GET['id']; ?>


<script type="text/javascript">
    function getURLParameter(name) {
        return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search) || [, ""])[1].replace(/\+/g, '%20')) || null
    }

    // fungsi ini untuk menampilkan list data receivedtlsektor sesuai halaman (page) yang dipilih.
    // list data yang ditampilkan disesuaikan juga dengan input data pada bagian search.
    function pagination(page) {
        var cari = $("input#fieldcari").val();
        var combo = $("select#pilihcari").val();
        var myvar = getURLParameter('id');
        var param = 'id=' + myvar;


        if (combo == "idreceivedtl") {
            dataString = 'starting=' + page + '&idreceivedtl=' + cari + '&random=' + Math.random();
        }
        else if (combo == "qty") {
            dataString = 'starting=' + page + '&qty=' + cari + '&random=' + Math.random();
        }
        else if (combo == "receive_price") {
            dataString = 'starting=' + page + '&receive_price=' + cari + '&random=' + Math.random();
        }
        else if (combo == "dtl_ppn") {
            dataString = 'starting=' + page + '&dtl_ppn=' + cari + '&random=' + Math.random();
        }
        else if (combo == "receive_priceppn") {
            dataString = 'starting=' + page + '&receive_priceppn=' + cari + '&random=' + Math.random();
        }
        else if (combo == "receive_pricedisc") {
            dataString = 'starting=' + page + '&receive_pricedisc=' + cari + '&random=' + Math.random();
        }
        else if (combo == "dtl_percent") {
            dataString = 'starting=' + page + '&dtl_percent=' + cari + '&random=' + Math.random();
        }
        else if (combo == "dtl_discount") {
            dataString = 'starting=' + page + '&dtl_discount=' + cari + '&random=' + Math.random();
        }
        else if (combo == "batch_no") {
            dataString = 'starting=' + page + '&batch_no=' + cari + '&random=' + Math.random();
        }
        else if (combo == "exp_date") {
            dataString = 'starting=' + page + '&exp_date=' + cari + '&random=' + Math.random();
        }
        else if (combo == "receivehdrsektor_idreceivehdr") {
            dataString = 'starting=' + page + '&receivehdrsektor_idreceivehdr=' + cari + '&random=' + Math.random();
        }
        else if (combo == "product_idproduct") {
            dataString = 'starting=' + page + '&product_idproduct=' + cari + '&random=' + Math.random();
        }
        else {
            dataString = 'starting=' + page + '&random=' + Math.random();
        }

        $.ajax({
            url: "receivedtlsektor_display.php",
            data: param,
            type: "GET",
            success: function (data) {
                $('#divPageData').html(data);
            }
        });
    }

    // fungsi untuk me-load tampilan list data receivedtlsektor, data yang ditampilkan disesuaikan
    // juga dengan input data pada bagian search
    function loadData() {
        var dataString;
        var cari = $("input#fieldcari").val();
        var combo = $("select#pilihcari").val();
        var myvar = getURLParameter('id');
        var param = 'id=' + myvar;

        if (combo == "idreceivedtl") {
            dataString = 'idreceivedtl=' + cari;
        }
        else if (combo == "qty") {
            dataString = 'qty=' + cari;
        }
        else if (combo == "receive_price") {
            dataString = 'receive_price=' + cari;
        }
        else if (combo == "dtl_ppn") {
            dataString = 'dtl_ppn=' + cari;
        }
        else if (combo == "receive_priceppn") {
            dataString = 'receive_priceppn=' + cari;
        }
        else if (combo == "receive_pricedisc") {
            dataString = 'receive_pricedisc=' + cari;
        }
        else if (combo == "dtl_percent") {
            dataString = 'dtl_percent=' + cari;
        }
        else if (combo == "dtl_discount") {
            dataString = 'dtl_discount=' + cari;
        }
        else if (combo == "batch_no") {
            dataString = 'batch_no=' + cari;
        }
        else if (combo == "exp_date") {
            dataString = 'exp_date=' + cari;
        }
        else if (combo == "receivehdrsektor_idreceivehdr") {
            dataString = 'receivehdrsektor_idreceivehdr=' + cari;
        }
        else if (combo == "product_idproduct") {
            dataString = 'product_idproduct=' + cari;
        }

        $.ajax({
            url: "receivedtlsektor_display.php", //file tempat pemrosesan permintaan (request)
            type: "GET",
            data: param,
            success: function (data) {
                $('#divPageData').html(data);
            }
        });
    }

    $(function () {
        // membuat warna tampilan baris data pada tabel menjadi selang-seling
        $('#receivedtlsektor tr:even:not(#nav):not(#total)').addClass('even');
        $('#receivedtlsektor tr:odd:not(#nav):not(#total)').addClass('odd');

        $("a.edit").click(function () {
            page = $(this).attr("href");
            $("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data
            $("#divPageData").show();
            $("#btnhide").show();
            return false;
        });

        $("a.delete").click(function () {
            el = $(this);
            if (confirm("Apakah benar akan menghapus data receivedtlsektor ini?")) {
                $.ajax({
                    url: $(this).attr("href"),
                    type: "GET",
                    dataType: 'json', //respon yang diminta dalam format JSON
                    success: function (response) {
                        if (response.status == 1) {
                            loadData();
                            $("#divFormContent").load("receivedtlsektor_form.php");
                            $("#divFormContent").hide();
                            $("#btnhide").hide();
                            alert("Data receivedtlsektor berhasil di hapus!");
                        }
                        else {
                            alert("data receivedtlsektor gagal di hapus!");
                        }
                    }
                });
            }
            return false;
        });

    });

</script>

<?php
include_once('config.php');
include_once('pagination_class.php');


$sql = "select * from receivedtlsektor where receivehdrsektor_idreceivehdr = '$idreceivehdr'";

if (isset($_GET['starting'])) { //starting page
    $starting = $_GET['starting'];
} else {
    $starting = 0;
}

$recpage = 25;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class($sql, $starting, $recpage);
$result = $obj->result;
?>
<p class="judul">Daftar Barang Yang Di terima</p>
<table class="grid" id="receivedtlsektor">
    <tr>
        <th>Nox <? echo $id; ?> </th>
        <th colspan=2>Nama Barang</th>
        <th>Qty</th>
        <th>Harga Beli</th>
        <th>Total</th>
        <th>Aksi</th>
    </tr>
    <?php
    //menampilkan data receivedtlsektor
    if (mysql_num_rows($result) != 0) {
        $alltotal = 0;
        while ($row = mysql_fetch_array($result)) {
            $product = productinfo($row['product_idproduct']);
            $productname = $product['productname'];
            $total = $row['qty'] * $row['receive_price'];
            $alltotal = $alltotal + $total;
            ?>
            <tr>
                <td><? echo $row['idreceivedtl']; ?></td>
                <td><? echo $row['product_idproduct']; ?></td>
                <td><? echo $productname; ?></td>
                <td class="right"><? echo nf($row['qty']); ?></td>
                <td class="right"><? echo nf($row['receive_price']); ?></td>
                <td class="right"><? echo nf($total); ?></td>

                <td width=110px><a href="receivedtlsektor_form.php?action=update&id=<? echo $row['idreceivedtl']; ?>"
                                   class="edit"> <input type="button" class="button" value="Edit"></a>
                    | <a href="receivedtlsektor_process.php?action=delete&id=<? echo $row['idreceivedtl']; ?>"
                         class="delete"><input type="button" class="button" value="Delete"></a></td>

            </tr>
        <? } //end while
        ?>
        <tr id="nav">
            <td colspan="5"><?php echo $obj->anchors; ?></td>
            <td class="right"><? echo nf($alltotal); ?> </td>
            <td></td>
        </tr>
        <tr id="total">
            <td colspan="7"><?php echo $obj->total; ?></td>
        </tr>
    <? } else {
        ?>
        <tr>
            <td align="center" colspan="5">Data tidak ditemukan!</td>
        </tr>
    <? } ?>
</table>
