<?php
require_once '../connection.php';


$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$username = $_POST['username'];
$password = $_POST['password'];
$gender = $_POST['gender'];
$birthday = $_POST['birthday'];
$occupation = $_POST['occupation'];
$email = $_POST['email'];
$preferred_gender = $_POST['preferred_gender'];


$img_name = $_FILES['image']['name'];
$img_size = $_FILES['image']['size'];
$img_tmpname = $_FILES['image']['tmp_name'];
$img_type = pathinfo($img_name, PATHINFO_EXTENSION);
$image = "../../public/".$img_name;

$password = password_hash($password, PASSWORD_DEFAULT);

$query = "INSERT INTO

         users
        (firstname, lastname, 
        username, password, image, 
        isAdmin, gender, 
        birthday, occupation, 
        email, preferred_gender) 

        VALUES 
        ('$firstname', 
        '$lastname', '$username', '$password',
        '$image', 0, '$gender', 
        '$birthday', '$occupation', 
        '$email', '$preferred_gender');";

mysqli_query($cn, $query);

$query = "SELECT id FROM users WHERE username = '$username';";
$result = mysqli_fetch_assoc(mysqli_query($cn, $query));
move_uploaded_file($img_tmpname, $image); 
$user_id = $result['id'];


mysqli_close($cn);

header ('Location: ../../views/login.php');







// echo $firstname . "<br>";
// echo $lastname . "<br>";
// echo $username . "<br>";
// echo $gender . "<br>";
// echo $birthday . "<br>";
// echo $occupation . "<br>";
// echo $email . "<br>";
// echo $preferred_gender . "<br>";


?>