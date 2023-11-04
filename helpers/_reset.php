<?php
if (isset($_POST['reset'])) {
    $newpassword = mysqli_real_escape_string($connection, sanitizeInput($_POST['newpassword']));
    $cnewpassword = mysqli_real_escape_string($connection, sanitizeInput($_POST['cnewpassword']));

    $resetErrors = [];
    // validate passwords
    if (empty($newpassword)) {
        $resetErrors['passErr'] = "Password cannot be empty";
    } else if ($newpassword != $cnewpassword) {
        $resetErrors['cpassErr'] = "The two password does not match";
    }

    if (count($resetErrors) < 1) {
        // reset password
        if (updateUserPassword(getUserByHash($_GET['hash']), $newpassword)) {
            $resetErrors['passUpdateSucc'] = "Password Changed Successfully. <a class='btn-link' href='login.php'>Login</a>";
            deleteReset($_GET['hash']);
        } else {
            $resetErrors['passUpdateErr'] = "Can't change password";
        };
    }
}

function isValidHash($hash)
{
    global $connection;
    $isValid = false;

    $data_q = "SELECT * FROM `recover_password` WHERE `hash` = ?";

    $data_stmt = mysqli_prepare($connection, $data_q);

    mysqli_stmt_bind_param($data_stmt, 's', $hash);

    mysqli_stmt_execute($data_stmt);

    $result = mysqli_fetch_assoc(mysqli_stmt_get_result($data_stmt));

    mysqli_stmt_close($data_stmt);

    $db_hash = $result['hash'];

    if ($db_hash == $hash) {
        $isValid = true;
    } else {
        $isValid = false;
    }
    return $isValid;
}


function getUserByHash($hash)
{
    global $connection;

    $data_q = "SELECT * FROM `recover_password` WHERE `hash` = ?";

    $data_stmt = mysqli_prepare($connection, $data_q);

    mysqli_stmt_bind_param($data_stmt, 's', $hash);

    mysqli_stmt_execute($data_stmt);

    $result = mysqli_fetch_assoc(mysqli_stmt_get_result($data_stmt));

    return $result['email'];
}


function deleteReset($hash)
{
    global $connection;

    $data_q = "DELETE FROM `recover_password` WHERE `hash` = ?";

    $data_stmt = mysqli_prepare($connection, $data_q);

    mysqli_stmt_bind_param($data_stmt, 's', $hash);

    mysqli_stmt_execute($data_stmt);

    mysqli_stmt_close($data_stmt);
}
