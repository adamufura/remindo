<?php

    if (!isset($_SESSION)) {
        session_start();
    }
    $email = $_SESSION['s_user_id'];

    if (isset($_GET['edit'])) {
        $taskId = $_GET['edit'];

        if (isset($_POST['updateTask'])) {
            $taskId = $_GET['edit'];
            $taskTitle = mysqli_real_escape_string($connection, $_POST['task_title']);
            $taskDescription = mysqli_real_escape_string($connection, $_POST['task_description']);
            $taskDate = mysqli_real_escape_string($connection, $_POST['task_date']);
            $taskTime = mysqli_real_escape_string($connection, $_POST['task_time']);

        if (empty($taskTitle) || empty($taskDescription) || empty($taskDate) || empty($taskTime)) {
                return;
            }

        $updateTaskQuery = "UPDATE `task` SET `task_title`=?,`task_description`=?,`task_date`=?,`task_time`=? WHERE `id` = ? AND `email` = ?";

        $updateTaskStmt = mysqli_prepare($connection, $updateTaskQuery);

        mysqli_stmt_bind_param($updateTaskStmt, "ssssss",
            $taskTitle, $taskDescription, $taskDate, $taskTime, $taskId, $email);

            if (mysqli_stmt_execute($updateTaskStmt)) {
                // send all upcoming agendas
                send_agenda_to_mail($email, "task");
                $msg = "<span class='text-success'> Task Updated successfully</span>";
            } else {
                $msg = "<span class='text-danger'> Can't update task, try again</span>";
            }
        }
    }else {
            if (isset($_POST['addTask'])) {
            $taskTitle = mysqli_real_escape_string($connection, $_POST['task_title']);
            $taskDescription = mysqli_real_escape_string($connection, $_POST['task_description']);
            $taskDate = mysqli_real_escape_string($connection, $_POST['task_date']);
            $taskTime = mysqli_real_escape_string($connection, $_POST['task_time']);

            if (empty($taskTitle) || empty($taskDescription) || empty($taskDate) || empty($taskTime)) {
                return;
            }

            $addTaskQuery = "INSERT INTO `task`(`email`, `task_title`, `task_description`, `task_date`, `task_time`) VALUES (?, ?, ?, ?, ?)";

            $addTaskStmt = mysqli_prepare($connection, $addTaskQuery);

            mysqli_stmt_bind_param($addTaskStmt, "sssss",
            $email, $taskTitle, $taskDescription, $taskDate, $taskTime);

            if (mysqli_stmt_execute($addTaskStmt)) {
                 // send all upcoming agendas
                send_agenda_to_mail($email, "task");
                $msg = "<span class='text-success'> Task added successfully</span>";
            }else{
                $msg = "<span class='text-danger'> Can't add task, try again</span>";
            }
    }
}

function getTaskById($taskId, $email)
{
    global $connection;
    $taskQuery = "SELECT * FROM `task` WHERE `id` = ? AND `email` = ?";

    $taskStmt = mysqli_prepare($connection, $taskQuery);

    mysqli_stmt_bind_param($taskStmt, "ss", $taskId, $email);

    mysqli_stmt_execute($taskStmt);

    $result = mysqli_fetch_assoc(mysqli_stmt_get_result($taskStmt));

    return $result;
}

?>