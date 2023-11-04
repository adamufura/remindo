<?php
if (isset($_POST['loginUser'])) {
    $email = mysqli_real_escape_string($connection, sanitizeInput($_POST['email']));
    $password = mysqli_real_escape_string($connection, sanitizeInput($_POST['password']));

    $messages = [];

    // email validation
    if (empty($email)) {
        $messages['emailError'] = "Email cannot be empty";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $messages['emailError'] = "Invalid email address";
    }

    // password validation
    if (empty($password)) {
        $messages['passError'] = "Password cannot be empty";
    }

    if (count($messages) < 1) {
        if (!user_exist($email, $password)) {
            $messages['userError'] = "Invalid username or password";
        }
        if (count($messages) < 1) {
            // login user
            loginUser($email, $password);
        }
    }
}