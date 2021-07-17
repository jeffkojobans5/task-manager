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
    <link rel="stylesheet" href="sass/css/add-act.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body>
    <div class="containers">
        <div class="row">
            <div class="col-md-3 left">
                <!-- <h1 > Dashboard </h1> -->
                <ul id="row" style="margin-top: 6rem">
                    <?php require_once('include/navigation.php') ?>
                  </ul>
            </div>


            <div class="col-md-9 right">
                <div class="container">
                <h2><i class="fa fa-book" aria-hidden="true"></i> Activities</h2>
                <div class="row main">
                        <div class="box" style="background-color:">
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



                <div class="message"><?php echo SuccessMessage(); ?></div>
                
                
                <div class="add-table">
                    <p> <i class="fas fa-check-circle"></i> Completed &nbsp;&nbsp;&nbsp;
                        <i class="fas fa-hourglass-half"></i> Pending
                    </p>
                    <!-- <h3>Activities</h3> -->
                    <table class="table table-bordered ">
                        <thead>
                          <tr>
                            <th>No.</th>
                            <th>Date</th>
                            <th>Creator</th>
                            <th>Activity</th>
                            <th>Status</th>
                            <th>View</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                    $view_query = "SELECT * FROM activity ORDER BY date desc";
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
                    <tbody>
                        <tr>
                            <td><?php echo $SrNo ?></td>
                            <td><?php echo date('d-F-y ---- h:i ', strtotime($date)); ?> <?php echo $time ?></td>
                            <td><?php echo $name ?></td>
                            <td><?php 
                                if (strlen($activity) > 11) {
                                    $activity = substr($activity , 0,20);
                                    $activity .= '...';
                                } 

                                echo $activity;
                            ?></td>
                            <td> <i class="<?php echo $status ?> "></i> </td>
                            <td><a href="viewAct.php?id=<?php echo $id ?>" class="btn bg-primary text-light"> VIEW </a></td>
                        </tr>
                    </tbody>
                    <?php } ?>
                    </table>

                   
                </div>


</body>
</html>