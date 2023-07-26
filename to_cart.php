<?php
$login_name = $_COOKIE['cookie_login_name'];
$passcode = $_COOKIE['cookie_pw'];
$customer_id = $_COOKIE['cookie_cus_id'];

$no_to_cart = $_POST['product-no-to-buy'];
$target_product_id = $_POST['product-to-cart-id'];
$current_stock = $_POST['product-stock-no'];

# 0-99 detect
if (preg_match('/^[0-9]+$/', $no_to_cart) == false){
    echo '<script>alert("Please enter 0 to 99 to buy. No dot.")</script>';
    header("Refresh:0; url=index.php");
    exit();
}
# detect if exist stock_no
if ($no_to_cart > $current_stock){
    echo '<script>alert("Please number that are less than or equal to current stock.")</script>';
    header("Refresh:0; url=index.php");
    exit();
}

$final_stock = $current_stock - $no_to_cart;

include "sqlconfig.php";
$conn = new mysqli($host, $user, $pw, $dname);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}else{
    #product_id is auto increment unique, 
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    #reduce stock_no
    $stmt = $conn->prepare("UPDATE fruit_product
    SET stock_no = $final_stock
    WHERE product_id = $target_product_id;
    ");
    $stmt->execute();
    $stmt->close();
    
    #to Cart
    $stmt_2 = $conn->prepare("INSERT INTO cart (cus_id, product_id, no_on_cart)
    VALUES ($customer_id, $target_product_id, $no_to_cart);
    ");
    $stmt_2->execute();
    $stmt_2->close();
    $conn->close();



    echo '<script>alert("Add cart complete.")</script>';
    #refresh page
    header("Refresh:0; url=index.php");
  
}




?>