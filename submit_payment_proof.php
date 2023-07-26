<?php
$login_name = $_COOKIE['cookie_login_name'];
$passcode = $_COOKIE['cookie_pw'];
$customer_id = $_COOKIE['cookie_cus_id'];

$order_lot_id = $_POST['order-lot-id-in-order-status'];
$pay_proof_input = $_POST['pay-proof'];

include "sqlconfig.php";
$conn = new mysqli($host, $user, $pw, $dname);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}else{
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    #update pay_proof
    $stmt = $conn->prepare("UPDATE order_lot
    SET pay_proof=$pay_proof_input
    WHERE order_lot_id=$order_lot_id;
    ");
    $stmt->execute();
    $stmt->close();


    echo '<script>alert("Payment proof submit success")</script>';
    #refresh page
    header("Refresh:0; url=order_status.php");
  
}

?>