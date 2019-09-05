<?php
session_start();
if ($_POST['change'] == 'main'){
    header('Location: Mainpage.php');
}
if ($_POST['change'] == 'time'){
    header('Location: ../Zeiterfassung/Zeiterfassung.php');
}
///----- Dateien Holen -----///
require_once "../Config/config.php";
require_once "../Zeiterfassung/Class_Zeit.php";
///----- Variablen -----///
$s = new Zeit();
$userid = $_SESSION['userId'];

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
<body

<div class="cont">
    <div class="fc">
        <form action="" method="POST">
            <fieldset>
                <h2>Stundenübersicht</h2>
                <td>
                    <?php
                    $commsel = "SELECT * FROM `projekt`";
                    $query1 = $mysqli->query($commsel);

                    echo('<button type="submit" name="was" value="all"> Alle </button>');
                    while ($res = $query1->fetch_array()) {
                        $name = $res['projektname'];
                        $id = $res['projektId'];
                        echo('<button type="submit" name="was" value=' . $res['projektId'] . '> ' . $name . ' </button>');

                    }
                    ?>
                    <table>
                        <tr>
                            <?php
                            $order = 'datum';
                            $comm = ('SELECT * FROM `zeit` WHERE userId = ' . $userid . '  AND projektId =' . $_POST['was'] . ' ORDER BY ' . $order . ' ASC ');
                            $commall = ('SELECT * FROM `zeit` WHERE userId = ' . $userid . ' ORDER BY ' . $order . ' ASC ');

                            if (!$_POST['was'] || $_POST['was'] == 'all' || $_POST['num'] ) {
                                $query1 = $mysqli->query($commall);
                                while ($res1 = $query1->fetch_array()) {
                                    echo('<tr>');
                                    echo('<td>' . $res1['zeitId'] . '</td>');
                                    echo('<td>' . $res1['datum'] . '</td>');
                                    $startzeit = $res1['start'];         ///Rechnen zeit
                                    $endzeit = $res1['stop'];            ///Rechnen zeit
                                    $pause = $res1['pause'];            ///Rechnen zeit
                                    $s->arbeitszeit($startzeit, $endzeit, $pause);
                                    echo('<td>' . $tot_time . ' Stunden</td>');
                                    echo('<td>' . $res1['beschreibung'] . '</td>');
                                }
                            } elseif ($_POST['was'] = $_POST['was']) {
                                $query = $mysqli->query($comm);
                                while ($res = $query->fetch_array()) {
                                    echo('<tr>');
                                    echo('<td>' . $res['zeitId'] . '</td>');
                                    echo('<td>' . $res['datum'] . '</td>');
                                    $startzeit = $res['start'];         ///Rechnen zeit
                                    $endzeit = $res['stop'];            ///Rechnen zeit
                                    $pause = $res['pause'];            ///Rechnen zeit
                                    $s->arbeitszeit($startzeit, $endzeit, $pause);
                                    echo('<td>' . $tot_time . ' Stunden</td>');
                                    echo('<td>' . $res['beschreibung'] . '</td>');
                                }
                            }

                            ?>
                    </table>
                <div class='bls'>

                    <button type="submit" name="change" value="main"> zur Hauptseite zurück </button>
                    <button type="submit" name="change" value="time"> Stunden erfassen </button>


        </form>
        <form action="" method="post">
            <input type="number" name="entf" placeholder="Stunden Nummer" required>
            <button type="submit" name="del" value="del">Löschen</button>
        </form>
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

if (isset ($_POST['entf'])){
    echo $_POST['entf'];
    $commdel = 'DELETE FROM zeit WHERE zeitId = '.$_POST['entf'];
    $query = $mysqli->query($commdel);
}
