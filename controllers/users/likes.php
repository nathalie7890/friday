<?php
require_once '../connection.php';

$user_id = $_POST['user_id'];
$like_user = $_POST['like_user'];

echo $user_id;
echo $like_user;

$query = "INSERT INTO likes(user_id, like_user) VALUES ('$user_id', '$like_user');";
mysqli_query($cn, $query);

$query = "SELECT user_id FROM likes WHERE user_id = $like_user AND like_user = $user_id";
$result = mysqli_fetch_assoc(mysqli_query($cn, $query));


if($result) {
    $query = "INSERT INTO matches(user_id, match_user) VALUES ('$user_id', '$like_user');";
    mysqli_query($cn, $query);
    $query = "INSERT INTO matches(user_id, match_user) VALUES ('$like_user', '$user_id');";
    mysqli_query($cn, $query);
}



mysqli_close($cn);

?>