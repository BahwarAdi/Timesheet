<?php
session_start();
if(isset($_SESSION['user'])) {
    require_once "../Config/config.php";
    require_once  "Class_Zeit.php";

    $z = new Zeit();
    $stunden = 0;
    $datumstrat = $_POST['start'];
    $datumstop = $_POST['stop'];
    $username = $_POST['user'];
    $projektname = $_POST['projekt'];

    $commall = 'SELECT * FROM zeit 
                LEFT JOIN user ON zeit.userId = user.userId 
                LEFT JOIN projekt ON zeit.projektId = projekt.projektId 
                WHERE user.vorname ="'.$username.'" AND projektname = "'.$projektname.'" AND datum >= "'.$datumstrat.'" AND datum <= "'.$datumstop.'"';

    if ($_POST['go'] == 'Anzeigen'){
        $query = $mysqli->query($commall);
        while ($res = $query->fetch_assoc()){

            $z->arbeitszeit($res['start'],$res['stop'],$res['pause']);
            $stunden += $tot_time ;
        }
    }
    if (isset($_POST['userverwaltung'])) {
        header('Location: ../Pages/Stundenubersicht.php');
    }
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Timesheet Main Page</title>
        <link href="../Style/StyleSheet.css" rel="stylesheet" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
    </head>
    <ul>
        <p id="Pul">TimeSheet Benutzer:<?php echo($_SESSION['vorname'] . $_SESSION['nachname']);?></p>
    </ul>

    <body>

    <div class="cont">
        <div class="fc">

                <fieldset>
                    <br class='bls' align="center">
                        <h2>Stunden Anzeigen</h2>
            <div>
                <form action="" method="post">


                    <select name="projekt"  required>
                        <?php
                        $commsel = "SELECT * FROM `projekt`WHERE archiviert = 'FALSE'";
                        $query = $mysqli->query($commsel);
                        while ($res = $query->fetch_array()){
                            echo('<option>'. $res['projektname'] .'</option>');
                        }
                        ?>
                    </select>
                    <select name="user"  required>
                        <?php
                        $commsel = "SELECT * FROM user";
                        $query = $mysqli->query($commsel);
                        while ($res = $query->fetch_array()){
                            echo('<option>'. $res['vorname'].'</option>');
                        }
                        ?>
                    </select>

                    <input type="date" name="start" required>
                    <input type="date" name="stop" required>

                    <input type="submit" name="go" value="Anzeigen">

                    <h2><?php echo $stunden;?> Stunden </h2>
                </form>
            </div>
                    </br>
                        <form action="" method="POST"> <button type="submit" name="userverwaltung"> zurück </button></form>
        </div>
        </fieldset>

    </div>

    </div>

    </body>
    <footer>
        <p id="Pfo">Copyright reamis ag</p>
    </footer>
    </html>
    </DOCTYPE>
<?php
}else{
header('Location: ../index.php');
}


