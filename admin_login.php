<?php 
#first check if cookie valid
if (isset($_COOKIE['cookie_admin_login_name'])) {
    header("Refresh:0; url=admin_work_space.php");
	echo '<script>alert("Already login")</script>';
	exit();
}else{
    #do nothing
}

########################
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin login</title>

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

			<div class="col-sm-8 row-1-font" style="text-align: right;">Hi, Admin</div>
				
			<div class="col-sm-1 row-1-font">
				<section>
					<input type="checkbox" id="checkbox-slide-menu">
					<label id="slide-menu-label" for="checkbox-slide-menu">&#9776</label>
					<div id="slide-menu">
						<button class="slide-menu-button" id="button-admin-login" type="button">log in</button>
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
						<form action="admin_login_script.php" method="post">
							<label id="reglabel" for="chk" aria-hidden="true">Log in</label>
							<input class="reginput" type="text" name="login-name-admin" placeholder="Admin login name" required="" maxlength="255">
							<input class="reginput" type="password" name="passcode" placeholder="Password" required="" maxlength="255">
							<button class="regbutton">Log in</button>
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
	<script src="adminSlideMenu.js"></script>
</body>
</html>