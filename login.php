<?php 
#first check if cookie valid
if (isset($_COOKIE['cookie_login_name'])) {
    #have cookie, redirect to index.php
    header("Refresh:0; url=index.php");
    echo '<script>alert("Already login")</script>';
    exit();
}
########################
?>
<?php
$login_name = $_POST['login-name'];
$passcode = $_POST['passcode'];#will check with hash
include "sqlconfig.php";
$conn = new mysqli($host, $user, $pw, $dname);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
} else {
    #check login_name first, login_name is unqique
    $sql= "SELECT * FROM customer WHERE login_name = '$login_name'";
    $result = mysqli_query($conn,$sql);
    $check = mysqli_fetch_array($result);
    if(isset($check)){
        $sql= "SELECT passcode FROM customer WHERE login_name = '$login_name'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_row($result);
        $passcode_hash = $row[0];

        if(password_verify($passcode, $passcode_hash)){
            echo '<script>alert("Login success.")</script>';

            $sql= "SELECT cus_id FROM customer WHERE login_name = '$login_name'";
            $result2 = $conn->query($sql);
            $row2 = mysqli_fetch_row($result2);
            $cus_id = $row2[0];   

            #setcookie
            setcookie("cookie_login_name", $login_name, time() + (86400 * 1), "/"); #86400 = 1 day, expiry after 1 day.
            setcookie("cookie_pw", $passcode, time() + (86400 * 1), "/"); #86400 = 1 day, expiry after 1 day.
            setcookie("cookie_cus_id", $cus_id, time() + (86400 * 1), "/"); #86400 = 1 day, expiry after 1 day.
            #redirect to home
            header("Refresh:0; url=index.php");
            exit();
        }else{
            echo '<script>alert("Wrong password, please try again")</script>';
        }
    }else{
        echo '<script>alert("Login error, maybe wrong login name and passowrd, please try again.")</script>';
    }

    #refresh page
    header("Refresh:0; url=register_login.php");

}


?>