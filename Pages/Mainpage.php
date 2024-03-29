<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);
require_once "../Config/config.php";
require_once "../Zeiterfassung/Class_Zeit.php";
if (isset($_SESSION) && $_SESSION['user'] == "user" || $_SESSION['user'] == "admin"){
//--------------------------------
$z = new Zeit();

/// ----- Abfrage ----- ///
$query = $mysqli->query('SELECT * FROM zeit 
LEFT JOIN user ON zeit.userId = user.userId
LEFT JOIN projekt ON zeit.projektId = projekt.projektId 
WHERE projekt.archiviert = \'FALSE\'
ORDER BY zeit.projektId ASC, zeit.userId ASC;
');

// Holt alle Daten in ein Array namens Rows.
$rows = array();
while ($res = $query->fetch_assoc()) {
    if($res['pause'] ==''){$res['pause'] = "00:00:00";}
    $rows[] = $res;
}
// Daten verarbeiten
$data = array();
foreach ($rows as $entry) {
    $data[$entry['projektname']][$entry['vorname'].' '.$entry['nachname']] += $z->arbeitszeitcharts($entry['start'], $entry['stop'], $entry['pause']);
}
// Daten in Charts ausgeben



//------------------------------
if (isset($_POST['system'])){
    header('Location: ../Admin/System/system.php');
}
if (isset($_POST['time'])) {
    header('Location: Stundenubersicht.php');
}
if (isset($_POST['Charts'])) {
    header('Location: Charts.php');
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


<body>
<nav class="Nav">
    <div class='placeholder'></div>
    <div class='innerdiv'>
        <div class='innderdivflex'>
            <p id="BnCol">
                <a class='UVlink' href='../Admin/User/Userverwaltung.php'>Benutzer:<?php echo($_SESSION['vorname'] . " " . $_SESSION['nachname']); ?></a> |
                <a class='UVlink' href='../Admin/Projekte/projekterfassung.php'>Projkte</a> </p>
            <p id="Pul">TimeSheet </p>
            <a id="logout" href='./../index.php'>
                <button id="logoutb">Logout</button>
            </a>
        </div>
    </div>
    <div class='placeholder'></div>
</nav>
    <div class='InContainer'>
        <h2 class="Mh2">Projkte</h2>
            <div class="MainRes">
                        <?php
                        if ($_SESSION['user'] == "admin"){
                            ?>
                            <?php
                            foreach ($data as $name => $chart) {
                                ?>
                                    <div class="chart" id="piechart<?php echo $name; ?>">
                                        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                                        <div>
                                            <script type="text/javascript">
                                                google.charts.load('current', {'packages': ['corechart']});
                                                google.charts.setOnLoadCallback(drawChart);
                                                function drawChart() {
                                                    var data = google.visualization.arrayToDataTable([
                                                        ['Task', '<?php echo($name);?>'],
                                                        <?php
                                                        foreach ($chart as $innername => $innerdata){
                                                            echo("['".$innername."', ".$innerdata."],");
                                                        }
                                                        ?>
                                                    ]);
                                                    var options = {
                                                        'title': '<?php echo($name);?>',
                                                        colors: ['#939CDC','#29368A','#465ADD'],
                                                        'backgroundColor': '',
                                                        'borderColor': 'black',
                                                        'width': 300, 'height': 300,
                                                        chartArea:{left:50,top:50,width:'75%',height:'75%'},
                                                        legend: {position: 'bottom', textStyle: {color: 'white', fontSize: 12}},
                                                        pieHole: 0.7,
                                                        pieSliceBorderColor: '',
                                                        titleTextStyle:{
                                                            color: 'white',
                                                            bold: true,
                                                            fontSize: 25,
                                                        }
                                                    };
                                                    var chart = new google.visualization.PieChart(document.getElementById('piechart<?php echo $name; ?>'));
                                                    chart.draw(data, options);
                                                }
                                            </script>
                                        </div>
                                    </div>

                                <?php
                            }
                            ?>

                            <?php
                        }
                        elseif ($_SESSION['user'] == "user"){
                            ?>
                            <button class="inputr" id="BuSize" type="submit" name="userverwaltung"> Userverwaltung </button>
                            <button class="inputr" id="BuSize" type="submit" name="time"> Stundenübersicht </button>
                            <button class="inputr" id="BuSize" type="submit" name="Charts"> Projektübersicht </button>
                            <?php
                        }
                        ?>
            </div>
    </div>

</body>
<footer>
    <p id="Pfo">Copyright reamis ag</p>
</footer>
</html>
</DOCTYPE>
    <?php

}
else{
    session_destroy();
    header('Location: ../index.php');
}
?>
<script>

</script>
