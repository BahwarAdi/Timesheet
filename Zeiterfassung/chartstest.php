<?php
session_start();
require_once "../Config/config.php";
require_once  "../Zeiterfassung/Class_Zeit.php";


$z = new Zeit();

/// ----- Test Charts ----- ///
$query = $mysqli->query('SELECT * FROM zeit 
LEFT JOIN user ON zeit.userId = user.userId
LEFT JOIN projekt ON zeit.projektId = projekt.projektId

ORDER BY zeit.projektId ASC, zeit.userId ASC;
');

// Holt alle Daten in ein Array namens Rows.
$rows = array();
while($res = $query->fetch_assoc()){
    $rows[] = $res;
}

// Daten verarbeiten
$data = array();
foreach($rows as $entry){
    $data[$entry['projektname']][$entry['nachname']] += $z->arbeitszeit($entry['start'], $entry['stop'], $entry['pause']);
}

// Daten in Charts ausgeben
foreach($data as $name => $chart){
    echo($name);
    echo("<br />");
    var_dump($chart);
    echo("<br />");



}




function getHoursFromUsers($user){


}

$comm1 = 'SELECT * FROM zeit WHERE userId = 6 AND projektId = 1';
$a = 0;
    $query = $mysqli->query($comm1);
    while ($res = $query->fetch_assoc()){
        $z->arbeitszeit($res['start'],$res['stop'],$res['pause']);
        $a += $tot_time;
}

$comm2 = 'SELECT * FROM zeit WHERE userId = 4 AND projektId = 1';
$b = 0;
$query = $mysqli->query($comm2);
while ($res = $query->fetch_assoc()){
    $z->arbeitszeit($res['start'],$res['stop'],$res['pause']);
    $b += $tot_time;
}

?>

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Projekt1'],
          ['user 6',     <?php echo $a ?>],
          ['user 4',      <?php echo $b ?>],
        ]);

        var options = {
          title: 'Ptojekt 1',
          pieHole: 0.5,
            colors: [],
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="donutchart" style="width: 900px; height: 500px;"></div>
  </body>
</html>
