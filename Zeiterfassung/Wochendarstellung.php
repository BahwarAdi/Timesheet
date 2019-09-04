<?php
///----- Dateien Holen -----///
require_once "../Config/config.php";
require_once "Class_Zeit.php";
session_start();
///----- Variablen -----///
$s = new Zeit();
$userid = 1;  //$_SESSION['userId'];
?>

<html>
<head>
    <style>table, th, td {
            border: 1px solid rgba(108, 0, 56, 0.74);
            border-collapse: collapse;
            background: gainsboro;
            padding: 2px;
        }</style>
</head>
<body>
<Form method="post">
    <td>
        <?php
        $commsel = "SELECT * FROM `projekt`";
        $query1 = $mysqli->query($commsel);

        echo('<button type="submit" name="was" value="all"> Alle </button>');
        while ($res = $query1->fetch_array()) {
            $name = $res['projektname'];
            $id = $res['projektId'];
            echo('<button type="submit" name="was" value='.$res['projektId'].'> ' . $name . ' </button>');

        }
        var_dump($_POST['was']);
        ?>
</form>
<fieldset>
    <table>
        <tr>
            <?php
            $order = 'datum';
            $projektid = $_SESSION['projekt'];
            $comm = ('SELECT * FROM `zeit` WHERE userId = ' . $userid . '  AND projektId ='.$_POST['was'].' ORDER BY ' . $order . ' ASC ');
            $commall = ('SELECT * FROM `zeit` WHERE userId = ' . $userid . ' ORDER BY ' . $order . ' ASC ');

            if(!$_POST ||$_POST['was']== 'all'){
                $query1 = $mysqli->query($commall);
            while ($res1 = $query1->fetch_array()) {
                echo('<tr>');
                echo('<th>' . $res1['zeitId'] . '</th>');
                echo('<th>' . $res1['datum'] . '</th>');
                $startzeit = $res1['start'];         ///Rechnen zeit
                $endzeit = $res1['stop'];            ///Rechnen zeit
                $pause = $res1['pause'];            ///Rechnen zeit
                $s->arbeitszeit($startzeit, $endzeit, $pause);
                echo('<th>' . $tot_time . ' Stunden</th>');
                echo('<th>' . $res1['beschreibung'] . '</th>');
            }
            }
            elseif ($_POST['was']= $_POST['was']){
                $query = $mysqli->query($comm);
                while ($res = $query->fetch_array()) {
                    echo('<tr>');
                    echo('<th>' . $res['zeitId'] . '</th>');
                    echo('<th>' . $res['datum'] . '</th>');
                    $startzeit = $res['start'];         ///Rechnen zeit
                    $endzeit = $res['stop'];            ///Rechnen zeit
                    $pause = $res['pause'];            ///Rechnen zeit
                    $s->arbeitszeit($startzeit, $endzeit, $pause);
                    echo('<th>' . $tot_time . ' Stunden</th>');
                    echo('<th>' . $res['beschreibung'] . '</th>');
                }
            }

            ?>
    </table>
</fieldset>
<form method="post">
    <?php
    $comdel = "DELETE FROM zeit WHERE zeitId = $id";
    ?>
    <input type="number" name="value">
    <button>Löschen</button>
</form>
</body>
</html>

