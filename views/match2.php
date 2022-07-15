<?php
function get_content() {
  require_once '../controllers/connection.php';
    $query = "SELECT * FROM users WHERE id = {$_SESSION['user_info']['id']};";
    $user = mysqli_fetch_assoc(mysqli_query($cn, $query));
    $user_gender = $user['gender'];
    $preferred_gender = $user['preferred_gender'];
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Match</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        <?php require_once '../assets/match2.css'?>
    </style>
  </head>
  <body>
    <div class="main d-flex flex-column justify-content-center">
      <div class="container-fluid mx-auto">
          <div class="row d-flex justify-content-center selection">
            <div class="d-sm-flex justify-content-center selection-container">
              <div class="col-sm-3 d-flex justify-content-center">
              <div id="carouselExampleControls" class="carousel slide carousel-fade" data-aos="fade-up" data-aos-duration="2000">
                  <div class="carousel-inner">
                    <div class="carousel-item active">
                      <h4>Click <span class="text-danger"><i class="fa-solid fa-heart"></i></span> to like someone and arrow on the right for the next person.<br></h4>
                    </div>
                <?php if($preferred_gender == '1'):
                  $query = "SELECT * FROM users WHERE gender = '1' AND username != '{$_SESSION['user_info']['username']}' AND (preferred_gender = '$user_gender' OR preferred_gender = 'Both') AND id not in(SELECT like_user FROM likes where user_id = {$user['id']});";
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
                        <div class="carousel-item" data-index = >
                          <div class="card bg-dark rounded-5">
                            <img src="<?php echo $selection['image']?>" class="card-img-top rounded-5 img-fluid">
                            <div class="card-body">
                              <h4 class="card-title text-info"><?php echo $selection['firstname'] . " " . $selection['lastname']?></h4>
                              <div class="d-flex">
                                <p><?php echo $gender['gender'] ."&nbsp&nbsp&nbsp"?></p>
                                <p><?php echo $birthday . " " . "year-old"?></p>
                              </div>
                              <p class="card-tex text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit ex facilis voluptatum dolor vero!</p>
                              <div class="text-end">
                                <form action="../controllers/users/likes.php" method="POST">
                                  <input type="hidden" class="user_id" name="user_id" value="<?php echo $user['id']?>">
                                  <input type="hidden" name="like_user" value="<?php echo $selection['id']?>">
                                  <input type="hidden" class="p_gender" name="p_gender" value="<?php echo $preferred_gender?>">
                                  <button type="submit" class="btn likeBtn text-danger"><i class="fa-solid fa-heart fa-2xl"></i></button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                <?php 
                endforeach;
                elseif($preferred_gender == '2'):
                  $query = "SELECT * FROM users WHERE gender = '2' AND username != '{$_SESSION['user_info']['username']}' AND (preferred_gender = '$user_gender' OR preferred_gender = 'Both') AND id not in(SELECT like_user FROM likes where user_id = {$user['id']});";
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
                        <div class="carousel-item" data-index = >
                          <div class="card bg-dark rounded-5">
                            <img src="<?php echo $selection['image']?>" class="card-img-top rounded-5 img-fluid">
                            <div class="card-body">
                              <h4 class="card-title text-info"><?php echo $selection['firstname'] . " " . $selection['lastname']?></h4>
                              <div class="d-flex">
                                <p><?php echo $gender['gender'] ."&nbsp&nbsp&nbsp"?></p>
                                <p><?php echo $birthday . " " . "year-old"?></p>
                              </div>
                              <p class="card-tex text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit ex facilis voluptatum dolor vero!</p>
                              <div class="text-end">
                                <form action="../controllers/users/likes.php" method="POST">
                                  <input type="hidden" class="user_id" name="user_id" value="<?php echo $user['id']?>">
                                  <input type="hidden" name="like_user" value="<?php echo $selection['id']?>">
                                  <input type="hidden" class="p_gender" name="p_gender" value="<?php echo $preferred_gender?>">
                                  <button type="submit" class="btn likeBtn text-danger"><i class="fa-solid fa-heart fa-2xl"></i></button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                <?php 
                endforeach;
                else:
                  $query = "SELECT * FROM users WHERE username != '{$_SESSION['user_info']['username']}' AND (preferred_gender = '$user_gender' OR preferred_gender = 'Both') AND id not in(SELECT like_user FROM likes where user_id = {$user['id']});";
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
                        <div class="carousel-item" data-index = >
                          <div class="card bg-dark rounded-5">
                            <img src="<?php echo $selection['image']?>" class="card-img-top rounded-5 img-fluid">
                            <div class="card-body">
                              <h4 class="card-title text-info"><?php echo $selection['firstname'] . " " . $selection['lastname']?></h4>
                              <div class="d-flex">
                                <p><?php echo $gender['gender'] ."&nbsp&nbsp&nbsp"?></p>
                                <p><?php echo $birthday . " " . "year-old"?></p>
                              </div>
                              <p class="card-tex text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit ex facilis voluptatum dolor vero!</p>
                              <div class="text-end">
                                <form action="../controllers/users/likes.php" method="POST">
                                  <input type="hidden" class="user_id" name="user_id" value="<?php echo $user['id']?>">
                                  <input type="hidden" name="like_user" value="<?php echo $selection['id']?>">
                                  <input type="hidden" class="p_gender" name="p_gender" value="<?php echo $preferred_gender?>">
                                  <button type="submit" class="btn likeBtn text-danger"><i class="fa-solid fa-heart fa-2xl"></i></button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                <?php 
                endforeach;
                endif; ?>
                    
                  </div>
                    <button class="carousel-control-prev d-none" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next d-none" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                  </div>
                  <div class="again text-center">
                    <h3>Seems like you've reached the end.</h3>
                    <button class="btn bg-* btn-large text-info fs-3 border-0 againBtn">Try again?</button>
                  </div>
                    </div>
                    <div class="nextBtn d-flex flex-column justify-content-center ms-sm-5">
                      <button class="btn bg-* border-0">
                        <h1><i class="fa-solid fa-angle-right"></i></h1>
                      </button>
                    </div>
                </div>
          </div>
        </div>
    </div>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
      AOS.init();
      $(document).ready(function(e) {
        const toastTrigger = document.getElementById('liveToastBtn')
        const toastLiveExample = document.getElementById('liveToast')
        if (toastTrigger) {
          toastTrigger.addEventListener('click', () => {
            alert("hey")
            const toast = new bootstrap.Toast(toastLiveExample)
            toast.show()
          })
        }

        $('.again').hide();
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

        $('.nextBtn').click(function (e) {
          
          $('.carousel-control-next').click();
          $current = $('.carousel-item.active').index();
          $length = $('.carousel-item').length;
          
          if($current == $length-1) {
            $('.carousel').toggleClass('d-none');
            $('.nextBtn').toggleClass('d-none');
            $('.again').fadeIn('slow');
          }
        })

        $('.againBtn').click(function() {
          location.reload();
        })
      })

      
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>

<?php
}
require_once 'layout.php';

?>