<?php
///----- Dateien Holen -----///
require_once "../Config/config.php";
require_once "Class_Zeit.php";
session_start();

///----- Variablen -----///
$s = new Zeit();
$userid = 1;  //$_SESSION['userId'];
$order = 'datum';

?>

<html>
<head><style>table, th, td {
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
            while ($res = $query1->fetch_array()){
                $name = $res['projektname'];
                $id = $res['projektId'];
                echo('<button type="submit" name="name" value="'.$id.'"> '.$name.' </button>');
            }
            ?>
</form>
<fieldset>
<table>
    <tr>
    <?php

    $projektid = ($_POST['name']);
    $comm =  ('SELECT * FROM `zeit` WHERE userId = '.$userid.'  AND projektId ='.$projektid.' ORDER BY '.$order.' ASC ');
    $query = $mysqli->query($comm);
    while ($res = $query->fetch_array()){
        echo('<tr>');
        echo ('<th>' . $res['datum']. '</th>');
        $startzeit = $res['start'];         ///Rechnen zeit
        $endzeit = $res['stop'];            ///Rechnen zeit
        $pause  = $res['pause'];            ///Rechnen zeit
        $s->arbeitszeit($startzeit,$endzeit,$pause );
        echo ('<th>' . $tot_time.' Stunden</th>');
        echo ('<th>' . $res['beschreibung']. '</th>');
}
    ?>
</table>
    </fieldset>






</body>
</html>

