<?php
session_start();
if (isset($_SESSION['user'])) {
    require_once('../../Config/config.php');

    if (isset($_POST['main'])) {
        header('Location: ../../Pages/Mainpage.php');
    }
    if (isset($_POST['projekt'])) {
        $projektName = $_POST['projektName'];
        $projektBeschreibung = $_POST['projektBeschreibung'];

        $mysqli->query("INSERT INTO projekt (projektname,beschreibung,archiviert) VALUES ('$projektName','$projektBeschreibung','false')");
    } elseif (isset($_POST['archiv'])) {
        $projektName = $_POST['projektName'];

        $mysqli->query("UPDATE projekt SET archiviert = 'true' WHERE projektname LIKE '$projektName'");
    }

    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Timesheet Main Page</title>
        <link href="../../Style/StyleSheet.css" rel="stylesheet" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
    </head>

    <body>
    <nav class="Nav">
        <p id="BnCol">Benutzer:<?php echo($_SESSION['vorname'] . " " . $_SESSION['nachname']); ?></p>
        <p id="Pul">TimeSheet</p>
        <a id="logout" href='../../index.php'>
            <button id="logoutb">Logout</button>
        </a>
    </nav>
    <div class="I">
        <div class="fc">
            <form class="projekteerform" action="" method="POST">
                <h2>Projekterfassung</h2>
                    <div class='plsProjekte'>
                        <div class=feiertageent>
                            <h3>Projekt Hinzufügen</h3>

                            <label for="projektName">Projektname</label>
                            <input class="inputr" type="text" name="projektName" id="projektName">

                            <label for="Beschreibung">Beschreibung</label>
                            <input class="inputr" type="text" name="projektBeschreibung" id="Beschreibung">

                            <input class="inputr" type="submit" name="projekt" value="Hinzufügen">
                            <input class="inputr" type="reset">
                        </div>

                        <div class="feiertageent">
                            <h3>Projekt Archivieren</h3>

                            <label for="projektName">Projektname</label>
                            <input class="inputr" type="text" name="projektName" id="projektName">

                            <input class="inputr" type="submit" name="archiv" value="Archivieren">
                            <input class="inputr" type="reset">
                            <button class="inputr" type="submit" name="main"> Hauptseite</button>
                        </div>

                        <div class="Tablescroll">
                            <table>
                                <tr>
                                    <th>
                                        Projektname
                                    </th>
                                    <th>
                                        Beschreibung
                                    </th>
                                </tr>

                                <?php

                                $res = $mysqli->query("SELECT projektname, beschreibung FROM projekt WHERE archiviert LIKE 'false' ORDER BY projektId");

                                while ($row = $res->fetch_assoc()) {

                                    echo('<tr>
                                              <td>' . $row['projektname'] . '</td>
                                              <td>' . $row['beschreibung'] . '</td>
                                          </tr>
                                    ');

                                }
                                ?>
                            </table>
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
