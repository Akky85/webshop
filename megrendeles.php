<?php require "header.php"; ?>

<div id="top">
    <img id="logo" src="" alt="">
    <?php  require "menu.php";  ?>
</div>

<div id="left">
    <?php require "kategoria.php"; ?>
</div>

<div id="right">
    <h2>Megrendelés összesítése</h2>

    <table align="center" cellpadding="8" width="90%">
        <tr align="center">
            <th>Azonosító</th>
            <th>Terméknév</th>
            <th>Bruttó ár</th>
            <th>Darabszám</th>
            <th>Cikkszám</th>
            <th>Érték</th>
        </tr>

        <?php

            $vegosszeg = 0;

            if(isset($_SESSION["cart"])){

                foreach($_SESSION["cart"] as $product_id => $db){

                    $con = mysqli_connect(host,user,pwd,dbname);
                    mysqli_query($con, "SET NAMES utf8");

                    $sql = "SELECT * FROM termekek WHERE id='$product_id'";

                    $result = mysqli_query($con, $sql);

                    while($row = mysqli_fetch_array($result)){

                        $id = $row["id"];
                        $termeknev = $row["nev"];
                        $bruttoar = $row["ar"];
                        $cikkszam = $row["cikkszam"];
                        $ertek = $bruttoar * $db;

                        echo "

                            <tr align='center'>
                                <td>".$id."</td>
                                <td>".$termeknev."</td>
                                <td>".number_format($bruttoar,0,".",".")." Ft </td>
                                <td>".$db."</td>
                                <td>".$cikkszam."</td>
                                <td>".number_format($ertek,0,".",".")." Ft</td>
                            </tr>
                        ";

                        $vegosszeg += $ertek;
                    }

                }
            }

        ?>

        <tr align="right">
            <td colspan="6"> <strong>Végösszeg: </strong> <?php echo number_format($vegosszeg,0,".","."); ?> Ft </td>
        </tr>
    </table>

    <?php

        $error="";
        $error2="";

        if(isset($_POST["megrendel"]) && (isset($_POST["check"]) == 1)){

            $nev = $_POST["nev"];
            $email = $_POST["email"];
            $telefon = $_POST["telefon"];
            $szcim = $_POST["szcim"];
            $szmod = $_POST["szmod"];
            $fizmod = $_POST["fizmod"];

            if(empty($nev) || empty($email) || empty($telefon) || empty($szcim)){

                 $error = "Rendelés leadásához minden mező kitöltése kötelező!";
            }
            else{

                $con = mysqli_connect(host,user,pwd,dbname);
                mysqli_query($con, "SET NAMES utf8");

                $sql = "INSERT INTO vevok(nev,email,cim,telefon,pw,szcim) VALUES('$nev','$email','','$telefon','','$szcim')";

                mysqli_query($con, $sql);

                //Megkeresem az utolsó vevőm azonosítóját
                $utolsovevoid = "SELECT id FROM vevok ORDER BY id DESC LIMIT 1";

                //Eltárolom az sql lekérdezésem kimenetét egy változóba
                $result = mysqli_query($con, $utolsovevoid);

                //Tömbösítem az sql lekérdezésem kimenetét
                $get_vevoid = mysqli_fetch_array($result);

                //A végleges vevő id-t eltárolom egy változóba
                $kapottvevoid = $get_vevoid[0];
                
                //Fetöltöm a megfelelő adatok a rendelések táblába
                $sql2 = "INSERT INTO rendelesek(vevoid,szallitas,fizmod,datum,statusz,bosszeg) VALUES('$kapottvevoid', '$szmod', '$fizmod', NOW(), 'függőben', '$vegosszeg')";

                mysqli_query($con, $sql2);

                  //Megkeresem az utolsó rendelésem azonosítóját
                $utolsorendelesid = "SELECT id FROM rendelesek ORDER BY id DESC LIMIT 1";

                //Eltárolom az sql lekérdezésem kimenetét egy változóba
                $result2 = mysqli_query($con, $utolsorendelesid);
                //Tömbösítem az sql lekérdezésem kimenetét
                $get_rendelesid = mysqli_fetch_array($result2);
                //A végleges vevő id-t eltárolom egy változóba
                $kapottrendelesid = $get_rendelesid[0];

                foreach($_SESSION["cart"] as $product_id => $db){

                    //FEltöltöm a megfelelő adatokat a rend_term táblába
                    $sql3 = "INSERT INTO rend_term(rendelesid,termekid,db) VALUES('$kapottrendelesid','$product_id', '$db')";

                    mysqli_query($con, $sql3);

                    //Frissítem a termék készletének darabszámát
                    $sql4 = "UPDATE termekek SET keszlet= keszlet - '$db' WHERE id='$product_id'";
                    mysqli_query($con, $sql4);
                }

                echo "<h3 style='text-align:center; color:green'>Rendelésed sikeresen rögzítettük!</h3>";
                unset($_SESSION["cart"]);

                
                //mail($email, "Rendelés visszaigazolása", "Rendelésed sikeresen rögzítettük! Hamarosan küldjük a terméket!");


            }
        }
        else if(isset($_POST["megrendel"]) && (isset($_POST["check"]) == 0)){

            $nev = $_POST["nev"];
            $email = $_POST["email"];
            $telefon = $_POST["telefon"];
            $szcim = $_POST["szcim"];
            $szmod = $_POST["szmod"];
            $fizmod = $_POST["fizmod"];

            $error2="Vásárlási feltételek elfogadása kötelező!";

            if(empty($nev) || empty($email) || empty($telefon) || empty($szcim)){

                 $error = "Rendelés leadásához minden mező kitöltése kötelező!";
            }
        }


    ?>
    <div id="megrendeles">
            <form action="" method="post">

                <h4 style="color: red"> <?php  if(!empty($error)){ echo $error;} ?></h4>

                <input type="text" name="nev" placeholder="Név...">
                <input type="text" name="email" placeholder="E-mail cím...">
                <input type="text" name="telefon" placeholder="Telefonszám...">
                <input type="text" name="szcim" placeholder="Szállítási cím (irsz,város,utca,házszám)...">

                <select name="szmod">
                    <option value="gls">Gls futárral</option>
                    <option value="posta-utanvet">Postai utánvéttel</option>
                    <option value="szemelyes">Személyes átvétel</option>
                </select>

                <select name="fizmod">
                    <option value="obk">Online bankkártya</option>
                    <option value="utanvet">Utánvét</option>
                    <option value="atutalas">Átutalás</option>
                </select>

                <h4 style="color: red"> <?php  if(!empty($error2)){ echo $error2;} ?></h4>
                <p> <a href="tajezkotato.php"> Elfogadom a vásárlási feltételeket</a></p>
                <input type="checkbox" name="check">

                <button type="submit" name="megrendel">Rendelés leadása</button>
            </form>
    </div>
</div>

</body>
</html>