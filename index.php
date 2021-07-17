<?php require_once('include/db.php') ?>
<?php require_once('include/sessions.php') ?>
<?php require_once('include/date.php') ?>
<?php require_once('include/logout.php') ?>
<?php require_once('include/auth.php') ?>
<?php   
if(isset($_POST['submit'])){
$activity = $_POST['activity'];  //grabing activity input
$comment = $_POST['comment'];    //grabing comment input

//checking for validations
if(empty($_POST['activity'])){
    $_SESSION['ErrorMessage'] = "Activity filled cannot be empty";      //error throws in addAct.php page
} else {
    // if no error insert into database and redirect to index.php 

    // $insert_query = "INSERT INTO test ( num , name  )
    //                 VALUES ( 1 , 'sept')" ;


    $insert_query = "INSERT INTO activity (date  , time ,  name , activity , comment , status )
                    VALUES ('$Date' , '$Time' , '$user' , '$activity' , '$comment' , 'fa fa-hourglass-half')" ;
                    
    $execute_insert_query = mysqli_query($conn,$insert_query) or die(mysqli_error($conn));
    
    if($execute_insert_query){
        $_SESSION['SuccessMessage'] = "Activity added successfully";
        header('location:addAct.php');
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
    <link rel="stylesheet" href="sass/css/index.css">
    <link rel="stylesheet" href="sass/css/navbar.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

        <style>
            h2 {
                background-color: none;
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
                <h2> Welcome <?php echo ucfirst($user) ?> </h2>
                <div class="row main">
                <div class="box" style="">
                        <?php
                            $count_query = "select count(*) from activity";
                            $execute_count_query = mysqli_query($conn , $count_query);
                            $row = mysqli_fetch_array($execute_count_query);
                            $total = $row[0];
                        ?>
                            <h1><?php echo $total ?> </h1>
                            <p> Total Actitivites </p>
                        </div>
                        <div class="box" style="background-color:">
                        <?php
                            $count_query = "select count(*) from activity WHERE status = 'fa fa-check-circle' ";
                            $execute_count_query = mysqli_query($conn , $count_query);
                            $row = mysqli_fetch_array($execute_count_query);
                            $completed = $row[0];
                        ?>
                            <h1><?php echo $completed ?> </h1>                        
                            <p> Completed Activities </p>
                        </div>
                        <div class="box" style="background-color:">
                        <?php
                            $count_query = "select count(*) from activity WHERE status = 'fa fa-hourglass-half' ";
                            $execute_count_query = mysqli_query($conn , $count_query);
                            $row = mysqli_fetch_array($execute_count_query);
                            $pending = $row[0];
                        ?>
                            <h1><?php echo $pending ?> </h1>  
                            <p> Pending Activities </p>
                        </div>                                                
                </div>



                <div class="message"><?php echo ErrorMessage(); ?></div>
                
                <div class="add-form">
                    <h3>Add Activity</h3>

                    <form action="index.php" method="post">
                    <div class="form-group">
                        <label for="activity"> <i class="fas fa-book"></i> Activity </label>
                        <input type="text" class="form-control" id="activity" name="activity">
                    </div>  
                    <div class="form-group">
                        <label for="activity"> <i class="fas fa-pencil-alt"></i> Comment </label>
                        <textarea name="comment" id="comment" cols="30" rows="7" name="comment"></textarea>
                    </div>     
                    <div class="form-group">
                        <button type="submit" id="submit" class="submit" name="submit"> SUBMIT </button>
                    </div>
                    </form>                     
                </div>

            </div>
            </div>
        </div>
</body>
</html>