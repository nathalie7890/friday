<?php
    require_once  '../controllers/connection.php';

    $query = "SELECT * from occupations";
    $result = mysqli_query($cn, $query);
    $occupations = mysqli_fetch_all($result, MYSQLI_ASSOC);
   
    $query = "SELECT * FROM genders";
    $result = mysqli_query($cn, $query);
    $genders = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $query = "SELECT * FROM interests";
    $result = mysqli_query($cn, $query);
    $interests = mysqli_fetch_all($result, MYSQLI_ASSOC);

   
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<style>
    <?php require_once '../assets/register.css'?>
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 register-left">
            <div class="caption d-flex flex-column justify-content-center text-center">
                <h5>Already have an account?</h5>
                <div>
                    <a href="./login.php" class="btn btn-light border-secondary border-3 px-4 rounded-pill">Login</a>
                    <a href="/" class="btn btn-light border-secondary px-4 rounded-pill">Back to home</a>
                </div>
            </div>
        </div>

        <!-- register form -->
        <div class="col-lg-6 register-right">

            <form id="register-form" method="POST" action="/controllers/users/register.php" enctype="multipart/form-data">
            <div class="container register-form w-75 p-5">
                <div class="row">
                    <div class="col-md text-center mb-4">
                        <div class="profile-img">
                            <div class="add-profile-img img-fluid rounded-circle" >
                                <input type="file" name="image" id="profile-img-input" style="display:none">
                                <div class="invalid-feedback">
                                    Please upload an image
                                </div>
                            </div>
                            <img src="../public/camera.jpg" class="profile-image rounded-circle border border-2" style="height: 180px; width: 180px">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="fname" name="firstname" placeholder="#">
                            <div class="invalid-feedback">
                                First name requires at least 1 character
                            </div>
                            <label for="fname">First Name</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="lname" name="lastname" placeholder="#">
                            <div class="invalid-feedback">
                                Last name requires at least 1 character
                            </div>
                            <label for="lname">Last Name</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="username" name="username" placeholder="#">
                            <div class="invalid-feedback">
                                Username requires at least 6 characters
                            </div>
                            <label for="username">Username</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="age" name="birthday" placeholder="#">
                            <div class="invalid-feedback">
                                Minimum age is 18 years old
                            </div>
                            <label for="age">Birthday</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <select class="form-select" name="gender" id='genderInput' placeholder="#">
                            <option hidden></option>
                            <?php foreach($genders as $gender): ?>
                            <option value="<?php echo $gender['id']; ?>" ><?php echo $gender['gender']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                                Gender is required
                        </div>
                        <label for="gender">Gender</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <select class="form-select" name="occupation" id='occupation'>
                                <?php foreach($occupations as $occupation): ?>
                                <option value="<?php echo $occupation['id']; ?>"><?php echo $occupation['occupation'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                Occupation is required
                            </div>
                            <label for='occupation'>Occupation</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="email" name="email" placeholder="#">
                            <div class="invalid-feedback">
                                Please enter a valid email
                            </div>
                            <label for="username">Email</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="password" name="password" placeholder="#">
                            <div class="invalid-feedback">
                                Please enter a valid password
                            </div>
                            <label for="password">Password</label>
                        </div>
                    </div>
                </div>
                
                <!-- button -->
                <div class="text-center mt-3">
                    <button type="button" class="btn btn-light rounded-pill px-5 firstNext">Next</button>
                </div>
            </div>

            <!-- interests -->
            <!-- <div class="interest mx-auto text-center p-5" style="display: none">
                <div class="interest-counter fixed-top w-50 text-center ms-auto me-0 p-3 d-none">
                    <h5>Please select only 10</h5>
                    <h6><span>0</span>/10</h6>
                </div>
                <div class="interest-caption m-4">
                    <h1>Pick some topics you are interested in.</h1>
                    <p>We'll find you matches based on your selections!</p>
                </div>
                <div class="d-flex flex-wrap gap-4 justify-content-center p-5 interest-form">
                    <?php foreach($interests as $interest): ?>
                        <div class="interest-pill rounded-pill">
                        <input type="checkbox"
                            id="<?php echo $interest['title']?>"
                            name="interests[]"
                            class="interest-box"
                            value="<?php echo $interest['id']?>">
                        <div class="rounded-pill">
                            <span class="px-4 py-2"><?php echo $interest['title']?></span>
                        </div>
                        </div>
                    <?php endforeach ?>
                </div>
                <button type="button" class="btn btn-light rounded-pill px-5 me-3 firstBack">Back</button>
                <button type="button" class="btn btn-light rounded-pill px-5 secondNext">Next</button>
            </div> -->
            <!-- end of interest -->

            <!-- gender -->
            <div class="gender mx-auto text-center" style="display: none">
                <div class="gender-container d-flex flex-wrap gap-3 flex-column justify-content-center align-items-center p-5 ">
                    <div class="gender-caption m-5">
                            <h1>and you would like to date...</h1>
                        </div>
                    <?php for($i = 0; $i <= 1; $i++):?>
                        <div class="gender-pill rounded-pill">
                        <input type="radio"
                            id="<?php echo $genders[$i]['gender']?>"
                            name="preferred_gender"
                            value="<?php echo $genders[$i]['id']?>">
                        <div class="rounded-pill">
                            <span class="px-4 py-2"><?php echo $genders[$i]['gender']?></span>
                        </div>
                        </div>
                    <?php endfor; ?>
                    <div class="gender-pill rounded-pill">
                        <input type="radio"
                            id="both"
                            name="preferred_gender"
                            value="Both">
                        <div class="rounded-pill">
                            <span class="px-4 py-2">Both</span>
                        </div>
                    </div>
                    <div class="d-flex mt-5 justify-content-center">
                        
                        <button type="button" class="btn btn-light rounded-pill px-5 secondBack">Back</button>
                        <button type="submit" class="btn btn-light rounded-pill ms-2 px-5" id="submitBtn">Signup</button>`
                    </div>
                </div>

            </div>
            <!-- end of gender -->
        </form>

        </div>
    <!-- end of register form -->
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

<script type="text/javascript" src="../js/register.js"></script>


<!-- // <script>
//     $(document).ready(function(e) {
//         $('#submitBtn').click(function (e) {
//             e.preventDefault();
//             $.ajax({
//                 method: "post",
//                 url: '/controllers/users/register.php',
//                 data: $('#register-form').serialize(),
//                 success: function(response) {
//                     console.log(response);
//                     $("#register-form")[0].reset()
//                 }
//             })

//         })
//     })
// </script>  -->

<?php

?>