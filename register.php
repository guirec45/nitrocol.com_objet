<?php

session_start();

include_once './config/config.php';
include_once './classes/auth.php';

$database = new Database();
$db = $database->getConnection();
$auth = new Auth($db);


if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $img = $_POST['img'];


    $message = $auth->inscription($username, $password,$f_name ,$l_name ,$img,);
    echo $message;

}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <p>register</p>
    
    <form action="register.php" method="POST">
        <div>
            <label for="username"></label>
            <input type="text" name="username" placeholder="username" required>
        </div>

        <div>
            <label for="password"></label>
            <input type="password" name="password" placeholder="password" required>
        </div>
        <div>
            <label for="f_name"></label>
            <input type="text" name="f_name" placeholder="f_name" required>
        </div>

        <div>
            <label for="l_name"></label>
            <input type="text" name="l_name" placeholder="l_name" required>
        </div>
        <div>
            <label for="img"></label>
            <input type="text" name="img" placeholder="img" required>
        </div>


        <div>
            <input type="submit" value="go">
        </div>
    </form>
</body>
</html>