<?
include_once("config.php");
$pay_date = date('d-m-Y');
$unit_idunit = $_GET['idunit'];


$unitar_idunitar = $_GET['id'];
$unitar = unitarinfo($unitar_idunitar);
$unitmstpayment_idpayment = $unitar['unitmstpayment_idpayment'];
$pay_value = $unitar['value'];

$action = "add";
$judul = "Penerimaan Pembayaran Piutang Unit";
$status = "Simpan Pembayaran";
$sql = "SELECT IFNULL(max(idunitarpayment),0)+1  FROM unitarpayment";
$result = mysql_query($sql);
$data = mysql_fetch_array($result);
$idunitarpayment = $data[0];
if (isset($_GET['action']) and $_GET['action'] == "update" and !empty($_GET['id'])) {
    $str = "select * from unitarpayment where idunitarpayment = '$_GET[id]'";
    $res = mysql_query($str) or die("query gagal dijalankan");
    $data = mysql_fetch_assoc($res);
    $idunitarpayment = $data['idunitarpayment'];
    $pay_value = $data['pay_value'];
    $unit_idunit = $data['unit_idunit'];
    $pay_date = gettanggal($data['pay_date']);
    $pay_name = $data['pay_name'];
    $pay_note = $data['pay_note'];
    $transfer = $data['transfer'];
    $unitmstpayment_idpayment = $data['unitmstpayment_idpayment'];
    $action = "update";
    $readonly = "readonly=readonly";
    $status = "Update";
    $judul = "Update data unitarpayment";
}

$unit = unitinfo($unit_idunit);
$kavling = $unit['kavling'];
$pay_name = $unit['owner'];


$payment = unitmstpaymentinfo($unitmstpayment_idpayment);
$paymentdesc = $payment['paymentdesc'];


