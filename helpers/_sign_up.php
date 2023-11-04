<?php
if (isset($_POST['createAccount'])) {
    $name = mysqli_real_escape_string($connection, sanitizeInput($_POST['name']));
    $email = mysqli_real_escape_string($connection, sanitizeInput($_POST['email']));
    $phoneNumber = mysqli_real_escape_string($connection, sanitizeInput($_POST['phoneNumber']));
    $password = mysqli_real_escape_string($connection, sanitizeInput($_POST['password']));

    $messages = [];


    // name validation
    if (empty($name)) {
        $messages['nameError'] = "Name cannot b e empty";
    } elseif (strlen($name) < 3 || strlen($name)  > 50) {
        $messages['nameError'] = "Name must be greater 3 to 50 characters";
    } elseif (haveSpecialChar($name)) {
        $messages['nameError'] = "Name cannot have special characters";
    }

    // email validation
    if (empty($email)) {
        $messages['emailError'] = "Email cannot be empty";
    } elseif (strlen($email) > 50) {
        $messages['emailError'] = "Email is too long";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $messages['emailError'] = "Invalid email address";
    }

    // phone  number validation
    if (empty($phoneNumber)) {
        $messages['phoneError'] = "Phone number cannot be empty";
    } elseif (strlen($phoneNumber) > 15) {
        $messages['phoneError'] = "Phone number is too long";
    }

    // password validation
    if (empty($password)) {
        $messages['passError'] = "Password cannot be empty";
    } elseif (strlen($password) < 4 || strlen($password)  > 12) {
        $messages['passError'] = "Password must be between 4 to 12 characters";
    }

    if (count($messages) < 1) {
        if (user_exist($email, $password)) {
            $messages['userError'] = "user already exist";
        } else {
            // create user account
            $createUserQuery = "INSERT INTO `users`(`name`, `email`, `phone_number`, `password`) VALUES (?, ?, ?, ?)";

            $createUserStmt = mysqli_prepare($connection, $createUserQuery);

            // hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT, []);
            mysqli_stmt_bind_param($createUserStmt, "ssss", $name, $email, $phoneNumber, $hashed_password);

            if (mysqli_stmt_execute($createUserStmt)) {
                // login user
                loginUser($email, $password);
            } else {
                // throw error
                echo "Error occured creating user";
            }
        }
    }
}