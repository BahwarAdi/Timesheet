<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
require_once "../Config/config.php";
require_once "../Zeiterfassung/Class_Zeit.php";

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
?>


<html>
<head>
    <title>Timesheet Projektübersicht</title>
    <link href="../Style/StyleSheet.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
</head>

<body>
<nav class="Nav">
    <p id="BnCol">Benutzer:<?php echo($_SESSION['vorname'] ." ". $_SESSION['nachname']);?></p>
    <p id="Pul">TimeSheet </p>
    <a id="logout" href='../../index.php'><button id="logoutb">Logout</button></a>
</nav>
<div class="cont" >
    <h2>Projektübersicht</h2>
    <div class="fc">
        <?php
        foreach ($data as $name => $chart) {
            ?>
            <form method="post" action="" style="text-align: center">
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
                                    'backgroundColor': 'transparent',
                                    'borderColor': 'black',
                                    'width': 300, 'height': 300,
                                    chartArea:{left:50,top:50,width:'75%',height:'75%'},
                                    legend: {position: 'bottom', textStyle: {color: 'white', fontSize: 12}},
                                    pieHole: 0.6,
                                    pieSliceBorderColor: 'transparent',
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
            </form>
            <?php
        }
        ?>
    </div>
    <div style="height:100px;">
        <form method="post">
            <button class="inputr" type="submit" name="back"> zur Hauptseite</button>
        </form>
        <div style="height:100px;">
            <form method="post">
            </form>
        </div>
    </div>

</body>
<footer>
    <p id="Pfo">Copyright reamis ag</p>
</footer>
</html>
