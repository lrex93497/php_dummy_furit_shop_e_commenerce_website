<?php
#admin account can only be created on this script
$login_name = "admin";
$passcode_raw = "admin2323";
$passcode = password_hash($passcode_raw, PASSWORD_DEFAULT); #encrypt password for security reason

include "sqlconfig.php";
$conn = new mysqli($host, $user, $pw, $dname);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}else{
   
    #admin_id is auto increment, login_name are UNQIUE,
    #insert a repeated login_name will cause exception.
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    try {
        $stmt = $conn->prepare("INSERT INTO admin(passcode, login_name)
        VALUES(?,?)");
        $stmt->bind_param("ss", $passcode, $login_name);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1062) {
            echo "Register not completed, repeated login name";
            exit();
        } else {
            throw $e;
        }
    }
    echo "Register completed.";
}
?>