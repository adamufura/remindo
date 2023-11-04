<?php
if (!isset($_SESSION)) {
        session_start();
    }

    $s_id = $_SESSION['s_userID'];
    $s_email = $_SESSION['s_user_id'];
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="navbar-btn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto shadow p-2 round">
                              <li class="dropdown">
                    <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                    <img alt="image" class="dp-image mx-2" src="<?php echo getUserByEmail($s_email)['avatar']; ?>" class="rounded-circle mr-1">
                    <div class="d-sm-none d-lg-inline-block mr-5">Hi, <?php echo getUserByEmail($s_email)['name']; ?></div></a>
                    <div class="dropdown-menu dropdown-menu-right p-5">
                    
                        <a href="profile.php" class="dropdown-item has-icon"><i class="far fa-user"></i> Profile</a>
                        <div class="dropdown-divider"></div>
                        <a href="helpers/logout.php" class="dropdown-item has-icon text-danger"><i class="fas fa-sign-out-alt"></i> Log Out</a>
                    </div>
                </li>
                        </ul>
                    </div>
                </div>
            </nav>