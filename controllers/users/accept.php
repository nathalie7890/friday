<?php
require_once '../../controllers/connection.php';

$id = $_GET['id'];
echo $id;

header('Location: ../../views/success.php');

?>