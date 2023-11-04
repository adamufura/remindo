<?php require "helpers/init.php" ?>
<?php require "helpers/_task.php" ?>

<?php 
if (!isset($_SESSION)) {
    session_start();
}

$email = $_SESSION['s_user_id'];

// check a task
if (isset($_GET['check'])) {
    checkTask($_GET['check'], $email);
}
// delete a task
if (isset($_GET['delete'])) {
    deleteTask($_GET['delete'], $email);
}

$headerFilePath = "includes/header.php";
$headerParams = ["title" => "Manage Tasks | Remindo"];
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
                    
                     <div class="col-12">
                  <div class="card  shadow mx-auto"  style="width: 50vw">
                  <div class="card-header text-center">
                        <a href="addTask.php"><img src="assets/images/plusSign.png" height="100vh" alt="image" srcset=""></a>
                    <h5 class="card-title">Create New Task</h5>
                  </div>
  <div class="card-body bg-primary text-center">
    <a href="addTask.php" class="btn btn-danger">Create New</a>
  </div>
                  </div>
              </div>
                     <div class="col-12 ">
                  <div class="card  shadow  mx-auto mt-5 "  style="width: 70vw">
                  <div class="card-header text-center bg-primary">
                    <h5 class="card-title text-white">Tasks List</h5>
                                    <img src="assets/images/agenda.png" alt="todo" height="250vh" srcset="">
                  </div>
  <div class="card-body">
         <h4 class="text-primary text-center">
                            <?php 
                                if (isset($_GET['tasks']) && $_GET['tasks'] == "all") {
                                    echo "All Tasks";
                                }else{
                                    echo "Upcoming Tasks";
                                }
                            ?>
                        </h4>

                         <ul class="list-group">
                <?php 
                if (isset($_GET['tasks']) && $_GET['tasks'] == "all") {
                                    $tasks = getAllTasks($email);
                                }else{
                                    $tasks = getUpcomingTasks($email);
                                }
                ?>
                <?php 
                    if (mysqli_num_rows($tasks) == 0) {
                        echo "<span class='text-center text-warning'> No Todo is found </span>";
                    }
                    ?>
                <?php while($task = mysqli_fetch_assoc($tasks)): ?>
                    
                    <li class="list-group-item d-flex justify-content-between align-items-center" style="text-decoration:<?php if(isTaskChecked($task['id'], $email)){echo "line-through;";} ?>">
                        <div class="content-body">
                        <h5><?php echo $task['task_title']; ?></h5>
                        <p><?php echo $task['task_description'] ?></p>
                        </div>
                        <span class="d-flex flex-column">
                            <div class="">
                                <a href="?check=<?php echo $task['id'];?>"><span class="fa fa-check text-success"></span></a>
                            <a href="addTask.php?edit=<?php echo $task['id'];?>"><span class="fa fa-edit text-success"></span></a>
                            <a href="?delete=<?php echo $task['id'];?>"><span class="fas fa-trash-alt text-danger"></span></a>
                            </div>
                            <div class="d-flex flex-column">
                                <span class="fas fa-calendar-check text-success mb-2">
                                    <?php echo date("d-M-Y", strtotime($task['task_date'])) ?>
                                </span>
                                <span class="fa fa-clock text-success">
                                    <?php echo date("h:i a",  strtotime($task['task_time'])) ?>
                                </span>
                            </div>
                        </span>
                    </li>
                    <?php endwhile; ?>
        </ul>
        </div>
                    <div class="card-footer">
                        <a href="<?php if (isset($_GET['tasks']) && $_GET['tasks'] == "all") {
                            echo "?tasks=up";
                        }else{ echo "?tasks=all";} ?>" class="btn btn-primary text-white">
                             <?php 
                                if (isset($_GET['tasks']) && $_GET['tasks'] == "all") {
                                    echo "Load Up coming Tasks";
                                }else{
                                    echo "Load All Tasks";
                                }
                            ?>
                        </a>
                    </div>
   
  </div>
                  </div>
              </div>
             
                </div>
            </section>
            
     
           
    </div>


             
     <script src="assets/js/jquery-3.4.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>