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

	$sql = "SELECT * FROM customer  
	INNER JOIN cart
	ON customer.cus_id=cart.cus_id
	INNER JOIN fruit_product
	ON cart.product_id=fruit_product.product_id
	WHERE customer.cus_id=$customer_id
	";
	$all_product = $conn->query($sql);
	
	$conn->close();
	if(mysqli_num_rows($all_product)==0){
		header("Location: /cart_empty.php");
  		exit();
	}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>

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

			<div class="col-sm-8 row-1-font" style="text-align: right; right; padding-top: 5px;">Hi, Customer: <?php
			 echo $login_name?></div>
				
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
				class="product-page-title-font">Cart</div>
			</div>
			<div class="col-sm-2"></div>
			
		</div>

		<div class="row product-row">

			<?php
				while($row = mysqli_fetch_assoc($all_product)){
			?>

			<div class="product-card" style="margin: 5px; padding: 7px; border-color: transparent;
			background-color: #ffffffc4; border-radius: 5%;">
				<div class="product-img">
					<img id="product-image" src="<?php echo $row["product_image_dir"]?>" 
					alt=<?php echo $row["product_name"]?>>
				</div>
				
				<div class="product-content">
					<span class="stock">No. in cart:<?php echo $row["no_on_cart"]?></span>
					<p><?php echo $row["product_name"]?>&nbsp sub:<?php echo $row["price"]*$row["no_on_cart"]?></p>
					<!--is input number is checked by backend-->
					<span id="empty-span-product-to-buy">&nbsp&nbsp&nbsp</span>
					
					
					<form action="drop_cart.php" method="post">
						<button class="buy-button" id="drop-cart">Drop</button>
						<?php $cart_id = $row["cart_id"];?>
						<?php $cart_stock_no = $row["no_on_cart"];?>
						<?php $current_product_id = $row["product_id"];?>
						<input type="hidden" name="current-cart-id" value="<?php echo $cart_id; ?>">
						<input type="hidden" name="cart-stock-no" value="<?php echo $cart_stock_no; ?>">
						<input type="hidden" name="cart-product-id" value="<?php echo $current_product_id; ?>">
					</form>
				</div>
			</div>

			<?php
				}
			?>

		</div>

		<div class="row row-3">
			<div class="col-sm">
			<form action="buy_from_cart.php" method="post">
				<button class="buy-all-button">Buy All</button>
			</form>
			</div>
		</div>
		
		<div class="row row-3">
			<div class="col-sm">
			
			</div>
		</div>

		<div class="footer row row-4">Dummy fruit shop
		</div>

	</div>
	<script src="slideMenu.js"></script>
</body>
</html>