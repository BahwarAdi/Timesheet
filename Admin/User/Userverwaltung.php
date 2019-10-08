<?php
session_start();
if (isset($_SESSION['user'])) {

    require_once('../../Config/config.php');

    if (isset($_POST['main'])) {
        header('Location: ../../Pages/Mainpage.php');
    }
    ?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml" lang='de'>
    <head>
        <title>reamis Login</title>
        <link href="../../Style/StyleSheet.css" rel="stylesheet" type="text/css">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
    </head>

    <body>
    <nav class="Nav">
        <div class='placeholder'></div>
        <div class='innerdiv'>
            <div class='innderdivflex'>
                <p id="BnCol">Benutzer:<?php echo($_SESSION['vorname'] . " " . $_SESSION['nachname']); ?></p>
                <p id="Pul">TimeSheet </p>
                <a id="logout" href='../../index.php'>
                    <button id="logoutb">Logout</button>
                </a>
            </div>
        </div>
        <div class='placeholder'></div>
    </nav>
    <div class="PlHa"></div>
    <?php
    //
    #region-Admin
    if ($_SESSION['user'] == 'admin') {
        $id = $_POST['userId'];
        $nachname = $_POST['nachname'];
        $vorname = $_POST['vorname'];
        $email = $_POST['email'];
        $passwort = md5($_POST['passwort']);
        $typ = $_POST['typ'];
        $soll = $_POST['soll'];
//hinzufügen
        if ($_POST['hinzu'] == 'hinzu') {
            if ($nachname != null && $vorname != null && $email != null && $passwort != null && $typ != null && $soll != null) {
                $sql = "INSERT INTO user (nachname,vorname,email,passwort,typ,soll)VALUES('$nachname','$vorname','$email','$passwort','$typ','$soll')";
                if ($mysqli->query($sql) === TRUE) {
                    $meldung = "Neue User wurde erfolgreich hinzugefügt";
                } else {
                    echo "Error: " . $sql . "<br>" . $mysqli->error;
                }
            } else {
                $errorMessage = "Bitte alle eingabe Felder einfüllen!!";
            }

        }
        //löschen
        if ($_POST['loeschen'] == 'loeschen') {

            if ($id != null) {

                $sql = "DELETE FROM user WHERE userId ='$id' ";

                if ($mysqli->query($sql) === TRUE) {
                    echo "User wurde erfolgreich Gelöscht";
                } else {
                    echo "Error: " . $sql . "<br>" . $mysqli->error;
                }
            } else {
                $errorMessage = "Geben Sie Nur ID von dem User um zu Löschen!!";
            }
        }
//passwort zurücksetzen
        if ($_POST['pasz'] == 'pasz') {

            if ($email != null) {

                //Generat a random md5 passwort
                $str = rand();
                $passwort = md5($str);
                //E-Mail
                $empfaenger = $email;
                $betreff = 'Passwort zurueck gesetzt';
                $nachricht = 'Guten Tag ' . $_SESSION['nachname'] . "\r\n" . 'Ihre passwort wurde Zurueck ersetzt'
                    . "\r\n" . 'Deine neue Passwort ist: ' . $passwort;
                $header = 'From: bahwar00@hotmail.com' . "\r\n" .
                    "Reply-To: $email" . "\r\n";


                if (mail($empfaenger, $betreff, $nachricht, $header)) {
                    $meldung = "ihre Passwort wurde Zurückersetzt.";
                    $mysqli->query("UPDATE user SET passwort ='$passwort' WHERE email = '$email'");
                }

            } else {
                $errorMessage = "Geben Sie Nur die E-Mail von dem User um zu Zurücksetzen!!";
            }

        }
        ?>
        <div class="InContainer">
            <form class="UserVerwaItem" action="?Userverwaltung.php=1" method="POST">
                <label style="margin-top: 10px"><?php echo("User ID : " . $_SESSION['userId']); ?></label>
                <h2>User Verwaltung</h2>
                <div class="FirstItem">
                    <div class="IputDivs">
                            <label for='vorname'>Vorname</label>
                            <input class="inputr" type="text" name="vorname" id='vorname'></input>

                            <label for='nachname'>Nachname</label>
                            <input class="inputr" type="text" name="nachname" id='nachname'></input>

                            <label for='id'>E-Mail</label>
                            <input class="inputr" type="email" name="email" id='email'></input>

                            <label for='userId'>ID</label>
                            <input class="inputr" type="number" name="userId" id='userId'></input>
                    </div>

                    <div class="IputDivs">
                            <label for='passwort'>Passwort</label>
                            <input class="inputr" type="passwort" name="passwort" id="passwort"></input>

                            <label for='typ'>Typ</label>
                            <input class="inputr" type="text" name="typ" id='typ'></input>

                            <label for='soll'>Soll</label>
                            <input class="inputr" type="text" name="soll" id='soll'></input>
                    </div>
                </div>
                <button class="UserVerZurBut" type="submit" name="main">Zurück</button>
                <div class="ButtonsDiv">
                    <button class="UserVerBut" type="submit" name="hinzu" value="hinzu">Hinzufügen</button>
                    <button class="UserVerBut" type="submit" name="loeschen" value="loeschen">Löschen</button>
                    <button class="UserVerBut" type="submit" name="pasz" value="pasz">Passwort Zurücksetzen</button>
                    <button class="UserVerBut" type="reset" name="Reset" value="Zurücksetzen">Zurücksetzen</button>
                </div>
                <div class="PDive">
                    <p class="UserVerP">* Beim Hinzufügen ID Feld am Besten Frei lassen!</p>
                    <p class="UserVerP">* Beim Löschen Nur ID Feld am Besten eingeben !</p>
                    <p class="UserVerP">* Beim Psswort Zurücksetzen Nur E-Mail Feld eingeben !</p>
                    <p id="Perro"><?php if ($errorMessage) {
                            echo("$errorMessage");
                        } ?></p>
                    <p id="Pmel"><?php if ($meldung) {
                            echo("$meldung");
                        } ?></p>
                </div>
                <div class="PlHaBottom"></div>
            </form>
        </div>
        <?php


    }
    #endregion-Admin


    #region-User
    if ($_SESSION['user'] == 'user') {

        if ($_POST['aendern'] == 'aendern') {

            $email = $_POST['email'];
            $passwort = md5($_POST['passwort']);
            if ($email != null && $passwort != null) {
                $mysqli->query("UPDATE user SET email= '$email', passwort= '$passwort' WHERE userId = '$_SESSION[userId]'");
            } else {
                $errorMessage = "E-Mail Oder Passwort Darf Nicht lerr sein !!";
            }
        }
        ?>
        <div class="cont">
            <form class="userform" action="?Userverwaltung=1" method="POST">
                <h2>User ändern</h2>
                <label for='id' class="labelimput">Neue E-Mail</label>
                <input class="inputr1" type="email" name="email" id='email'>
                <label for='passwort' class="labelimput">Neue Passwort</label>
                <input class="inputr1" type="password" name="passwort" id="passwort">
                <button class="loginbut" type="submit" name="aendern" value="aendern" style="align-self: center">ändern</button>
                <button class="loginbut" type="reset" name="Reset" value="Zurücksetzen" style="align-self: center">Zurücksetzen</button>
                <button class="loginbut" type="submit" name="main" style="align-self: center"> Zur Hauptseite zurück</button>
                <p id="Perro">
                    <?php
                    if ($errorMessage) {
                        echo("$errorMessage");
                    }
                    ?>
                </p>
            </form>
        </div>
        <?php

    }
    #endregion-User
    ?>
    <footer>
        <p id="Pfo">Copyright reamis ag</p>
    </footer>
    </body>

    </html>

    <?php
} else {
    header('Location: ../../index.php');
}
