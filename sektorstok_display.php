<script type="text/javascript">

    // fungsi ini untuk menampilkan list data sektorstok sesuai halaman (page) yang dipilih.
    // list data yang ditampilkan disesuaikan juga dengan input data pada bagian search.
    function pagination(page) {
        var cari = $("select#sektor").val();


        dataString = 'starting=' + page + '&sektor=' + cari + '&random=' + Math.random();


        $.ajax({
            url: "sektorstok_display.php",
            data: dataString,
            type: "GET",
            success: function (data) {
                $('#divPageData').html(data);
            }
        });
    }

    // fungsi untuk me-load tampilan list data sektorstok, data yang ditampilkan disesuaikan
    // juga dengan input data pada bagian search
    function loadData() {
        var dataString;
        var cari = $("select#sektor").val();

        dataString = 'sektor=' + cari;

        $.ajax({
            url: "sektorstok_display.php", //file tempat pemrosesan permintaan (request)
            type: "GET",
            data: dataString,
            success: function (data) {
                $('#divPageData').html(data);
            }
        });
    }

    $(function () {
        // membuat warna tampilan baris data pada tabel menjadi selang-seling
        $('#sektorstok tr:even:not(#nav):not(#total)').addClass('even');
        $('#sektorstok tr:odd:not(#nav):not(#total)').addClass('odd');

        $("a.edit").click(function () {
            page = $(this).attr("href");
            $("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data
            $("#divPageData").show();
            $("#btnhide").show();
            return false;
        });

        $("a.delete").click(function () {
            el = $(this);
            if (confirm("Apakah benar akan menghapus data sektorstok ini?")) {
                $.ajax({
                    url: $(this).attr("href"),
                    type: "GET",
                    dataType: 'json', //respon yang diminta dalam format JSON
                    success: function (response) {
                        if (response.status == 1) {
                            loadData();
                            $("#divFormContent").load("sektorstok_form.php");
                            $("#divFormContent").hide();
                            $("#btnhide").hide();
                            alert("Data sektorstok berhasil di hapus!");
                        }
                        else {
                            alert("data sektorstok gagal di hapus!");
                        }
                    }
                });
            }
            return false;
        });

    });

</script>

<?php
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php');
include_once('pagination_class.php');
$sektor_idsektor = $_GET['sektor'];
$productname = $_GET['product'];

$sql = "select * from sektorstok a,product b where a.product_idproduct=b.idproduct 
and sektor_idsektor = '$sektor_idsektor' and b.productname like '%" . $productname . "%' order by productname";


if (isset($_GET['starting'])) { //starting page
    $starting = $_GET['starting'];
} else {
    $starting = 0;
}

$recpage = 15;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class($sql, $starting, $recpage);
$result = $obj->result;
?>
<p class="judul">Data Stok Barang Gudang Sektor</p>
<table class="grid" id="sektorstok">
    <tr>
        <th>No.</th>
        <th colspan=2>Sektor</th>
        <th colspan=2>Nama Barang</th>

        <th>Jumlah</th>
        <th>Aksi</th>
    </tr>
    <?php
    //menampilkan data sektorstok
    if (mysql_num_rows($result) != 0) {
        while ($row = mysql_fetch_array($result)) {
            $product = productinfo($row['product_idproduct']);
            $productname = $product['productname'];
            $sektor = sektorinfo($row['sektor_idsektor']);
            $sektorname = $sektor['sektorname'];

            ?>
            <tr>
                <td><? echo $row['idsektorstok']; ?></td>
                <td><? echo $row['sektor_idsektor']; ?></td>
                <td><? echo $sektorname; ?></td>
                <td><? echo $row['product_idproduct']; ?></td>
                <td><? echo $productname; ?></td>
                <td class=right><? echo nf($row['qty']); ?></td>

                <td width=110px><a href="sektorstok_form.php?action=update&id=<? echo $row['idsektorstok']; ?>"
                                   class="edit"> <input type="button" class="button" value="Edit"></a>
                    | <a href="sektorstok_process.php?action=delete&id=<? echo $row['idsektorstok']; ?>" class="delete"><input
                            type="button" class="button" value="Delete"></a></td>
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
