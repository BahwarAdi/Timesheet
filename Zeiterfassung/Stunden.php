<?php
session_start();
if(isset($_SESSION['user'])) {
    require_once "../Config/config.php";
    require_once  "../Zeiterfassung/Class_Zeit.php";

    $z = new Zeit();
    $stunden = 0;

    $datumstrat = $_POST['start'];
    $datumstop = $_POST['stop'];
    $userId = $_POST['user'];
    $projektId = $_POST['projekt'];
    if (isset($_POST['alleb'])){
        $userId = '1,2,3,4,5,6,7,8,9';
    }
    if (isset($_POST['allepro'])){
        $projektId = '1,2,3,4,5,6,7,8,9';
    }
    $commall = 'SELECT * FROM zeit LEFT JOIN user ON zeit.userId = user.userId LEFT JOIN projekt ON zeit.projektId = projekt.projektId WHERE user.vorname ="'.$userId.'" AND projekt.projektname = '.$projektId.' AND datum >= "'.$datumstrat.'" AND datum <= "'.$datumstop.'"';
    if ($_POST['go'] == 'Anzeigen'){
        $query = $mysqli->query($commall);

        while ($res = $query->fetch_assoc()){

            $z->arbeitszeit($res['start'],$res['stop'],$res['pause']);
            $stunden += $tot_time;
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
<body>
    <nav>
        <p id="Pul">TimeSheet Benutzer:<?php echo($_SESSION['vorname'] ." ". $_SESSION['nachname']);?></p>
        <a id="logout" href='./../index.php'><button id="logoutb">Logout</button></a>
    </nav>
    <div class="flex">
        <div class="flexitem">


                <form class="stundenform" action="stunden.php" method="post">
                    <h2>Stunden Anzeigen</h2>
                    <div class="stundenformulardiv">
                        <select class="inputr" name="projekt"  required>
                            <?php
                            $commsel = "SELECT * FROM `projekt`WHERE archiviert = 'FALSE'";
                            $query = $mysqli->query($commsel);
                            while ($res = $query->fetch_array()){
                                echo('<option>'. $res['projektname'] .'</option>');
                            }
                            ?>
                        </select>
                        <select class="inputr" name="user"  required>
                            <?php
                            $commsel = "SELECT * FROM user";
                            $query = $mysqli->query($commsel);
                            while ($res = $query->fetch_array()){
                                echo('<option>'. $res['vorname'] .'</option>');
                            }
                            ?>
                        </select>
                        <input class="inputr" type="date" name="start" required>
                        <input class="inputr" type="date" name="stop" required>
                        <button class="loginbut" type="submit" name="go" value="Anzeigen">Anzeigen</button>
                    </div>
                    <h2><?php echo $stunden;?> Stunden </h2>
                </form>

        </div>
    </div>

    </body>
    <footer>
        <p id="Pfo">Copyright reamis ag</p>
    </footer>
    </html>

<?php
}else{
header('Location: ../index.php');
}


