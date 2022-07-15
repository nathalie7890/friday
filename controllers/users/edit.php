<?php
require_once '../connection.php';

$user_id = $_POST['user_id'];
$query = "SELECT password AS password, image AS image FROM users WHERE id = '$user_id';";
$result = mysqli_query($cn, $query);
$user = mysqli_fetch_all($result, MYSQLI_ASSOC);


$firstname = $_POST['fname'];
$lastname = $_POST['lname'];
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$birthday = $_POST['birthday'];
$occupation= $_POST['occupation'];


echo $user_id . "<br>";
echo $firstname . "<br>";
echo $lastname . "<br>";
echo $username . "<br>";
echo $email . "<br>";
echo $occupation;
echo $birthday;

if($password == "") {
    foreach($user as $u) {
        $password = $u['password'];
        $query = "UPDATE users SET password = '$password' WHERE id = '$user_id';";
        mysqli_query($cn, $query);
        
    }
}

if(empty($_FILES['image']['name'])) {
    foreach($user as $u) {
        $img_url = $u['image'];
        $query = "UPDATE users SET image = '$img_url' WHERE id = '$user_id';";
        mysqli_query($cn, $query);
    }
}

if(!empty($password)) {
    $password = password_hash($password, PASSWORD_DEFAULT);
    $query = "UPDATE users SET password = '$password' WHERE id = '$user_id';";
    mysqli_query($cn, $query);

}


if (!empty($_FILES['image']['name'])) {
    $img_name = $_FILES['image']['name'];
    $img_size = $_FILES['image']['size'];
    $img_tmpname = $_FILES['image']['tmp_name'];
    $img_type = pathinfo($img_name, PATHINFO_EXTENSION); // jpg, svg, png, gif, jpeg
    $image = "../../public/".$img_name;
    $query = "UPDATE users SET image = '$image' WHERE id = '$user_id';";
    mysqli_query($cn, $query);
    move_uploaded_file($img_tmpname, $image);
}

$query = "UPDATE users 
        SET 
        firstname = '$firstname',
        lastname = '$lastname',
        username = '$username',
        email = '$email',
        birthday = '$birthday',
        occupation = '$occupation'
        WHERE id = '$user_id';";
 mysqli_query($cn, $query);
 mysqli_close($cn);

header('Location: ../../views/profile.php');
?>