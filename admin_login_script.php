<?php
$login_name = $_POST['login-name-admin'];
$passcode = $_POST['passcode'];#will check with hash
include "sqlconfig.php";
$conn = new mysqli($host, $user, $pw, $dname);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
} else {
    #check login_name first, login_name is unqique
    $sql= "SELECT * FROM admin WHERE login_name = '$login_name'";
    $result = mysqli_query($conn,$sql);
    $check = mysqli_fetch_array($result);
    if(isset($check)){
        $sql= "SELECT passcode FROM admin WHERE login_name = '$login_name'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_row($result);
        $passcode_hash = $row[0];

        if(password_verify($passcode, $passcode_hash)){
            echo '<script>alert("Login success.")</script>';
            #setcookie
            setcookie("cookie_admin_login_name", $login_name, time() + (86400 * 1), "/"); #86400 = 1 day, expiry after 1 day.
            setcookie("cookie_admin_pw", $passcode, time() + (86400 * 1), "/"); #86400 = 1 day, expiry after 1 day.
            #redirect to admin work space
            header("Refresh:0; url=admin_work_space.php");
            exit();
        }else{
            echo '<script>alert("Wrong password, please try again")</script>';
        }
    }else{
        echo '<script>alert("Login error, maybe wrong login name and passowrd, please try again.")</script>';
    }

    #refresh page
    header("Refresh:0; url=admin_login.php");

}


?>