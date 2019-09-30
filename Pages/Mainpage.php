<?php
session_start();
if(isset($_SESSION['user'])) {
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
if (isset($_POST['Charts'])) {
    header('Location: Charts.php');
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


<body>
<nav>
    <p id="BnCol">Benutzer:<?php echo($_SESSION['vorname'] ." ". $_SESSION['nachname']);?></p>
    <p id="Pul">TimeSheet</p>
    <a id="logout" href='./../index.php'><button id="logoutb">Logout</button></a>
</nav>
    <div class="InContainer">
            <form class="MainIt" action="" method="POST">
                    <h2>Main</h2>
                        <div class="MainRes">
                        <?php
                        if ($_SESSION['user'] == "admin"){
                            ?>
                            <button class="inputr" id="BuSize" type="submit" name="userverwaltung"> Userverwaltung </button>
                            <button class="inputr" id="BuSize" type="submit" name="projekte"> Projekte </button>

                            <button class="inputr" id="BuSize" type="submit" name="system"> System </button>
                            <button class="inputr" id="BuSize" type="submit" name="Charts"> Projektübersicht </button>
                            <?php
                        }
                        elseif ($_SESSION['user'] == "user"){
                            ?>
                            <button class="inputr" id="BuSize" type="submit" name="userverwaltung"> Userverwaltung </button>
                            <button class="inputr" id="BuSize" type="submit" name="time"> Stundenübersicht </button>
                            <button class="inputr" id="BuSize" type="submit" name="Charts"> Projektübersicht </button>
                            <?php
                        }
                        ?>
                        </div>
            </form>

    </div>

</body>
<footer>
    <p id="Pfo">Copyright reamis ag</p>
</footer>
</html>
</DOCTYPE>
    <?php
}else{
    header('Location: ../index.php');
}

