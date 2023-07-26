<?php 
#first check if cookie valid
if (isset($_COOKIE['cookie_admin_login_name'])) {
    $login_name = $_COOKIE['cookie_admin_login_name'];
    $passcode = $_COOKIE['cookie_admin_pw'];
}else{
    #if wrong/no cookie, redirect to admin login
    header("Refresh:0; url=admin_login.php");
	echo '<script>alert("Please login")</script>';
	exit();
}

include "admin_cookie_verify.php";
if(admin_verify_cookie($login_name, $passcode) ==true){
# do nothing
} else {
    header("Refresh:0; url=admin_login.php");
	echo '<script>alert("Please login")</script>';
	exit();
}
########################
?>
<?php
	include "sqlconfig.php"; 
	$conn = new mysqli($host, $user, $pw, $dname);
	$sql = "SELECT * FROM order_lot
	INNER JOIN customer 
	ON order_lot.cus_id=customer.cus_id";
	$result_1 = $conn->query($sql);


	$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin work space</title>

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

			<div class="col-sm-8 row-1-font" style="text-align: right; right; padding-top: 5px;">Hi, Admin</div>
				
			<div class="col-sm-1 row-1-font">
				<section>
					<input type="checkbox" id="checkbox-slide-menu">
					<label id="slide-menu-label" for="checkbox-slide-menu">&#9776</label>
					<div id="slide-menu">
						<button class="slide-menu-button" id="admin-button-add" type="button">Add product</button>
						<button class="slide-menu-button" id="admin-button-logout" type="button">Logout</button>
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
				class="product-page-title-font">Orders</div>
			</div>
			<div class="col-sm-2"></div>
			
		</div>

		<div class="row product-row">

			<?php
				while($row = mysqli_fetch_assoc($result_1)){
			?>

			<div class="product-card" style="margin: 5px; padding: 7px; border-color: transparent;
			background-color: #ffffffc4; border-radius: 5%;">
				
				<div class="product-content">
					<p id="product-label">lot_id: <?php echo $row["order_lot_id"]?></p>
					<span id="empty-span-product-to-buy">&nbsp&nbsp&nbsp</span>
					<p class="stock">Payment proof:<?php
						if($row["pay_proof"]==""){
							echo "Not yet";
						}else{
							echo $row["pay_proof"];
						}
					
					?></p>
					<p class="stock">Address:<?php echo $row["address"]?></p>
					<p class="stock">Real name:<?php echo $row["cus_name"]?></p>
					<p style="font-weight: bold;">Include:</p>
					

					<!--get what to ship-->
					<?php
	            		$tamp = $row["order_lot_id"];
						$conn = new mysqli($host, $user, $pw, $dname);
						$sql_2 = "SELECT product_name,no_product,price
						FROM order_detail 
						INNER JOIN fruit_product
						ON order_detail.product_id=fruit_product.product_id
						WHERE order_lot_id=$tamp
						";
						$result_2 = $conn->query($sql_2);
						$conn->close();

	            		$total_price = 0;

						while($row2 = mysqli_fetch_assoc($result_2)){
		    			$total_price = $total_price + $row2["price"] * $row2["no_product"];
					?>
						<p class="stock"><?php echo $row2["product_name"]?>:<?php echo $row2["no_product"]?></p>	
					<?php
						}
					?>
					<!--total price-->
					<p class="stock">Total: $<?php echo $total_price?></p>	
					<p class="stock">Shipment: <?php echo $row["shipment_state"];?></p>
					<p class="stock">Accept: <?php echo $row["accept_state"];?></p>				
					<div>
						
						<form action="admin_ship.php" method="post">
							<input type="hidden" name="order-lot-id" value="<?php echo $row["order_lot_id"]; ?>">
							<button class="admin-work-button" id="admin-ship"<?php if ($row["shipment_state"]=="1"){?>style="display:none"<?php } ?>
							>ship</button>
						</form>
						<form action="admin_accept.php" method="post">
							<input type="hidden" name="order-lot-id" value="<?php echo $row["order_lot_id"]; ?>">
							<button class="admin-work-button" id="admin-accept"<?php if ($row["accept_state"]=="1"){?>style="display:none"<?php } ?>
							>Accept</button>
						</form>
					</div>
				</div>
			</div>
			<?php
				}
			?>

		</div>

		<div class="row row-3">
			<div class="col-sm"></div>
		</div>

		<div class="footer row row-4">Dummy fruit shop
		</div>		

	</div>
	<script src="adminSlideMenuWork.js"></script>
</body>
</html>