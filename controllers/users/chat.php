<?php
require_once '../connection.php';
$sender = $_POST['sender'];
$receiver = $_POST['receiver'];
$message = $cn -> real_escape_string($_POST['message']);
echo $sender;
echo $receiver;
echo $message;


$query = "INSERT INTO chat(sender, receiver, message) VALUES($sender, $receiver, '$message')";                     
mysqli_query($cn, $query);
mysqli_close($cn);
//header('Location: ../../views/chat.php');
?>