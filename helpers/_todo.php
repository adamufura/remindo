<?php

if (!isset($_SESSION)) {
    session_start();
}

$email = $_SESSION['s_user_id'];

if (isset($_POST['changeTime'])) {
    $todoTime = mysqli_real_escape_string($connection, $_POST['todoTime']);

    $changeTimeQuery = "UPDATE `users` SET `todo_time`=? WHERE `email` = ?";

    $changeTimeStmt = mysqli_prepare($connection, $changeTimeQuery);

    mysqli_stmt_bind_param($changeTimeStmt, "ss", $todoTime, $email);

    mysqli_stmt_execute($changeTimeStmt);
}

function getUpcomingTodos($email)
{
    global $connection;
    $todoQuery = "SELECT * FROM `todo` WHERE `todo_status` = 0 AND `email` = ?";

    $todoStmt = mysqli_prepare($connection, $todoQuery);

    mysqli_stmt_bind_param($todoStmt, "s", $email);

    mysqli_stmt_execute($todoStmt);

    $result = mysqli_stmt_get_result($todoStmt);

    return $result;
}

function getAllTodos($email)
{
    global $connection;
    $todoQuery = "SELECT * FROM `todo` WHERE `email` = ?";

    $todoStmt = mysqli_prepare($connection, $todoQuery);

    mysqli_stmt_bind_param($todoStmt, "s", $email);

    mysqli_stmt_execute($todoStmt);

    $result = mysqli_stmt_get_result($todoStmt);

    return $result;
}

function checkTodo($todoId, $email)
{
    global $connection;
    $todoUpdateQuery = "UPDATE `todo` SET `todo_status`='1' WHERE `id` = ? AND `email` = ?";
    $todoUpdateStmt = mysqli_prepare($connection, $todoUpdateQuery);

    mysqli_stmt_bind_param($todoUpdateStmt, "ss", $todoId, $email);

    mysqli_stmt_execute($todoUpdateStmt);

    header("location: todo.php");
}

function isTodoChecked($todoId, $email)
{
    $isChecked = false;
    global $connection;

    $isTodoCheckedQuery = "SELECT * FROM `todo` WHERE `id` = ? AND `email` = ?";

    $isTodoCheckedStmt = mysqli_prepare($connection, $isTodoCheckedQuery);

    mysqli_stmt_bind_param($isTodoCheckedStmt, "ss", $todoId, $email);

    mysqli_stmt_execute($isTodoCheckedStmt);

    $todo = mysqli_fetch_assoc(mysqli_stmt_get_result($isTodoCheckedStmt));

    if ($todo['todo_status'] == 1) {
        $isChecked = true;
    }else{
        $isChecked = false;
    }
    return $isChecked;
}

function deleteTodo($todoId, $email)
{
    global $connection;
    $todoDeleteQuery = "DELETE FROM `todo` WHERE `id` = ? AND `email` = ?";
    $todoDeleteStmt = mysqli_prepare($connection, $todoDeleteQuery);

    mysqli_stmt_bind_param($todoDeleteStmt, "ss", $todoId, $email);

    mysqli_stmt_execute($todoDeleteStmt);

    header("location: todo.php");
}

?>