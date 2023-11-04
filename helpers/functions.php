<?php

include 'config.php';

function getConnection()
{
    global $connection;
    return $connection;
}

function sanitizeInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = stripslashes($data);
    $data = filter_var($data, FILTER_SANITIZE_STRING);
    return $data;
}

function haveSpecialChar($data)
{
    return preg_match('/[#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/', $data);
}

function getUserByEmail($email)
{
    global $connection;

    $userdata_q = "SELECT * FROM `users` WHERE `email` = ?";

    $user_data_stmt = mysqli_prepare($connection, $userdata_q);

    mysqli_stmt_bind_param($user_data_stmt, 's', $email);

    mysqli_stmt_execute($user_data_stmt);

    $result = mysqli_fetch_assoc(mysqli_stmt_get_result($user_data_stmt));

    mysqli_stmt_close($user_data_stmt);

    return $result;
}

function user_exist($email, $password)
{
    $userExist = false;

    $result = getUserByEmail($email);

    $db_userEmail = $result['email'];
    $is_password = password_verify($password, $result['password']);

    if ($db_userEmail == $email && $is_password) {
        $userExist = true;
    } else {
        $userExist = false;
    }
    return $userExist;
}

function email_exist($email)
{
    $emailExist = false;

    $result = getUserByEmail($email);

    $db_email = $result['email'];

    if ($db_email == $email) {
        $emailExist = true;
    } else {
        $emailExist = false;
    }
    return $emailExist;
}

function loginUser($email, $password)
{
    if (user_exist($email, $password)) {
        $result = getUserByEmail($email);

        session_start();
        $_SESSION['s_userID'] = $result['id'];
        $_SESSION['s_user_id'] = $result['email'];
        header("Location: dashboard.php");
    }
}

function isUserLoggedIn()
{
    if (!isset($_SESSION)) {
        session_start();
    }

    if (isset($_SESSION['s_userID']) && isset($_SESSION['s_user_id'])) {
        return true;
    } else {
        return false;
    }
}


function logoutUser()
{
    if (!isset($_SESSION)) {
        session_start();
    }

    $s_id = $_SESSION['s_userID'];
    $s_email = $_SESSION['s_user_id'];

    $s_id = null;
    $s_email = null;

    unset($s_id);
    unset($s_email);

    session_destroy();
    header("Location: login.php");
}

function updateUserPassword($email, $newpassword)
{
    $isUPdated = false;
    global $connection;
    $hashedPass = password_hash($newpassword, PASSWORD_DEFAULT, []);

    $update_q = "UPDATE `users` SET `password`= ? WHERE `email` = ?";

    $update_stmt = mysqli_prepare($connection, $update_q);

    mysqli_stmt_bind_param($update_stmt, "ss", $hashedPass, $email);

    if (mysqli_stmt_execute($update_stmt)) {
        $isUPdated = true;
    } else {
        $isUPdated = false;
    }
    mysqli_stmt_close($update_stmt);

    return $isUPdated;
}

function getUpcomingAgendaCount($email, $tablename, $columnname)
{
    global $connection;
    $agendaQuery = "SELECT * FROM `$tablename` WHERE `$columnname` = 0 AND `email` = ?";

    $agendaStmt = mysqli_prepare($connection, $agendaQuery);

    mysqli_stmt_bind_param($agendaStmt, "s", $email);

    mysqli_stmt_execute($agendaStmt);

    $result = mysqli_stmt_get_result($agendaStmt);

    $count =  mysqli_num_rows($result);
    return $count;
}

function getAllAgendaCount($email, $tablename)
{
    global $connection;
    $agendaQuery = "SELECT * FROM `$tablename` WHERE `email` = ?";

    $agendaStmt = mysqli_prepare($connection, $agendaQuery);

    mysqli_stmt_bind_param($agendaStmt, "s", $email);

    mysqli_stmt_execute($agendaStmt);

    $result = mysqli_stmt_get_result($agendaStmt);

    $count =  mysqli_num_rows($result);
    return $count;
}

