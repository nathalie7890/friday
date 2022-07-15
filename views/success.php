<?php
session_start();
require_once 'partials/nav2.php';
require_once '../controllers/connection.php';

$user_id = $_SESSION['user_info']['id'];

$query = "SELECT * FROM users 
        JOIN matches 
        ON (matches.user_id = '$user_id' AND matches.match_user = users.id);";
$result = mysqli_query($cn, $query);
$matches = mysqli_fetch_all($result, MYSQLI_ASSOC);


?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <style>
        <?php require_once '../assets/success.css'?>
    </style>
  </head>
  <body>
    <div class="main d-flex flex-column justify-content-center">
        <div class="container-fuid mx-auto w-75 gap-3 my-5 text-center">
            <?php if(!$matches): ?>
                <h1>You don't have any matches yet 😟</h1>
            <?php else: ?>
            <h1 class="mb-5 text-info">You've got matches!</h1>
            <div class="row justify-content-center">
                <?php foreach($matches as $match):
                $birthDate = $match['birthday'];
                $birthDate = new DateTime($birthDate);
                $now = new DateTime();
                $interval = $now->diff($birthDate);
                $birthday = $interval->y;
                ?>
                <div class="col-md-3">
                    <div class="card bg-dark"  data-aos="zoom-in" data-aos-duration="1500">
                        <img src=<?php echo $match['image'];?> class="card-img-top" style="height:300px">
                        <div class="card-body">
                            <h5 class="card-title text-info text-start"><?php echo $match['firstname'] . " " . $match['lastname']?></h5>
                            <div class="d-flex justify-content-start gap-2">
                                <p class="card-text text-white">
                                    <?php
                                        $query = "SELECT gender FROM genders WHERE id = {$match['gender']}";
                                        $gender = mysqli_fetch_assoc(mysqli_query($cn, $query));
                                        echo $gender['gender'];
                                    ?>
                                <p>
                                <p class="card-text text-white">
                                    <?php echo $birthday . " " . "year-old"?>
                                </p>

                            </div>
                            <div class="text-end">
                                <form method="POST" action="../controllers/users/accept.php">
                                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_info']['id']?>">
                                    <input type="hidden" name="match_user" value="<?php echo $match['match_user']?>">
                                    <!-- <button class="btn btn-outline-info btn-sm px-3 rounded-pill submitBtn">Accept</button> -->
                                </form>
                                <?php if($user_id == $match['user_id']):?>
                                    <a href="./chat.php?id=<?php echo $match['match_user']?>" class="btn btn-outline-info msg-btn btn-sm px-3 rounded-pill">Message</a>
                                <?php elseif($user_id == $match['match_user']): ?>
                                    <a href="./chat.php?id=<?php echo $match['user_id']?>" class="btn btn-outline-info msg-btn btn-sm px-3 rounded-pill">Message</a>
                                <?php endif; ?>
                                
                              
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <script>

            $(document).ready(function(e) {
                $('.submitBtn').click(function (e) {
                    e.preventDefault();
                   
                    $.ajax({
                        method: "post",
                        url: '../controllers/users/accept.php',
                        data: $(this).closest('form').serialize(),
                        success: function(response) {
                            console.log(response);
                            
                        }
                    })
                    $(this).removeClass('btn-outline-info').addClass('btn-info');
                    $(this).text('Accepted');
                    $(this).prop('disabled', true);
                    $('.msg-btn').removeClass('d-none');
                })
            })

        </script>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    
  </body>
</html>