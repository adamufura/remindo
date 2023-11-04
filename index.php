<?php require "helpers/init.php" ?>

<?php 
$headerFilePath = "includes/ex-header.php";
$headerParams = ["title" => "Home | Remindo"];
Includes::custom_include($headerFilePath, $headerParams, true);
?>

<body>
    <!--Navigation bar-->
    <?php 
$navbarFilePath = "includes/ex-navbar.php";
Includes::custom_include($navbarFilePath, [], true);
 ?>
    <!--end of Navigation bar-->
      <!--header-->
   <div class="container-fluid header-bg ">
       <div class="container py-5   text-white ">
       
           <div class="header">
              <h1>Remindo</h1>
           <p>Add, prioritize & organise your daily tasks, todo and agendas </p>
           <p>Start with a simple To-Do-List and add more Details as you go!</p>
                 <a href="signUp.php">  <button class="btn btn-danger " type="submit">Register for free</button></a>
           </div>
       </div>
   </div>
   <div class="container-fluid bg-primary">
<div class="container">
         <div class="row py-5 d-flex "> 
              <div class="col-12 text-center col-md-6 py-5 text-white mt-2">  <h1  >TASKS</h1>
           <p>Add, prioritize & organise your daily tasks, todo and agendas </p>
           <p>Start with a simple To-Do-List and add more Details as you go!</p>
                 <a href="signUp.php">  <button class="btn btn-danger " type="submit">CREATE TASK</button></a></div>      
           <div class="col-12 col-md-6  text-center">
             <img src="assets/images/background-image (2).png" alt="Reminder App"  class="header-image" srcset="" height="250vh" >
           </div>
                 <div class="col-12 text-center col-md-6 py-5 text-white">  <h1  >To-Do-List</h1>
           <p>Add, prioritize & organise your daily tasks, todo and agendas </p>
           <p>Start with a simple To-Do-List and add more Details as you go!</p>
                 <a href="signUp.php">  <button class="btn btn-danger " type="submit">CREATE TODO</button></a></div>
           <div class="col-12 col-md-6 mt-2 text-center ">
             <img  src="assets/images/TASK-IMG.png" alt="Reminder App"  srcset="" height="250vh" >
           </div>
             <div class="col-12 text-center col-md-6 py-5 text-white">  <h1  >AGENDA</h1>
           <p>Add, prioritize & organise your daily tasks, todo and agendas </p>
           <p>Start with a simple To-Do-List and add more Details as you go!</p>
                 <a href="signUp.php">  <button class="btn btn-danger " type="submit">CREATE AGENDA</button></a></div>
           <div class="col-12 col-md-6  text-center">
             <img src="assets/images/agenda.png" alt="Reminder App"  class="header-image" srcset="" height="300vh" >
           </div>
           
         </div>
       </div>
   </div>
      <!--end of header-->
<?php 
$footerFilePath = "includes/ex-footer.php";
Includes::custom_include($footerFilePath, [], true);
 ?>