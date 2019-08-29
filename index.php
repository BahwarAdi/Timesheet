<?php
session_start();
$mysqli = new mysqli('localhost','root','','Timesheet');
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
        echo("Du bist als ".$_SESSION['user']. " angemeldet");
    }
    else{
        $errorMessage = " E-Mail oder Passwort Ungültig !!";
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
<ul>
    <p id="Pul">TimeSheet</p>
</ul>
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
                <p id="Perro"><?php if($errorMessage){echo ("$errorMessage");}?></p>
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

