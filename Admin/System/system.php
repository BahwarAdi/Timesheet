<?php
session_start();
require_once('../../Config/config.php');

if( isset($_POST['projekt']))
{
    $projektName = $_POST['projektName'];
    $projektBeschreibung = $_POST['projektBeschreibung'];

    $mysqli->query("INSERT INTO projekt (projektname,beschreibung,archiviert) VALUES ('$projektName','$projektBeschreibung','false')");
}
elseif(isset($_POST['archiv']))
{
    $projektName = $_POST['projektName'];

    $mysqli->query("UPDATE projekt SET archiviert = 'true' WHERE projektname LIKE '$projektName'");
}


?>
    <body>
    <main>
        <div>
            <form action="" method="post">
                <h3>Konfiguration Tagessoll</h3>
                <table>
                    <tr>
                        <td>
                            Nachname User:
                        </td>
                        <td>
                            <input type="text" name="nachname">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Vorname User:
                        </td>
                        <td>
                            <input type="text" name="vorname">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Vorname User:
                        </td>
                        <td>
                            <input type="text" name="vorname">
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
    </main>
    </body>
<?php
