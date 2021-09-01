<?php  require "connection.php";

session_start();
$_SESSION["logged"] = false;

$error = "";
$success = "";

if(isset($_POST["reg"])){

    $user = $_POST["user"];
    $pwd = $_POST["pwd"];

    if(empty($user) || empty($pwd)){

        $error="Minden mező kitöltése kötelező!";
    }
    else if(strlen($pwd) < 6){

        $error = "A jelszó hossza min. 6 karakter legyen!";
    }
    else{

        $con = mysqli_connect(host,user,pwd,dbname);
        mysqli_query($con, "SET NAMES utf8");

        $sql = "INSERT INTO adatok(user,email,pwd) VALUES('$user', '', sha1('$pwd'))";

        mysqli_query($con, $sql);

        $success = "Sikeres regisztráció!";
    }
}


if(isset($_POST["login"])){

    $user = $_POST["user"];
    $pwd = $_POST["pwd"];

    $con = mysqli_connect(host,user,pwd,dbname);
    mysqli_query($con, "SET NAMES utf8");

    $sql = "SELECT * FROM adatok WHERE user='$user' AND pwd=sha1('$pwd')";

    $result = mysqli_query($con, $sql);

    if(mysqli_num_rows($result) == 1){

        $_SESSION["logged"] = true;
        $_SESSION["user"] = $user;
        header("Location: index.php");
    }
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">

<title>Title</title>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
    
        <form action="" method="post" class="form-group text-center p-5 bg-light">
            <span class="text-danger d-block"><?php if(!empty($error)){ echo $error;} ?></span>
            <span class="text-success d-block"><?php if(!empty($success)){ echo $success;} ?></span>
            
            <label for="">Felhasználónév</label>
            <input type="text" name="user" class="form-control mb-3">

            <label for="">Jelszó</label>
            <input type="password" name="pwd" class="form-control mb-3">

            <button type="submit" name="login" class="btn btn-success">Bejelentkezés</button>
            <button type="submit" name="reg" class="btn btn-primary">Regisztráció</button>
        </form>
    </div>
</div>


</body>
</html>