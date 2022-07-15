<?php
require_once '../connection.php';
$id = $_POST['id'];

$query = "UPDATE chat SET seen = '1' WHERE receiver = '$id';";
mysqli_query($cn, $query);
mysqli_close($cn);