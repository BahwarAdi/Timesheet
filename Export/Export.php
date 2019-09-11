<?php
session_start();
require_once "../Config/config.php";
require_once "../Zeiterfassung/Class_Zeit.php";
$z = new Zeit();

$comm = "SELECT user.vorname, user.nachname, projekt.projektname, zeit.datum, zeit.`start`,zeit.`stop`, zeit.pause FROM zeit 
LEFT JOIN user ON zeit.userId = user.userId
LEFT JOIN projekt ON zeit.projektId = projekt.projektId 
WHERE datum BETWEEN '2019-09-01' AND '2019-09-20'
ORDER BY datum";

$query = $mysqli->query($comm);
$rows = array();

while ($res = $query->fetch_assoc()) {
    $rows[] = $res;
}

$data = array();
foreach ($rows as $text) {
    $data[$text['vorname']].[$text['nachname']].[$text['projektname']].[$text['datum']] += $z->arbeitszeit($text['start'], $text['stop'], $text['pause']);

    var_dump($data.'</BR>');
}
// Daten in Charts ausgeben


//$fp = fopen('daten.csv', 'a');
//
//foreach ($daten as $arrays) {
//    fputcsv($fp, $arrays);
//}
//
//fclose($fp);

