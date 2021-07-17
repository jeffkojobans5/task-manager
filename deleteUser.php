<?php require_once('include/sessions.php') ?>
<?php require_once('include/db.php') ?>
<?php
$delete_id = $_GET['id'];

$delete_query = "DELETE FROM users where id = '$delete_id' " ;

$executive_delete_query = mysqli_query($conn , $delete_query);

if($executive_delete_query){
    $_SESSION['SuccessMessage'] = "Username deleted successfully";
    header('location:addUser.php');
    exit;
} else {
    $_SESSION['ErrorMessage'] = "There is a problem";
    header('location:addUser.php');
    exit;
}   

?>