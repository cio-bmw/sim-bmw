<? require_once('login.php');

$sektor = $_POST['sektor_idsektor'];
$duedate = $_POST['duedate'] ?: date('d-m-Y');
$duedate1 = $_POST['duedate1'] ?: date('d-m-Y');

$paydate = $_POST['paydate'] ?: date('d-m-Y');
$dsp = $_POST['dsp'] ?: 5000;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>technosoft Indonesia</title>
    <link rel="stylesheet" type="text/css" href="css/style-page.css"/>
    <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="js/unitar_all.js"></script>

    <script type="text/javascript" src="js/jquery-1.9.1.js"></script>
    <link rel="stylesheet" href="css/jquery-ui.css"/>
    <script type="text/javascript" src="js/jquery-ui.js"></script>
    <script type="text/javascript" language="javascript">
        jQuery(function () {
            jQuery('input[name=duedate]').datepicker({
                changeYear: true,
                changeMonth: true,
                yearRange: "1990:2025",
                dateFormat: "dd-mm-yy"
            });
            jQuery('input[name=duedate1]').datepicker({
                changeYear: true,
                changeMonth: true,
                yearRange: "1990:2025",
                dateFormat: "dd-mm-yy"
            });
        })
    </script>


</head>
<body>
<? include_once "header.php"; ?>
<div id="divSearch">
    <form id="unitar" method="POST" action="" name="unitar">
        <table class="header">
            <tr>
                <td>
                    Sektor :
                    <select id="sektor_idsektor" name="sektor_idsektor" onchange="this.form.submit()">
                        echo "
                        <option value="%">Semua</option>
                        ";
                        <? createsektoroption($sektor); ?>
                    </select>
                    Jatuh Tempo : <input type="text" size=8 name="duedate" id="duedate" value="<? echo $duedate; ?>"
                                         onchange="this.form.submit()"/>
                    s/d <input type="text" size=8 name="duedate1" id="duedate1" value="<? echo $duedate1; ?>"
                               onchange="this.form.submit()"/>

                    Show :<select id="dsp" name="dsp" onchange="this.form.submit()">
                        <? createdisplayoption($dsp); ?>
                    </select>

                    <input class="button" type="button" value="Tampilkan" id="btnshow"/>


                </td>
            </tr>
        </table>
    </form>
</div>
<div id="column1-wrap" style="width:550px;">
    <div id="divPageEntry"></div>
    <br>

    <div id="divPageData"></div>
</div>
<div id="divLOV" style="width:450px;"></div>
<div id="clear"></div>
<br>


</body>
</html> 