?>
<script type="text/javascript">

    $(function () {
        $("input#unitarpayment").focus();

        function loadData() {
            var dataString;
            var cari = $("input#fieldcari").val();
            var combo = $("select#pilihcari").val();

            if (combo == "idunitarpayment") {
                dataString = 'idunitarpayment=' + cari;
            }
            else if (combo == "pay_value") {
                dataString = 'pay_value=' + cari;
            }
            else if (combo == "unit_idunit") {
                dataString = 'unit_idunit=' + cari;
            }
            else if (combo == "pay_date") {
                dataString = 'pay_date=' + cari;
            }
            else if (combo == "pay_name") {
                dataString = 'pay_name=' + cari;
            }
            else if (combo == "pay_note") {
                dataString = 'pay_note=' + cari;
            }
            else if (combo == "unitmstpayment_idpayment") {
                dataString = 'unitmstpayment_idpayment=' + cari;
            }

            $.ajax({
                url: "unitarpayment_display.php",
                type: "GET",
                data: dataString,
                success: function (data) {
                    $('#divPageData').html(data);
                }
            });
        }

        $("form#unitarpayment_form").submit(function () {

            if (confirm("Apakah benar akan menyimpan data unitarpayment ini?")) {
                $.ajax({
                    url: "unitarpayment_process.php",
                    type: $(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST'
                    data: $(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses
                    dataType: 'json', //respon yang diminta dalam format JSON
                    success: function (response) {
                        if (response.status == 1) // return nilai dari hasil proses
                        {
                            alert("Data berhasil disimpan!");

                            window.open("unitarpayment_kwitansi.php?id=" + $("input#idunitarpayment").val(), "_blank");

                            page = "unitar_display.php?idunit=" + $('input#idunit').val() + "&dsp=" + $('select#dsp').val();
                            $("#divPageData").load(page);
                            $("#divPageData").show();
                            return false;


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


        $("#btnlovunit").click(function () {
            pagelov = "unit_lov.php?idsektor=" + $('select#idsektor').val();
            $("#divLOV").load(pagelov);
            $("#divLOV").show();
            return false;
        });
        $("#btnlovpayment").click(function () {
            pagelov = "unitar_lov.php?idunit=" + $('input#unit_idunit').val();
            $("#divLOV").load(pagelov);
            $("#divLOV").show();
            return false;
        });
        $("#cetak").click(function () {
            window.open("unitarpayment_kwitansi.php?id=" + $("input#idunitarpayment").val(), "_blank");
        });

    });
</script>
<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
<link rel="stylesheet" href="css/jquery-ui.css"/>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" language="javascript">
    jQuery(function () {
        jQuery('input[name=pay_date]').datepicker({
            changeYear: true,
            changeMonth: true,
            yearRange: "1990:2025",
            dateFormat: "dd-mm-yy"
        });
    })
</script>
<form method="post" name="unitarpayment_form" action="" id="unitarpayment_form">
    <table>
        <tr>
            <th colspan="2"><b><?php echo $judul; ?></b></th>
        </tr>
        <?php if ($_GET['action'] == "update") { ?> <!-- //jika update maka textfield ID Pelanggan ditampilkan -->
            <tr>
                <td class="right">No Dok</td>
                <td><input type="text" id="idunitarpayment" name="idunitarpayment" size="10" <? echo $readonly; ?>
                           value="<? echo $idunitarpayment; ?>"/></td>
            </tr>
        <?php } else { ?>
            <tr>
                <td class="right">No Dok</td>
                <td><input type="text" id="idunitarpayment" name="idunitarpayment" size="10"
                           value="<? echo $idunitarpayment; ?>"/></td>
            </tr>
        <?php } ?>
        <tr>
            <td class="right">Kode Unit / Kavling</td>
            <td>
                <input type="text" id="unit_idunit" name="unit_idunit" size="5" maxlength="25"
                       value="<? echo $unit_idunit; ?>" onchange="this.form.submit()"/>
                <input type="submit" name="unit" class="button" id="btnlovunit" value="...">
                <input type="text" id="kavling" name="kavling" size="30" maxlength="25" value="<? echo $kavling; ?>"/>
            </td>
        </tr>
        <tr>
            <td class="right">Pembayaran</td>
            <td>
                <input type="text" id="unitmstpayment_idpayment" name="unitmstpayment_idpayment" size="5" maxlength="25"
                       value="<? echo $unitmstpayment_idpayment; ?>"/>
                <input type="button" class="button" id="btnlovpayment" value="...">
                <input type="text" id="paymentdesc" name="paymentdesc" size="30" maxlength="25"
                       value="<? echo $paymentdesc; ?>"/>
            </td>
        </tr>

        <tr>
            <td class="right">Jumlah</td>
            <td><input type="text" id="pay_value" name="pay_value" size="10" maxlength="25"
                       value="<? echo $pay_value; ?>"/></td>
        </tr>

        <tr>
            <td class="right">Tanggal Bayar</td>
            <td><input type="text" id="pay_date" name="pay_date" size="10" maxlength="25"
                       value="<? echo $pay_date; ?>"/></td>
        </tr>
        <tr>
            <td class="right">Di bayar Oleh</td>
            <td><input type="text" id="pay_name" name="pay_name" size="30" maxlength="25"
                       value="<? echo $pay_name; ?>"/></td>
        </tr>
        <tr>
            <td class="right">Catatan Lain-Lain</td>
            <td><input type="text" id="pay_note" name="pay_note" size="30" maxlength="25"
                       value="<? echo $pay_note; ?>"/></td>
        </tr>
        <tr>
            <td class="right">Transfer</td>
            <td><input type="text" id="transfer" name="transfer" size="30" maxlength="25"
                       value="<? echo $transfer; ?>"/></td>
        </tr>

        <input type="hidden" id="unitar_idunitar" name="unitar_idunitar" size="30" maxlength="25"
               value="<? echo $unitar_idunitar; ?>"/>
        <tr>
            <td colspan="2">
                <input class="button" type="submit" name="simpan" value="<? echo $status; ?>">
                <input class="button" type="button" id="cetak" name="cetak" value="Cetak Ulang">
            </td>
        </tr>
    </table>
    <input type="hidden" name="action" value="<? echo $action; ?>"/>
</form> 
