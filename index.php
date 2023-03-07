<?php
    session_start();
    $_SESSION['message']='';

    $con = new mysqli('localhost','root','','register');

    if($con->connect_error){
        die("Connection Failed");
    }
    $user_id=0;
    $user_id=$_GET['user_id'];
    $fullname="";
    $education="";

    $sql = "SELECT * FROM users WHERE id=$user_id";
    $res = $con->query($sql);

    if($res->num_rows > 0){
        while($row = $res->fetch_assoc()){
            $fullname = $row['fullname'];
            $education = $row['education'];
        }
    }

    $con->close();
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Form Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    </head>
    <body class="bg-body-secondary">
        <nav class="navbar bg-dark-subtle p-3">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="nav-link active fs-2" aria-current="page" href="index.php">Home</a>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </nav>

        <div class="container text-center ">
            <div class="row">
                <span class="fs-1 text-primary-emphasis">Hello <?=$fullname; ?></span>
            </div>
            <div class="row">
                <span class="fs-2 text-primary-emphasis">Your education is <?=$education; ?></span>
            </div>
            <div class="row">
                <span class="fs-2 text-primary-emphasis">So we recommended those websites to learn more : </span>
                <a href="https://www.udemy.com/" class="fs-3 text-secondary-emphasis" target="_blank">Udemy</a>
                <a href="https://www.udacity.com/" class="fs-3 text-secondary-emphasis" target="_blank">Udacity</a>
                <a href="https://www.coursera.org/" class="fs-3 text-secondary-emphasis " target="_blank">Coursera</a>
                <a href="https://www.w3schools.com/" class="fs-3 text-secondary-emphasis" target="_blank">W3schools</a>
            </div>
        </div>
    </body>
</html>