<?php
$login_name = $_COOKIE['cookie_login_name'];
$passcode = $_COOKIE['cookie_pw'];
$customer_id = $_COOKIE['cookie_cus_id'];



include "sqlconfig.php";
$conn = new mysqli($host, $user, $pw, $dname);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}else{
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    #create new order_lot_id row
    $stmt = $conn->prepare("INSERT INTO order_lot (cus_id, pay_proof, accept_state, create_time, shipment_state)
    VALUES ($customer_id, '', '0', NOW(), '0');
    ");
    $stmt->execute();
    $stmt->close();

    #get new order_lot_id, it is biggest as newest at same cus_id and order_lot_id is AUTO_INCREMENT
    $sql = "SELECT MAX(order_lot_id) AS largerest
    FROM order_lot
    WHERE cus_id=$customer_id;
    ";
    $result = $conn->query($sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $order_lot_id = $row["largerest"];
    }


    #add to order_FETAILS table
    $stmt_2 = $conn->prepare("INSERT INTO order_detail (product_id, no_product, cus_id, order_lot_id)
        SELECT product_id, no_on_cart, cus_id, $order_lot_id
        FROM cart
        WHERE cus_id=$customer_id
    ");
    $stmt_2->execute();
    $stmt_2->close();
    

    #remove moved bought product from cart
    $stmt_3 = $conn->prepare("DELETE FROM cart 
    WHERE cus_id=$customer_id;
    ");
    $stmt_3->execute();
    $stmt_3->close();
    $conn->close();


    echo '<script>alert("Buy all complete. Please check order.")</script>';
    #refresh page
    header("Refresh:0; url=cart.php");
  
}

?>