<?php
session_start();
if (isset($_SESSION['user'])) {
    require_once('../../Config/config.php');

    if (isset($_POST['system'])) {
        header('Location: system.php');
    }
#region verarbeitung

#region verarbeitung Feiertag Hinzufügen
    if (isset($_POST['addFeiertag'])) {
        $feiertagName = $_POST['feiertagName'];
        $feiertagDatum = $_POST['feiertagDatum'];

        $mysqli->query("INSERT INTO feiertag (feiertagName, datum) VALUES ('$feiertagName','$feiertagDatum')");
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

    <body>
    <nav>
        <p id="Pul">TimeSheet Benutzer:<?php echo($_SESSION['vorname'] . " " . $_SESSION['nachname']); ?></p>
        <a id="logout" href='../../index.php'>
            <button id="logoutb">Logout</button>
        </a>
    </nav>
    <div class="cont">
        <div class="fc">
            <form class="feiertageform" action="" method="POST">
                <h2>Feiertage</h2>
                <div class="plsFreirtage">

                    <div class="feiertagehinzu">

                            <h3>Feiertag Hinzufügen</h3>
                            <label for="feiertagName">Name</label>
                            <input class="inputr" type="text" name="feiertagName" id="feiertagName">

                            <label for="feiertagDatum">Datum</label>
                            <input class="inputr" type="date" name="feiertagDatum" id="feiertagDatum">

                            <input class="loginbut" type="submit" name="addFeiertag" value="Hinzufügen">
                    </div>

                    <div class="feiertageent">

                            <h3>Feiertag Entfernen</h3>

                            <label for="feiertagId">ID</label>

                            <input class="inputr" type="number" name="feiertagId" id="feiertagId">

                        <input class="loginbut" type="submit" name="delFeiertag" value="Entfernen">
                    </div>

                    <div class="Tablescroll">
                        <table>
                            <tr>
                                <th>
                                    Id
                                </th>
                                <th>
                                    Datum
                                </th>
                                <th>
                                    Feiertag
                                </th>

                            </tr>

                            <?php

                            $res = $mysqli->query("SELECT feiertagId, datum, feiertagName FROM feiertag ORDER BY feiertagId");

                            while ($row = $res->fetch_assoc()) {

                                echo('<tr>
                                              <td>' . $row['feiertagId'] . '</td>
                                              <td>' . $row['datum'] . '</td>
                                               <td>' . $row['feiertagName'] . '</td>
                                      </tr>
                                    ');

                            }
                            ?>

                        </table>
                    </div>
                    <div class="feiertagebot">
                        <button class="loginbut" type="submit" name="system"> System</button>
                        <input class="loginbut" type="reset">
                    </div>

                </div>

            </form>
        </div>
    </div>
    </body>
    <footer>
        <p id="Pfo">Copyright reamis ag</p>
    </footer>
    </html>
    <?php

} else {
    header('Location: ../../index.php');
}
