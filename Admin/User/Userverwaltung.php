<?php
session_start();
require_once('../../Config/config.php');

if (isset($_POST['main'])){
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
<ul>
    <p id="Pul">TimeSheet Benutzer:<?php echo($_SESSION['vorname'] ." ". $_SESSION['nachname']);?></p>
</ul>
<body

<?php
//
#region-Admin
if($_SESSION['user']=='admin'){
    $id=$_POST['userId'];
    $nachname=$_POST['nachname'];
    $vorname=$_POST['vorname'];
    $email=$_POST['email'];
    $passwort=md5($_POST['passwort']);
    $typ=$_POST['typ'];
    $soll=$_POST['soll'];
//hinzufügen
    if($_POST['hinzu']=='hinzu'){
        if($nachname != null && $vorname != null && $email != null && $passwort != null && $typ != null && $soll != null){
                $sql="INSERT INTO user (nachname,vorname,email,passwort,typ,soll)VALUES('$nachname','$vorname','$email','$passwort','$typ','$soll')";
                if ($mysqli->query($sql) === TRUE) {
                    $meldung = "Neue User wurde erfolgreich hinzugefügt";
                } else {
                    echo "Error: " . $sql . "<br>" . $mysqli->error;
                }
        }else {
            $errorMessage="Bitte alle eingabe Felder einfüllen!!";
        }

    }
    //löschen
    if($_POST['loeschen']=='loeschen'){

        if($id != null ){

            $sql="DELETE FROM user WHERE userId ='$id' ";

            if ($mysqli->query($sql) === TRUE) {
                echo "User wurde erfolgreich Gelöscht";
            } else {
                echo "Error: " . $sql . "<br>" . $mysqli->error;
            }
        }else {
            $errorMessage="Geben Sie Nur ID von dem User um zu Löschen!!";
        }
    }
//passwort zurücksetzen
    if($_POST['pasz']=='pasz'){

        if($email != null){

            //Generat a random md5 passwort
            $str=rand();
            $passwort =md5($str);
            //E-Mail
            $empfaenger = $email;
            $betreff = 'Passwort zurueck gesetzt';
            $nachricht = 'Guten Tag '.$_SESSION['nachname']."\r\n".'Ihre passwort wurde Zurueck ersetzt'
                ."\r\n".'Deine neue Passwort ist: '.$passwort;
            $header = 'From: bahwar00@hotmail.com' . "\r\n" .
                "Reply-To: $email" . "\r\n" ;


            if(mail($empfaenger, $betreff, $nachricht, $header)){
                $meldung="ihre Passwort wurde Zurückersetzt.";
                $mysqli->query("UPDATE user SET passwort ='$passwort' WHERE email = '$email'");
            }

        }else {
            $errorMessage="Geben Sie Nur die E-Mail von dem User um zu Zurücksetzen!!";
        }

    }
?>
<div class="cont">

    <div class="fc">

        <form action="?Userverwaltung.php=1" method="POST">
            <fieldset>
                <label><?php echo ("User ID : " .$_SESSION['userId']); ?></label>
                <label><?php echo ("Username : " .$_SESSION['nachname']); ?></label>
                <h2>User Verwaltung</h2>
                <div class='bls'>
                    <label for='userId'>ID</label>
                    <input type="number" name="userId" id='userId'></input>

                    <label for='nachname'>Nachname</label>
                    <input type="text" name="nachname" id='nachname'></input>

                    <label for='vorname'>Vorname</label>
                    <input type="text" name="vorname" id='vorname'></input>

                    <label for='id'>E-Mail</label>
                    <input type="email" name="email" id='email'></input>

                    <label for='passwort'>Passwort</label>
                    <input type="passwort" name="passwort" id="passwort"></input>

                    <label for='typ'>Typ</label>
                    <input type="text" name="typ" id='typ'></input>

                    <label for='soll'>Soll</label>
                    <input type="text" name="soll" id='soll'></input>

                </div>
                <button type="submit" name="hinzu" value="hinzu">Hinzufügen</button>
                <button type="submit" name="loeschen" value="loeschen">Löschen</button>
                <button type="submit" name="pasz" value="pasz">Passwort Zurücksetzen</button>
                <button type="reset" name="Reset" value="Zurücksetzen">Zurücksetzen</button>
                <button type="submit" name="main">Hauptseite</button>

                <label>* Beim Hinzufügen ID Feld am Besten Frei lassen!</label>
                <label>* Beim Löschen Nur ID Feld am Besten eingeben !</label>
                <label>* Beim Psswort Zurücksetzen Nur E-Mail Feld eingeben !</label>
                <p id="Perro"><?php if($errorMessage){echo ("$errorMessage");}?></p>
                <p id="Pmel"><?php if($meldung){echo ("$meldung");}?></p>
            </fieldset>
        </form>

    </div>

</div>
<?php


}
#endregion-Admin


#region-User
if($_SESSION['user']=='user') {

    if($_POST['aendern']=='aendern'){

        $email=$_POST['email'];
        $passwort= md5($_POST['passwort']);
        if($email != null && $passwort != null){
            $mysqli->query("UPDATE user SET email= '$email', passwort= '$passwort' WHERE userId = '$_SESSION[userId]'");
        }
        else{
            $errorMessage = "E-Mail Oder Passwort Darf Nicht lerr sein !!";
        }
    }
?>
<div class="cont">

    <div class="fc">

        <form action="?Userverwaltung=1" method="POST">
            <fieldset>
                <label><?php echo ("User ID : " .$_SESSION['userId']); ?></label>
                <label><?php echo ("Username : " .$_SESSION['nachname']); ?></label>

                <h2>User ändern</h2>
                <div class='bls'>

                    <label for='id'>Neue E-Mail</label>
                    <input type="email" name="email" id='email'></input>

                    <label for='passwort'>Neue Passwort</label>
                    <input type="password" name="passwort" id="passwort"></input>

                </div>
                <button type="submit" name="aendern" value="aendern">ändern</button>

                <button type="reset" name="Reset" value="Zurücksetzen">Zurücksetzen</button>


                <button type="submit" name="change" value="main"> Zur Hauptseite zurück</button>

                <p id="Perro"><?php if($errorMessage){echo ("$errorMessage");}?></p>
            </fieldset>
        </form>

    </div>

</div>
<?php

}
#endregion-User
?>

</body>
<footer>
    <p id="Pfo">Copyright reamis ag</p>
</footer>
</html>
</DOCTYPE>
