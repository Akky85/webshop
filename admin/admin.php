<?php

    require "../connection.php";

    $error = "";
    $success = "";

    if(isset($_POST["upload"])){

        $target = "../img/".basename($_FILES["file"]["name"]);

        $termekkep = $_FILES["file"]["name"];
        $termeknev = $_POST["termeknev"];
        $termekar = $_POST["termekar"];
        $kategoria = $_POST["kategoria"];
        $cikkszam = $_POST["cikkszam"];
        $keszlet = $_POST["keszlet"];
        $trovid = $_POST["trovid"];
        $thosszu = $_POST["thosszu"];

        if(empty($termekkep) || empty($termeknev) || empty($termekar) || empty($cikkszam) || empty($keszlet) || empty($trovid) || empty($thosszu)){

            $error = "Minden mező kitöltése kötelező!";
        }
        else{

            $con = mysqli_connect(host,user,pwd,dbname);
            mysqli_query($con, "SET NAMES utf8");

            $sql = "INSERT INTO termekek(kategoria,nev,cikkszam,ar,rleiras,hleiras,kep,keszlet) VALUES('$kategoria', '$termeknev', '$cikkszam', '$termekar', '$trovid', '$thosszu', 'img/$termekkep', '$keszlet')";

            mysqli_query($con, $sql);

            move_uploaded_file($_FILES["file"]["tmp_name"] , $target);

            $success = "Sikeres termékfeltöltés!";
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
<title>PHP Webshop Admin</title>
</head>
<body>
    
    <div class="container">
        <div class="row justify-content-center">
            <form enctype="multipart/form-data" action="" method="post" class="form-group text-center bg-light p-5">

                <span class="text-danger d-block mb-3">
                 <?php 
                    if(!empty($error)){
                        
                        echo $error ;
                    }   
                 ?> 
                 </span>
                <span class="text-success d-block mb-3">
                 <?php

                    if(!empty($success)){ 
                        echo $success;
                    }   
                 ?>
                 </span>
                <h2 class="mb-5">Admin</h2>

                <label for="">Termékkép</label>
                <input type="file" name="file" class="form-control mb-3 ">

                <label for="">Terméknév</label>
                <input type="text" name="termeknev" class="form-control mb-3">

                <label for="">Termékár</label>
                <input type="text" name="termekar" class="form-control mb-3">

                <label for="">Kategória</label>
                <select name="kategoria" class="form-control mb-3">
                    <option value="2">HP Notebook</option>
                    <option value="3">Dell Notebook</option>
                    <option value="4">Asus Notebook</option>
                    <option value="5">Lenovo Notebook</option>
                    <option value="6">Apple Notebook</option>
                    <option value="7">Toshiba Notebook</option>
                </select>

                <label for="">Cikkszám</label>
                <input type="text" name="cikkszam" class="form-control mb-3">

                <label for="">Készlet</label>
                <input type="text" name="keszlet" class="form-control mb-3">

                <label for="">Termék rövid leírása</label>
                <input type="text" name="trovid" class="form-control mb-3">

                <label for="">Termék részletes leírása</label>
                <textarea name="thosszu" cols="50" rows="10" class="form-control mb-3"></textarea>

                <button type="submit" name="upload" class="btn btn-primary form-control">Feltöltés</button>
            </form>
        </div>
    </div>

</body>
</html>