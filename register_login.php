<?php 
#first check if cookie valid
if (isset($_COOKIE['cookie_login_name'])) {
    $login_name = $_COOKIE['cookie_login_name'];
    $passcode = $_COOKIE['cookie_pw'];

	include "cookie_verify.php";
	if(verify_cookie($login_name, $passcode) ==true){
	header("Refresh:0; url=index.php");
	echo '<script>alert("Already login")</script>';
	exit();
}
}else{
	$login_name = "Guest";
}


########################
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login or register</title>

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
						<button class="slide-menu-button" id="button-order" type="button">Order</button>
						<button class="slide-menu-button" id="button-about-us" type="button">About us</button>
						<button class="slide-menu-button" id="button-reg" type="button">Login</br>Sign up</button>
						<button class="slide-menu-button" id="button-logout" type="button">Logout</button>
					</div>
				</section>
			</div>
		</div>

		<div class="empty-row-2 row">
			<div class="col-sm"></div>
		</div>

		<div class="row">
			<div class="grid-related col-sm"></div>

			<div class="col-sm">
				<div class="login-signup-container">  	
					<input type="checkbox" id="chk" aria-hidden="true">
					<div class="signup">
						<form action="register.php" method="post">
							<label id="reglabel" for="chk" aria-hidden="true">Sign up</label>
							<input class="reginput" type="text" name="login-name-sign-up" placeholder="Login name" required="" maxlength="255">
							<input class="reginput" type="email" name="email" placeholder="Email" required="" maxlength="255">
							<input class="reginput" type="text" name="cus-name" placeholder="Your name" required="" maxlength="255">
							<input class="reginput" type="text" name="address" placeholder="Address" required="" maxlength="255">
							<input class="reginput" type="text" name="phone-no" placeholder="Phone number" required="" maxlength="255">
							<input class="reginput" type="password" name="passcode" placeholder="Password" required="" maxlength="255">
							<button class="regbutton">Sign up</button>
						</form>
					</div>

					<div class="login">
						<form action="login.php" method="post">
							<label id="reglabel" for="chk" aria-hidden="true" maxlength="255">Login</label>
							<input class="loginput" type="text" name="login-name" placeholder="Login name" required="" maxlength="255">
							<input class="loginput" type="password" name="passcode" placeholder="Password" required="" maxlength="255">
							<button class="regbutton">Login</button>
						</form>
					</div>
				</div>
			</div>

			<div class="col-sm"></div>
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