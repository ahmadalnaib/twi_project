<?php

 require_once("config/db.php");

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/style.css">
  <title><?php echo $title; ?></title>
</head>
<body>

<header>
  <h1>twi</h1>
  <nav>
    <ul>
    <!-- <li class="user"><a title="Hi" href="#"><?php echo $userLoggedIn ?></a></li> -->

    <li><a title="home" href="index.php"><i class="fas fa-home"></i></a></li>

    <li><a title="message" href="#"><i class="far fa-envelope"></i></a></li>

    <li><a title="notifications" href="#"><i class="far fa-bell"></i></a></li>

    <li><a title="friends" href="#"><i class="fas fa-user-friends"></i></a></li>
    

    <li><a title="settings" href="#"><i class="fas fa-sliders-h"></i></a></li>
    

    <li><a title="logout" href="logout.php"><i class="fas fa-angry"></i></a></li>
    
    </ul>
  </nav>
</header>

<div class="container">

