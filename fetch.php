<?php

    require "connection.php";

    $con = mysqli_connect(host,user,pwd,dbname);
    mysqli_query($con, "SET NAMES utf8");

    $search = mysqli_real_escape_string($con, $_POST["search"]);

    $sql = "SELECT * FROM termekek WHERE nev LIKE '%$search%'";

    $result = mysqli_query($con, $sql);

    if(mysqli_num_rows($result) > 0){

        while($row = mysqli_fetch_array($result)){

            $id = $row["id"];
            $termeknev = $row["termeknev"];
            $termekar = $row["ar"];
            $termekkep = $row["kep"];
            $keszlet = $row["keszlet"];

            echo "
                <div class='termekdoboz'>

                    <div class='termekkep'>
                        <a href='termek.php?termekid=".$id."'>
                            <img src='$termekkep'/>
                        </a>
                    </div>

                    <div class='termeknev'>
                        ".$termeknev."
                    </div>

                    <div class='keszlet'>
                        Készlet: ".$keszlet."
                    </div>

                    <div class='termekar'>
                        ".number_format($termekar)." Ft
                    </div>

                    <div class='termekkosar'>
                        <a href='kosarmuvelet.php?id=".$id."&action=add'>Kosárba</a>
                    </div>

                </div>
            ";
        }
    }
    else{

        echo "<h3>Nincs ilyen termék az adatbázisban!</h3>";
    }