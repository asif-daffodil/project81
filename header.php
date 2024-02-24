<?php

    require_once "./classes/Auth.php";
    use classes\Auth\Auth as Auth;
    $auth = new Auth();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./node_modules/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="./node_modules/animate.css/animate.min.css">
    <link rel="stylesheet" href="./assets/css/style.min.css">
</head>
<body>
    <?php 
        require_once "./components/navbar.php";
    ?>