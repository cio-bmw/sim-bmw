<?php
include "connect.php";

############ Edit settings ##############
$ThumbSquareSize = 200; //Thumbnail will be 200x200
$BigImageMaxSize = 500; //Image Maximum height or width
$ThumbPrefix = "thumb_"; //Normal thumb Prefix
$DestinationDirectory = 'uploads/'; //specify upload directory ends with / (slash)
$Quality = 90; //jpeg quality
##########################################
function resizeImage($CurWidth, $CurHeight, $MaxSize, $DestFolder, $SrcImage, $Quality, $ImageType)
{
    //Check Image sie is not 0
    if ($CurWidth <= 0 || $CurHeight <= 0) {
        return false;
    }

    //Construct a proportional size of new image
    $ImageScale = min($MaxSize / $CurWidth, $MaxSize / $CurHeight);
    $NewWidth = ceil($ImageScale * $CurWidth);
    $NewHeight = ceil($ImageScale * $CurHeight);
    $NewCanves = imagecreatetruecolor($NewWidth, $NewHeight);

    // Resize Image
    if (imagecopyresampled($NewCanves, $SrcImage, 0, 0, 0, 0, $NewWidth, $NewHeight, $CurWidth, $CurHeight)) {
        switch (strtolower($ImageType)) {
            case 'image/png':
                imagepng($NewCanves, $DestFolder);
                break;
            case 'image/gif':
                imagegif($NewCanves, $DestFolder);
                break;
            case 'image/jpeg':
            case 'image/pjpeg':
                imagejpeg($NewCanves, $DestFolder, $Quality);
                break;
            default:
                return false;
        }
        //Destroy image, frees memory
        if (is_resource($NewCanves)) {
            imagedestroy($NewCanves);
        }
        return true;
    }

}

//This function corps image to create exact square images, no matter what its original size!
function cropImage($CurWidth, $CurHeight, $iSize, $DestFolder, $SrcImage, $Quality, $ImageType)
{
    //Check Image size is not 0
    if ($CurWidth <= 0 || $CurHeight <= 0) {
        return false;
    }

    //abeautifulsite.net has excellent article about "Cropping an Image to Make Square bit.ly/1gTwXW9
    if ($CurWidth > $CurHeight) {
        $y_offset = 0;
        $x_offset = ($CurWidth - $CurHeight) / 2;
        $square_size = $CurWidth - ($x_offset * 2);
    } else {
        $x_offset = 0;
        $y_offset = ($CurHeight - $CurWidth) / 2;
        $square_size = $CurHeight - ($y_offset * 2);
    }

    $NewCanves = imagecreatetruecolor($iSize, $iSize);
    if (imagecopyresampled($NewCanves, $SrcImage, 0, 0, $x_offset, $y_offset, $iSize, $iSize, $square_size, $square_size)) {
        switch (strtolower($ImageType)) {
            case 'image/png':
                imagepng($NewCanves, $DestFolder);
                break;
            case 'image/gif':
                imagegif($NewCanves, $DestFolder);
                break;
            case 'image/jpeg':
            case 'image/pjpeg':
                imagejpeg($NewCanves, $DestFolder, $Quality);
                break;
            default:
                return false;
        }
        //Destroy image, frees memory
        if (is_resource($NewCanves)) {
            imagedestroy($NewCanves);
        }
        return true;

    }
}

function terbilang($bilangan)
{
    $bilangan = abs($bilangan);

    $angka = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";

    if ($bilangan < 12) {
        $temp = " " . $angka[$bilangan];
    } else if ($bilangan < 20) {
        $temp = terbilang($bilangan - 10) . " belas";
    } else if ($bilangan < 100) {
        $temp = terbilang($bilangan / 10) . " puluh" . terbilang($bilangan % 10);
    } else if ($bilangan < 200) {
        $temp = " seratus" . terbilang($bilangan - 100);
    } else if ($bilangan < 1000) {
        $temp = terbilang($bilangan / 100) . " ratus" . terbilang($bilangan % 100);
    } else if ($bilangan < 2000) {
        $temp = " seribu" . terbilang($bilangan - 1000);
    } else if ($bilangan < 1000000) {
        $temp = terbilang($bilangan / 1000) . " ribu" . terbilang($bilangan % 1000);
    } else if ($bilangan < 1000000000) {
        $temp = terbilang($bilangan / 1000000) . " juta" . terbilang($bilangan % 1000000);
    }

    return $temp;
}


