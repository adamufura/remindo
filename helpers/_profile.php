<?php

if (!isset($_SESSION)) {
        session_start();
    }

    $s_id = $_SESSION['s_userID'];
    $s_email = $_SESSION['s_user_id'];

    $user_data = getUserByEmail($s_email);

    if (isset($_POST['saveChanges'])) {
        $name = mysqli_real_escape_string($connection, sanitizeInput($_POST['name']));
        $phoneNumber = mysqli_real_escape_string($connection, sanitizeInput($_POST['phoneNumber']));

        if (empty($name) || empty($phoneNumber)) {
            return;
        }

        $email = $user_data['email'];
        $avatar = $user_data['avatar'];

    if ($_FILES['avatar']['error'] < 1 && isset($_FILES['avatar'])) {
        $file_input = 'avatar';
        $upload_dir = 'assets/avatars/';

        $target_file = $upload_dir .  basename($_FILES["avatar"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (!isset($_FILES[$file_input])) {
            $msgs['imageErr'] = "Error Uploading image";
        }

        // return false if error occurred
        $error = $_FILES[$file_input]['error'];

        if ($error !== UPLOAD_ERR_OK) {
            $msgs['imageErr'] = "Error Uploading image";
        }

        // move the uploaded file to the upload_dir
        $new_file = $upload_dir . $email . '.' . $imageFileType;

        if (move_uploaded_file($_FILES[$file_input]['tmp_name'], $new_file)) {
                $avatar = $new_file;
            }else{
                $avatar = $user_data['avatar'];
            }
        }


        $updateUserQuery = "UPDATE `users` SET `name`=?,`phone_number`=?,`avatar`=? WHERE `email`=?";

        $updateUser_stmt = mysqli_prepare(getConnection(), $updateUserQuery);

        mysqli_stmt_bind_param($updateUser_stmt, "ssss", $name, $phoneNumber, $avatar, $email);

        if (mysqli_stmt_execute($updateUser_stmt)) {
            $Msg = "<span class='text-success'>User Updated Successfully</span";
        }else{
            $Msg = "<span class='text-danger'>Can't Update user </span>";
            echo mysqli_error($connection);
        }
    }
?>