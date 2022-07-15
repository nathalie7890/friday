<?php
function get_content() {
    require_once '../controllers/connection.php';

    $query = "SELECT * FROM users WHERE username = '{$_SESSION['user_info']['username']}';";
    $user = mysqli_fetch_assoc(mysqli_query($cn, $query));
    $user_gender = $user['gender'];
                                      
?>
    <!doctype html>
    <html lang="en">
      <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        

        <title>Match</title>
        <style>
            
            <?php require_once '../assets/select.css'?>

            body {
                height: 100vh;
                overflow: hidden;
            }

            #preloader {
                background: #16191b url('../public/match.gif') no-repeat center center;
                background-size: 5%;
                height: 100%;
                width: 100%;
                position: fixed;
                z-index: 100;
            }

            .likeBtn:hover, .btn {
                border:none;
            }

            .likeBtn:active {
                border: none;
                box-shadow: none;
                outline: none;
            }

            .btn[disabled=disabled], .btn:disabled  {
                color: #dc3545 !important;
            }

            #refresh {
                border: none;
            }
        </style>
      </head>
    <body>
        <div class="selections d-flex flex-column justify-content-center align-items-center ">
            
            <div class="d-flex gap-5 selections-container ">
            <?php if($user['preferred_gender'] == '1'):

                $query = "SELECT * FROM users WHERE gender = '1' AND username != '{$_SESSION['user_info']['username']}' AND (preferred_gender = '$user_gender' OR preferred_gender = 'both') ORDER BY RAND() LIMIT 3;";
                $result = mysqli_query($cn, $query);
                $selections = mysqli_fetch_all($result, MYSQLI_ASSOC);

                foreach($selections as $selection):

                    $query = "SELECT genders.gender FROM genders JOIN users ON users.id = {$selection['id']} AND genders.id = {$selection['gender']}";
                    $gender = mysqli_fetch_assoc(mysqli_query($cn, $query));

                    $birthDate = $selection['birthday'];
                    $birthDate = new DateTime($birthDate);
                    $now = new DateTime();
                    $interval = $now->diff($birthDate);
                    $birthday = $interval->y;
            ?>

                <div class="card" data-aos="zoom-in" data-aos-duration="1500">
                    <img src=<?php echo $selection['image']?> class="card-img-top">
                    <small><?php echo $selection['id']?></small>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $selection['firstname'] . " " . $selection['lastname']?></h5>
                        <div class="card-text d-flex justify-content-start">
                            <p><?php echo $gender['gender'] ."&nbsp" . "&nbsp" . "&nbsp"?></p>
                            <p><?php echo $birthday ?> year-old</p>
                            
                        </div>
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. </p>
                        <div class="text-end">
                            <form id="likeForm">
                                <input type="hidden" name="user_id" value="<?php echo $user['id']?>">
                                <input type="hidden" name="like_user" value="<?php echo $selection['id']?>">

                                <?php
                                    $query = "SELECT user_id FROM likes WHERE user_id = '{$_SESSION['user_info']['id']}' AND like_user = '{$selection['id']}';";
                                    $result = mysqli_fetch_assoc(mysqli_query($cn, $query));
                                    if($result):
                                ?>
                                    <button type="button" class="btn text-danger" disabled><i class="fa-solid fa-heart-circle-check"></i></button>

                                <?php else: ?>
                                    <button type="submit" class="btn likeBtn text-danger"><i class="fa-solid fa-heart"></i></button>
                                <?php endif;?>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; 
                elseif($user['preferred_gender'] == '2'):

                $query = "SELECT * FROM users WHERE gender = '2' AND username != '{$_SESSION['user_info']['username']}' AND (preferred_gender = '$user_gender' OR preferred_gender = 'both') ORDER BY RAND() LIMIT 3;";
                $result = mysqli_query($cn, $query);
                $selections = mysqli_fetch_all($result, MYSQLI_ASSOC);

                foreach($selections as $selection):

                    $query = "SELECT genders.gender FROM genders JOIN users ON users.id = {$selection['id']} AND genders.id = {$selection['gender']}";
                    $gender = mysqli_fetch_assoc(mysqli_query($cn, $query));

                    $birthDate = $selection['birthday'];
                    $birthDate = new DateTime($birthDate);
                    $now = new DateTime();
                    $interval = $now->diff($birthDate);
                    $birthday = $interval->y;
            ?>

                <div class="card" data-aos="zoom-in" data-aos-duration="1500">
                    <img src=<?php echo $selection['image']?> class="card-img-top">
                    <p><?php echo $selection['id']?></p>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $selection['firstname'] . " " . $selection['lastname']?></h5>
                        <div class="card-text d-flex justify-content-start">
                            <p><?php echo $gender['gender'] ."&nbsp" . "&nbsp" . "&nbsp"?></p>
                            <p><?php echo $birthday ?> year-old</p>
                            
                        </div>
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. </p>
                        <div class="text-end">
                            <form method="POST" action="../controllers/users/likes.php" id="likeForm">
                                <input type="hidden" name="user_id" value="<?php echo $user['id']?>">
                                <input type="hidden" name="like_user" value="<?php echo $selection['id']?>">

                                <?php
                                    $query = "SELECT user_id FROM likes WHERE user_id = '{$_SESSION['user_info']['id']}' AND like_user = '{$selection['id']}';";
                                    $result = mysqli_fetch_assoc(mysqli_query($cn, $query));
                                    if($result):
                                ?>
                                    <button type="button" class="btn text-danger" disabled><i class="fa-solid fa-heart-circle-check"></i></button>

                                <?php else: ?>
                                    <button type="submit" class="btn likeBtn text-danger"><i class="fa-solid fa-heart"></i></button>
                                <?php endif;?>
                            </form>
                        </div>
                    </div>
                </div>
            <?php
            endforeach;
            else:
                $query = "SELECT * FROM users WHERE username != '{$_SESSION['user_info']['username']}' AND (preferred_gender = '$user_gender' OR preferred_gender = 'both') ORDER BY RAND() LIMIT 3;";
                $result = mysqli_query($cn, $query);
                $selections = mysqli_fetch_all($result, MYSQLI_ASSOC);

                foreach($selections as $selection):
                    $query = "SELECT genders.gender FROM genders JOIN users ON users.id = {$selection['id']} AND genders.id = {$selection['gender']}";
                    $gender = mysqli_fetch_assoc(mysqli_query($cn, $query));

                    $birthDate = $selection['birthday'];
                    $birthDate = new DateTime($birthDate);
                    $now = new DateTime();
                    $interval = $now->diff($birthDate);
                    $birthday = $interval->y;
            ?>
                <div class="card" data-aos="zoom-in" data-aos-duration="1500">
                    <img src=<?php echo $selection['image']?> class="card-img-top">
                    <p><?php echo $selection['id']?></p>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $selection['firstname'] . " " . $selection['lastname']?></h5>
                        <div class="card-text d-flex justify-content-start">
                            <p><?php echo $gender['gender'] ."&nbsp" . "&nbsp" . "&nbsp"?></p>
                            <p><?php echo $birthday ?> year-old</p>
                            
                        </div>
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. </p>
                        <div class="text-end">
                            <form method="POST" action="../controllers/users/likes.php" id="likeForm">
                                <input type="hidden" name="user_id" value="<?php echo $user['id']?>">
                                <input type="hidden" name="like_user" value="<?php echo $selection['id']?>">

                                <?php
                                    $query = "SELECT user_id FROM likes WHERE user_id = '{$_SESSION['user_info']['id']}' AND like_user = '{$selection['id']}';";
                                    $result = mysqli_fetch_assoc(mysqli_query($cn, $query));
                                    if($result):
                                ?>
                                    <button type="button" class="btn text-danger" disabled><i class="fa-solid fa-heart-circle-check"></i></button>

                                <?php else: ?>
                                    <button type="submit" class="btn likeBtn text-danger"><i class="fa-solid fa-heart"></i></button>
                                <?php endif;?>
                            </form>
                        </div>
                    </div>
                </div>
            <?php
            endforeach;
            endif;
            ?>
            </div>
            <div class="d-flex mt-4 gap-2 buttons">
                <button id="refresh" class="btn rounded-pill px-4"><i class="fa-solid fa-arrow-rotate-right"></i></button>
            </div>
        </div>
    
    
        <script>

            $(document).ready(function(e) {
                $('.likeBtn').click(function (e) {
                    e.preventDefault();
                   
                    $.ajax({
                        method: "post",
                        url: '/controllers/users/likes.php',
                        data: $(this).closest('form').serialize(),
                        success: function(response) {
                            console.log(response);
                            
                        }
                    })
                    $(this).find('i').removeClass('fa-heart').addClass('fa-heart-circle-check');
                    $(this).prop('disabled', true);
                })
            })

            $('#refresh').click(function() {
                location.reload();
                $('.main').addClass('d-none');
            });


            

        </script>
    
    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
       
      </body>
    </html>
<?php
}
require_once 'layout.php';
?>
