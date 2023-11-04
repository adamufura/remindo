<?php require "helpers/init.php" ?>
<?php require "helpers/_reset.php" ?>

<?php 
$headerFilePath = "includes/ex-header.php";
$headerParams = ["title" => "Reset Password | Remindo"];
Includes::custom_include($headerFilePath, $headerParams, true);


if (!isset($_GET['hash']) || !isValidHash($_GET['hash'])) {
	header("Location: login.php");
}
?>
?>

<body>
    <!--Navigation bar-->
    <?php 
$navbarFilePath = "includes/ex-navbar.php";
Includes::custom_include($navbarFilePath, [], true);
 ?>
    <!--end of Navigation bar-->
      <!--header-->
   <div class="container">
	   					<div class="container col-md-6 text-start mx-auto mt-5">
						<form class="auth-form auth-signup-form" accept="" method="POST">
							<h3>Reset Password</h3>
							<div class="password mb-3">
								<label class="sr-only" for="signup-password">New Password</label>
								<input id="signup-password" name="newpassword" type="password" class="form-control signup-password" placeholder="Create a New password">
								<span class="text-danger text-center">
									<?php
									if (isset($resetErrors['passErr'])) {
										echo $resetErrors['passErr'];
									} ?>
								</span>
							</div>

							<div class="password mb-3">
								<label class="sr-only" for="signup-password">Confirm New Password</label>
								<input id="signup-password" name="cnewpassword" type="password" class="form-control signup-password" placeholder="Confirm New password">
								<span class="text-danger text-center">
									<?php
									if (isset($resetErrors['cpassErr'])) {
										echo $resetErrors['cpassErr'];
									} ?>
								</span>
							</div>


							<!--//extra-->

							<div class="text-center">
								<span class="text-success">
									<?php
									if (isset($resetErrors['passUpdateSucc'])) {
										echo $resetErrors['passUpdateSucc'];
									}
									?>
								</span>
								<span class="text-danger">
									<?php
									if (isset($resetErrors['passUpdateErr'])) {
										echo $resetErrors['passUpdateErr'];
									}
									?>
								</span>
								<button type="submit" name="reset" class="btn btn-primary w-100 theme-btn mx-auto">Reset Password</button>
							</div>
						</form>
						<!--//auth-form-->

						<div class="auth-option text-center pb-5">
						</div>
					</div>
   </div>
      <!--end of header-->
<?php 
$footerFilePath = "includes/ex-footer.php";
Includes::custom_include($footerFilePath, [], true);
 ?>