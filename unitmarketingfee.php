<? require_once('login.php');

$carisektor = $_POST['carisektor'];
$idcontractor = $_POST['idcontractor'];
$kav = $_POST['kav'] ?: '%';
$own = $_POST['own'] ?: '%';
$dsp = $_POST['dsp'] ?: '25';
$carabayar = $_POST['carabayar'];


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>technosoft Indonesia</title>
    <link rel="stylesheet" type="text/css" href="css/style-page.css"/>
    <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="js/unit.js"></script>
</head>
<body>
<? include_once "header.php"; ?>
<div id="divSearch">
    <form id="unit" method="POST" action="" name="unit">
        <table class="header">
            <tr>
                <td>Sektor :
                    <select id="carisektor" name="carisektor" onchange="this.form.submit()">
                        echo "
                        <option value="%">Semua</option>
                        ";
                        <? createsektoroption($carisektor); ?>
                    </select>
                    <input class="button" type="button" value="Cetak" id="btncetak">
                    Kavling : <input type="text" id="kav" name="kav" size="10" value="<? echo $kav; ?>">
                    Customer :<input type="text" id="own" name="own" size="15" value="<? echo $own; ?>">
                    Cara Bayar:<select id="carabayar" name="carabayar" onchange="this.form.submit()">
                        <?
                        echo "<option value=\"KPR\"";
                        if ($carabayar == "KPR") echo "selected";
                        echo ">KPR</option>";
                        echo "<option value=\"Cash\"";
                        if ($carabayar == "Cash") echo "selected";
                        echo ">Cash</option>";
                        ?>
                    </select>

                    Show :<select id="dsp" name="dsp" onchange="this.form.submit()">
                        <? createdspoption($dsp); ?>
                    </select>
                    <input class="button" type="submit" value="Tampilkan" id="btntampil">
                    <input class="button" type="button" value="Tambah" id="btntambah">


                </td>
            </tr>
        </table>
    </form>
    <br/>
</div>

<div id="divPageData"></div>
<div id="divLoading"></div>

</body>
</html> 
