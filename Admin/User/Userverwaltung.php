<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang='de'>
<head>
    <title>reamis Login</title>
    <link href="../../Style/StyleSheet.css" rel="stylesheet" type="text/css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
</head>
<ul>
    <p id="Pul">TimeSheet</p>
</ul>
<body
<?php
session_start();
$mysqli = new mysqli('localhost','root','','Timesheet');
if($mysqli->connect_errno){
    echo("Fehler".$mysqli->connect_error());
}

if($_SESSION['user']=='admin'){

?>
<div class="cont">

    <div class="fc">

        <form action="?Userverwaltung.php=1" method="POST">
            <fieldset>

                <h2>User Verwaltung</h2>
                <div class='bls'>

                    <label for='userId'>ID</label>
                    <input type="number" name="userId" id='userId'></input>

                    <label for='nachname'>Nachname</label>
                    <input type="text" name="nachname" id='nachname'></input>

                    <label for='vorname'>Name</label>
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
                <button type="submit" name="emz" value="emz">E-Mail Zurücksetzen</button>
                <button type="reset" name="Reset" value="Zurücksetzen">Zurücksetzen</button>

            </fieldset>
        </form>

    </div>

</div>
<?php

        $id=$_POST['userId'];
        $nachname=$_POST['nachname'];
        $vorname=$_POST['vorname'];
        $email=$_POST['email'];
        $passwort=md5($_POST['passwort']);
        $typ=$_POST['typ'];
        $soll=$_POST['soll'];

    if($_POST['hinzu']=='hinzu'){
        $sql="INSERT INTO user (nachname,vorname,email,passwort,typ,soll)VALUES('$nachname','$vorname','$email','$passwort','$typ','$soll')";
        if ($mysqli->query($sql) === TRUE) {
            echo "Neue User wurde erfolgreich hinzugefügt";
        } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }

    }
    if($_POST['loeschen']=='loeschen'){
        $sql="DELETE FROM user WHERE userId ='$id' ";

        if ($mysqli->query($sql) === TRUE) {
            echo "User wurde erfolgreich Gelöscht";
        } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }

    }
    if($_POST['emz']=='emz'){

    }
}




if($_SESSION['user']=='User') {
    echo("Hallo " . $_SESSION['user'] . "Sie können Ihren E_Mail ändern oder Passwort Zurückstzen");
?>
<div class="cont">

    <div class="fc">

        <form action="?index=1" method="POST">
            <fieldset>

                <h2>User ändern</h2>
                <div class='bls'>

                    <label for='id'>E-Mail</label>
                    <input type="email" name="email" id='email'></input>

                    <label for='password'>Passwort</label>
                    <input type="password" name="password" id="password"></input>

                </div>
                <button type="submit" name="aendern" value="aendern">ändern</button>

                <button type="reset" name="Reset" value="Zurücksetzen">Zurücksetzen</button>

            </fieldset>
        </form>

    </div>

</div>
<?php

}

?>
</body>
<footer>
    <p id="Pfo">Copyright reamis ag</p>
</footer>
</html>
</DOCTYPE>