function settanggal($tgl)
{
    $tgl1 = substr($tgl, 6, 4);
    $tgl2 = substr($tgl, 3, 2);
    $tgl3 = substr($tgl, 0, 2);
    $tgl = $tgl1 . '-' . $tgl2 . '-' . $tgl3;
    return $tgl;
}

function settanggaljam($tgl)
{
    $tgl1 = substr($tgl, 6, 4);
    $tgl2 = substr($tgl, 3, 2);
    $tgl3 = substr($tgl, 0, 2);
    $tgl4 = substr($tgl, 11, 8);
    $tgl = $tgl1 . '-' . $tgl2 . '-' . $tgl3 . ' ' . $tgl4;
    return $tgl;
}

function nowdatetime()
{
    $tglnow = date("Y-m-d H:i:s");
    return gettanggaljam($tglnow);
}

function gettanggaljam($tgl)
{
    $tgl1 = substr($tgl, 8, 2);
    $tgl2 = substr($tgl, 5, 2);
    $tgl3 = substr($tgl, 0, 4);
    $tgl4 = substr($tgl, 11, 8);
    $tgl = $tgl1 . '-' . $tgl2 . '-' . $tgl3 . ' ' . $tgl4;
    return $tgl;
}


function gettanggal($tgl)
{
    $tgl1 = substr($tgl, 8, 2);
    $tgl2 = substr($tgl, 5, 2);
    $tgl3 = substr($tgl, 0, 4);
    $tgl = $tgl1 . '-' . $tgl2 . '-' . $tgl3;
    return $tgl;
}


function unitarinfo($id)
{
//edit perintah sql di bawah ini // 
    $sql = "select * from unitar where idunitar='$id'";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    return $row;
}

function unitspkinfo($id)
{
//edit perintah sql di bawah ini // 
    $sql = "select * from unitspk where idunitspk='$id'";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    return $row;
}


function spkcatinfo($id)
{
//edit perintah sql di bawah ini // 
    $sql = "select * from spkcat where idspkcat='$id'";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    return $row;
}

function spkpaymenthdrinfo($id)
{
//edit perintah sql di bawah ini // 
    $sql = "select * from spkpaymenthdr where idspkpaymenthdr='$id'";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    return $row;
}


function clbanguninfo($id)
{
//edit perintah sql di bawah ini // 
    $sql = "select * from clbangun where idclbangun='$id'";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    return $row;
}

function unitmstpaymentinfo($id)
{
//edit perintah sql di bawah ini // 
    $sql = "select * from unitmstpayment where idpayment='$id'";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    return $row;
}

function unitarpaymentinfo($id)
{
//edit perintah sql di bawah ini // 
    $sql = "select * from unitarpayment where unitar_idunitar='$id'";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    return $row;
}


function costcenterinfo($id)
{
//edit perintah sql di bawah ini // 
    $sql = "select * from costcenter where idcostcenter ='$id'";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    return $row;
}

function rabcatinfo($id)
{
//edit perintah sql di bawah ini // 
    $sql = "select * from rabcat where idrabcat='$id'";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    return $row;
}

function rabmstinfo($id)
{
//edit perintah sql di bawah ini // 
    $sql = "select * from rabmst where idrabmst='$id'";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    return $row;
}

function productkayuinfo($id)
{
//edit perintah sql di bawah ini // 
    $sql = "select * from productkayu where idproduct='$id'";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    return $row;
}

function productinfo($id)
{
//edit perintah sql di bawah ini // 
    $sql = "select * from product where idproduct='$id'";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    return $row;
}

