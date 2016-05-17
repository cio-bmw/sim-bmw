<?
include_once("config.php");
$unitmstpayment_idpayment = $_GET['idpayment'];
$unit_idunit = $_GET['idunit'];
$createdate = date('d-m-Y');

$action = "add";
$judul = "Penambahan Data unitar";
$status = "Tambah";
$sql = "SELECT IFNULL(max(idunitar),0)+1  FROM unitar";
$result = mysql_query($sql);
$data = mysql_fetch_array($result);
$idunitar = $data[0];
if (isset($_GET['action']) and $_GET['action'] == "update" and !empty($_GET['id'])) {
    $str = "select * from unitar where idunitar = '$_GET[id]'";
    $res = mysql_query($str) or die("query gagal dijalankan");
    $data = mysql_fetch_assoc($res);
    $idunitar = $data['idunitar'];
    $createdate = gettanggal($data['createdate']);
    $duedate = gettanggal($data['duedate']);
    $paydate = gettanggal($data['paydate']);
    $doknumb = $data['doknumb'];
    $value = $data['value'];
    $unitmstpayment_idpayment = $data['unitmstpayment_idpayment'];
    $unit_idunit = $data['unit_idunit'];
    $custpayhdr_idcustpayhdr = $data['custpayhdr_idcustpayhdr'];
    $action = "update";
    $readonly = "readonly=readonly";
    $status = "Update";
    $judul = "Update data unitar";
}
$payment = unitmstpaymentinfo($unitmstpayment_idpayment);
$paymentdesc = $payment['paymentdesc'];
?>
<script type="text/javascript">
    $(function () {
        function loadData() {
            var dataString;
            var vidunit = $("input#idunit").val();

            dataString = 'idunit=' + vidunit;

            $.ajax({
                url: "unitar_displaymini.php",
                type: "GET",
                data: dataString,
                success: function (data) {
                    $('#divPageData').html(data);
                }
            });
        }

        $("form#unitar_form").submit(function () {
            if (confirm("Apakah benar akan menyimpan data unitar ini?")) {
                //   var vNama = $("input#namapelanggan").val(); //mengambil id dari input
                //   var vAlamat = $("textarea#alamat").val();
                //   var vNoHP = $("input#nohp").val();
                //   var myRegExp=/^\+62[0-9]+$/;
                //
                //   // cek validasi form dahulu, semua field data harus diisi
                //   if ((vNama.replace(/\s/g,"") == "") || (vAlamat.replace(/\s/g,"") == "") || (vNoHP.replace(/\s/g,"") == "")) {
                //     alert("Mohon melengkapi semua field data!");
                //     $("input#namapelanggan").focus();
                //     return false;
                //   }
                //   // cek validasi no handphone
                //   else if (!myRegExp.test(vNoHP)){
                //     alert ('No handphone harus angka dan diawali +62 (contoh: +62818040567890)');
                //     $("input#nohp").focus();
                //    return false;
                //   }
                //   else{
                $.ajax({
                    url: "unitar_process.php",
                    type: $(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST'
                    data: $(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses
                    dataType: 'json', //respon yang diminta dalam format JSON
                    success: function (response) {
                        if (response.status == 1) // return nilai dari hasil proses
                        {
                            alert("Data berhasil disimpan!");
                            document.unitar_form.unitmstpayment_idpayment.value = '';
                            document.unitar_form.createdate.value = '';
                            document.unitar_form.duedate.value = '';
                            document.unitar_form.value.value = '';
                            document.unitar_form.paymentdesc.value = '';

                            loadData(); //reload list data
                            $("#divFormEntry").load("unitar_form.php");
                            $("#divFormEntry").hide();
                        }
                        else {
                            alert("Data gagal di simpan!");
                        }
                    }
                });
                //		return false;
            }
            //}
            return false;
        });

        $("#btnclose").click(function () {

            page = "unitar_display.php?idunit=" + $('input#idunit').val();
            $("#divPageData").load(page);
            $("#divPageData").show();
            $("#divLOV").hide();
            $("#divPageEntry").hide();

            return false;
        });
    });
</script>


<form method="post" name="unitar_form" action="" id="unitar_form">
    <table width="95%">
        <tr>
            <th colspan="2"><b><?php echo $judul; ?></b></th>
        </tr>
        <?php if ($_GET['action'] == "update") { ?>
            <tr>
                <td class="right">ID</td>
                <td><input type="text" id="idunitar" name="idunitar" size="10" <? echo $readonly; ?>
                           value="<? echo $idunitar; ?>"/></td>
            </tr>
        <?php } else { ?>
            <tr>
                <td class="right"></td>
                <td><input type="hidden" id="idunitar" name="idunitar" size="10" value="<? echo $idunitar; ?>"/></td>
            </tr>
        <?php } ?>
        <tr>
            <td class="right">Kode</td>
            <td><input type="text" id="unitmstpayment_idpayment" name="unitmstpayment_idpayment" size="5" maxlength="25"
                       value="<? echo $unitmstpayment_idpayment; ?>"/></td>
        </tr>
        <tr>
            <td class="right">Keterangan</td>
            <td><input type="text" id="paymentdesc" name="paymentdesc" size="50" maxlength="100"
                       value="<? echo $paymentdesc; ?>"/></td>
        </tr>
        <tr>
            <td class="right">Dibuat</td>
            <td><input type="text" id="createdate" name="createdate" size="10" maxlength="25"
                       value="<? echo $createdate; ?>" readonly/></td>
        </tr>
        <tr>
            <td class="right">Jatuh Tempo</td>
            <td><input type="text" id="duedate" name="duedate" size="10" maxlength="25" value="<? echo $duedate; ?>"/>
            </td>
        </tr>
        <tr>
            <td class="right">Nilai</td>
            <td><input type="text" class="right" id="value" name="value" size="10" maxlength="25"
                       value="<? echo $value; ?>"/></td>
        </tr>

        <tr>

            <input type="hidden" id="unit_idunit" name="unit_idunit" size="30" maxlength="25"
                   value="<? echo $unit_idunit; ?>"/>
        <tr>
            <td></td>
            <td colspan="2">
                <input class="button" type="submit" value="<? echo $status; ?>">
                <input class="button" type="button" id="btnclose" value="Tutup Form">

            </td>
        </tr>
    </table>
    <input type="hidden" name="action" value="<? echo $action; ?>"/>
</form> 