        <nav id="sidebar">
            <div class="sidebar-header">
               <a href="dashboard.php"><img src="assets/images/remindo bg image.png" alt="LOGO" srcset=""></a>
            </div>

            <ul class="list-unstyled components">
                <h3 class="text-center py-3 text-uppercase"><a href="index.php">HOME</a></h3>
                <li class="active">
                    <a href="dashboard.php" >DASHBOARD</a>
                </li>

                 <li>
                    <a href="profile.php">Profile</a>
                </li>
                <li>           
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Schedules</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="todo.php">To-Do-List</a>
                        </li>
                        <li>
                            <a href="event.php">EVENTS</a>
                        </li>
                        <li>
                            <a href="task.php">TASKS</a>
                        </li>
                    </ul>
                </li>

                <li>
                <a href="change-password.php">Change Password</a>      
                </li>

                <li>
                            <a href="about.php">About</a>      
                    </li>
            </ul>

            <ul class="list-unstyled CTAs">
                <li>
                    <a href="helpers/logout.php" class="logOut-btn">Log Out</a>
                </li>
            </ul>
        </nav>