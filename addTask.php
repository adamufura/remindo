<?php require "helpers/init.php" ?>
<?php require "helpers/_add_task.php" ?>

<?php 

if (!isset($_SESSION)) {
    session_start();
}

$email = $_SESSION['s_user_id'];

$headerFilePath = "includes/header.php";
$headerParams = ["title" => "Add Task | Remindo"];
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
                                                echo "Update Task";
                                            }else{
                                                echo "Create New Task";
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
                                                <label>Task Title</label>
                                                <input type="text" name="task_title" class="form-control" value="<?php if (isset($_GET['edit'])) {
                                                    echo getTaskById($_GET['edit'], $email)['task_title'];
                                                } ?>" >
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12 col-12">
                                                <label for="description">Task Description:</label>
                                                <textarea class="form-control" name="task_description" rows="5" id="description" >
                                                <?php if (isset($_GET['edit'])) {
                                                    echo getTaskById($_GET['edit'], $email)['task_description'];
                                                } ?>
                                                </textarea>
                                                </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6 col-12">
                                                <label>Task Date</label>
                                                <input type="date" name="task_date" class="form-control" value="<?php if (isset($_GET['edit'])) {
                                                    echo getTaskById($_GET['edit'], $email)['task_date'];
                                                } ?>" >
                                            </div>
                                            <div class="form-group col-md-6 col-12">
                                                <label>Task Time</label>
                                                <input type="time" name="task_time" class="form-control" value="<?php if (isset($_GET['edit'])) {
                                                    echo getTaskById($_GET['edit'], $email)['task_time'];
                                                } ?>" >
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="card-footer text-right">
                                        <button class="btn btn-primary" name="<?php
                                            if (isset($_GET['edit'])) {
                                                echo "updateTask";
                                            }else{
                                                echo "addTask";
                                            }
                                            ?>" type="submit">
                                            <?php
                                            if (isset($_GET['edit'])) {
                                                echo "Update Task";
                                            }else{
                                                echo "Add Task";
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
    </script>
        <script>
       </script>
</body>

</html>