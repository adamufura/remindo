<?php require "helpers/init.php" ?>

<?php 

    if (!isset($_SESSION)) {
        session_start();
    }
    $email = $_SESSION['s_user_id'];

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
                  <div class="row">
              <div class="col-lg-4 mt-2 col-md-4 col-sm-12">
                  <div class="card py-3  shadow"  style="width: 100%">
            <img src="assets/images/background-image (2).png" class="card-img-top" alt="tasks" height="300vh">
  <div class="card-body">
    <h5 class="card-title">Tasks</h5>
    <p class="card-text">Upcoming: <?php echo getUpcomingAgendaCount($email, "task", "task_status"); ?></p>
    <p class="card-text">Over Due: <?php echo getAllAgendaCount($email, "task"); ?></p>
    <p class="card-text">Completed: <?php echo getAllCompletedAgendaCount($email, "task", "task_status")?></p>
    <a href="task.php" class="btn btn-primary">View Details</a>
  </div>
                  </div>
              </div>
              <div class="col-lg-4 mt-2 col-md-4 col-sm-12">
                  <div class="card  py-3  shadow"  style="width:  100%">
            <img src="assets/images/TASK-IMG.png" class="card-img-top" alt="tasks" height="300vh">
  <div class="card-body">
    <h5 class="card-title">To-Do-List</h5>
    <p class="card-text">Upcoming: <?php echo getUpcomingAgendaCount($email, "todo", "todo_status"); ?></p>
    <p class="card-text">Over Due: <?php echo getAllAgendaCount($email, "todo"); ?></p>
    <p class="card-text">Completed: <?php echo getAllCompletedAgendaCount($email, "todo", "todo_status")?></p>
    <a href="todo.php" class="btn btn-primary">View Details</a>
  </div>
                  </div>
              </div>
              <div class="col-lg-4  mt-2 col-md-4 col-sm-12">
                  <div class="card  shadow"  style="width:  100%">
            <img src="assets/images/agenda.png" class="card-img-top" alt="tasks" height="300vh">
  <div class="card-body">
    <h5 class="card-title">Events</h5>
    <p class="card-text">Upcoming: <?php echo getUpcomingAgendaCount($email, "event", "event_status"); ?></p>
    <p class="card-text">Over Due: <?php echo getAllAgendaCount($email, "event"); ?></p>
    <p class="card-text">Completed: <?php echo getAllCompletedAgendaCount($email, "event", "event_status")?></p>
   
    <a href="event.php" class="btn btn-primary">View Details</a>
  </div>
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