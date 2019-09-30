<?php
session_start();
require_once('Config/config.php');
if(isset($_GET['index'])){
    $email=$_POST['email'];
    $passwort= md5($_POST['passwort']);
    $user=$mysqli->query("SELECT * FROM user WHERE email = '$email'");
    $res=$user->fetch_assoc();
    if($res !== false && $res !== null && $res['passwort'] == $passwort){
        $_SESSION['user'] = $res['typ'];
        $_SESSION['userId'] = $res['userId'];
        $_SESSION['nachname']= $res['nachname'];
        $_SESSION['vorname']= $res['vorname'];
        header('Location: Pages/Mainpage.php');
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
<body>
    <nav>
        <p id="Pul">TimeSheet</p>
    </nav>
    <div class="InContainer">
            <form class="InItem" action="?index=1" method="POST">
                        <h2>LOGIN</h2>
                        <div class="LabInpIn">
                            <label for='id'>E-Mail</label>
                            <input class="inputr" type="email" name="email" id='email'></input>
                            <label for='passwort'>Passwort</label>
                            <input class="inputr" type="password" name="passwort" id="passwort"></input>
                        </div>
                        <div class = "InBu">
                            <button class="LoginBut" id="LoginBut" type="submit" name="log" value="Log">Login</button>
                            <button class="LoginBut" id="ZurkBut" type="reset" name="Reset" value="Zurücksetzen">Zurücksetzen</button>
                        </div>
                <p id="Perro"><?php if($errorMessage){echo ("$errorMessage");}?></p>
            </form>
    </div>
    <footer>
        <p id="Pfo">Copyright reamis ag</p>
    </footer>
</body>

</html>
