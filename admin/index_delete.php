<?php

include "../config.php";
error_reporting(0);

$conn = connectToDatabase();
$id = $_REQUEST['id'];
$sql = "DELETE FROM songs WHERE id = '$id'";
if ($conn->query($sql) === TRUE) {
    $valid = true;
} else {
    $valid = false;
}
$conn->close();

if ($valid === true) {
    echo "<script>alert('Data successfully delete'); location.href = 'index.php';</script>";
} else {
    echo "<script>alert('Failed delete, please try again'); location.href = 'index.php';</script>";
}
