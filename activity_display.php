<script type="text/javascript">

    // fungsi ini untuk menampilkan list data activity sesuai halaman (page) yang dipilih.
    // list data yang ditampilkan disesuaikan juga dengan input data pada bagian search.
    function pagination(page) {
        var cari = $("input#fieldcari").val();
        var combo = $("select#pilihcari").val();

        if (combo == "idactivity") {
            dataString = 'starting=' + page + '&idactivity=' + cari + '&random=' + Math.random();
        }
        else if (combo == "activity") {
            dataString = 'starting=' + page + '&activity=' + cari + '&random=' + Math.random();
        }
        else if (combo == "soptype_idsoptype") {
            dataString = 'starting=' + page + '&soptype_idsoptype=' + cari + '&random=' + Math.random();
        }
        else if (combo == "unitact_idunitact") {
            dataString = 'starting=' + page + '&unitact_idunitact=' + cari + '&random=' + Math.random();
        }
        else {
            dataString = 'starting=' + page + '&random=' + Math.random();
        }

        $.ajax({
            url: "activity_display.php",
            data: dataString,
            type: "GET",
            success: function (data) {
                $('#divPageData').html(data);
            }
        });
    }

    // fungsi untuk me-load tampilan list data activity, data yang ditampilkan disesuaikan
    // juga dengan input data pada bagian search
    function loadData() {
        var dataString;
        var cari = $("input#fieldcari").val();
        var combo = $("select#pilihcari").val();

        if (combo == "idactivity") {
            dataString = 'idactivity=' + cari;
        }
        else if (combo == "activity") {
            dataString = 'activity=' + cari;
        }
        else if (combo == "soptype_idsoptype") {
            dataString = 'soptype_idsoptype=' + cari;
        }
        else if (combo == "unitact_idunitact") {
            dataString = 'unitact_idunitact=' + cari;
        }

        $.ajax({
            url: "activity_display.php", //file tempat pemrosesan permintaan (request)
            type: "GET",
            data: dataString,
            success: function (data) {
                $('#divPageData').html(data);
            }
        });
    }

    $(function () {
        // membuat warna tampilan baris data pada tabel menjadi selang-seling
        $('#activity tr:even:not(#nav):not(#total)').addClass('even');
        $('#activity tr:odd:not(#nav):not(#total)').addClass('odd');

        $("a.edit").click(function () {
            page = $(this).attr("href");
            $("#divPageData").load(page);
            $("#divPageData").show();
            return false;
        });

        $("a.detail").click(function () {
            window.location = $(this).attr("href");
            return false;
        });

        $("a.delete").click(function () {
            el = $(this);
            if (confirm("Apakah benar akan menghapus data activity ini?")) {
                $.ajax({
                    url: $(this).attr("href"),
                    type: "GET",
                    dataType: 'json', //respon yang diminta dalam format JSON
                    success: function (response) {
                        if (response.status == 1) {
                            loadData();
                            $("#divFormEntry").load("activity_form.php");
                            $("#divFormEntry").hide();
                            alert("Data activity berhasil di hapus!");
                        }
                        else {
                            alert("data activity gagal di hapus!");
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

if (isset($_GET['idactivity']) and !empty($_GET['idactivity'])) {
    $idactivity = $_GET['idactivity'];
    $sql = "select * from activity where idactivity like '%$idactivity%' order by idactivity";
} else if (isset($_GET['activity']) and !empty($_GET['activity'])) {
    $activity = $_GET['activity'];
    $sql = "select * from activity where activity like '%$activity%' order by activity";
} else if (isset($_GET['soptype_idsoptype']) and !empty($_GET['soptype_idsoptype'])) {
    $soptype_idsoptype = $_GET['soptype_idsoptype'];
    $sql = "select * from activity where soptype_idsoptype like '%$soptype_idsoptype%' order by soptype_idsoptype";
} else if (isset($_GET['unitact_idunitact']) and !empty($_GET['unitact_idunitact'])) {
    $unitact_idunitact = $_GET['unitact_idunitact'];
    $sql = "select * from activity where unitact_idunitact like '%$unitact_idunitact%' order by unitact_idunitact";
} else {
    $sql = "select * from activity";
}

if (isset($_GET['starting'])) { //starting page
    $starting = $_GET['starting'];
} else {
    $starting = 0;
}

$recpage = 15;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class($sql, $starting, $recpage);
$result = $obj->result;
?>

<p class="judul">Daftar Aktifitas Karyawan BMW</p>
<table id="activity">
    <tr>
        <th>ID Aktifitas</th>
        <th>Aktifitas</th>
        <th>Tipe SOP</th>
        <th>Aktifitas Unit</th>
        <th>Aksi</th>
    </tr>
    <?php
    //menampilkan data activity
    if (mysql_num_rows($result) != 0) {
        while ($row = mysql_fetch_array($result)) { ?>
            <tr>
                <td><? echo $row['idactivity']; ?></td>
                <td><? echo $row['activity']; ?></td>
                <td><? echo $row['soptype_idsoptype']; ?></td>
                <td><? echo $row['unitact_idunitact']; ?></td>

                <td width="150px">
                    <a href="activity_detail.php?action=detail&id=<? echo $row['idactivity']; ?>" class="detail"> <input
                            type="button" class="button" value="Detail"></a>
                    | <a href="activity_form.php?action=update&id=<? echo $row['idactivity']; ?>" class="edit"> <input
                            type="button" class="button" value="Edit"></a>
                    | <a href="activity_process.php?action=delete&id=<? echo $row['idactivity']; ?>"
                         class="delete"><input type="button" class="button" value="Delete"></a>
                </td>
            </tr>
        <? } //end while
        ?>
        <tr id="nav">
            <td colspan="5"><?php echo $obj->anchors; ?></td>
        </tr>
        <tr id="total">
            <td colspan="5"><?php echo $obj->total; ?></td>
        </tr>
    <? } else { ?>
        <tr>
            <td align="center" colspan="5">Data tidak ditemukan!</td>
        </tr>
    <? } ?>
</table>
