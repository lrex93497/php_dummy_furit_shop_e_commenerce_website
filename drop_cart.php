<?php
$login_name = $_COOKIE['cookie_login_name'];
$passcode = $_COOKIE['cookie_pw'];
$customer_id = $_COOKIE['cookie_cus_id'];

$cart_id = $_POST['current-cart-id'];
$cart_stock_no = $_POST['cart-stock-no'];
$product_id = $_POST['cart-product-id'];

include "sqlconfig.php";
$conn = new mysqli($host, $user, $pw, $dname);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}else{
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    #drop respective cart row
    $stmt = $conn->prepare("DELETE FROM cart 
    WHERE cart_id=$cart_id;
    ");
    $stmt->execute();
    $stmt->close();

    #add stock back
    $stmt_2 = $conn->prepare("UPDATE fruit_product
    SET stock_no = stock_no+$cart_stock_no
    WHERE product_id = $product_id;
    ");
    $stmt_2->execute();
    $stmt_2->close();
    $conn->close();


    echo '<script>alert("remove complete.")</script>';
    #refresh page
    header("Refresh:0; url=cart.php");
  
}




?>