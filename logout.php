<?php
if (isset($_COOKIE['cookie_login_name'])) {
    $login_name = $_COOKIE['cookie_login_name'];
    $passcode = $_COOKIE['cookie_pw'];
	$customer_id = $_COOKIE['cookie_cus_id'];
    #clean all cookie
    setcookie("cookie_login_name", $login_name, time()-1, "/"); #86400 = 1 day, expiry after 1 day.
    setcookie("cookie_pw", $passcode, time()-1, "/"); #86400 = 1 day, expiry after 1 day.
    setcookie("cookie_cus_id", $cus_id, time()-1, "/"); #86400 = 1 day, expiry after 1 day.
    setcookie("cookie_current_lot_order_id", $current_lot_order_id, time()-1, "/");
    #back to login
    header("Refresh:0; register_login.php");
	echo '<script>alert("logout success")</script>';
	exit();
}
header("Refresh:0; register_login.php");
echo '<script>alert("You did not logined in")</script>';
exit();

?>