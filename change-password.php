<?php require "helpers/init.php" ?>
<?php require "helpers/_change-password.php" ?>

<?php 
$headerFilePath = "includes/header.php";
$headerParams = ["title" => "User Dashboard | Remindo"];
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
            
        <section class="section">
            <!-- Main -->
            <div class="container">
                <div class="card col-md-8">
                    <div class="card-body border m-3 shadow-sm">
                        <h4 class="text-center text-primary">(Change Password)</h4>
                        <form class="row g-3 " action="" method="POST">
                            <span class="text-success">
                                <?php if (isset($msgs['passSucc'])) {
                                    echo $msgs['passSucc'];
                                }  ?></span>
                            <span class="text-danger">
                                <?php if (isset($msgs['passErr'])) {
                                    echo $msgs['passErr'];
                                }  ?></span>
                            <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="floatingPassword1">Old Password</label>
                                <input type="password" name="oldpass" class="form-control shadow-sm" id="floatingPassword1" placeholder="Enter Old Password"  />
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="floatingPassword2">New Password</label>
                                <input type="password" name="newpass" class="form-control shadow-sm" id="floatingPassword2" placeholder="Enter New Password"/>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="floatingPassword3">Confirm New Password</label>
                                <input type="password" name="cnewpass" class="form-control shadow-sm" id="floatingPassword3" placeholder="Enter New Password"  />
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="submit" name="changepassword" class="btn btn-primary float-end">
                                    Change Password <i class="mdi mdi-lock"></i>
                                </button>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>        
        </section>
    </div>

   <script src="assets/js/jquery-3.4.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
        });
    </script>
</body>

</html>