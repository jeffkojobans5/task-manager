<?php 
    function login () {
        if(isset($_SESSION['id'])){
            return true;
        }
    }

    function login_confirm () {
        if(!login()){
            header('location:login.php');
            exit;
        }
    }

    login_confirm();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin'S Dashboard</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/delAct.scss">
</head>
<body>
    <div class="container-fluid">   
        <div class="row">
            <div class="col-md-3 sidebar column">
                <a href="index.php"> ACTIVITIES</a>
                <a href="addAct.php"> ADD</a>
                <a href="searchAct.php"> SEARCH</a>
                <a href=""> ADD USER</a>
            </div>
            <div class="container column">
            <div class="col-md-9 main ">
                <div class="changes flex">
                    <button type="submit"><a href="viewAct.php">BACK</a></button>
                    <!-- <button type="submit">DELETE</button> -->
                </div>
                <div class="activity ">
                    <p>Last Edited By : Bansah</p>
                    <p>Date : 24th April, 2021</p>
                    <p>Time : 9:45am <br/><br/><br/></p> 
                    
                    <div class="form-group">
                    <label for="activity"> Activity </label>
                    <input type="text" class="form-control" id="activity">
                        </div>    
                        <div class="form-group">
                            <label for="activity"> Comment </label>
                            <textarea name="comment" id="comment" cols="30" rows="5"></textarea>
                        </div>     
                        <div class="form-group">
                            <button type="submit" id="submit" class="submit"> SUBMIT </button>
                        </div>                    
                </div>
                </div>    
            </div>
        </div>
    </div>
</body>
</html>