<?php
    session_start();
    $_SESSION['message']='';

    $con = new mysqli('localhost','root','','register');

    if($con->connect_error){
        die("Connection Failed");
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if($_POST['password'] == $_POST['confirm-password']){
            $fullname = $con->real_escape_string($_POST['fullname']);
            $email = $con->real_escape_string($_POST['email']);
            $education = $con->real_escape_string($_POST['education']);
            $password = $con->real_escape_string($_POST['password']);

            $sql = "SELECT * FROM users WHERE email = '$email'";
            $res = $con->query($sql);

            if($res->num_rows > 0){
                $_SESSION['message'] = "This E-mail is already used";
            }
            else{
                $sql = "INSERT INTO users(fullname,email,education,passwod) VALUES('$fullname','$email','$education','$password')";
                if(mysqli_query($con,$sql)){
                    $sql2 = "SELECT * FROM users WHERE email = '$email'";
                    $res2 = $con->query($sql2);

                    if($res2->num_rows > 0){
                        while($row = $res2->fetch_assoc()){
                            $user_id = $row['id'];
                        }
                    }
                    header("location:index.php?user_id=$user_id");
                }
                else{
                    echo"Error : ".$sql."<br>".$con->error;
                }
            }
        }
        else{
            $_SESSION['message'] = "password or confirm password not correct";
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
    <body>
        <nav class="navbar bg-body-tertiary p-3">
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

        <div class="container text-center">
            <div class="row">
                <div class="col">
                    
                </div>
                <div class="col-6">
                    
                </div>
            </div>

            <form action="register.php" method="POST" class="container text-center">
                <div class="input-group input-group-lg m-2">
                    <span class="input-group-text" id="inputGroup-sizing-lg">Full Name</span>
                    <input type="text" name="fullname" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" required>
                </div>
                <div class="input-group input-group-lg m-2">
                    <span class="input-group-text" id="inputGroup-sizing-lg">E-Mail</span>
                    <input type="email" name="email" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" required>
                </div>
                <div class="input-group input-group-lg m-2">
                    <span class="input-group-text" id="inputGroup-sizing-lg">Education</span>
                    <input type="text" name="education" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" required>
                </div>
                <div class="input-group input-group-lg m-2">
                    <span class="input-group-text" id="inputGroup-sizing-lg">Password</span>
                    <input type="password" name="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" required>
                </div>
                <div class="input-group input-group-lg m-2">
                    <span class="input-group-text" id="inputGroup-sizing-lg">Confrim Password</span>
                    <input type="password" name="confirm-password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" required>
                </div>
                <div class="fs-5 text-danger-emphasis"><?= $_SESSION['message'] ?></div>
                <div class="input-group input-group-lg m-2">
                    <input type="submit" value="Register" class="form-control btn btn-primary" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
                </div>
                
            </form>
        </div>
    </body>
</html>