<?php 
#first check if cookie valid
if (isset($_COOKIE['cookie_login_name'])) {
    $login_name = $_COOKIE['cookie_login_name'];
}else{
	$login_name = "Guest";
    #do nothing
}

########################
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About us</title>
	
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
				class="product-page-title-font">About us</div>
			</div>
			<div class="col-sm-2"></div>
			
		</div>

		<div class="row product-row" style="text-align:center; background-color: #ffffffaa;">

			We, fruity aim to provide best quality and price food to our dear customer. We established at 2022. 
			Hope you can have a good shopping experience at our shop! We get the fruit from all over the world, 
			from good framers! By the way the website is just a project, this shop is not real.</br></br>

			Please attach bank transfer no. (To bank account:0000000000) as payment proof after purchase. Goods will be sent as soon as possible
			after payment confirmed. Only bank transfer is accepted as payment method.
		</div>

		<div class="row row-3">
			<div class="col-sm"></div>
		</div>

		<div class="footer row row-4">Dummy fruit shop
		</div>

	</div>
	<script src="slideMenu.js"></script>
</body>
</html>