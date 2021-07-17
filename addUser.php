<?php require_once('include/sessions.php') ?>
<?php require_once('include/db.php') ?>
<?php require_once('include/date.php') ?>
<?php require_once('include/logout.php') ?>
<?php require_once('include/auth.php') ?>


<?php 

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    
    if(empty($username) || empty($password1) || empty($password2)){
        $_SESSION['ErrorMessage'] = "All fields must be filled";
    } else if (strlen($username) < 5 ) {
        $_SESSION['ErrorMessage'] = "Username is too Short. Please try 5 characters and above.";
    } else if (strlen($password1) < 6){
        $_SESSION['ErrorMessage'] = "Password is too Short. Try 6 character and above.";
    } else if ($password1 == $password2){
        $insert_query = "INSERT INTO users (date , time , username , password, addedby , status)
                        VALUES ('$Date' , '$Time' , '$username' , '$password1' , '$user' , 'user' )";
        $execute_insert_query = mysqli_query($conn , $insert_query);
        if($execute_insert_query){
            $_SESSION['SuccessMessage'] = "User has been added Succesfully";
        }
    }  else if ($password1 != $password2) {
        $_SESSION['ErrorMessage'] = "Passwords do not match";        
    }
  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin'S Dashboard</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/fontawesome/css/all.css">
    <link rel="stylesheet" href="sass/css/bootstrap.css">
    <link rel="stylesheet" href="sass/css/addUser.css">
    <link rel="stylesheet" href="sass/css/navbar.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

        <style>        
            select {
                width: 100%;
                padding: 1%;
            }
        </style>

</head>
<body>
    <div class="containers">
        <div class="row">
            <div class="col-md-3 left">
                <ul id="row" style="margin-top: 6rem">
                    <?php require_once('include/navigation.php') ?>
                  </ul>
            </div>


            <div class="col-md-9 right">
                <div class="container">
                <h2>Manage Accounts</h2>
                <div class="row main">
                <div class="box" style="">
                        <?php
                            $count_query = "select count(*) from users";
                            $execute_count_query = mysqli_query($conn , $count_query);
                            $row = mysqli_fetch_array($execute_count_query);
                            $total = $row[0];
                        ?>
                            <h1><?php echo $total ?> </h1>
                            <p> Total Accounts </p>
                        </div>
                        <div class="box" style="background-color:">
                        <?php
                            $count_query = "select count(*) from users WHERE status = 'admin' ";
                            $execute_count_query = mysqli_query($conn , $count_query);
                            $row = mysqli_fetch_array($execute_count_query);
                            $completed = $row[0];
                        ?>
                            <h1><?php echo $completed ?> </h1>                        
                            <p> Admin Accounts </p>
                        </div>
                        <div class="box" style="background-color:">
                        <?php
                            $count_query = "select count(*) from users WHERE status = 'user' ";
                            $execute_count_query = mysqli_query($conn , $count_query);
                            $row = mysqli_fetch_array($execute_count_query);
                            $pending = $row[0];
                        ?>
                            <h1><?php echo $pending ?> </h1>  
                            <p> User Accounts </p>
                        </div>                                             
                </div>



                <div class="message"><?php echo ErrorMessage(); ?></div>
                <div class="message"><?php echo SuccessMessage(); ?></div>
                
                <div class="add-form">
                    <h3>Add New User</h3>

                    <form action="addUser.php" method="post">
                    <div class="form-group">
                        <label for="activity"> <i class="fas fa-user"></i> Name </label>
                        <input type="text" class="form-control" id="activity" name="username">
                    </div>  

                    <div class="form-group">
                        <label for="activity"> <i class="fas fa-key"></i> Password </label>
                        <input type="password" class="form-control" id="activity" name="password1">
                    </div>  
                    <div class="form-group">
                        <label for="activity"> <i class="fas fa-key"></i> Password </label>
                        <input type="password" class="form-control" id="activity" name="password2">
                    </div>            
                    <div class="form-group">
                        <button type="submit" name="submit"> ADD USER </button>
                    </div>                                                                        
                </div>

                <div class="add-form">
                <h1>User List</h1>
                <table class="table table-bordered ">       
                    <thead>
                        <tr>  
                            <th> No </th>                            
                            <th> Date & Time </th>
                            <th> User Name</th>
                            <th> Status </th>
                            <th> Added By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <?php
                    //connecting to database and extracting activities
                    $view_query = "SELECT * FROM users WHERE status = 'user'  ORDER BY date desc";
                    $execute_view_query = mysqli_query($conn , $view_query) or die( mysqli_error($conn));;
                    $SrNo = 0;
                    while($data = mysqli_fetch_array($execute_view_query , MYSQLI_ASSOC)){
                        $id = $data['id'];
                        $date = $data['date'];
                        $time = $data['time'];
                        $status = $data['status'];
                        $username = $data['username'];
                        $password = $data['password'];
                        $addedby = $data['addedby'];
                        $SrNo++;
                    ?>    
                    <tbody>
                        <tr>
                            <td><?php echo $SrNo ?></td>
                            <td><?php echo date('d-F-y ---- h:i ', strtotime($date)); ?> <?php echo $time ?></td>

                            <td><?php echo $username ?></td>
                            <td><?php echo $status  ?></td>
                            <td><?php echo $addedby  ?></td>
                            <td><a href="deleteUser.php?id=<?php echo $id ?>" class="btn btn-danger text-white">DELETE</a></td>
                        </tr>
                    </tbody>
                    <?php } ?>
                </table>
                </div>                
            </div>
            </div>
        </div>
</body>
</html>