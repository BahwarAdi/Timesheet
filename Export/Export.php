<?php
session_start();
require_once "../Config/config.php";
require_once "../Zeiterfassung/Class_Zeit.php";
date_default_timezone_set("Europe/Berlin");
$timestamp = time();

$z = new Zeit();

$titel = array('Vorname', 'Nachname', 'Projektname', 'Datum', 'Startzeit', 'Endzeit', 'Pausen', 'Arbeitszeit');
$stunden = array();

$comm = "SELECT user.vorname, user.nachname, projekt.projektname, zeit.datum, zeit.`start`,zeit.`stop`, zeit.pause FROM zeit
LEFT JOIN user ON zeit.userId = user.userId
LEFT JOIN projekt ON zeit.projektId = projekt.projektId
WHERE datum BETWEEN '".$_POST['von']."' AND '".$_POST['bis']."'
ORDER BY datum";



if (isset($_POST['go'])){


    $query = $mysqli->query($comm);
    $rows = array();
    while ($res = $query->fetch_assoc()) {
        $rows[] = $res;
    }
    foreach ($rows as $text) {
        $stunden[] = array(
            $text['vorname'],
            $text['nachname'],
            $text['projektname'],
            $text['datum'],
            $text['start'],
            $text['stop'],
            $text['pause'],
            $z->arbeitszeitcharts($text['start'], $text['stop'], $text['pause'])
        );
    }

    $fp = fopen('../Stundenexport.csv', 'w');
    fputcsv($fp, $titel);
    foreach ($stunden as  $text) {
        fputcsv($fp, $text);
    }
    fclose($fp);
}
?>

<html xmlns="http://www.w3.org/1999/xhtml" lang='de'>
<head>
    <title>reamis export</title>
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
                <h2>Export</h2>
                    <div class='bls'>
                        <input type="date" name="von" >
                        <input type="date" name="bis" >
                        <button type="submit" name="go" >Exportieren</button>
                        <button><a href="../Stundenexport.csv">Speichern</a></button>

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

