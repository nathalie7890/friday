<?php
function get_content() {
    require_once '../controllers/connection.php';

    $query = "SELECT * FROM users WHERE username = '{$_SESSION['user_info'   ]['username']}';";
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
    
        <title></title>
        <style>
            <?php require_once '../assets/select.css'?>
        </style>
      </head>
      <body>
          <div class="main d-flex flex-column justify-content-center align-items-center">
            <h1>Hi, <?php echo $user['firstname']?>!</h1>
            <h3>What would you like to do next?</h3>
            <div class="d-flex flex-column justify-content-center align-items-center gap-4 mt-5">
                <a href="match2.php"class="btn btn-outline-light btn-lg rounded-pill px-5 matchBtn">Start matching!</a>
                <a href="profile.php"class="btn btn-outline-light btn-lg rounded-pill px-5 matchBtn">My Profile</a>
            </div>
        </div>
    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
      </body>
    </html>
<?php
}
require_once 'layout.php';
?>
