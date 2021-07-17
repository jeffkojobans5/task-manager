                    <li class="active"><i class="" aria-hidden="true"></i><a href="#">Dashboard</a></li>
                    <li><i class="fa fa-home" aria-hidden="true"></i><a href="index.php">Home</a></li>
                    <li><i class="fa fa-book" aria-hidden="true"></i><a href="addAct.php"> Activities </a></li>
                    <li><i class="fa fa-search" aria-hidden="true"></i><a href="searchAct.php">Search</a></li>
                    <?php if ( $auth == 'admin' ) {
                            echo '<li><i class="fa fa-tools" aria-hidden="true"></i><a href="addUser.php">Manage Users</a></li>
                            ';
                        }
                    ?>
                    <li><i class="fa fa-sign-out" aria-hidden="true"></i><a href="logOut.php">Log Out</a></li>
              