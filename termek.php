<?php require "header.php"; ?>

<div id="top">
    <img id="logo" src="" alt="">
    <?php  require "menu.php";  ?>
</div>

<div id="left">
    <?php require "kategoria.php"; ?>
</div>

<div id="right">
    <?php

    $con = mysqli_connect(host,user,pwd,dbname);
    mysqli_query($con, "SET NAMES utf8");

    if(isset($_GET["termekid"])){

        $termekid = $_GET["termekid"];

        $sql = "SELECT * FROM termekek WHERE id='$termekid'";
    }

    $result = mysqli_query($con, $sql);

    while($row = mysqli_fetch_array($result)){

        $id = $row["id"];
        $termekkep = $row["kep"];
        $termeknev = $row["nev"];
        $termekar = $row["ar"];
        $cikkszam = $row["cikkszam"];
        $keszlet = $row["keszlet"];
        $rovid = $row["rleiras"];
        $hosszu = $row["hleiras"];

        echo "
        
            <div id='termekkep'>
                <img src='$termekkep' alt='' title='' />
            </div>

            <div id='termekadatok'>
                
                <div id='termeknev'>
                    <h2>".$termeknev."</h2>
                </div>

                <div id='termekar'>
                    <h3>".number_format($termekar,0,".",".")." Ft</h3>
                </div>

                <div id='termekrovid'>
                    <p>".$rovid."</p>
                </div>

                <div id='cikkszam'>
                    <p> <strong>Cikkszám: </strong>".$cikkszam." <strong>Készlet: </strong>".$keszlet." </p>
                </div>

                <div id='termekkosar'>
                    <a href='kosarmuvelet.php?id=".$id."&action=add'>Kosárba</a>
                </div>

            </div>

            <div id='termekhosszu'>
                <h3>Termék részletes leírása:</h3>
                <p>".$hosszu."</p>
            </div>


        
        
        
        
        ";
    }


    ?>
</div>

</body>
</html>