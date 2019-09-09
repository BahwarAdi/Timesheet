<?php
session_start();
if ($_SESSION['user'] == "user" || $_SESSION['user'] == "admin"){

}
else{
    die('weg da');
}

if (isset($_POST['userverwaltung'])) {
   header('Location: ../Admin/User/Userverwaltung.php');
}
if (isset($_POST['projekte'])) {
   header('Location: ../Admin/Projekte/projekterfassung.php');
}
if (isset($_POST['system'])){
    header('Location: ../Admin/System/system.php');
}
if (isset($_POST['time'])) {
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

<body>

<div class="cont">
    <div class="fc">
        <form action="" method="POST">
            <fieldset>
                <h2>Hauptseite</h2>
                    <div class='bls'>
                        <?php
                        if ($_SESSION['user'] == "admin"){
                            ?>
                            <button type="submit" name="userverwaltung"> Userverwaltung </button>
                            <button type="submit" name="projekte"> Projekte </button>
                            <button type="submit" name="system"> System </button>
                            <?php
                        }
                        elseif ($_SESSION['user'] == "user"){
                            ?>
                            <button type="submit" name="userverwaltung"> Userverwaltung </button>
                            <button type="submit" name="time"> Stundenübersicht </button>
                            <?php
                        }
                        ?>
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