function empinfo($id)
{
//edit perintah sql di bawah ini // 
    $sql = "select * from emp where idemp='$id'";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    return $row;
}

function unitinfo($id)
{
    $sql = "select * from unit where idunit='$id'";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    return $row;
}

function sektorstokinfo($id)
{
    $sql = "select * from sektorstok where idsektorstok='$id'";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    return $row;
}


function txnposinfo($id)
{
    $sql = "select * from txnpos where idtxnpos='$id'";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    return $row;
}

function txnalokasiinfo($id)
{
    $sql = "select * from txnalokasi where idtxnalokasi='$id'";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    return $row;
}

function createtxnposoption($kolomid)
{
    $sql = "select idtxnpos,posname from txnpos";
    $result = mysql_query($sql);
    if (!isset($kolomid) || $kolomname == '')
        echo "<option value=%>Semua</option>";
    while ($row = mysql_fetch_row($result)) {
        echo "<option value= $row[0]";
        if ($kolomid == $row[0]) echo 'selected';
        echo ">$row[1]</option>";
    }
}

function createtxnalokasioption($kolomid)
{
    $sql = "select idtxnalokasi,alokasiname from txnalokasi";
    $result = mysql_query($sql);
    if (!isset($kolomid) || $kolomname == '')
        echo "<option value=%>Semua</option>";
    while ($row = mysql_fetch_row($result)) {
        echo "<option value= $row[0]";
        if ($kolomid == $row[0]) echo 'selected';
        echo ">$row[1]</option>";
    }
}


function createcategoryoption($kolomid)
{
    $sql = "select idcat,catname,margin from category";
    $result = mysql_query($sql);
    if (!isset($kolomid) || $kolomname == '')
        echo "<option></option>";
    while ($row = mysql_fetch_row($result)) {
        echo "<option value= $row[0]";
        if ($kolomid == $row[0]) echo 'selected';
        echo ">$row[1]</option>";
    }
}

function createcontractoroption($kolomid)
{
    $sql = "select idcontractor,contractorname from contractor order by contractorname";
    $result = mysql_query($sql);
    if (!isset($kolomid) || $kolomname == '')
        echo "<option value='%'>Semua</option>";
    while ($row = mysql_fetch_row($result)) {
        echo "<option value='" . $row[0] . "'";
        if ($kolomid == $row[0]) echo 'selected';
        echo ">$row[1]</option>";
    }
}

function createrabcatoption($kolomid)
{
    $sql = "select idrabcat,rabcatname from rabcat";
    $result = mysql_query($sql);
    if (!isset($kolomid) || $kolomname == '')
        echo "<option value='%'>Semua</option>";
    while ($row = mysql_fetch_row($result)) {
        echo "<option value='" . $row[0] . "'";
        if ($kolomid == $row[0]) echo 'selected';
        echo ">$row[1]</option>";
    }
}

function createrabmstoption($kolomid)
{
    $sql = "select idrabmst,rabdesc from rabmst";
    $result = mysql_query($sql);
    if (!isset($kolomid) || $kolomname == '')
        echo "<option value='%'>Semua</option>";
    while ($row = mysql_fetch_row($result)) {
        echo "<option value='" . $row[0] . "'";
        if ($kolomid == $row[0]) echo 'selected';
        echo ">$row[1]</option>";
    }
}

function createrabmstoptioncat($cat, $kolomid)
{
    $sql = "select idrabmst,rabdesc from rabmst where rabcat_idrabcat = '$cat'";
    $result = mysql_query($sql);
    if (!isset($kolomid) || $kolomname == '')
        echo "<option value='%'>Semua</option>";
    while ($row = mysql_fetch_row($result)) {
        echo "<option value='" . $row[0] . "'";
        if ($kolomid == $row[0]) echo 'selected';
        echo ">$row[1]</option>";
    }
}


function createspkcatoption($kolomid)
{
    $sql = "select idspkcat,category from spkcat";
    $result = mysql_query($sql);
    if (!isset($kolomid) || $kolomname == '')
        echo "<option value='%'>Semua</option>";
    while ($row = mysql_fetch_row($result)) {
        echo "<option value='" . $row[0] . "'";
        if ($kolomid == $row[0]) echo 'selected';
        echo ">$row[1]</option>";
    }
}

