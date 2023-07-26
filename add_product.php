<?php
$product_name = $_POST['product-name'];
$stock_no = $_POST['stock-no'];
$price = $_POST['price'];
$upload_dir = "img/";

#upload file to img/, same name file will be replaced.
$product_img = $upload_dir . basename($_FILES['product-img']['name']);
$filename=$_FILES['product-img']['name'];

if (move_uploaded_file($_FILES["product-img"]["tmp_name"], $product_img)) {
} else {
    #echo  '<script>alert("Error uploading image.")</script>';
    #refresh page
    header("Refresh:0; url=admin_index_add_product.php");
}

$product_image_dir = $upload_dir . $filename;

include "sqlconfig.php";
$conn = new mysqli($host, $user, $pw, $dname);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}else{
    #product_id is auto increment unique, 
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    $product_img = file_get_contents($product_img); 
    $stmt = $conn->prepare("INSERT INTO fruit_product(product_name, stock_no, price, product_image_dir)
    VALUES(?,?,?,?)");
    $stmt->bind_param("ssss", $product_name, $stock_no, $price, $product_image_dir);
    $stmt->execute();
    echo '<script>alert("Add product complete.")</script>';
    $stmt->close();
    $conn->close();


    #refresh page
    header("Refresh:0; url=admin_index_add_product.php");
  
}
?>