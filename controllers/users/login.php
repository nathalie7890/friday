<?php
require_once "../connection.php";
$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE username = '$username';";
$user = mysqli_fetch_assoc(mysqli_query($cn, $query));

if($user && password_verify($password, $user['password'])) {
    session_start();
    $_SESSION['user_info'] = $user;
    if($user['isAdmin'] == 1) {
        $_SESSION['user_info']['isAdmin'] = true;
    }
    mysqli_close($cn);
    header('Location: ../../views/select.php');
} else {
    echo "<h4>Wrong Credentials</h4>";
    echo "<a href='/views/login.php'>Go back to Login</a>";
}