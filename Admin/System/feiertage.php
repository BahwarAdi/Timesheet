<?php
session_start();
require_once('../../Config/config.php');

if (isset($_POST['system'])) {
    header('Location: system.php');
}
#region verarbeitung

#region verarbeitung Feiertag Hinzufügen
if (isset($_POST['addFeiertag'])) {
    $feiertagName = $_POST['feiertagName'];
    $feiertagDatum = $_POST['feiertagDatum'];

    $mysqli->query("INSERT INTO feiertag (datum,feiertagName) VALUES ('$feiertagDatum','$feiertagName')");
}
#endregion
#region verarbeitung Feiertag Entfernen
elseif (isset($_POST['delFeiertag'])) {
    $feiertagId = $_POST['feiertagId'];


    $mysqli->query("DELETE FROM feiertag WHERE feiertagId = '$feiertagId'");
}
#endregion
#endregion
?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Feiertage</title>
        <link href="../../Style/StyleSheet.css" rel="stylesheet" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
    </head>
    <ul>
        <p id="Pul">TimeSheet Benutzer:<?php echo($_SESSION['vorname'] . $_SESSION['nachname']); ?></p>
    </ul>

    <body>
    <div class="cont">
        <div class="fc">
            <form action="" method="POST">
                <fieldset>
                    <h2>Feiertage</h2>
                    <div class="bls">
                        <div>
                            <form action="" method="post">
                                <h3>Feiertag Hinzufügen</h3>
                                <table>
                                    <tr>
                                        <td>
                                            Name:
                                        </td>
                                        <td>
                                            <input type="text" name="feiertagName">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Datum:
                                        </td>
                                        <td>
                                            <input type="date" name="feiertagDatum">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="submit" name="addFeiertag" value="Hinzufügen">
                                        </td>
                                        <td>
                                            <input type="reset">
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                        <div>
                            <form action="" method="post">
                                <h3>Feiertag Entfernen</h3>
                                <table>
                                    <tr>
                                        <td>
                                            Id:
                                        </td>
                                        <td>
                                            <input type="number" name="feiertagId">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="submit" name="delFeiertag" value="Entfernen">
                                        </td>
                                        <td>
                                            <input type="reset">
                                        </td>
                                    </tr>
                                </table>
                                <button type="submit" name="system"> System</button>
                            </form>
                        </div>
                        <div>
                            <table>
                                <tr>
                                    <th>
                                        Id
                                    </th>
                                    <th>
                                        Feiertag
                                    </th>
                                    <th>
                                        Datum
                                    </th>
                                </tr>

                                <?php

                                $res = $mysqli->query("SELECT feiertagId,feiertagName, datum FROM feiertag ORDER BY feiertagId");

                                while ($row = $res->fetch_assoc()) {

                                    echo('<tr>
          <td>' . $row['feiertagId'] . '</td>
          <td>' . $row['feiertagName'] . '</td>
          <td>' . $row['datum'] . '</td>
          </tr>');

                                }
                                ?>

                            </table>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
    </body>
    <footer>
        <p id="Pfo">Copyright reamis ag</p>
    </footer>
    </html>
<?php
