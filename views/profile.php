<?php

    session_start();
    require_once 'partials/nav2.php';
    
    require_once '../controllers/connection.php';
    $username = $_SESSION['user_info']['username'];
    $query = "SELECT * FROM users WHERE username = '$username';";
    $user = mysqli_fetch_assoc(mysqli_query($cn, $query));

    $query = "SELECT gender FROM genders WHERE id = {$user['gender']};";
    $gender = mysqli_fetch_assoc(mysqli_query($cn, $query));

    $birthDate = $user['birthday'];
    $birthDate = new DateTime($birthDate);
    $now = new DateTime();
    $interval = $now->diff($birthDate);
    $birthday = $interval->y;

    $query = "SELECT occupation FROM occupations WHERE id = {$user['occupation']};";
    $occupation = mysqli_fetch_assoc(mysqli_query($cn, $query));

    $query = "SELECT interests.title FROM interests INNER JOIN user_interests ON user_interests.user_id ={$user['id']} AND user_interests.interest = interests.id; ";
    $result = mysqli_query($cn, $query);
    $interests = mysqli_fetch_all($result, MYSQLI_ASSOC);


    $query = "SELECT * from occupations";
    $result = mysqli_query($cn, $query);
    $occupations = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $query = "SELECT * FROM genders";
    $result = mysqli_query($cn, $query);
    $genders = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <!-- font-awesome -->
    <script src="https://kit.fontawesome.com/1546ce94aa.js" crossorigin="anonymous"></script>
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <style>
        <?php require_once '../assets/profile.css'?>
        .filler {
            height: 10%;
        }
    </style>
  </head>
  <body>
      <!-- <div class="container profile d-flex flex-column justify-content-center">
          <div class="row d-flex justify-content-center">
          <div class="card mb-3 text-bg-dark rounded-4">
            <div class="row g-0">
                <div class="col-md-6 py-3">
                <img src="<?php echo $user['image']?>" class="img-fluid rounded-4" style="height: 450px">
                </div>
                <div class="col-md-6">
                <div class="card-body">
                    <h1 class="card-title text-info"><?php echo $user['firstname'] . " " . $user['lastname'] ?></h1>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
                </div>
            </div>
            </div>
          </div>
      </div> -->
    <div class="container main mx-auto my-5 p-4 d-flex flex-column justify-content-center">
        <div class="row">
            <div class="col-lg-6 d-flex justify-content-center">
                <img src=<?php echo $user['image']?> style="height: 500px" class="img-fluid profile-img">
            </div>
            <div class="col-lg-6 pe-5 d-flex flex-column justify-content-between">
                <div>
                    <h1 class="text-info">
                            <?php echo $user['firstname'] . " " . $user['lastname']?>
                    </h1>
                 
                </div>
                <div class="d-flex gap-4 justify-content-start">
                    <div>
                        <h6 class="fw-bolder">Gender:</h6>
                        <p class="text-info"><?php echo $gender['gender']?></p>
                    </div>
                    <div>
                        <h6 class="fw-bolder">Age:</h6>
                        <p class="text-info"><?php echo $birthday . " year-old"?></p>
                    </div>
                </div>
                
                <div class="d-flex gap-4 justify-content-start" style="width: 100%">
                    <div>
                        <h6 class="fw-bolder">Username:</h6>
                        <p  class="text-info"><?php echo $user['username']?></p>
                    </div>
                    <div>
                        <h6 class="fw-bolder">Email:</h6>
                        <p  class="text-info"><?php echo $user['email']?></p>
                    </div>
                </div>
                <div class="d-flex gap-4" style="width: 100%">
                    <div>
                        <h6 class="fw-bolder" style="width: 50%">Occupation:</h6>
                        <p  class="text-info"><?php echo $occupation['occupation']?></p>
                    </div>
                </div>
                <!-- <div>
                    <h6 class="fw-bolder">Interests: </h6>
                    <div class="d-flex flex-wrap gap-2">
                    <?php
                    foreach($interests as $interest):
                    ?>
                    <button class="rounded-pill btn text-white btn-sm gap-2 px-3 disabled border-info"><?php echo $interest['title']?></button>
                    <?php endforeach; ?>
                    </div>
                    
                </div> -->
                <?php if(isset($_SESSION)): ?>
                <div class="text-end">
                <button class="btn text-info btn-sm rounded-pill edit-btn fw-bolder px-3">Edit Profile</button>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="container edit-profile mx-auto my-5 p-4 d-none">
        <div class="row">
            <div class="col-lg-6 d-flex justify-content-center position-relative">
                <img src=<?php echo $user['image']?> style="height: 500px" class="img-fluid profileImg">
                <div class="position-absolute">
                    <button class="btn btn-lg text-info fs-3 fw-normal profile-image"><i class="fa-solid fa-pen-to-square"></i></button>
                </div>
            </div>
            <div class="col-lg-6 pt-4 pe-5 d-flex flex-column justify-content-between">
                <form action="../controllers/users/edit.php" method="POST" enctype="multipart/form-data">
                    <div class="d-flex justify-content-between gap-2 mb-3">
                        <div>
                            <label for="fname" class="form-label">Firstname</label>
                            <input type="file" name="image" id="profile-img-input" style="display:none">
                            <input type="hidden" name="user_id" value="<?php echo $user['id']?>">
                            <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $user['firstname']?>">
                        </div>
                        <div>
                            <label for="lname" class="form-label">Lastname</label>
                            <input type="text" class="form-control" id="lname" name="lname" value="<?php echo $user['lastname']?>">
                        </div>
                    </div>
                    <div class="d-flex justify-content-center gap-2 mb-3">
                        <div>
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['username']?>">
                        </div>
                        <div>
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                    </div>
                    <div class="d-flex justify-content-center gap-2 mb-3">
                        <div class="w-100">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']?>">
                        </div>
                    </div>
                    <div class="d-flex justify-content-center gap-2 mb-3">
                        <div class="w-100">
                            <label for="birthday" class="form-label">Birthday</label>
                            <input type="date" class="form-control" id="birthday" name="birthday" value="<?php echo $user['birthday']?>">
                        </div>
                    </div>
                    <div class="d-flex justify-content-center gap-2 mb-3">
                        <div class="w-100">
                            <label for='occupation'>Occupation</label>
                            <select class="form-select" name="occupation" id='occupation'>
                                <option value="<?php echo $user['occupation']?>"><?php echo $occupation['occupation']?></option>
                                <?php foreach($occupations as $occupation): ?>
                                <option value="<?php echo $occupation['id']; ?>"><?php echo $occupation['occupation'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            
                        </div>
                    </div>
                    <div class="text-end">
                        <button class="btn text-info btn-sm rounded-pill submit-btn fw-bolder px-3" type="submit">Save</button>
                        <button class="btn text-info btn-sm rounded-pill profile-btn fw-bolder px-3" type="button">My Profile</button>
                    </div>
                </form>
            </div>
        </div>
        <script>

            $('.edit-btn').click(function() {
                $('.main').toggleClass('d-none');
                $('.edit-profile').toggleClass('d-none');
            })

            $('.profile-btn').click(function() {
                $('.main').toggleClass('d-none');
                $('.edit-profile').toggleClass('d-none');
            })


            let uploadBtn = document.querySelector('.profile-image');
            uploadBtn.addEventListener('click', e => {
                document.querySelector('#profile-img-input').click();
            })

            let profileImg = document.querySelector('#profile-img-input');
            profileImg.addEventListener('change', e => {
                let filePath = profileImg.value;
                let extensions = /(\.jpg|\.jpeg|\.png)$/i;

                if(!extensions.exec(filePath)) {
                    profileImg.classList.add('is-invalid');
                } else {
                    profileImg.classList.remove('is-invalid');
                    const reader = new FileReader();
                    reader.addEventListener('load', (event) => {
                        const img = new Image();
                        img.src = event.target.result;
                        document.querySelector('.profileImg').src = img.src;
                    });
                    reader.readAsDataURL(profileImg.files[0]);
                }
            }, false);
        </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>



<?php

?>