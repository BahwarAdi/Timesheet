<!DOCTYPE html>
<html lang="en-US">
<body>
<nav>
    <p id="Pul">TimeSheet Benutzer:<?php echo($_SESSION['vorname'] ." ". $_SESSION['nachname']);?></p>
    <a id="logout" href='../../index.php'><button id="logoutb">Logout</button></a>
</nav>
<?php
session_start();
if(isset($_SESSION['user'])) {
require_once "../Config/config.php";
require_once "../Zeiterfassung/Class_Zeit.php";


$z = new Zeit();

/// ----- Test Charts ----- ///
$query = $mysqli->query("SELECT * FROM zeit 
LEFT JOIN user ON zeit.userId = user.userId
LEFT JOIN projekt ON zeit.projektId = projekt.projektId 
WHERE projekt.archiviert = 'FALSE'

ORDER BY zeit.projektId ASC, zeit.userId ASC;
");

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
foreach ($data as $name => $chart) {
    ?>
    <div id="piechart<?php echo $name; ?>"></div>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Task', '<?php echo($name);?>'],
                ['User 6', <?php echo($chart['Peter']);?> ],
                ['User 4', <?php echo($chart['Bertolf']);?> ],
            ]);
            var options = {'title':'<?php echo($name);?>',
                colors: ['#333', '#4b4c50'],
                'width':550, 'height':400,
                pieHole: 0.5};
            var chart = new google.visualization.PieChart(document.getElementById('piechart<?php echo $name; ?>'));
            chart.draw(data, options);
        }
    </script>
<?php
}

$daten = $rows;

$fp = fopen('daten.csv', 'a');

foreach ($daten as $arrays) {
    fputcsv($fp, $arrays);
}

fclose($fp);

?>
</body>
</html>
<?php
}else{
    header('Location: ../index.php');
}
