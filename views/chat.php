<?php
function get_content() {
require_once '../controllers/connection.php';
$id = $_GET['id'];

$query = "SELECT * FROM users where id = '$id';";
$user = mysqli_fetch_assoc(mysqli_query($cn, $query));

$query = "SELECT * FROM users WHERE id = {$_SESSION['user_info']['id']}";
$sender = mysqli_fetch_assoc(mysqli_query($cn, $query));

$sender_name = $_SESSION['user_info']['username'];

$query = "SELECT sender, receiver, message, cast(date as time) as time, cast(date as date) as date FROM chat 
        where (sender = '{$sender['id']}' AND receiver = {$user['id']})
        OR (sender = '{$user['id']}' AND receiver = {$sender['id']});";
$result = mysqli_query($cn, $query);
$messages = mysqli_fetch_all($result, MYSQLI_ASSOC);



$query = "SELECT * FROM chat where sender = '{$sender['id']}' AND receiver = {$user['id']}";
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <style>
    <?php require_once '../assets/chat.css'?>
    </style>
  </head>
  <body>
      <div class="sidenav">
          
      </div>
    <div class="main d-flex flex-column justify-content-center">
        <div class="container-fluid chat-container mx-auto py-4">
            <!-- chat header -->
            <div class="row chat-header">
                <div class="col">
                    <div class="d-flex flex-column justify-content-center">
                        <h5><?php echo $user['firstname'] . " " . $user['lastname']?></h5>
                    </div>
                </div>
            </div>
            <!-- end  of chat header -->
            <!-- chat body -->
            <div class="row chat p-2">
                <div class="col chat-body">

                    <?php foreach($messages as $msg){
                        if($msg['sender'] != $sender['id']) {
                            $message = $msg['message'];
                            $time = strtotime($msg['time']);
                           echo "<div class='d-flex my-2'>
                                <img src=" . $user['image'] ."
                                class='rounded-circle' style='height: 50px; width: 50px'>
                                <div class='receiver-msg rounded-4 px-4 py-2 mx-2 d-flex flex-column justify-content-center'>
                                    <p class='m-0 mb-1'>" . $msg['message'] . "</p>
                                    <small class='text-end'>" . date('H:i', $time) . "</small>
                                </div>
                                </div>";
                       } elseif ($msg['sender'] == $sender['id']){
                            echo "<div class='d-flex my-2 justify-content-end'>
                            <div class='sender-msg rounded-4 px-4 py-2 mx-2 d-flex flex-column justify-content-center'>
                                <p class='m-0 text-end mb-1'>" . $msg['message'] . "</p>
                                <small class='text-end'>" . date("H:i", $time) . "</small>
                            </div>
                            <img src=" . $sender['image'] ."
                            class='rounded-circle' style='height: 50px; width: 50px'>
                            </div>";
                       }
                    }
                    ?>
                </div>
            </div>
            <!-- end of chat body -->
            <!-- chat message input -->
            <div class="row">
                <div class="col chat-input">
                    <form action="../controllers/users/chat.php" method="POST">
                        <div class="d-flex justify-content-between">

                            <input type="hidden" name="sender" id="sender" value="<?php echo $_SESSION['user_info']['id']?>">
                            <input type="hidden" name="receiver" id="receiver" value="<?php echo $user['id']?>">
                            <input type="hidden" name="sender-img" id="sender-img" value="<?php echo $user['image']?>">
                            <input type="hidden" name="receiver-img" id="receiver-img" value="<?php echo $sender['image']?>">
                            <input type="text" name="message" class="form-control">
                            
                            <button class="btn btn-dark rounded-pill submitBtn">SEND</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- end ofchat message input -->
        </div>
    </div>
    <script>
        
        $(document).ready(function(e) {
            var c = $('.chat');
            c.scrollTop(c.prop("scrollHeight"));

            $('.submitBtn').click(function (e) {
                e.preventDefault();
                
                $.ajax({
                    method: "post",
                    url: '/controllers/users/chat.php',
                    data: $(this).closest('form').serialize(),
                    success: function(response) {
                        console.log(response);
                        
                    }
                })
                $("form")[0].reset();
            
            })

            

            setInterval(() => {
                $.ajax({
                    method: "post",
                    url: '/controllers/users/realtime_chat.php',
                    data: {
                        sender: $('#sender').val(),
                        receiver: $('#receiver').val(),
                        senderImg: $('#sender-img').val(),
                        receiverImg: $('#receiver-img').val(),
                    },
                    success: function(response) {
                        $('.chat-body').html(response);
                        var c = $('.chat');
                    }
                })
            }, 500);

        })
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>

<?php
}
require_once 'layout.php';
?>