<?php
session_start();
if (isset($_POST['main'])) {
    header('Location: ../../Pages/Mainpage.php');
}
require_once('../../Config/config.php');

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
    <ul>
        <p id="Pul">TimeSheet Benutzer:<?php echo($_SESSION['vorname'] . $_SESSION['nachname']);?></p>
    </ul>
    <body>

    <div class="cont">
        <div class="fc">
            <form action="" method="POST">
                <fieldset>
                    <h2>Projekterfassung</h2>
                    <div class='bls'>
                        <div>
                            <form action="" method="post">
                                <h3>Projekt Hinzufügen</h3>
                                <table>
                                    <tr>
                                        <td>
                                            Projektname:
                                        </td>
                                        <td>
                                            <input type="text" name="projektName">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Beschreibung:
                                        </td>
                                        <td>
                                            <input type="text" name="projektBeschreibung">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="submit" name="projekt" value="Hinzufügen">
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
                                <h3>Projekt Archivieren</h3>
                                <table>
                                    <tr>
                                        <td>
                                            Projektname:
                                        </td>
                                        <td>
                                            <input type="text" name="projektName">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="submit" name="archiv" value="Hinzufügen">
                                        </td>
                                        <td>
                                            <input type="reset">
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                        <div>
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
          </tr>');

                                }
                                ?>

                            </table>
                        </div>
                        <button type="submit" name="main"> Hauptseite </button>
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
    </DOCTYPE>
<?php
