<?php
session_start();
if(isset($_SESSION['user'])) {

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


<body>
<nav class="Nav">
    <p id="BnCol">Benutzer:<?php echo($_SESSION['vorname'] ." ". $_SESSION['nachname']);?></p>
    <p id="Pul">TimeSheet </p>
    <a id="logout" href='../../index.php'><button id="logoutb">Logout</button></a>
</nav>
<div class="cont">
    <div class="fc">
        <form class="systemform" action="" method="POST">
                <h2>System</h2>
                <h3>Konfiguration Tagessoll</h3>
                <div class="bls">
                                <label for="usernachname">Users Nachname</label>
                                <input class="inputr" type="text" name="nachname" id="usernachname">

                                <label for="uservorname">Users Vorname</label>
                                <input class="inputr" type="text" name="vorname" id="uservorname">

                                <label for="Tagessoll">Tagessoll</label>
                                <input class="inputr" id="tagessoll" type="time" name="tagessoll" id="tagessoll">

                    <input class="loginbut" type="submit" name="soll" value="Festlegen">
                    <input class="loginbut" type="reset">

                        <button class="loginbut" type="submit" name="main"> Hauptseite</button>
                        <button class="loginbut" type="submit" name="feiertage">Feiertage</button>
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

    }else{
        header('Location: ../../index.php');
    }