function createkproption($kolomid)
{
    $sql = "select idkpr,kprname from kpr";
    $result = mysql_query($sql);
    if (!isset($kolomid) || $kolomname == '')
        echo "<option value='%'>Semua</option>";
    while ($row = mysql_fetch_row($result)) {
        echo "<option value='" . $row[0] . "'";
        if ($kolomid == $row[0]) echo 'selected';
        echo ">$row[1]</option>";
    }
}

function createuomoption($kolomid)
{
    $sql = "select iduom,uomname from uom";
    $result = mysql_query($sql);
    if (!isset($kolomid) || $kolomname == '')
        echo "<option></option>";
    while ($row = mysql_fetch_row($result)) {
        echo "<option value= $row[0]";
        if ($kolomid == $row[0]) echo 'selected';
        echo ">$row[1]</option>";
    }
}

function createunitoption($sektor, $unit)
{
    $sql = "select idunit,kavling from unit where sektor_idsektor='$sektor'";
    $result = mysql_query($sql);
    if (!isset($unit) || $kavling == '')
        echo "<option value='" % "' >Semua</option>";
    while ($row = mysql_fetch_row($result)) {
        echo "<option value= '" . $row[0] . "'";
        if ($unit == $row[0]) echo 'selected';
        echo ">" . $row[1] . "</option>";
    }
}

function createsektoroption($kolomid)
{
    $sql = "select idsektor,sektorname from sektor";
    $result = mysql_query($sql);
    if (!isset($kolomid) || $kolomname == '')
        echo "<option value='" % "' >Semua</option>";
    while ($row = mysql_fetch_row($result)) {
        echo "<option value= '" . $row[0] . "'";
        if ($kolomid == $row[0]) echo 'selected';
        echo ">" . $row[1] . "</option>";
    }
}

function createmarketeroption($kolomid)
{
    $sql = "select idmarketing,marketing from marketing";
    $result = mysql_query($sql);
    if (!isset($kolomid) || $kolomname == '')
        echo "<option value='" % "' >Semua</option>";
    while ($row = mysql_fetch_row($result)) {
        echo "<option value= '" . $row[0] . "'";
        if ($kolomid == $row[0]) echo 'selected';
        echo ">" . $row[1] . "</option>";
    }
}

function createempoption($kolomid)
{
    $sql = "select idemp,empname from emp";
    $result = mysql_query($sql);
    if (!isset($kolomid) || $kolomname == '')
        echo "<option value='" % "' >Semua</option>";
    while ($row = mysql_fetch_row($result)) {
        echo "<option value= '" . $row[0] . "'";
        if ($kolomid == $row[0]) echo 'selected';
        echo ">" . $row[1] . "</option>";
    }
}

function createsupplieroption($kolomid)
{
    $sql = "select idsupp,suppname,supptype,address,phone,fax,email,website,creditlimit,npwp,contact,pooverdue,aroverdue,active from supplier order by suppname";
    $result = mysql_query($sql);
    if (!isset($kolomid) || $kolomname == '')
        echo "<option value='" % "'>Semua</option>";
    while ($row = mysql_fetch_row($result)) {
        echo "<option value='" . $row[0] . "'";
        if ($kolomid == $row[0]) echo 'selected';
        echo ">" . $row[1] . "</option>";
    }
}

function categoryinfo($id)
{
//edit perintah sql di bawah ini // 
    $sql = "select * from category where idcat='$id'";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    return $row;
}

function kprinfo($id)
{
//edit perintah sql di bawah ini // 
    $sql = "select * from kpr where idkpr='$id'";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    return $row;
}

function contractorinfo($id)
{
//edit perintah sql di bawah ini // 
    $sql = "select * from contractor where idcontractor='$id'";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    return $row;
}

function uominfo($id)
{
//edit perintah sql di bawah ini // 
    $sql = "select * from uom where iduom='$id'";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    return $row;
}

