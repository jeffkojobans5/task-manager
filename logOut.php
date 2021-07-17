<?php require_once('include/sessions.php') ?>
<?php require_once('include/db.php') ?>
<?php require_once('include/date.php') ?>
<?php require_once('include/logout.php') ?>
<?php
$_SESSION['id'] = null;
session_destroy();
header('location:login.php');
exit;
?>