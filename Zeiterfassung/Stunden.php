<?php//
session_start();
require_once "../Config/config.php";
require_once  "../Zeiterfassung/Class_Zeit.php";
$z = new Zeit();
//$userId = $_SESSION['userId'];
//$projektId = $_SESSION['projektId'];
$stunden;
$userId = '1';
$projektId = '1';
$comm = 'SELECT * FROM zeit WHERE userId = '.$userId.' AND projektId = '.$projektId;
$query = $mysqli->query($comm);

while ($res = $query->fetch_assoc()){

    $z->arbeitszeit($res['start'],$res['stop'],$res['pause']);
    echo($tot_time .'<br>');
    $stunden += $tot_time;
}
echo $stunden;    //Total stunden pro projekt und user

