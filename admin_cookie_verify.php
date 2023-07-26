<?php
#cookie given by admin_login.php
#verify if cookie is vaild, by passcode from cookie, true for pass, false for not ok
function admin_verify_cookie($login_name,$passcode) {
    include "sqlconfig.php";
    $conn = new mysqli($host, $user, $pw, $dname);
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    } else {
        #check login_name first, login_name is unqique
        $sql = "SELECT * FROM admin WHERE login_name = '$login_name'";
        $result = mysqli_query($conn, $sql);
        $check = mysqli_fetch_array($result);
        if (isset($check)) {
            $sql = "SELECT passcode FROM admin WHERE login_name = '$login_name'";
            $result = $conn->query($sql);
            $row = mysqli_fetch_row($result);
            $passcode_hash = $row[0];
            $conn->close();
            if (password_verify($passcode, $passcode_hash)) {
                return true;
            } else {
                return false;
            }
        } else {
            $conn->close();
            return false;
        }
    }
}
?>