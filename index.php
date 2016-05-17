<?php
//a:9:{s:4:"lang";s:2:"en";s:9:"auth_pass";s:32:"d41d8cd98f00b204e9800998ecf8427e";s:8:"quota_mb";i:0;s:17:"upload_ext_filter";a:0:{}s:19:"download_ext_filter";a:0:{}s:15:"error_reporting";i:1;s:7:"fm_root";s:0:"";s:17:"cookie_cache_time";i:2592000;s:7:"version";s:5:"0.9.8";}
$userid = $_SESSION['cookie_name'];
$role = $_SESSION['cookie_role'];

require_once('login.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="robots" content="all"/>
    <title>Technosoft Indonesia Software</title>
    <link rel="stylesheet" type="text/css" href="css/latofonts.css">
    <link rel="stylesheet" type="text/css" href="css/latostyle.css">
    <link rel="stylesheet" type="text/css" href="css/style-page.css"/>
    <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
</head>
<body>
<? include_once "header.php"; ?>
<div id="divPagexData" style="width:1000px; padding:20px 10px 0 10px;">
</div>
<div id="divPagexEntry" style="width:1000px; padding:20px 10px 0 10px;"></div>
<div id="clear"></div>
</body>
</html>