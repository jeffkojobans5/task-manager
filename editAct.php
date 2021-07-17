<?php require_once('include/sessions.php') ?>
<?php require_once('include/db.php') ?>
<?php require_once('include/date.php') ?>
<?php require_once('include/logout.php') ?>
<?php require_once('include/auth.php') ?>
<?php
if(isset($_POST['submit'])){

    $activity = $_POST['activity'];  //grabing activity input
    $comment = $_POST['comment'];    //grabing comment input
    $status = $_POST['status'];  //grabing status option
    
    //checking for validations
    if(empty($_POST['activity'])){
        $_SESSION['ErrorMessage'] = "Activity filled cannot be empty";      //error throws in addAct.php page
    } else {
        // if no error insert into database and redirect to index.php 
        $get_id = $_GET['id'];
        mysqli_query($conn, "START TRANSACTION");
        $update_query = mysqli_query ($conn, "UPDATE activity SET activity='$activity' , status = '$status' , comment = '$comment' WHERE id= '$get_id' ") or die(mysqli_error($conn)) ; 
        $insert_query = mysqli_query($conn , "INSERT INTO edit_history ( date , time , name , activity , comment , status , activity_history_link  )
        VALUES ('$Date' , '$Time' , '$user' , '$activity' , '$comment' , '$status' , '$get_id')") or die(mysqli_error($conn));
        if ($update_query and $insert_query) {
            mysqli_query($conn, "COMMIT") ;
            $_SESSION['SuccessMessage'] = "Activity updated successfully";
            header("location:viewAct.php?id={$get_id}");
            exit;
        } else {        
            mysqli_query($conn , "ROLLBACK") or die(mysqli_error($conn));
            $_SESSION['ErrorMessgae'] = "Couldn't Update. Please try again";
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
    <link rel="stylesheet" href="sass/css/bootstrap.css">
    <link rel="stylesheet" href="sass/css/navbar.css">
    <link rel="stylesheet" href="sass/css/editAct.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <style>
        .fa-hourglass-half {
            color: orange !important;
            font-size: 1.5rem;
        }
        .fa-check-circle {
            color: green !important;
            font-size: 1.5rem;
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
                <h2><i class="fa fa-eye" aria-hidden="true"></i> Edit Activity</h2>
                <div class="row main">
                </div>
                <?php $get_id = $_GET['id']; ?>
                <div class="add-table">
                    <div class="sign">
                        <button type="submit" class="btn btn-1 btn-lg"><i class="fa fa-caret-left" aria-hidden="true"></i> <a href="viewAct.php?id=<?php echo $get_id ?>">BACK</a></button>
                    </div>
                </div>
                <div class="message"><?php echo ErrorMessage(); ?></div>
                <div class="main-content">
                    <?php
                    $get_id = $_GET['id'];
                    $view_query = "SELECT * FROM activity WHERE id = '$get_id' ORDER BY date desc";
                    $execute_view_query = mysqli_query($conn , $view_query) or die( mysqli_error($conn));;
                    $SrNo = 0;
                    while($data = mysqli_fetch_array($execute_view_query , MYSQLI_ASSOC)){
                        $id = $data['id'];
                        $date = $data['date'];
                        $time = $data['time'];
                        $name = $data['name'];
                        $activity = $data['activity'];
                        $comment = $data['comment'];
                        $status = $data['status'];
                        $SrNo++;
                        ?>     
                    <p><i class="fa fa-user" aria-hidden="true"></i> <span class="color"> Created By : </span> <?php echo $name ?></p>
                    <p> <i class="fas fa-calendar-alt"></i> <span class="color"> Date : </span> 
                    <?php echo date('d-F-y', strtotime($date)) ; ?> </p>
                    <p> <i class="fa fa-clock" aria-hidden="true"></i> <span class="color"> Time : </span>  
                    <?php echo date('h:i', strtotime($date)); ?> <?php echo $time ?>
                     <br/><br/></p> 
                    <p> <i class="fa fa-monitor-heart-rate" aria-hidden="true"></i> <span class="color"> Status : </span> <i class="<?php echo $status ?>"></i> </p> <br/>
                    <form action="editAct.php?id=<?php echo $get_id ?>" method="post" onsubmit="return true">
                        <div class="form-group">
                        <label for="activity"> <i class="fas fa-book"></i> Activity </label>
                        <input type="text" class="form-control" name="activity" id="activity" value="<?php echo $activity ?>">
                        </div>    
                        <div class="form-group">
                            <label for="activity"> <i class="fa fa-monitor-heart-rate"></i> Status </label><br/>
                            <select name="status" id="" value="">
                            <option value="fa fa-hourglass-half">Pending</option>
                            <option value="fa fa-check-circle"> Completed </option>
                            </select>
                        </div> 
                        <div class="form-group">
                            <label for="activity"> <i class="fas fa-pen"></i> Comment </label>
                            <textarea name="comment" id="comment" cols="30" rows="8"><?php echo $comment ?></textarea>
                        </div>  
                        <div class="form-group">
                            <button type="submit" id="submit" class="submit btn-lg" name="submit"> SUBMIT </button>
                        </div> 
                    </form>         
                <?php } ?>                    
                </div>

</body>
</html>