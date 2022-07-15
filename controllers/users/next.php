<?php
require_once '../connection.php';
$id = $_POST['id'];
$p_gender = $_POST['p_gender'];

$query = "SELECT * FROM users WHERE id = $id;";
$user = mysqli_fetch_assoc(mysqli_query($cn, $query));
$gender = $user['gender'];

$output = "";
if($p_gender == '1'){
    $query = "SELECT * FROM users WHERE gender = $p_gender AND id != '$id' AND (preferred_gender = $gender OR preferred_gender = 'Both') AND id not in(SELECT like_user FROM likes where user_id = $id) ORDER BY rand() LIMIT 1;";
    $result = mysqli_query($cn, $query);
    $selections = mysqli_fetch_all($result, MYSQLI_ASSOC);

    foreach($selections as $selection) {

        $query = "SELECT genders.gender FROM genders JOIN users ON users.id = {$selection['id']} AND genders.id = {$selection['gender']}";
        $gender = mysqli_fetch_assoc(mysqli_query($cn, $query));

        $birthDate = $selection['birthday'];
        $birthDate = new DateTime($birthDate);
        $now = new DateTime();
        $interval = $now->diff($birthDate);
        $birthday = $interval->y;

        $output = "
        <div class='d-flex justify-content-center'>
        <div class='col-md-3 d-flex justify-content-center'>
          <div class='card bg-dark rounded-5'>
            <img src=" . $selection['image'] . " class='card-img-top rounded-5 img-fluid' style='height: 400px'>
            <div class='card-body'>
              <h4 class='card-title text-info'>" . $selection['firstname'] . " " . $selection['lastname'] . "</h4>
              <div class='d-flex'>
                <p>" . $gender['gender'] ."&nbsp&nbsp&nbsp" . "</p>
                <p>" . $birthday . " " . "year-old" . "</p>
              </div>
              <p class='card-tex text-secondary'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit ex facilis voluptatum dolor vero!</p>
              <div class='text-end'>
                <form action='../controllers/users/likes.php' method='POST'>
                  <input type='hidden' class='user_id' name='user_id' value='" . $user['id'] . "'>
                  <input type='hidden' name='like_user' value='" . $selection['id'] . "'>
                  <input type='hidden' class='p_gender' name='p_gender' value='"  . $p_gender ."'>
                  <button type='submit' class='btn likeBtn text-danger'><i class='fa-solid fa-heart fa-2xl'></i></button>
                </form>
              </div>
            </div>
          </div>
          </div>
          <div class='nextBtn d-flex flex-column justify-content-center ms-5'>
            <button class='btn bg-* border-0'>
              <h1><i class='fa-solid fa-angles-right'></i></h1>
            </button>
          </div>
      </div>
        ";

    }
}

echo $output;