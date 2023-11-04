<?php
 if (!isset($_SESSION)) {
        session_start();
    }

if (isset($_POST['changepassword'])) {
    $oldpass = mysqli_real_escape_string($connection, sanitizeInput($_POST['oldpass']));
    $newpass = mysqli_real_escape_string($connection, sanitizeInput($_POST['newpass']));
    $cnewpass = mysqli_real_escape_string($connection, sanitizeInput($_POST['cnewpass']));

    $user_data = getUserByEmail($_SESSION['s_user_id']);
    $email = $user_data['email'];

    $db_oldpass = $user_data['password'];

    if (empty($oldpass) || empty($newpass) || empty($cnewpass)) {
        return;
    }

    $msgs = [];

    if (!password_verify($oldpass, $db_oldpass)) {
        $msgs['passErr']  = "Incorrect Old Password does not match!";
    } elseif ($newpass != $cnewpass) {
        $msgs['passErr']  = "The New password and Confirm password does not match!";
    }

    if (count($msgs) < 1) {
        // change user password 
        if (updateUserPassword($email, $newpass)) {
            $msgs['passSucc']  = "Password changed successfully...";
        };
    }
}
