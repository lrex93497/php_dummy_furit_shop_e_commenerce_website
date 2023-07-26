<?php
$login_name = $_COOKIE['cookie_admin_login_name'];
$passcode = $_COOKIE['cookie_admin_pw'];

$order_lot_id = $_POST['order-lot-id'];

include "sqlconfig.php";
$conn = new mysqli($host, $user, $pw, $dname);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}else{
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    $stmt = $conn->prepare("UPDATE order_lot
    SET accept_state = '1'
    WHERE order_lot_id = $order_lot_id;
    ");
    $stmt->execute();
    $stmt->close();
    
    #refresh page
    header("Refresh:0; url=admin_work_space.php");
  
}

?>