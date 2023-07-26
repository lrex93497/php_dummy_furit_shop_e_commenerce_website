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

	$sql = "SELECT * FROM order_lot WHERE cus_id=$customer_id";
	$all_product = $conn->query($sql);
	
	$conn->close();
	if(mysqli_num_rows($all_product)==0){
		header("Location: /order_lot_empty.php");
  		exit();
	}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order lot</title>

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

			<div class="col-sm-8 row-1-font" style="text-align: right; padding-top: 5px;">
			Hi, Customer: <?php echo $login_name?></div>
				
			<div class="col-sm-1 row-1-font">
				<section>
					<input type="checkbox" id="checkbox-slide-menu">
					<label id="slide-menu-label" for="checkbox-slide-menu">&#9776</label>
					<div id="slide-menu">
						<button class="slide-menu-button" id="button-home" type="button">Home</button>
						<button class="slide-menu-button" id="button-cart" type="button">Cart</button>
						<button class="slide-menu-button" id="button-order" type="button">Order</button>
						<button class="slide-menu-button" id="button-about-us" type="button">About us</button>
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
				class="product-page-title-font">Order lot</div>
			</div>
			<div class="col-sm-2"></div>
			
		</div>

		<div class="row product-row">

			<?php
				while($row = mysqli_fetch_assoc($all_product)){
			?>

			<div class="product-card" style="margin: 5px; padding: 7px; border-color: transparent;
			background-color: #ffffffc4; border-radius: 10%;">
				
				<div class="product-content">
					<p>Order lot id: <?php echo $row["order_lot_id"]?></p>
					<p class="stock">Create time: <?php echo $row["create_time"]?></p>
					<p>Payment proof: <?php 
						$empty_proof_string = "Not yet";
						if($row["pay_proof"]){
							echo $row["pay_proof"];
						}else{
						echo $empty_proof_string;
						}
					?></p>

					<p>Order accept: <?php 
						if($row["accept_state"]==0){
							echo "Not yet";
						}else if($row["accept_state"]==1){
							echo "Accepted";
						}
					?></p>

					<p>Shipment: <?php 
						if($row["shipment_state"]==0){
							echo "Not yet";
						}else if($row["shipment_state"]==1){
							echo "Shipped";
						}
					?></p>
					
					<!--is input number is checked by backend-->
					<span id="empty-span-product-to-buy">&nbsp&nbsp&nbsp</span>
					
					<form action="to_order_status.php" method="post">
						<div>
							<?php $current_lot_order_id = $row["order_lot_id"];?>
							<input type="hidden" name="current-lot-order-id" value="<?php echo $current_lot_order_id; ?>">
							<button class="buy-button" id="order-lot-detail">Detail</button>
						</div>
					</form>
				</div>
			</div>

			<?php
				}
			?>

		</div>

		<div class="row product-row"></div>
		<div class="row row-3">
			<div class="col-sm"></div>
		</div>

		<div class="footer row row-4">Dummy fruit shop
		</div>

	</div>
	<script src="slideMenu.js"></script>
</body>
</html>