<?php 
#first check if cookie valid
if (isset($_COOKIE['cookie_login_name'])) {
    $login_name = $_COOKIE['cookie_login_name'];
    $passcode = $_COOKIE['cookie_pw'];
	$customer_id = $_COOKIE['cookie_cus_id'];
}else{
    #if wrong/no cookie, redirect to admin login
    header("Refresh:0; register_login.php");
	echo '<script>alert("Please login")</script>';
	exit();
}

include "cookie_verify.php";
if(verify_cookie($login_name, $passcode) ==true){
# do nothing
} else {
    header("Refresh:0; url=register_login.php");
	echo '<script>alert("Please login")</script>';
	exit();
}
########################
?>

<?php
	include "sqlconfig.php"; 
	$conn = new mysqli($host, $user, $pw, $dname);
	$order_lot_id = $_COOKIE['cookie_current_lot_order_id'];;

	#1 order_lot_id is from 1 customer only.
	$sql = "SELECT * FROM order_detail
	INNER JOIN order_lot 
	ON order_detail.order_lot_id = order_lot.order_lot_id AND order_detail.cus_id = order_lot.cus_id
	INNER JOIN fruit_product
	ON order_detail.product_id=fruit_product.product_id
	WHERE order_detail.order_lot_id=$order_lot_id AND order_detail.cus_id=$customer_id";

	$all_product = $conn->query($sql);
	$conn->close();

	$conn = new mysqli($host, $user, $pw, $dname);
	$sql = "SELECT * FROM order_lot WHERE order_lot_id=$order_lot_id";
	$Result_2 = $conn->query($sql);
	$conn->close();
	
	if(mysqli_num_rows($all_product)==0 or mysqli_num_rows($Result_2)==0){
		header("Location: /order_status_empty.php");
  		exit();
	}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order status</title>

    <link rel="stylesheet" href="css/mystyle.css">
	<!--bootstrap grid-->
	<link rel="stylesheet" href="css/bootstrap-3.3.7-dist/bootstrap-grid.min.css">
</head>

<body>
	<!--login/sign form was greatly modified from https://codepen.io/mamislimen/pen/jOwwLvy -->
		<div class="gridc container-fluid d-flex flex-column">
		<div class="row row-1">
			<div class="col-sm-3 row-1-col-1">
				<img class="fake_icon" src="/img/fake_icon.PNG">
			</div>

			<div class="col-sm-8 row-1-font" style="text-align: right; right; padding-top: 5px;">
			Hi, Customer: <?php echo $login_name?></div>
				
			<div class="col-sm-1 row-1-font">
				<section>
					<input type="checkbox" id="checkbox-slide-menu">
					<label id="slide-menu-label" for="checkbox-slide-menu">&#9776</label>
					<div id="slide-menu">
						<button class="slide-menu-button" id="button-home" type="button">Home</button>
						<button class="slide-menu-button" id="button-cart" type="button">Cart</button>
						<button class="slide-menu-button" id="button-about-us" type="button">About us</button>
						<button class="slide-menu-button" id="button-order" type="button">Order</button>
						<button class="slide-menu-button" id="button-reg" type="button">Login</br>Sign up</button>
						<button class="slide-menu-button" id="button-logout" type="button">Logout</button>
					</div>
				</section>
			</div>
		</div>

		<div class="empty-row-2 row">
			<div class="col-sm-2"></div>
			<div class="col-sm-8">
				<div style="font-size: 1.5em;
				font-weight: bold;
				color: var(--deepblue);
				min-height: 5vh;
				text-align: center;
				"
				class="product-page-title-font">Order lot id: <?php echo $order_lot_id?></div>
			</div>
			<div class="col-sm-2"></div>
			
		</div>

		<div class="row product-row">

			<?php
            	$total_price = 0;
				while($row = mysqli_fetch_assoc($all_product)){
				$total_price = $total_price + $row["price"] * $row["no_product"];
			?>

			<div class="product-card" style="margin: 5px; padding: 7px; border-color: transparent;
			background-color: #ffffffc4; border-radius: 5%;">
				<div class="product-img">
					<img id="product-image" src="<?php echo $row["product_image_dir"]?>" 
					alt=<?php echo $row["product_name"]?>>
				</div>
				
				<div class="product-content">
					<p><?php echo $row["product_name"]?></p>
					<span class="stock">No. purhased:<?php echo $row["no_product"]?></span>
					<span id="empty-span-product-to-buy">&nbsp&nbsp&nbsp</span>
					<p>sub total: $<?php echo $row["price"]*$row["no_product"]?></p>
					
				</div>
			</div>

			<?php
				}
			?>

		</div>

		<div class="row row-3">
			<?php
            while ($row2 = mysqli_fetch_assoc($Result_2)) {
            ?>

			<div class="col-sm">
			<div class="order-detail-extra">Other details:
				<p style="padding-top: 5px;">Shipment: <?php echo $row2["shipment_state"]?></p>
				<p>Order accept: <?php echo $row2["accept_state"]?></p>
				<p>Payment proof (Bank transfer reference number): 
				<form action="submit_payment_proof.php" method="post">	
					<p><input class="payment_input" type="text" name="pay-proof" 
						placeholder=<?php echo "Current:".$row2["pay_proof"]?> 
						required="" maxlength="255">
						<input type="hidden" name="order-lot-id-in-order-status" value="<?php echo $order_lot_id; ?>">
						<button class="paymeny-proof-button">submit</button>
				</form>
				<p>Total price: <?php echo $total_price?> </p>
				<p>Create time: <?php echo $row2["create_time"]?></p>	
			</div>
			</div>

			<?php
            	}
			?>

		</div>

		<div class="row row-3">
		</div>

		<div class="footer row row-4">Dummy fruit shop
		</div>

	</div>
	<script src="slideMenu.js"></script>
</body>
</html>