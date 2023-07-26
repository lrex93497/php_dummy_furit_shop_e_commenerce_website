<?php
$login_name = $_COOKIE['cookie_login_name'];
$passcode = $_COOKIE['cookie_pw'];
$customer_id = $_COOKIE['cookie_cus_id'];

$current_lot_order_id = $_POST['current-lot-order-id'];
setcookie("cookie_current_lot_order_id", $current_lot_order_id, time() + (86400 * 1), "/"); #86400 = 1 day, expiry after 1 day.
header("Refresh:0; url=order_status.php");
?>