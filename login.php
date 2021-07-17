<?php require_once('include/sessions.php') ?>
<?php require_once('include/db.php') ?>
<?php

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
if(empty($username) || empty($password)){
    $_SESSION['ErrorMessage'] = "Both fields must be filled out";
} else {
    function mix () {
        
        
         // $conn = mysqli_connect('host', 'username' , 'password');
         // $conn_db = mysqli_select_db( $conn , 'database' );


        $username = $_POST['username'];
        $password = $_POST['password'];

        $select_query = "SELECT * from users WHERE username='$username' AND password = '$password' ";
        $execute_select_query = mysqli_query($conn , $select_query);
           
        if($data = mysqli_fetch_assoc($execute_select_query)){   
            return $data;        
        } else {
            return null ;
        }
    }
        if (mix()) {
            $_SESSION['id'] = mix()['id'];
            $_SESSION['login'] = mix()['username'];
            $_SESSION['auth'] = mix()['status'];
            $_SESSION['SuccessMessage'] = 'Welcome ' . mix()['username'] ;
            header('location:index.php');
            exit;
        } else {
            $_SESSION['ErrorMessage'] = 'Invalid Username or password';
            header('location:login.php');
            exit;
        }
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
    <link rel="stylesheet" href="sass/css/navbar.css">
    <link rel="stylesheet" href="sass/css/login.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <style>
        a:link {
            position: absolute;
            top: 30px;
            right: 30px;
        }    
        a:hover {
            text-decoration: none;
            color: white;
        }
    </style>

</head>
<body>
    <form action="login.php" method="post">
        <h2>WELCOME</h2>
        <div class="message bg-success"><?php echo ErrorMessage() ?></div>
        <div class="form-group">
        <label for="username"> <i class="fas fa-user"></i> Username : </label>
        <input type="text" name="username" id="">
        </div>      
        <div class="form-group">
        <label for="username"> <i class="fas fa-lock"></i> Password : </label>
        <input type="password" name="password" id="">
        </div>   
        <div class="form-group">
        <button type="submit" name="submit" class="bg-danger"> LOGIN</button>
        </div>                    
    </form>

</body>
</html>