<?php
///----- Datei holen -----/////
session_start();
require_once "../Config/config.php";
if ($_POST['time'] == 'time'){
    header('Location: ../Pages/Stundenubersicht.php');
}
///----- Welcher Benutzer -----///
$userId = $_SESSION['userId'];    //abfrage welche user eingelogt ist

///----- Variablen -----///
if($_POST['save'] == 'save')
{
    $kalenderwoche = $_POST['kalenderwoche'];
    $datum = $_POST['datum'];
    $start = $_POST['start'];
    $stop = $_POST['stop'];
    $pause = $_POST['pause'];
    $beschreibung = $_POST['beschreibung'];
    $projekt = $_POST['projekt'];

    ///----- SQL Befehle -----///
    $prRes = $mysqli->query("SELECT projektId FROM projekt WHERE projektname LIKE '$projekt' ");
    $prArray = $prRes->fetch_assoc();
    $projektId = $prArray['projektId'];

    $commins = "INSERT INTO zeit (userId, projektId, kw, datum, start, stop, pause,beschreibung) VALUES ( $userId , $projektId,$kalenderwoche ,'$datum','$start','$stop','$pause','$beschreibung')";
    $mysqli->query($commins);
    if($mysqli->error){
        echo('Fehler'. $mysqli->error);
    }
}


///----- Projecktauswal -----///
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
        <form action="" method="POST">
            <fieldset>
                <h2>Hauptseite</h2>
                <div class='bls'>
                    <form action="" method="post">
                        <table>
                            <tr>
                                <th>Datum</th>
                                <th>Kalenderwoche</th>
                                <th>Start</th>
                                <th>Stop</th>
                                <th>Pause</th>
                                <th>Projekt</th>
                                <th>Beschreibung</th>
                            </tr>
                            <tr>
                                <td><input type="date" name="datum" required> </td>
                                <td><input type="number" name="kalenderwoche" required> </td>
                                <td><input type="time" name="start" required> </td>
                                <td><input type="time" name="stop" required> </td>
                                <td><input type="time" name="pause"></td>
                                <td><select name="projekt"  required >
                                        <?php
                                        $commsel = "SELECT * FROM `projekt` WHERE archiviert LIKE 'false'";
                                        $query = $mysqli->query($commsel);
                                        while ($res = $query->fetch_array()){
                                            echo('<option>'. $res['projektname'] .'</option>');
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td><input type="text" name="beschreibung" placeholder="Beschreibung" required></td>
                            </tr>
                        </table>
                        <button type="submit" name="save" value="save">Speichern</button>
                    </form>


        <form action="" method="post"><button type="submit" name="time" value="time"> Stundenübersicht </button></form>
                </div>
            </fieldset>
        </form>
    </div>

</div>

</body>
<footer>
    <p id="Pfo">Copyright reamis ag</p>
</footer>
</html>
</DOCTYPE>