function supplierinfo($id)
{
//edit perintah sql di bawah ini // 
    $sql = "select * from supplier where idsupp='$id'";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    return $row;
}

function pasieninfo($id)
{
//edit perintah sql di bawah ini // 
    $sql = "select * from pasien where regno='" . $id . "'";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    return $row;
}

function nf($number)
{
    $nf = number_format($number, 0, ',', '.');
    return $nf;
}


function rnf($number)
{
    $rnf = str_replace('.', '', $number);
    return $rnf;
}

function createkabupatenoption($idkab)
{
    $sql = "select idkab,kabname from kabupaten";
    $result = mysql_query($sql);
    if (!isset($idkab) || $kabname == '')
        echo "<option></option>";
    while ($row = mysql_fetch_row($result)) {
        echo "<option value=$row[0]";
        if ($idkab == $row[0]) echo 'selected';
        echo ">$row[1]</option>";
    }
}

function sektorinfo($id)
{
//edit perintah sql di bawah ini // 
    $sql = "select * from sektor where idsektor='" . $id . "'";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    return $row;
}

function dokterinfo($id)
{
//edit perintah sql di bawah ini // 
    $sql = "select * from dokter where iddr='" . $id . "'";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    return $row;
}

function desainfo($id)
{
//edit perintah sql di bawah ini // 
    $sql = "select * from desa where iddesa='$id'";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    return $row;
}

function createkecamatanoption($kolomid)
{
    $sql = "select idkec,kecname from kecamatan";
    $result = mysql_query($sql);
    if (!isset($idkec) || $kecname == '')
        echo "<option></option>";
    while ($row = mysql_fetch_row($result)) {
        echo "<option value=$row[0]";
        // if($idkec == $row[0]) echo 'selected';
        echo ">$row[1]</option>";
    }
}

function accinfo($id)
{
//edit perintah sql di bawah ini // 
    $sql = "select * from acc where idacc='$id'";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    return $row;
}


function createagamaoption($idagama)
{
    $sql = "select idagama,agama from agama";
    $result = mysql_query($sql);
    if (!isset($idagama) || $agama == '')
        //echo "<option></option>";
        while ($row = mysql_fetch_row($result)) {
            echo "<option value=$row[0]";
            if ($idagama == $row[0]) echo 'selected';
            echo ">$row[1]</option>";
        }
}

function createjoboption($idjob)
{
    $sql = "select idjob,jobname from job";
    $result = mysql_query($sql);
    if (!isset($idjob) || $jobname == '')
        //echo "<option></option>";
        while ($row = mysql_fetch_row($result)) {
            echo "<option value=" . $row[0] . "";
            if ($idjob == $row[0]) echo 'selected';
            echo ">$row[1]</option>";
        }
}


function createeducationoption($idedu)
{
    $sql = "select idedu,eduname from education";
    $result = mysql_query($sql);
//if(!isset($idedu) || $eduname == '') 
//   echo "<option></option>"; 
    while ($row = mysql_fetch_row($result)) {
        echo "<option value=" . $row[0] . "";
        if ($idedu == $row[0]) echo 'selected';
        echo ">$row[1]</option>";
    }
}

function createdesaoption($iddesa)
{
    $sql = "select iddesa,desaname,kecamatan_idkec from desa";
    $result = mysql_query($sql);
    if (!isset($iddesa) || $desaname == '')
        //  echo "<option></option>";
        while ($row = mysql_fetch_row($result)) {
            echo "<option value=" . $row[0] . "";
            if ($iddesa == $row[0]) echo 'selected';
            echo ">$row[1]</option>";
        }
}

function createroomoption($idroom)
{
    $sql = "select idroom,roomname,bangsal_idbangsal,kelas,tarif from room";
    $result = mysql_query($sql);
    if (!isset($idroom) || $roomname == '')
        echo "<option></option>";
    while ($row = mysql_fetch_row($result)) {
        echo "<option value=" . $row[0] . "";
        if ($idroom == $row[0]) echo 'selected';
        echo ">$row[1]</option>";
    }
}

