<?php require "helpers/init.php" ?>
<?php require "helpers/_sign_up.php" ?>

<?php 
$headerFilePath = "includes/ex-header.php";
$headerParams = ["title" => "Sign Up | Remindo"];
Includes::custom_include($headerFilePath, $headerParams, true);
 ?>
<body class="bg-primary">
      <!--Navigation bar-->
<?php 
$navbarFilePath = "includes/ex-navbar.php";
Includes::custom_include($navbarFilePath, [], true);
?>
       <!--end of Navigation bar-->
 <div class="container py-5 text-center bg-primaryshadow rounded signUp-form">
  
        <div class="container form-body bg-white rounded shadow p-4">
       <h1 class="text-center shadow-sm">SIGNUP</h1>
            <form action="" method="POST">
              <span class="text-danger text-center">
      <?php if (isset($messages['userError'])) {
      echo $messages['userError'];
      }?>
      </span>
        <div class="row  g-3">
       <div class="col-md-12">
    <label for="name" class="form-label">Name</label>
    <input type="text" name="name" class="form-control" placeholder="Enter name" id="name" value="<?php if (isset($name)) {
    echo $name;
}?>">
    <span class="text-danger">
      <?php if (isset($messages['nameError'])) {
      echo $messages['nameError'];
      }?>
      </span>
      </div>
      <div class="col-md-12">
    <label for="email" class="form-label">Email</label>
    <input type="email" name="email" class="form-control" placeholder="Enter Email" id="email" value="<?php if (isset($email)) {
    echo $email;
}?>">
      <span class="text-danger">
      <?php if (isset($messages['emailError'])) {
      echo $messages['emailError'];
      }?>
      </span>
    </div>
      <div class="col-md-12">
    <label for="phoneNumber" class="form-label">Phone Number(+234-XXXXXXXXXX)</label>
    <input type="text" class="form-control" name="phoneNumber" placeholder="Enter phone number" id="phoneNumber" value="<?php if (isset($phoneNumber)) {
    echo $phoneNumber;
}?>">
     <span class="text-danger">
      <?php if (isset($messages['phoneError'])) {
      echo $messages['phoneError'];
      }?>
      </span>
    </div>
    <div class="col-md-12">
    <label for="password" class="form-label">password</label>
    <input type="password" class="form-control" name="password" placeholder="Enter password" id="password" >
    <span class="text-danger">
      <?php if (isset($messages['passError'])) {
      echo $messages['passError'];
      }?>
      </span>
    </div>
    <div class="col-12">
    <button type="submit" name="createAccount" class="btn btn-primary mt-3 p-3 shadow signUp-btn">SignUp</button>
    <p></p>
    </div>
     <div class="col-12">
  <a href="logIn.php"><p>Already have an account?</p></a>
  </div>
    <div/>
            </form>
</div>
        
</div>
</div>
</div>
 <?php 
$footerFilePath = "includes/ex-footer.php";
Includes::custom_include($footerFilePath, [], true);
 ?>