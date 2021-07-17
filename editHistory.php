<?php require_once('include/sessions.php') ?>
<?php require_once('include/db.php') ?>
<?php require_once('include/date.php') ?>
<?php require_once('include/logout.php') ?>
<?php require_once('include/auth.php') ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin'S Dashboard</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sass/css/bootstrap.css">
    <link rel="stylesheet" href="sass/css/navbar.css">
    <link rel="stylesheet" href="sass/css/editHistory.css">
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
            <ul id="row" style="margin-top: 6rem" >
                    <?php require_once('include/navigation.php') ?>
                  </ul>
            </div>


            <div class="col-md-9 right">
                <div class="container">
                <h2><i class="fa fa-eye" aria-hidden="true"></i> Edit History</h2>
                
                <div class="row main">
                                               
                </div>


                <div class="message"><?php echo SuccessMessage(); ?></div>
                
                <?php $get_id = $_GET['id']; ?>
                
                <div class="add-table">
                    <div class="sign">
                       <button type="submit" class="btn btn-1 btn-lg"><i class="fa fa-eye" aria-hidden="true"></i> <a href="viewAct.php?id=<?php echo $get_id ?>">BACK</a></button>
                    </div>
                </div>

                <?php
                    $get_id = $_GET['id'];
                    $view_query = "SELECT * FROM edit_history WHERE activity_history_link = '$get_id' ORDER BY date desc";
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
            <div class="main-content" style="overflow-wrap:break-word ; margin-bottom: 5rem">

                <div class="message"><?php echo ErrorMessage(); ?></div>

                    <!-- <h3><i class="fa fa-eye" aria-hidden="true"></i> View Activity</h3> -->
                    <h1>#<?php echo $SrNo ?></h1>
                    <p><i class="fa fa-user-edit" aria-hidden="true"></i> <span class="color"> Edited By : </span> <?php echo $name ?></p>
                    <p> <i class="fa fa-calendar-alt" aria-hidden="true"></i> <span class="color"> Date : </span> <?php echo date('d-F-y', strtotime($date)) ; ?> </p>
                    <p> <i class="fa fa-clock" aria-hidden="true"></i> <span class="color"> Time : </span>  
                                 <?php echo date('h:i', strtotime($date)); ?> <?php echo $time ?>
                    <br/><br/></p> 
                    <p> <i class="fa fa-book" aria-hidden="true"></i> <span class="color"> Activity : </span>  <?php echo $activity ?></p> 
                    <p> <i class="fa fa-monitor-heart-rate" aria-hidden="true"></i> <span class="color"> Status : </span> <i class="<?php echo $status ?>"></i> </p> <br/>
                    
                    <p> <i class="fa fa-pen" aria-hidden="true"></i> <span class="color"> Comment : </span> 
                    <p class="comment"> <?php echo $comment ?> </p>
                </div>
                <?php } ?>                    
            </div>
                </div>

</body>
</html>