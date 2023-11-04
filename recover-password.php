<?php require "helpers/init.php" ?>
<?php require "helpers/_recover.php" ?>

<?php 
$headerFilePath = "includes/ex-header.php";
$headerParams = ["title" => "Recover Password | Remindo"];
Includes::custom_include($headerFilePath, $headerParams, true);
?>

<body>
    <!--Navigation bar-->
    <?php 
$navbarFilePath = "includes/ex-navbar.php";
Includes::custom_include($navbarFilePath, [], true);
 ?>
    <!--end of Navigation bar-->
      <!--header-->
   <div class="container-fluid">

     <div class="app-auth-body mx-auto">
          <h2 class="auth-heading text-center mb-4">Recover Password</h2>

          <div class="auth-intro mb-4 text-center">
            Enter your email address below. We'll email you a link to a page
            where you can easily create a new password.
          </div>

          <div class="container col-md-6">
            <form class="auth-form resetpass-form" action="" method="POST">
              <div class="email mb-5">
                <label class="sr-only" for="reg-email">Your Email</label>
                <input id="reg-email" name="email" type="email" class="form-control" placeholder="Your Email" name="email" />
                <span class="text-danger">
                  <?php if (isset($recoverErrors['emailErr'])) {
                    echo $recoverErrors['emailErr'];
                  } ?>
                </span>
                <span class="text-success">
                  <?php if (isset($recoverErrors['emailSucc'])) {
                    echo $recoverErrors['emailSucc'];
                  } ?>
                </span>
              </div>
              <!--//form-group-->
              <div class="text-center">
                <button type="submit" name="recover" class="btn btn-primary btn-block theme-btn mx-auto">
                  Recover Password
                </button>
              </div>
            </form>

            <div class="auth-option text-center pt-5">
            </div>
          </div>
          <!--//auth-form-container-->
        </div>
   </div>
      <!--end of header-->
<?php 
$footerFilePath = "includes/ex-footer.php";
Includes::custom_include($footerFilePath, [], true);
 ?>