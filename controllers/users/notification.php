<?php
require_once '../connection.php';
session_start();

$query = "SELECT * 
        FROM matches 
        where (user_id = {$_SESSION['user_info']['id']} AND status = '0');";
$match = mysqli_fetch_assoc(mysqli_query($cn, $query));
$output;

$query = "SELECT * 
        FROM chat 
        where (receiver = {$_SESSION['user_info']['id']} AND seen = '0');";
$chat = mysqli_fetch_assoc(mysqli_query($cn, $query));
$output;

if($match && $chat){
    $output = 3;
} elseif ($match){
    $output = 1;
} elseif($chat) {
    $output = 2;
}

echo $output;
?>