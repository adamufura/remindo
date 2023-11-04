<?php

if (!isset($_SESSION)) {
    session_start();
}

$email = $_SESSION['s_user_id'];

function getUpcomingTasks($email)
{
    global $connection;
    $taskQuery = "SELECT * FROM `task` WHERE `task_status` = 0 AND `email` = ?";

    $taskStmt = mysqli_prepare($connection, $taskQuery);

    mysqli_stmt_bind_param($taskStmt, "s", $email);

    mysqli_stmt_execute($taskStmt);

    $result = mysqli_stmt_get_result($taskStmt);

    return $result;
}

function getAllTasks($email)
{
    global $connection;
    $taskQuery = "SELECT * FROM `task` WHERE `email` = ?";

    $taskStmt = mysqli_prepare($connection, $taskQuery);

    mysqli_stmt_bind_param($taskStmt, "s", $email);

    mysqli_stmt_execute($taskStmt);

    $result = mysqli_stmt_get_result($taskStmt);

    return $result;
}

function checkTask($taskId, $email)
{
    global $connection;
    $taskUpdateQuery = "UPDATE `task` SET `task_status`='1' WHERE `id` = ? AND `email` = ?";
    $todoUpdateStmt = mysqli_prepare($connection, $taskUpdateQuery);

    mysqli_stmt_bind_param($todoUpdateStmt, "ss", $taskId, $email);

    mysqli_stmt_execute($todoUpdateStmt);

    header("location: task.php");
}

function isTaskChecked($taskId, $email)
{
    $isChecked = false;
    global $connection;

    $isTaskCheckedQuery = "SELECT * FROM `task` WHERE `id` = ? AND `email` = ?";

    $isTaskCheckedStmt = mysqli_prepare($connection, $isTaskCheckedQuery);

    mysqli_stmt_bind_param($isTaskCheckedStmt, "ss", $taskId, $email);

    mysqli_stmt_execute($isTaskCheckedStmt);

    $task = mysqli_fetch_assoc(mysqli_stmt_get_result($isTaskCheckedStmt));

    if ($task['task_status'] == 1) {
        $isChecked = true;
    }else{
        $isChecked = false;
    }
    return $isChecked;
}

function deleteTask($taskId, $email)
{
    global $connection;
    $taskDeleteQuery = "DELETE FROM `task` WHERE `id` = ? AND `email` = ?";
    $taskDeleteStmt = mysqli_prepare($connection, $taskDeleteQuery);

    mysqli_stmt_bind_param($taskDeleteStmt, "ss", $taskId, $email);

    mysqli_stmt_execute($taskDeleteStmt);

    header("location: task.php");
}

?>