<?php require "helpers/init.php" ?>
<?php require "helpers/_add_event.php" ?>

<?php 

if (!isset($_SESSION)) {
    session_start();
}

$email = $_SESSION['s_user_id'];

$headerFilePath = "includes/header.php";
$headerParams = ["title" => "Add Event | Remindo"];
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
         <div class="container col-md-8">
                            <div class="card">
                                <form method="post" action="">
                                
                                    <div class="card-header">
                                        <h4>
                                            <?php
                                            if (isset($_GET['edit'])) {
                                                echo "Update Event";
                                            }else{
                                                echo "Create New Event";
                                            }
                                            ?></h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="text-center">
                                    <?php
                                    if (isset($msg)) {
                                        echo $msg;
                                    }
                                    ?>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12 col-12">
                                                <label>Event Title</label>
                                                <input type="text" name="event_title" class="form-control" value="<?php if (isset($_GET['edit'])) {
                                                    echo getEventById($_GET['edit'], $email)['event_title'];
                                                } ?>" >
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12 col-12">
                                                <label for="description">Task Description:</label>
                                                <textarea class="form-control" name="event_description" rows="5" id="description" >
                                                <?php if (isset($_GET['edit'])) {
                                                    echo getEventById($_GET['edit'], $email)['event_description'];
                                                } ?>
                                                </textarea>
                                                </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12 col-12">
                                                <label>Event Date</label>
                                                <input type="date" name="event_date" class="form-control" value="<?php if (isset($_GET['edit'])) {
                                                    echo getEventById($_GET['edit'], $email)['event_date'];
                                                } ?>" >
                                            </div>
                                            <div class="form-group col-md-6 col-12">
                                                <label>Event Start Time</label>
                                                <input type="time" name="event_start_time" class="form-control" value="<?php if (isset($_GET['edit'])) {
                                                    echo getEventById($_GET['edit'], $email)['event_start_time'];
                                                } ?>" >
                                            </div>
                                            <div class="form-group col-md-6 col-12">
                                                <label>Event End Time</label>
                                                <input type="time" name="event_end_time" class="form-control" value="<?php if (isset($_GET['edit'])) {
                                                    echo getEventById($_GET['edit'], $email)['event_end_time'];
                                                } ?>" >
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="card-footer text-right">
                                        <button class="btn btn-primary" name="<?php
                                            if (isset($_GET['edit'])) {
                                                echo "updateEvent";
                                            }else{
                                                echo "addEvent";
                                            }
                                            ?>" type="submit">
                                            <?php
                                            if (isset($_GET['edit'])) {
                                                echo "Update Event";
                                            }else{
                                                echo "Add Event";
                                            }
                                            ?>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>   
         
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

        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
        <script>
   
    </script>
</body>

</html>