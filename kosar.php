<?php require "header.php"; ?>

<div id="top">
    <img id="logo" src="" alt="">
    <?php  require "menu.php";  ?>
</div>

<div id="left">
    <?php require "kategoria.php"; ?>
</div>

<div id="right">
   <h2>Kosár tartalma</h2>

   <table width="90%" align="center" cellspacing="8">

        <tr>

            <th>Azonosító</th>
            <th>Terméknév</th>
            <th>Brutto ár</th>
            <th>Darabszám</th>
            <th>Cikkszám</th>
            <th>Érték</th>
            <th><a href="kosarmuvelet.php?action=empty"><i class="fas fa-trash-alt"></i></a></th>

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

                        $product_id = $row["id"];
                        $termeknev = $row["nev"];
                        $cikkszam = $row["cikkszam"];
                        $bruttoar = $row["ar"];
                        $ertek = $bruttoar * $db;


                        echo "
                        
                            <tr align='center'>
                                <td>".$product_id."</td>
                                <td>".$termeknev."</td>
                                <td>".number_format($bruttoar,0,".",".")." Ft</td>
                                <td>".$db."</td>
                                <td>".$cikkszam."</td>
                                <td>".number_format($ertek,0,".",".")." Ft</td>
                                <td>
                                    <a href='kosarmuvelet.php?id=".$product_id."&action=add'><i class='fas fa-plus'></i></a>
                                    <a href='kosarmuvelet.php?id=".$product_id."&action=remove'><i class='fas fa-minus'></i></a>
                                </td>
                               
                            </tr>
                        
                        ";

                        $vegosszeg += $ertek;
                    }


                }
            }
            else{

                echo "<h2 align='center'>A kosár üres!</h2>";
            }
        ?>
        <tr>

            <td align="right" colspan="7"><strong>Végösszeg: </strong> <?php  echo number_format($vegosszeg,0,".",".");  ?> Ft </td>

        </tr>
   </table>

   <?php

            if($_SESSION["logged"]){
    ?>
    <a class="rendeles_gomb" href="megrendeles.php">Megrendelem</a>

        <?php
            }
            else{

    ?>
    <a class="rendeles_gomb" href="login_reg.php">Rendelés leadásához kérjük jelentkezzen be!</a>
    <?php
            }
    ?>
</div>

</body>
</html>