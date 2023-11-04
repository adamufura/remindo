<?php require "helpers/init.php" ?>

<?php 
$headerFilePath = "includes/ex-header.php";
$headerParams = ["title" => "About | Remindo"];
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
   <div class="container-fluid">
       <div class="container my-3">
         <div class="row">
             <div class="col-md-6 col-12 d-flex text-center mx-auto">
                 <img src="assets/images/aboutUs-img.png" class="mx-auto" alt="About Us" srcset="" height="400vh">
             </div>
             <div class="col-md-6 col-12">
                 <p class="lead">Taking our modern life and the 21st-century developments, it is quite easy for one to be distracted by other activities. For a person to be productive, there is a need for the person to be able to manage their time effectively, while still being able to remember what task or event should happen at an exact time.</p>
                 <p class="lead">To achieve that level of productivity, people write their agendas on a piece of paper, sticky notes, notepads, diaries, and calendars, while some people simply try to memorise them in their heads. People who write their agenda on paper, use to keep those papers in a place they are most likely to remember, places like a tabletop or by their teacups side. </p>
                 <p class="lead">While people who wrote their tasks on sticky notes, stick them on places they use habitually examples on their laptop screen, on the wall, the fridge doors or on book covers or any conspicuous location to remember the agendas they have to attend to. While those who write them on their dairies usually go everywhere with it and look into it in their free time.</p>
                 <p class="lead">This kind of problem motivated people like Victoria Bellotti, et al (2004), Richard H. Leukart, et al (2010), and Jake Tobin (2013) among others to research and develop systems to effectively manage and keep track of time.</p>
                 <p class="lead">ٌRemindo was built to enable people to “set and forget” and get reminded later of the agenda at an appropriate time.</p>
             </div>
         </div>
       </div>
   </div>
      <!--end of header-->
<?php 
$footerFilePath = "includes/ex-footer.php";
Includes::custom_include($footerFilePath, [], true);
 ?>