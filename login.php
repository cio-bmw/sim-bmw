<?php
session_start();

$login = $_POST['login'];
$user = $_POST['user'];
$password = $_POST['password'];
$db = $_POST['db'];

$_SESSION['cookie_db'] = $db;
$cookiedb = $_SESSION['cookie_db'];

require_once "config.php";

$cookie_name = $_SESSION['cookie_name'];
$cookie_role = $_SESSION['cookie_role'];


$enc_pwd = $_SESSION['enc_pwd'];
$usertype = $_SESSION['usertype'];
$HTTP_REFERER = $_SERVER['HTTP_REFERER'];

if (isset($login)) {
	
	
	
   $pwd=md5($password);
  
	if(checkUser($user,$pwd)) {
		
	   $userinfo = getuserinfo($user);
                
      $cookie_role = $userinfo['userrole'];
		$_SESSION['cookie_role'] = $cookie_role;
   
      
      $cookie_name = $user;
		$_SESSION['cookie_name'] = $cookie_name;
	
	   $_SESSION['cookie_db'] = $db;
      $cookiedb = $_SESSION['cookie_db'];

     
      
      $cookie_empname = $userinfo['empname'];
		$_SESSION['cookie_empname'] = $cookie_empname;
   
   
   
    	$enc_pwd = $pwd;
   	$_SESSION['enc_pwd'] = $enc_pwd;
 	
 		$referer = "$HTTP_REFERER";
		 echo "<meta http-equiv='Refresh' content='0;url=index.php'>";
          return;
         }
	else 
         {
	 echo '<script > alert("User atau Password yang anda Masukkan Salah !!! Ulangi Lagi")</script>';
 	 echo "<meta http-equiv='Refresh' content='0;url=login.php'>";
 	 return;
	}
}


if(!isCookieSet()) {
echo '
<html><head>
<title>technosoft INDONESIA</title>
</head>
<body>
<form action="login.php" method=post>
<table align=center style="padding-top:25px; padding-bottom:25px; border-width: 1px;
	border-style: solid;	border-color: #ccd2d2;  padding-left:25px; padding-right:25px  " class=submain wdth=300px>
<tr><td align=center colspan=2><img src="images/logo.png" width="400px" height="200px" ></td></tr>

<tr><td align="right">Username&nbsp;:</td><td><input type=text name=user size=12></td></tr>
<tr><td align="right" >Password&nbsp;:</td><td><input type=password name=password size=12></td></tr>


<tr><td></td><td><input type=submit name="login" value="Login"></td></tr>

</table>																		</tr>
</body>
</html>';
exit;
}


/***********************************************************************************************************
**	function isCookieSet():
************************************************************************************************************/
function isCookieSet() {
	global $cookie_name, $enc_pwd,$cookiedb;
	if((checkUser($cookie_name, $enc_pwd)) && $cookie_name != '') {
		return true;
	} else {
		return false;
	}
}

/***********************************************************************************************************
**	function checkCustomerUser():
************************************************************************************************************/
function checkUser($user,$pwd) {
	$sql = "select * from emp where idemp='$user' and empasswd='$pwd'";
	$result = mysql_query($sql);
	if(mysql_fetch_row($result)) {
		return true;
	} else {
		return false;
	}
}

function getuserinfo($user) {
	$sql = "select * from emp where idemp='".$user."'";
	$result = mysqli_query($sql);
	$row = mysql_fetch_array($result);
	return $row;
}



?>
