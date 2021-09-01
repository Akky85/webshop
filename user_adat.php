<?php require "header.php"; ?>

<div id="top">
    <img id="logo" src="" alt="">
    <?php  require "menu.php";  ?>
</div>

<div id="left">
    <?php require "kategoria.php"; ?>
</div>

<div id="right">

    <h2> <?php echo $_SESSION["user"]." rendeléseinek megtekintése!"; ?></h2>

    <table width="90%" align="center" cellpadding="7">
        <tr>
            <th>Azonosító</th>
            <th>Terméknév</th>
            <th>Termékár</th>
            <th>Darabszám</th>
            <th>Érték</th>
            <th>Termékkép</th>
        </tr>

        <?php
            $nev = $_SESSION["user"];
            $con = mysqli_connect(host,user,pwd,dbname);
            mysqli_query($con, "SET NAMES utf8");

            $sql = "SELECT termekid,termeknev,ar,db,kep FROM vevok INNER JOIN rendelesek ON vevok.id=rendelesek.vevoid INNER JOIN rend_term ON rendelesek.id=rend_term.rendelesid INNER JOIN termekek ON rend_term.termekid=termekek.id WHERE vevok.nev LIKE '$nev'";

            $result = mysqli_query($con, $sql);

            while($row = mysqli_fetch_array($result)){

                $id = $row["termekid"];
                $termeknev = $row["termeknev"];
                $termekar = $row["ar"];
                $db = $row["db"];
                $ertek = $db * $termekar;
                $termekkep = $row["kep"];

                echo "
                    <tr align='center'>
                    <td>".$id."</td>
                    <td>".$termeknev."</td>
                    <td>".number_format($termekar,0,".",".")." Ft</td>
                    <td>".$db."</td>
                    <td>".number_format($ertek,0,".",".")." Ft</td>
                    <td> <a href='termek.php?termekid=".$id."'> <img src='$termekkep' width='32px' height='32px' /> </a></td>
                    
                    
                    
                    ";
            }

        ?>
    </table>
</div>

</body>
</html>