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
$commall = 'SELECT * FROM zeit WHERE username '.$userId.' AND projektname = '.$projektId.' AND datum >= "'.$datumstrat.'" AND datum <= "'.$datumstop.'"';
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
            <form action="stunden.php" method="post">


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
                        echo('<option>'. $res['vorname'] .' '. $res['nachname'] .'</option>');
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



