<?php require "helpers/init.php" ?>
<?php require "helpers/_add_todo.php" ?>

<?php 
if (!isset($_SESSION)) {
    session_start();
}

$email = $_SESSION['s_user_id'];

$headerFilePath = "includes/header.php";
$headerParams = ["title" => "Add Todo | Remindo"];
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
                                                echo "Update Todo";
                                            }else{
                                                echo "Create New Todo";
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
                                                <label>Todo Title</label>
                                                <input type="text" name="todo_title" class="form-control" value="<?php if (isset($_GET['edit'])) {
                                                    echo getTodoById($_GET['edit'], $email)['todo_title'];
                                                } ?>" >
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12 col-12">
                                                <label for="description">Todo Description:</label>
                                                <textarea class="form-control" name="todo_description" rows="5" style="text-align:left;" id="description" >
                                                <?php if (isset($_GET['edit'])) {
                                                    echo getTodoById($_GET['edit'], $email)['todo_description'];
                                                } ?>
                                                </textarea>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <button class="btn btn-primary" name="<?php
                                            if (isset($_GET['edit'])) {
                                                echo "updateTodo";
                                            }else{
                                                echo "addTodo";
                                            }
                                            ?>" type="submit">
                                            <?php
                                            if (isset($_GET['edit'])) {
                                                echo "Update Todo";
                                            }else{
                                                echo "Add Todo";
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