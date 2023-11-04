<?php

if (!isset($_SESSION)) {
    session_start();
}

$email = $_SESSION['s_user_id'];

function getUpcomingEvents($email)
{
    global $connection;
    $eventQuery = "SELECT * FROM `event` WHERE `event_status` = 0 AND `email` = ?";

    $eventStmt = mysqli_prepare($connection, $eventQuery);

    mysqli_stmt_bind_param($eventStmt, "s", $email);

    mysqli_stmt_execute($eventStmt);

    $result = mysqli_stmt_get_result($eventStmt);

    return $result;
}

function getAllEvents($email)
{
    global $connection;
    $eventQuery = "SELECT * FROM `event` WHERE `email` = ?";

    $eventStmt = mysqli_prepare($connection, $eventQuery);

    mysqli_stmt_bind_param($eventStmt, "s", $email);

    mysqli_stmt_execute($eventStmt);

    $result = mysqli_stmt_get_result($eventStmt);

    return $result;
}

function checkEvent($eventId, $email)
{
    global $connection;

    $eventUpdateQuery = "UPDATE `event` SET `event_status`='1' WHERE `id` = ? AND `email` = ?";

    $eventUpdateStmt = mysqli_prepare($connection, $eventUpdateQuery);

    mysqli_stmt_bind_param($eventUpdateStmt, "ss", $eventId, $email);

    mysqli_stmt_execute($eventUpdateStmt);

    header("location: event.php");
}

function isEventChecked($eventId, $email)
{
    $isChecked = false;
    global $connection;

    $isEventCheckedQuery = "SELECT * FROM `event` WHERE `id` = ? AND `email` = ?";

    $isEventCheckedStmt = mysqli_prepare($connection, $isEventCheckedQuery);

    mysqli_stmt_bind_param($isEventCheckedStmt, "ss", $eventId, $email);

    mysqli_stmt_execute($isEventCheckedStmt);

    $event = mysqli_fetch_assoc(mysqli_stmt_get_result($isEventCheckedStmt));

    if ($event['event_status'] == 1) {
        $isChecked = true;
    }else{
        $isChecked = false;
    }
    return $isChecked;
}

function deleteEvent($eventId, $email)
{
    global $connection;
    $eventDeleteQuery = "DELETE FROM `event` WHERE `id` = ? AND `email` = ?";
    $eventDeleteStmt = mysqli_prepare($connection, $eventDeleteQuery);

    mysqli_stmt_bind_param($eventDeleteStmt, "ss", $eventId, $email);

    mysqli_stmt_execute($eventDeleteStmt);

    header("location: event.php");
}

?>