function getAllCompletedAgendaCount($email, $tablename, $columnname)
{
    global $connection;
    $agendaQuery = "SELECT * FROM `$tablename` WHERE `email` = ? AND `$columnname` = 1";

    $agendaStmt = mysqli_prepare($connection, $agendaQuery);

    mysqli_stmt_bind_param($agendaStmt, "s", $email);

    mysqli_stmt_execute($agendaStmt);

    $result = mysqli_stmt_get_result($agendaStmt);

    $count =  mysqli_num_rows($result);
    return $count;
}


function send_agenda_to_mail($email, $agendaTypeTable)
{
  $isSent = false;

  $list = getUpcomingAgendas($email, $agendaTypeTable);

  $to_email = $email;
  $subject = "My Upcoming Agendas";
  $body = '<html lang="en">
  <head>
      <link rel="stylesheet" href="https://localhost/remindo/assets/css/bootstrap.min.css">
    <title>My Upcoming Agendas</title>
    <style>
      ol,
        ul {
        margin: 0;
        padding: 0;
        list-style: none;
        display: grid;
        gap: 1rem;
        }
        li {
        display: grid;
        grid-template-columns: 0 1fr;
        gap: 1.75em;
        align-items: start;
        font-size: 1.5rem;
        line-height: 1.25;
        }
        ol {
            counter-reset: orderedlist;
            }

            ol li::before {
            counter-increment: orderedlist;
            content: counter(orderedlist);

                        font-family: "Indie Flower";
            font-size: 1.25em;
            line-height: 0.75;
            width: 1.5rem;
            padding-top: 0.25rem;
            text-align: center;
            color: #fff;
            background-color: purple;
            border-radius: 0.25em;
                        }
                        
                        ol {
            --li-bg: purple;
            }

            ol li::before {
            background-color: var(--li-bg);
            }
    </style>
  </head>
  <body>
    <div>
      <div class="row my-3">
          <div class="card offset-md-5">
              <div class="card-header shadow-sm text-primary">
                <h3>My Upcoming '. strtoupper($agendaTypeTable) .'</h3>
              </div>
              <div class="card-body text-center">
                  <img src="http://localhost/remindo/assets/images/remindo%20bg%20image.png" alt="Remindo" />
              </div>
              <div class="card-footer text-center">
                  <a href="https://localhost/remindo/'.$agendaTypeTable.'.php?todos=all">View All Todos</a>
              </div>
          </div>
      </div>
 <div class="row">
     <div class="col-md-6 offset-md-3">
              <ol class="list-group">
              '.  $list .'
</ol>
     </div>
 </div>
    </div>
  </body>
</html>
';
  $headers = "From: " . 'webmaster@remindo.com' . "\r\n";
  $headers .= "Reply-To: " . $email . "\r\n";
  $headers .= "CC: $email\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

  if (mail($to_email, $subject, $body, $headers)) {
    $isSent = true;
  } else {
    $isSent = false;
  }
  return $isSent;
}

function getUpcomingAgendas($email, $table)
{
    global $connection;

    $column = $table . "_status";
    $column_title = $table . "_title";

    $agendaQuery = "SELECT * FROM $table WHERE $column = 0 AND `email` = ?";

    $agendaStmt = mysqli_prepare($connection, $agendaQuery);

    mysqli_stmt_bind_param($agendaStmt, "s", $email);

    mysqli_stmt_execute($agendaStmt);

    $results = mysqli_stmt_get_result($agendaStmt);

    $listItems = "";
    $agenda_date = $table . "_date";

    if ($table == "todo") {
        $agenda_date = $table . "_status";
    }

    while ($result = mysqli_fetch_assoc($results)) {
        $a = $result[$agenda_date] == 0 ? " - " : $result[$agenda_date] ;
        $listItems .= "<li class='list-group-item d-flex justify-content-between align-items-center'>". $result[$column_title] . "<span class='badge badge-primary badge-pill'>  ". $a ."  </span>"  ."</li>";
    }

    return $listItems;
}