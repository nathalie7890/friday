<?php
require_once '../connection.php';
$id = $_POST['id'];

$query = "UPDATE matches SET status = '1' WHERE user_id = '$id';";
mysqli_query($cn, $query);
mysqli_close($cn);