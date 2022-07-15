<?php
function get_content() {
require_once '../controllers/connection.php';
$user_id = $_SESSION['user_info']['id'];
$query = "SELECT *, users.id as user_id FROM users JOIN chat ON (chat.receiver = users.id AND chat.sender = '$user_id') OR (chat.receiver = '$user_id' AND chat.sender = users.id) group by user_id;";
$result = mysqli_query($cn, $query);
$chats = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<style>
    <?php require_once '../assets/message.css'?>
</style>
<div class="main d-flex flex-column justify-content-center">
    <div class="container-fluid mx-auto">
        <div class="row justify-content-center">
            <?php foreach($chats as $i => $chat):?>
            <div class="col-md-2">
                <div class="justify-content-center d-flex text-center">
                    <div class="person">
                        <a href="./chat.php?id=<?php echo $chat['user_id']?>"><img src=<?php echo $chat['image']?> style="height: 200px; width: 200px" class="rounded-circle border-1 border-info border chat-<?php echo $i?>" ></a>
                        <div class="d-flex justify-content-center">
                            <form class="form">
                                <input type="hidden" name="receiver" class="receiver" value="<?php echo $chat['receiver']?>">
                                <input type="hidden" name="sender" class="sender" value="<?php echo $chat['sender']?>">
                                <input type="hidden" id="index" value="<?php echo $i?>">
                            </form>
                            <h6 class="text-info mt-3"><?php echo $chat['firstname'] . " " .  $chat['lastname']?></h6>
                            <p class="badge badge-chat-<?php echo $i?> text-bg-info rounded-circle my-auto ms-2"></p>
                        </div>
                       
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // let badges = document.querySelectorAll('.badge');
        // for(let i = 0; i < badges.length; i++) {
        //     $.ajax({
        //         method: "post",
        //         url: '/controllers/users/chat_seen2.php',
        //         data: $('.form').serialize(),
        //         success: function(response) {
        //            badges[i].innerText = response;
        //         }
        //     })
        // }
        
        // setInterval(() => {
        //     $index = $('.index').val();
        //     $.ajax({
        //         method: "post",
        //         url: '/controllers/users/chat_seen2.php',
        //         data: {
        //             receiver: $('.receiver').val(),
        //             sender: $('.sender').val()

        //         },
        //         success: function(response) {
        //            $('.badge-chat-${index}').text(response);
        //         }
        //     })
        // }, 500);
    })
</script>
<?php
}
require_once 'layout.php';
?>