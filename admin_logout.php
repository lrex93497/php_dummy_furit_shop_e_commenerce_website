<?php
if (isset($_COOKIE['cookie_login_name'])) {
    $login_name = $_COOKIE['cookie_login_name'];
    $passcode = $_COOKIE['cookie_pw'];
	$customer_id = $_COOKIE['cookie_cus_id'];
}else{
    #clean all cookie
    setcookie("cookie_admin_login_name", $login_name, time()-1, "/"); #86400 = 1 day, expiry after 1 day.
    setcookie("cookie_admin_pw", $passcode, time()-1, "/"); #86400 = 1 day, expiry after 1 day.
    #back to login
    header("Refresh:0; admin_login.php");
	echo '<script>alert("logout success")</script>';
	exit();
}
header("Refresh:0; admin_login.php");
echo '<script>alert("logout success")</script>';
exit();

?>