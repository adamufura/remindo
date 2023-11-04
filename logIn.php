<?php require "helpers/init.php" ?>
<?php require "helpers/_login.php" ?>

<?php 
$headerFilePath = "includes/ex-header.php";
$headerParams = ["title" => "Login | Remindo"];
Includes::custom_include($headerFilePath, $headerParams, true);
 ?>
<body class="bg-primary">
      <!--Navigation bar-->
<?php 
$navbarFilePath = "includes/ex-navbar.php";
Includes::custom_include($navbarFilePath, [], true);
?>
       <!--end of Navigation bar-->
<div class="container-fluid py-5">
    <div class="container py-5 text-center mt-5  rounded signUp-form">

   <div class="container py-5 form-body bg-white rounded shadow p-4">
        <h1 class="text-center shadow">LOGIN</h1>
            <form action="" method="POST">
     <div class="row  g-3">

  <div class="col-md-12">
    <label for="email" class="form-label">Email</label>
    <input type="text" class="form-control" name="email" id="email">
        <span class="text-danger text-center">
      <?php if (isset($messages['emailError'])) {
      echo $messages['emailError'];
      }?>
      </span>
  </div>

  <div class="col-md-12">
    <label for="password" class="form-label">password</label>
    <input type="password" class="form-control" name="password" id="password" >
        <span class="text-danger text-center">
      <?php if (isset($messages['passError'])) {
      echo $messages['passError'];
      }?>
      </span>
  </div>
    <span class="text-danger text-center">
      <?php if (isset($messages['userError'])) {
      echo $messages['userError'];
      }?>
      </span>
  <div class="col-12">
    <button type="submit" name="loginUser" class="btn btn-primary mt-3 p-3 shadow signUp-btn">logIn</button>
   
  </div>
  <div class="col-12">
  <a href="signUp.php"><p>Don't have an account?</p></a>
  </div>
</div>
            </form>
        </div>
        
    </div>

</div>
 <?php 
$footerFilePath = "includes/ex-footer.php";
Includes::custom_include($footerFilePath, [], true);
 ?>