mysqli_query($conn, "START TRANSACTION");

$a1 = mysqli_query($conn , "INSERT INTO chelsea (name) VALUES('1')");
$a2 = mysqli_query($conn , "INSERT INTO madrid (name) VALUES('2')");

if ($a1 and $a2) {
    mysqli_query($conn, "COMMIT");
    echo "na true";
} else {        
    mysqli_query($conn , "ROLLBACK");
    echo "na lie";
}
