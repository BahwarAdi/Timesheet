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
        <div class='placeholder'></div>
        <div class='innerdiv'>
            <div class='innderdivflex'>
                <p id="BnCol">
                    <a class='UVlink' href='../Admin/User/Userverwaltung.php'>Benutzer:<?php echo($_SESSION['vorname'] . " " . $_SESSION['nachname']); ?></a> |
                    <a class='UVlink' href=''>Projkte</a> </p>
                <p id="Pul">TimeSheet </p>
                <a id="logout" href='../../index.php'>
                    <button id="logoutb">Logout</button>
                </a>
            </div>
        </div>
        <div class='placeholder'></div>
    </nav>
    <div class="PlHa"></div>
    <div class="InContainer">
        <form class="ProForItem" action="" method="POST">
            <h2 class="ProHed">Projekterfassung</h2>
            <div class="ProForInpItem">
                <div class="InputItem">
                    <h3>Projekt Hinzufügen/Archivieren</h3>
                    <label for="projektName">Projektname</label>
                    <input class="inputr" type="text" name="projektName" id="projektName">

                    <label for="Beschreibung">Beschreibung</label>
                    <input class="inputr" type="text" name="projektBeschreibung" id="Beschreibung">

                    <input class="ProForInput" type="submit" name="projekt" value="Hinzufügen">
                    <input class="ProForInput" type="submit" name="archiv" value="Archivieren">
                </div>
            </div>
            <div class="ProForButtItem">
                <button class="ProeButton" type="reset">Zurücksetzen</button>
                <button class="ProeButton" type="submit" name="main">Hauptseite</button>
            </div>
            <div class="PTablescroll">
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

                    $res = $mysqli->query("SELECT projektname, beschreibung FROM projekt ORDER BY projektId");

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
        </form>
    </div>
    <footer>
        <p id="Pfo">Copyright reamis ag</p>
    </footer>
    </body>
    </html>
    <?php
} else {
    header('Location: ../../index.php');
}
