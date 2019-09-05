<?php
session_start();
if ($_SESSION['user'] == "user"){

}
elseif ($_SESSION['user'] == "admin"){
    header('Location: Pages/MainpageAdmin.php');
}
else{
    die('weg da');
}

if ($_POST['change'] == 'change') {
   header('Location: ../Admin/User/Userverwaltung.php');
}
if ($_POST['time'] == 'time') {
    header('Location: Stundenubersicht.php');
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Timesheet Main Page</title>
    <link href="../Style/StyleSheet.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
</head>
<ul>
    <p id="Pul">TimeSheet Benutzer:<?php echo($_SESSION['vorname'] . $_SESSION['nachname']);?></p>
</ul>
<body

<div class="cont">
    <div class="fc">
        <form action="" method="POST">
            <fieldset>
                <h2>Hauptseite</h2>
                    <div class='bls'>
                <button type="submit" name="change" value="change"> Passwort und E-Mail ändern </button>
                <button type="submit" name="time" value="time"> Stundenübersicht </button>
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