function createdokteroption($iddr)
{
    $sql = "select iddr,drname,address,phone,tarifpoli,vvip,vip,kelas1,kelas2,kelas3 from dokter";
    $result = mysql_query($sql);
    if (!isset($iddr) || $drname == '')
        //  echo "<option></option>";
        while ($row = mysql_fetch_row($result)) {
            echo "<option value=" . $row[0] . "";
            if ($iddr == $row[0]) echo 'selected';
            echo ">$row[1]</option>";
        }
}

function createicdxoption($idicdx)
{
    $sql = "select idicdx,icdxname from icdx order by icdxname";
    $result = mysql_query($sql);
    if (!isset($idicdx) || $icdxname == '')
        echo "<option></option>";
    while ($row = mysql_fetch_row($result)) {
        echo "<option value=" . $row[0] . "";
        if ($idicdx == $row[0]) echo 'selected';
        echo ">$row[1]</option>";
    }
}

function createstatusselect($status)
{
    echo "<option value='%'";
    if ($status == '%') echo "selected";
    echo ">&nbsp;Semua&nbsp; </option>";
    echo "<option value='open'";
    if ($status == 'open') echo "selected";
    echo ">&nbsp;Open&nbsp; </option>";
    echo "<option value='close'";
    if ($status == 'close') echo "selected";
    echo ">&nbsp;Close&nbsp; </option>";

}

function createstatusdata($status)
{
    echo "<option value='open'";
    if ($status == 'open') echo "selected";
    echo ">&nbsp;Open&nbsp; </option>";
    echo "<option value='confirm'";
    if ($status == 'confirm') echo "selected";
    echo ">&nbsp;Confirm&nbsp; </option>";
}

function createpolioption($poli_id)
{
    $sql = "select poli_id,poli_desc,kelas from poli";
    $result = mysql_query($sql);
    if (!isset($poli_id) || $poli_desc == '')
        echo "<option value='%'";
    if ($poli_id == '%') echo "selected";
    echo ">&nbsp;Semua&nbsp; </option>";

//   echo "<option value='%'></option>"; 
    while ($row = mysql_fetch_row($result)) {
        echo "<option value='" . $row[0] . "'";
        if ($poli_id == $row[0]) echo 'selected';
        echo ">" . $row[1] . "</option>";
    }
}

function poliinfo($id)
{
//edit perintah sql di bawah ini // 
    $sql = "select * from poli where poli_id='$id'";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    return $row;
}

function updatestock($idproduct, $qty, $upd)
{
    if ($upd == 'plus') {
        $sql = "update product set stock = stock+$qty where idproduct='" . $idproduct . "'";
    } else {
        $sql = "update product set stock = stock-$qty where idproduct='" . $idproduct . "'";
    }
    if (mysql_query($sql)) {
    }

}

function updatestocksektor($idproduct, $qty, $sektor)
{
//chek ada	
    $test = mysql_query(" insert into sektorstok (qty,sektor_idsektor,product_idproduct)  values  ('$qty','$sektor','$idproduct')");
    return $test;
}

function createbulanoption($bulan)
{
    echo "<option value=\"1\"";
    if ($bulan == 1) echo 'selected';
    echo ">Januari</option>";
    echo "<option value=\"2\"";
    if ($bulan == 2) echo 'selected';
    echo ">Pebruari</option>";
    echo "<option value=\"3\"";
    if ($bulan == 3) echo "selected";
    echo ">Maret</option>";
    echo "<option value=\"4\"";
    if ($bulan == 4) echo "selected";
    echo ">April</option>";
    echo "<option value=\"5\"";
    if ($bulan == 5) echo "selected";
    echo ">Mei</option>";
    echo "<option value=\"6\"";
    if ($bulan == 6) echo "selected";
    echo ">Juni</option>";
    echo "<option value=\"7\"";
    if ($bulan == 7) echo "selected";
    echo ">Juli</option>";
    echo "<option value=\"8\"";
    if ($bulan == 8) echo "selected";
    echo ">Agustus</option>";
    echo "<option value=\"9\"";
    if ($bulan == 9) echo "selected";
    echo ">September</option>";
    echo "<option value=\"10\"";
    if ($bulan == 10) echo "selected";
    echo ">Oktober</option>";
    echo "<option value=\"11\"";
    if ($bulan == 11) echo "selected";
    echo ">Nopember</option>";
    echo "<option value=\"12\"";
    if ($bulan == 12) echo "selected";
    echo ">Desember</option>";
}

