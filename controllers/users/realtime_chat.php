<?php

require_once '../connection.php';


$sender = $_POST['sender'];
$receiver = $_POST['receiver'];
$senderImg = $_POST['senderImg'];
$receiverImg= $_POST['receiverImg'];

$output = "";

$query = "SELECT sender, receiver, message, cast(date as time) as time, cast(date as date) as date FROM chat 
        WHERE (sender = $sender AND receiver = $receiver)
        OR (sender = $receiver AND receiver = $sender);";
$result = mysqli_query($cn, $query);
$messages = mysqli_fetch_all($result, MYSQLI_ASSOC);



foreach($messages as $msg){
    if($msg['sender'] != $sender){
        $time = strtotime($msg['time']);
        $date = strtotime($msg['date']);
        $output .= "<div class='d-flex my-2'>
             <img src=" . $senderImg ."
             class='rounded-circle' style='height: 50px; width: 50px'>
             <div class='receiver-msg rounded-4 px-4 py-2 mx-2 d-flex flex-column justify-content-center'>
                 <p class='m-0 mb-1'>" . $msg['message'] . "</p>
                 <small class='text-end'>" . date('H:i', $time) . "</small>
             </div>
             </div>";
    } elseif ($msg['sender'] == $sender){
        $time = strtotime($msg['time']);
         $output .= "<div class='d-flex my-2 justify-content-end'>
         <div class='sender-msg rounded-4 px-4 py-2 mx-2 d-flex flex-column justify-content-center'>
             <p class='m-0 text-end mb-1'>" . $msg['message'] . "</p>
             <small class='text-end'>" . date('H:i', $time) . "</small>
         </div>
         <img src=" . $receiverImg ."
         class='rounded-circle' style='height: 50px; width: 50px'>
         </div>";
    }
}

echo $output;
?>