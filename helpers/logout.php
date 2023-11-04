<?php
if (!isset($_SESSION)) {
        session_start();
    }

    $s_id = $_SESSION['s_userID'];
    $s_email = $_SESSION['s_user_id'];

    $s_id = null;
    $s_email = null;

    unset($s_id);
    unset($s_email);

    session_destroy();
    header("Location: ../login.php");
?>