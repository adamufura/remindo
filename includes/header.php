<?php
if (!isUserLoggedIn()) {
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?php echo $variable['title']; ?></title>
    
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/icons/css/all.min.css">
    <link rel="stylesheet" href="assets/icons/js/all.min.js">
    <link rel="stylesheet" href="assets/js/app.js">
    <link rel="stylesheet" href="assets/css/usercss.css">
    <link rel="stylesheet" href="assets/css/components.min.css">
</head>