function createtahunoption($tahun)
{
    echo "<option value=\"2012\"";
    if ($tahun == 2012) echo "selected";
    echo "> 2012 </option>";
    echo "<option value=\"2013\"";
    if ($tahun == 2013) echo "selected";
    echo "> 2013 </option>";
    echo "<option value=\"2014\"";
    if ($tahun == 2014) echo "selected";
    echo "> 2014 </option>";
    echo "<option value=\"2015\"";
    if ($tahun == 2015) echo "selected";
    echo "> 2015 </option>";
    echo "<option value=\"2016\"";
    if ($tahun == 2016) echo "selected";
    echo "> 2016 </option>";
    echo "<option value=\"2017\"";
    if ($tahun == 2017) echo "selected";
    echo "> 2017 </option>";
    echo "<option value=\"2018\"";
    if ($tahun == 2017) echo "selected";
    echo "> 2018 </option>";
    echo "<option value=\"2019\"";
    if ($tahun == 2018) echo "selected";
    echo "> 2019 </option>";

}

function createdspoption($dsp)
{
    echo "<option value=\"15\"";
    if ($dsp == 15) echo "selected";
    echo "> 15 </option>";
    echo "<option value=\"100\"";
    if ($dsp == 100) echo "selected";
    echo "> 100 </option>";
    echo "<option value=\"500\"";
    if ($dsp == 500) echo "selected";
    echo "> 500 </option>";
    echo "<option value=\"1000\"";
    if ($dsp == 1000) echo "selected";
    echo "> 1000 </option>";
    echo "<option value=\"5000\"";
    if ($dsp == 5000) echo "selected";
    echo "> 5000 </option>";
}

function createdisplayoption($dsp)
{
    echo "<option value=\"5000\"";
    if ($dsp == 5000) echo "selected";
    echo "> Semua </option>";

    echo "<option value=\"1000\"";
    if ($dsp == 1000) echo "selected";
    echo "> 1000 </option>";
    echo "<option value=\"500\"";
    if ($dsp == 500) echo "selected";
    echo "> 500 </option>";
    echo "<option value=\"100\"";
    if ($dsp == 100) echo "selected";
    echo "> 100 </option>";
    echo "<option value=\"15\"";
    if ($dsp == 15) echo "selected";
    echo "> 15 </option>";
}

function howDays($from, $to)
{
    $first_date = strtotime($from);
    $second_date = strtotime($to);
    $offset = $second_date - $first_date;
    return floor($offset / 60 / 60 / 24);
}


function creategroupaccoption($kolomid)
{
    $sql = "select idgroupacc,groupname from groupacc";
    $result = mysql_query($sql);
//if(!isset($kolomid) || $kolomname == '') 
//   echo "<option value='"%"' >Semua</option>"; 
    while ($row = mysql_fetch_row($result)) {
        echo "<option value= '" . $row[0] . "'";
        if ($kolomid == $row[0]) echo 'selected';
        echo ">" . $row[1] . "</option>";
    }
}

function createunitmstpaymentoption($kolomid)
{
    $sql = "select idpayment,paymentdesc from unitmstpayment";
    $result = mysql_query($sql);
//if(!isset($kolomid) || $kolomname == '') 
//   echo "<option value='"%"' >Semua</option>"; 
    while ($row = mysql_fetch_row($result)) {
        echo "<option value= '" . $row[0] . "'";
        if ($kolomid == $row[0]) echo 'selected';
        echo ">" . $row[1] . "</option>";
    }
}

?>
