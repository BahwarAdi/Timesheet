<?php
///----- Datei holen -----///
require_once "../Config/config.php";

///----- Welcher Benutzer -----///
$userId = 1;    //abfrage welche user eingelogt ist  zum testen "1"

///----- Variablen -----///
if(isset($_POST['Speichern']))
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
$commsel = "SELECT * FROM `projekt`";
$projekt = $mysqli->query($commsel);
?>

<html>
<head>
</head>
<body>
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
                        while ($res = $projekt->fetch_array()){
                            echo('<option>'. $res['projektname'] .'</option>');
                        }
                        ?>
                    </select>
                </td>
                <td><input type="text" name="beschreibung" placeholder="Beschreibung" required></td>
            </tr>
        </table>
        <button type="submit" name="Speichern">Speichern</button>
</form>
</body>
</html>
