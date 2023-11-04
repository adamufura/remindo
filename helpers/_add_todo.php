<?php

    if (!isset($_SESSION)) {
        session_start();
    }
    $email = $_SESSION['s_user_id'];

    if (isset($_GET['edit'])) {
        $todoId = $_GET['edit'];

        if (isset($_POST['updateTodo'])) {
            $todoId = $_GET['edit'];
            $todoTitle = mysqli_real_escape_string($connection, trim($_POST['todo_title']));
        $todoDescription = mysqli_real_escape_string($connection, trim($_POST['todo_description']));

            if (empty($todoTitle) || empty($todoDescription)) {
                return;
            }

            $addTodoQuery = "UPDATE `todo` SET `todo_title`=?,`todo_description`=? WHERE`id` = ? AND `email` = ?";

            $addTodoStmt = mysqli_prepare($connection, $addTodoQuery);

        mysqli_stmt_bind_param($addTodoStmt, "ssss", $todoTitle, $todoDescription, $todoId, $email);

            if (mysqli_stmt_execute($addTodoStmt)) {
                // send all upcoming agendas
                send_agenda_to_mail($email, "todo");
                $msg = "<span class='text-success'> Todo Updated successfully</span>";
            } else {
                $msg = "<span class='text-danger'> Can't update todo, try again</span>";
            }
        }
    }else {
            if (isset($_POST['addTodo'])) {
            $todoTitle = mysqli_real_escape_string($connection, $_POST['todo_title']);
            $todoDescription = mysqli_real_escape_string($connection, $_POST['todo_description']);

            if (empty($todoTitle) || empty($todoDescription)) {
                return;
            }

            $addTodoQuery = "INSERT INTO `todo`(`email`, `todo_title`, `todo_description`) VALUES (?, ?, ?)";

            $addTodoStmt = mysqli_prepare($connection, $addTodoQuery);

            mysqli_stmt_bind_param($addTodoStmt, "sss", $email, $todoTitle, $todoDescription);

            if (mysqli_stmt_execute($addTodoStmt)) {
                // send all upcoming agendas
                send_agenda_to_mail($email, "todo");
                $msg = "<span class='text-success'> Todo added successfully</span>";
            }else{
                $msg = "<span class='text-danger'> Can't add todo, try again</span>";
            }
    }
}

function getTodoById($todoId, $email)
{
    global $connection;
    $todoQuery = "SELECT * FROM `todo` WHERE `id` = ? AND `email` = ?";

    $todoStmt = mysqli_prepare($connection, $todoQuery);

    mysqli_stmt_bind_param($todoStmt, "ss", $todoId, $email);

    mysqli_stmt_execute($todoStmt);

    $result = mysqli_fetch_assoc(mysqli_stmt_get_result($todoStmt));

    return $result;
}

?>