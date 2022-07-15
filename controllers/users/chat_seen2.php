<?php
require_once '../connection.php';
session_start();

$receiver = $_POST['receiver'];
$sender = $_POST['sender'];


$query = "SELECT count(*) 
        FROM chat 
        where (receiver = $sender AND sender = $receiver AND seen2 = '0');";
$chat = mysqli_fetch_assoc(mysqli_query($cn, $query));
$output;

foreach($chat as $count) {
    $output = $count;
}

echo $output;