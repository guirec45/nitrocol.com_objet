<?php

include_once './config/config.php';
include_once './classes/update.php';

//  create instance de la classe de connexion

$database = new Database();
$db = $database->getConnection();

$update = new Update($db);

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if($update->updateData($id, $username , $password)) {
        echo "update marche bien";
    } else {
        echo "Null";
    }
}
?>