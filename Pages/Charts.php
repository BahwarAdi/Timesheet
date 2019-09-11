<?php
session_start();
if(isset($_SESSION['user'])) {
require_once "../Config/config.php";
require_once "../Zeiterfassung/Class_Zeit.php";


$z = new Zeit();


if (isset($_POST['back'])) {
    header('Location: Mainpage.php');
}

/// ----- Test Charts ----- ///
$query = $mysqli->query('SELECT * FROM zeit 
LEFT JOIN user ON zeit.userId = user.userId
LEFT JOIN projekt ON zeit.projektId = projekt.projektId 
WHERE projekt.archiviert = \'FALSE\'

ORDER BY zeit.projektId ASC, zeit.userId ASC;
');

// Holt alle Daten in ein Array namens Rows.
$rows = array();
while ($res = $query->fetch_assoc()) {
    $rows[] = $res;
}

// Daten verarbeiten
$data = array();
foreach ($rows as $entry) {
    $data[$entry['projektname']][$entry['nachname']] += $z->arbeitszeit($entry['start'], $entry['stop'], $entry['pause']);
}
// Daten in Charts ausgeben
foreach ($data

as $name => $chart) {
?>

<html>
<head>
    <title>Timesheet Projektübersicht</title>
    <link href="../Style/StyleSheet.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
</head>
<ul>
    <p id="Pul">TimeSheet Benutzer:<?php echo($_SESSION['vorname'] . '' . $_SESSION['nachname']); ?></p>
</ul>

<body>

<div class="cont">
    <div class="fc">
        <form action="" method="POST">
            <fieldset>
                <h2>Projektübersicht</h2>
                <div class='bls'>
                    <button type="submit" name="back"> zur Hauptseite</button>
                </div>
                <table>
                    <tr>
                        <div class="chart" id="piechart<?php echo $name; ?>">

                            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                            <div class="chart">
                                <script type="text/javascript">
                                    google.charts.load('current', {'packages': ['corechart']});
                                    google.charts.setOnLoadCallback(drawChart);

                                    function drawChart() {
                                        var data = google.visualization.arrayToDataTable([
                                            ['Task', '<?php echo($name);?>'],
                                            ['User 6', <?php echo($chart['Peter']);?> ],
                                            ['User 4', <?php echo($chart['Bertolf']);?> ],
                                        ]);
                                        var options = {
                                            'title': '<?php echo($name);?>',
                                            colors: ['#333', '#4b4c50'],
                                            'backgroundColor': 'transparent',
                                            'width': 500, 'height': 500,
                                        };

                                        var chart = new google.visualization.PieChart(document.getElementById('piechart<?php echo $name; ?>'));
                                        chart.draw(data, options);
                                    }
                                </script>
                    </tr>
    </div>
    </table>
</div>
<?php
}
?>

</fieldset>
</form>
</div>


</body>
<footer>
    <p id="Pfo">Copyright reamis ag</p>
</footer>
</html>
<?php
}else{
header('Location: ../index.php');
}


