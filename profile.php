<?php require "helpers/init.php" ?>
<?php require "helpers/_profile.php" ?>

<?php
if (!isset($_SESSION)) {
        session_start();
    }

    $s_id = $_SESSION['s_userID'];
    $s_email = $_SESSION['s_user_id'];
?>

<?php 
$headerFilePath = "includes/header.php";
$headerParams = ["title" => "Profile | Remindo"];
Includes::custom_include($headerFilePath, $headerParams, true);
?>

<body>
      <div class="wrapper">
        <!-- Sidebar Holder -->
            <?php 
            $navbarFilePath = "includes/sidebar.php";
            Includes::custom_include($navbarFilePath, [], true);
            ?>
        <!-- end of sidebar -->

        <!-- Page Content Holder -->
        <div id="content">
        <!-- navbar -->
            <?php 
            $navbarFilePath = "includes/navbar.php";
            Includes::custom_include($navbarFilePath, [], true);
            ?>
        <!-- end of navbar -->
            
    <div class="section-body">
        <div class="text-center">
            <?php
                if (isset($Msg)) {
                    echo $Msg;
                }
            ?>
        </div>
        <form action=""  method="POST" enctype="multipart/form-data">
                    <h2 class="section-title">Hi, <?php echo getUserByEmail($s_email)['name']; ?></h2>
                    <p class="section-lead">Change information about yourself on this page.</p>

                    <div class="row mt-sm-4">
                        <div class="col-12 col-md-12 col-lg-5">
                            <div class="card profile-widget">
                                <div class="profile-widget-header text-center py-3">                     
                                    <img alt="image" src="<?php echo getUserByEmail($s_email)['avatar']; ?>" class="rounded-circle h-25 w-25 mt-5">
                                    
                                </div>
                                <div class="row">
                                    <input type="file" class="custom-file-input" id="customFile" name="avatar" value="<?php echo getUserByEmail($s_email)['avatar'];?>">
                                    <label class="custom-file-label" for="customFile">Change Avatar</label>
                                </div>
                                <div class="profile-widget-description text-center mt-n5">
                                    <div class="profile-widget-name"><?php echo getUserByEmail($s_email)['name']; ?> <div class="text-muted d-inline font-weight-normal"><div class="slash"></div>Student</div></div>
                            
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12 col-md-12 col-lg-7">
                            <div class="card">
                                    <div class="card-header">
                                        <h4>Edit Profile</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-md-12 col-12">
                                                <label>Full Name</label>
                                                <input type="text" class="form-control" value="<?php echo getUserByEmail($s_email)['name']; ?>" name="name" required="">
                                                
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6 col-12">
                                                <label>Email</label>
                                                <input type="email" class="form-control" value="<?php echo getUserByEmail($s_email)['email']; ?>"  name="email" disabled>
                                            </div>
                                            <div class="form-group col-md-6 col-12">
                                                <label>Phone Number</label>
                                                <input type="text" class="form-control" value="<?php echo getUserByEmail($s_email)['phone_number']; ?>" required="" name="phoneNumber">
                                                
                                            </div>
                                        </div>
                                    
                                    </div>
                                    <div class="card-footer text-right">
                                        <button class="btn btn-primary" type="submit" name="saveChanges">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
           
    </div>


             
     <script src="assets/js/jquery-3.4.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>
</body>
</html>