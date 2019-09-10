<?php
session_start();
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

/// $userId = $_SESSION['userId'];
/// $projektId = $_SESSION['projektId'];
//$comm = 'SELECT * FROM zeit WHERE userId IN ('.$userId.') AND projektId IN ('.$projektId.')';
//$commzeit = 'SELECT * FROM zeit WHERE datum >= "'.$datumstrat.'" AND datum <= "'.$datumstop.'"';


$commall = 'SELECT * FROM zeit WHERE userId IN ('.$userId.') AND projektId IN ('.$projektId.') AND datum >= "'.$datumstrat.'" AND datum <= "'.$datumstop.'"';
if ($_POST['go'] == 'Anzeigen'){
    $query = $mysqli->query($commall);

    while ($res = $query->fetch_assoc()){

        $z->arbeitszeit($res['start'],$res['stop'],$res['pause']);
        //echo($tot_time .'<br>');
        $stunden += $tot_time;
    }
}
?>


<html>
<head>
</head>
<body>
<div>
    <form action="stunden.php" method="post">

        <input type="text" name="projekt" > Projeckt ID
        <input type="text" name="user" > Benutzer ID
        <input type="date" name="start" required> Von (Datum)
        <input type="date" name="stop" required> Bis (Datum)
        <input type="checkbox" name="alleb" > Alle Benzuer
        <input type="checkbox" name="allepro" > Alle projekte

        <input type="submit" name="go" value="Anzeigen">

    </form>
</div>
</body>
</html>

<?php
echo $stunden;    //Total stunden pro projekt und user
