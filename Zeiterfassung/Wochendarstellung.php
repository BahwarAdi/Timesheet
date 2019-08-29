<?php
require_once "../Config/config.php";
$day = array('Montag','Dienstag','Mittwoch','Wonnerstag','Freitag','Samstag','Sonntag',);
$kw = '1';
?>

<html>
<head><style>table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            background: gainsboro;
            padding: 2px;
        }</style>
</head>
<body>
    <form action="" method="post">
        <table>
            <tr>
                <th> KW<?php echo($kw);  ?></th>
            </tr>
            <tr>
                <th>Projekt</th>
                <th>Montag</th>
                <th>Dienstag</th>
                <th>Mittwoch</th>
                <th>Donnerstag</th>
                <th>Freitag</th>
                <th>Samstag</th>
                <th>Sonntag</th>
            </tr>
            <?php
            $pro = $mysqli->query("SELECT projektname FROM projekt");
            while ($res = $pro->fetch_assoc()){
                echo('<tr><td>'.$res['projektname'].'</td>');
                    foreach ($day as $time) {
                    echo('<td><input style="width:50px" type="number" value="' . $_POST[$time . 'zeit'] . '" name="' . $time . 'zeit"></td>');
                    }
                    ' </tr>';
                     }
                     ?>
        </table>
        <button type="submit">Speichern</button>
</form>
</body>
</html>

