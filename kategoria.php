<?php

    $con = mysqli_connect(host,user,pwd,dbname);
    mysqli_query($con, "SET NAMES utf8");

    $sql = "SELECT * FROM kategoriak ORDER BY katsorrend ASC";

    $result = mysqli_query($con, $sql);

    while($row = mysqli_fetch_array($result)){

        $id = $row["id"];
        $katnev = $row["katnev"];

        echo "

            <div class='katlista'>
                <a href='termekek.php?katid=".$id."'>
                    ".$katnev."
                </a>
            </div>
        ";
    }