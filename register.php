<?php
$login_name = $_POST['login-name-sign-up'];
$email = $_POST['email'];
$cus_name = $_POST['cus-name'];
$address = $_POST['address'];
$phone_no = $_POST['phone-no'];
$passcode = password_hash($_POST['passcode'], PASSWORD_DEFAULT); #encrypt password for security reason

include "sqlconfig.php";
$conn = new mysqli($host, $user, $pw, $dname);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}else{
   
    #cus_id is auto increment, email and login_name are UNQIUE,
    #insert a repeated email/login_name will cause exception.
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    try {
        $stmt = $conn->prepare("INSERT INTO customer(cus_name, address, phone_no, email, passcode, login_name, create_time)
        VALUES(?,?,?,?,?,?,NOW())");
        $stmt->bind_param("ssisss", $cus_name, $address, $phone_no, $email, $passcode, $login_name);
        $stmt->execute();
        echo '<script>alert("Register completed, you can login now.")</script>';
        $stmt->close();
        $conn->close();
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1062) {
            echo '<script>alert("Register not completed, repeated login name and/or email.")</script>';
        } else {
            throw $e;
        }
    }
    #refresh page
    header("Refresh:0; url=register_login.php");
  
}
?>