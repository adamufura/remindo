<?php

    if (!isset($_SESSION)) {
        session_start();
    }
    $email = $_SESSION['s_user_id'];

    if (isset($_GET['edit'])) {
        $eventId = $_GET['edit'];

        if (isset($_POST['updateEvent'])) {
            $eventId = $_GET['edit'];
            $eventTitle = mysqli_real_escape_string($connection, $_POST['event_title']);
            $eventDescription = mysqli_real_escape_string($connection, $_POST['event_description']);
            $eventDate = mysqli_real_escape_string($connection, $_POST['event_date']);
            $eventStartTime = mysqli_real_escape_string($connection, $_POST['event_start_time']);
            $eventEndTime = mysqli_real_escape_string($connection, $_POST['event_end_time']);

        if (empty($eventTitle) || empty($eventDescription) || empty($eventDate) || empty($eventStartTime) || empty($eventEndTime)) 
            {
                return;
            }

        $updateEventQuery = "UPDATE `event` SET `event_title`=?,`event_description`=?,`event_date`=?,`event_start_time`=?,`event_end_time`=? WHERE `id` = ? AND `email` = ?";

        $updateEventStmt = mysqli_prepare($connection, $updateEventQuery);

        $eventDescription = trim($eventDescription);

        mysqli_stmt_bind_param($updateEventStmt,
            "sssssss",
            $eventTitle,
            $eventDescription,
            $eventDate,
            $eventStartTime,
            $eventEndTime,
            $eventId, $email);

            if (mysqli_stmt_execute($updateEventStmt)) {
                 // send all upcoming agendas
                send_agenda_to_mail($email, "event");
                $msg = "<span class='text-success'> Event Updated successfully</span>";
            } else {
                $msg = "<span class='text-danger'> Can't update event, try again</span>";
            }
        }
    }else {
            if (isset($_POST['addEvent'])) {
            $eventTitle = mysqli_real_escape_string($connection, $_POST['event_title']);
            $eventDescription = mysqli_real_escape_string($connection, $_POST['event_description']);
            $eventDate = mysqli_real_escape_string($connection, $_POST['event_date']);
            $eventStartTime = mysqli_real_escape_string($connection, $_POST['event_start_time']);
            $eventEndTime = mysqli_real_escape_string($connection, $_POST['event_end_time']);

            if (empty($eventTitle) || empty($eventDescription) || empty($eventDate) || empty($eventStartTime) || empty($eventEndTime)) 
            {
                return;
            }

            // compare booked date and time

            // Get dates from database
            $getDates = "SELECT * FROM `event` WHERE `event_date` = ? AND `event_status` = 0";

            $getDatesStmt = mysqli_prepare($connection, $getDates);

            mysqli_stmt_bind_param($getDatesStmt, "s", $eventDate);

            mysqli_stmt_execute($getDatesStmt);

            $date_results = mysqli_stmt_get_result($getDatesStmt);

            // check for dates and time
            $userStartTime = date("h",  strtotime($eventStartTime));
            $userEndTime = date("h",  strtotime($eventEndTime));

            $startTime = "";
            $endTime = "";

            while ($datetime_result = mysqli_fetch_assoc($date_results)) {
                $startTime = date("h",  strtotime($datetime_result['event_start_time']));
                $endTime = date("h",  strtotime($datetime_result['event_end_time']));
            }

            // echo $startTime . " " . $userStartTime;
            // echo "<br>";
            // echo $endTime . " " . $userEndTime;

            if (
                ($date_results != null)&&($startTime == $userStartTime && $endTime == $userEndTime)
                || ($userStartTime >= $startTime && $userEndTime <= $endTime)
                ){
            $msg =  "<span class='text-danger'>This day and hour is booked, try other available hours</span>";

            return;
            }else {
                // insert new event
                $addEventQuery = "INSERT INTO `event`(`email`, `event_title`, `event_description`, `event_date`, `event_start_time`, `event_end_time`) VALUES (?, ?, ?, ?, ?, ?)";

                $addEventStmt = mysqli_prepare($connection, $addEventQuery);

                $eventDescription = trim($eventDescription);
                mysqli_stmt_bind_param($addEventStmt, "ssssss",
                $email, $eventTitle, $eventDescription, $eventDate, $eventStartTime, $eventEndTime);

                if (mysqli_stmt_execute($addEventStmt)) {
                      // send all upcoming agendas
                        send_agenda_to_mail($email, "event");
                    $msg = "<span class='text-success'> Event added successfully</span>";
                }else{
                    $msg = "<span class='text-danger'> Can't event task, try again</span>";
                }
                
        }
    }
}

function getEventById($taskId, $email)
{
    global $connection;
    $EventQuery = "SELECT * FROM `event` WHERE `id` = ? AND `email` = ?";

    $eventStmt = mysqli_prepare($connection, $EventQuery);

    mysqli_stmt_bind_param($eventStmt, "ss", $taskId, $email);

    mysqli_stmt_execute($eventStmt);

    $result = mysqli_fetch_assoc(mysqli_stmt_get_result($eventStmt));

    return $result;
}

?>