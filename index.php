<?php
session_start();
require_once "Config/Config.php";
//$mysqli = new mysqli('localhost','root','','Timesheet');
if($mysqli->connect_errno){
    echo("Fehler".$mysqli->connect_error());
}

if(isset($_GET['index'])){
    $email=$_POST['email'];
    $password=$_POST['password'];
    $user=$mysqli->query("SELECT * FROM user WHERE email = '$email'");
    $res=$user->fetch_assoc();
    if($res !== false && $res !== null && $res['passwort'] == $password){
        $_SESSION['user'] = $res['nachname'];
        $_SESSION['userId'] = $res['userId'];
        echo("Du bist als ".$_SESSION['user']. " angemeldet");
        header('Location: http://localhost/Timesheet/Zeiterfassung/Zeiterfassung.php');
    }
    else{
        $errorMessage = " E-Mail oder Passwort war ungültig !!";
    }
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang='de'>
<head>
    <title>reamis Login</title>
    <link href="Style/StyleSheet.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
</head>
<body

<div class="cont">
    <div class="fc">
        <form action="?index=1" method="POST">
            <fieldset>
                <h2>LOGIN</h2>
                <div class='bls'>
                    <label for='id'>E-Mail</label>
                    <input type="email" name="email" id='email'></input>

                    <label for='password'>Passwort</label>

                    <input type="password" name="password" id="password"></input>

                </div>
                <button type="submit" name="log" value="Log">Login</button>
                <button type="reset" name="Reset" value="Zurücksetzen">Zurücksetzen</button>
                <p><?php if($errorMessage){echo ("$errorMessage");}?></p>
            </fieldset>
        </form>
    </div>

</div>

</body>
<footer>
    <p>Copyright reamis ag</p>
</footer>
</html>
</DOCTYPE>

