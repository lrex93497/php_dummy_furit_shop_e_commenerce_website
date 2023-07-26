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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin add product</title>

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
						<button class="slide-menu-button" id="admin-button-work-space" type="button">Work</button>
						<button class="slide-menu-button" id="admin-button-logout" type="button">Logout</button>
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
						<form action="add_product.php" method="post" enctype="multipart/form-data">
							<label id="reglabel" for="chk" aria-hidden="true">Add product</label>
							<input class="reginput" type="text" name="product-name" placeholder="product name" required="" maxlength="255">
							<input class="reginput" type="text" name="stock-no" placeholder="stock number" required="" maxlength="255">
							<input class="reginput" type="text" name="price" placeholder="price" required="" maxlength="255">
							<p style="text-align: center;">Select image(64KB max):</p>
							<p style="text-align: center;">Please use square image:</p>
							<p style="text-align: center;">250x250 transparent background</p>
							<!--size check by js-->
							<input class="reginput" type="file" id="product-img" name="product-img">
							<button class="regbutton">Add</button>
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
	<script src="checkImgSize.js"></script>
	<script src="adminSlideMenuAdd.js"></script>
</body>
</html>

