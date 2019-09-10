<?php
session_start();
require_once('../../Config/config.php');

if (isset($_POST['main'])) {
    header('Location: ../../Pages/Mainpage.php');
}
if (isset($_POST['feiertage'])) {
    header('Location: feiertage.php');
}

#region verarbeitung soll
if (isset($_POST['soll'])) {
    $nachname = $_POST['nachname'];
    $vorname = $_POST['vorname'];
    $tagessoll = $_POST['tagessoll'];

    $mysqli->query("UPDATE user SET soll = '$tagessoll' WHERE nachname = '$nachname' AND vorname = '$vorname'");
}
#endregion

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
    <p id="Pul">TimeSheet Benutzer:<?php echo($_SESSION['vorname'] . $_SESSION['nachname']); ?></p>
</ul>

<body>
<div class="cont">
    <div class="fc">
        <form action="" method="POST">
            <fieldset>
                <h2>System</h2>
                <div class="bls">
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
                                        Tagessoll:
                                    </td>
                                    <td>
                                        <input type="time" name="tagessoll">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="submit" name="soll" value="Festlegen">
                                    </td>
                                    <td>
                                        <input type="reset">
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    <div>
                        <button type="submit" name="main"> Hauptseite</button>
                        <button type="submit" name="feiertage">Feiertage</button>
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
