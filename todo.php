<?php require "helpers/init.php" ?>
<?php require "helpers/_todo.php" ?>

<?php 

if (!isset($_SESSION)) {
    session_start();
}

$email = $_SESSION['s_user_id'];

// check a todo
if (isset($_GET['check'])) {
    checkTodo($_GET['check'], $email);
}
// delete a todo
if (isset($_GET['delete'])) {
    deleteTodo($_GET['delete'], $email);
}

$headerFilePath = "includes/header.php";
$headerParams = ["title" => "Manage Todos | Remindo"];
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
                        <a href="addTodo.php"><img src="assets/images/plusSign.png" height="100vh" alt="image" srcset=""></a>
                    <h5 class="card-title">Create New Todo</h5>
                  </div>
                    <div class="card-body bg-primary text-center">
                        <a href="addTodo.php" class="btn btn-danger">Create New</a>
                    </div>
                  </div>
              </div>
                     <div class="col-12 ">
                  <div class="card  shadow  mx-auto mt-5 "  style="width: 70vw">
                  <div class="card-header text-center bg-primary">
                    <h5 class="card-title text-white">To-Do-List</h5>
                                    <img src="assets/images/TASK-IMG.png" alt="todo" height="250vh" srcset="">
                </div>
                    <div class="card-body">
                        <h4 class="text-primary text-center">
                            <?php 
                                if (isset($_GET['todos']) && $_GET['todos'] == "all") {
                                    echo "All Todos";
                                }else{
                                    echo "Upcoming Todos";
                                }
                            ?>
                        </h4>
            <ul class="list-group">
                <?php 
                if (isset($_GET['todos']) && $_GET['todos'] == "all") {
                                    $todos = getAllTodos($email);
                                }else{
                                    $todos = getUpcomingTodos($email);
                                }
                ?>
                <?php 
                    if (mysqli_num_rows($todos) == 0) {
                        echo "<span class='text-center text-warning'> No Todo is found </span>";
                    }
                    ?>
                <?php while($todo = mysqli_fetch_assoc($todos)): ?>
                    
                    <li class="list-group-item d-flex justify-content-between align-items-center" style="text-decoration:<?php if(isTodoChecked($todo['id'], $email)){echo "line-through;";} ?>">
                        <div class="content-body">
                        <h5><?php echo $todo['todo_title']; ?></h5>
                        <p><?php echo $todo['todo_description'] ?></p>
                        </div>
                        <span class="">
                            <a href="?check=<?php echo$todo['id'];?>"><span class="fa fa-check text-success"></span></a>
                            <a href="addTodo.php?edit=<?php echo$todo['id'];?>"><span class="fa fa-edit text-success"></span></a>
                            <a href="?delete=<?php echo$todo['id'];?>"><span class="fas fa-trash-alt text-danger"></span></a>
                        </span>
                    </li>
                    <?php endwhile; ?>
        </ul>
                    </div>
                    <div class="card-footer">
                        <a href="<?php if (isset($_GET['todos']) && $_GET['todos'] == "all") {
                            echo "?todos=up";
                        }else{ echo "?todos=all";} ?>" class="btn btn-primary text-white">
                             <?php 
                                if (isset($_GET['todos']) && $_GET['todos'] == "all") {
                                    echo "Load Up coming Todos";
                                }else{
                                    echo "Load All Todos";
                                }
                            ?>
                        </a>
                    </div>
                  </div>
              </div>
            </div>
        </section>   
    </div>             
     <script src="assets/js/jquery-3.4.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>

    <script>
        // setInterval(() => {
        //     var xmlhttp = new XMLHttpRequest();
        //     xmlhttp.onreadystatechange = function() {
        //     if (this.readyState == 4 && this.status == 200) {
        //         console.log(this.responseText);
        //     }
        //     };
        //     xmlhttp.open("GET", "sendMailFromTodo.php", true);
        //     xmlhttp.send();
        // }, 3000);
    </script>
</body>
</html>