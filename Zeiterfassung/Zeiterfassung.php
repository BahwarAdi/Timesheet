<?php
///----- Datei holen -----/////
session_start();
if(isset($_SESSION['user'])) {
    require_once "../Config/config.php";
    if ($_POST['time'] == 'time'){
        header('Location: ../Pages/Stundenubersicht.php');
    }
    ///----- Welcher Benutzer -----///
    $userId = $_SESSION['userId'];    //abfrage welche user eingelogt ist

    ///----- Variablen -----///
    if($_POST['save'] == 'save')
    {
        $kalenderwoche = $_POST['kalenderwoche'];
        $datum = $_POST['datum'];
        $start = $_POST['start'];
        $stop = $_POST['stop'];
        $pause = $_POST['pause'];
        $beschreibung = $_POST['beschreibung'];
        $projekt = $_POST['projekt'];

        ///----- SQL Befehle -----///
        $prRes = $mysqli->query("SELECT projektId FROM projekt WHERE projektname LIKE '$projekt' ");
        $prArray = $prRes->fetch_assoc();
        $projektId = $prArray['projektId'];

        $commins = "INSERT INTO zeit (userId, projektId, kw, datum, start, stop, pause,beschreibung) VALUES ( $userId , $projektId,$kalenderwoche ,'$datum','$start','$stop','$pause','$beschreibung')";
        $mysqli->query($commins);
        if($mysqli->error){
            echo('Fehler'. $mysqli->error);
        }
    }


    ///----- Projecktauswal -----///
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
    <nav class="Nav">
        <p id="BnCol">Benutzer:<?php echo($_SESSION['vorname'] ." ". $_SESSION['nachname']);?></p>
        <p id="Pul">TimeSheet </p>
        <a id="logout" href='../../index.php'><button id="logoutb">Logout</button></a>
    </nav>
    <div class="cont">
        <div class="formstund">
                    <div style="display: flex; flex-direction: column; height: 900px; justify-content: space-evenly">
                        <h2>Zeiterfassung</h2>
                        <form method="post" style="display: flex; flex-direction: column">
                            <p class="font" > Datum         <input class="inpt3" type="date" name="datum" required> </p>
                            <p class="font" > KW            <input class="inpt3" type="number" name="kalenderwoche" required> </p>
                            <p class="font" > Start         <input class="inpt3" type="time" name="start" required> </p>
                            <p class="font" > Stop          <input class="inpt3" type="time" name="stop" required> </p>
                            <p class="font" > Pause         <input class="inpt3" type="time" name="pause"> </p>
                            <p class="font" > Projekt       <select class="inpt3" name="projekt"  required >
                                <?php
                                $commsel = "SELECT * FROM `projekt`WHERE projekt.archiviert = 'FALSE'";
                                $query = $mysqli->query($commsel);
                                while ($res = $query->fetch_array()){
                                    echo('<option>'. $res['projektname'] .'</option>');}?>
                            </select></p>
                        <p class="font" > Beschreibung <input  class="inpt3" type="text" name="beschreibung" required></p>
                        </form>
                        <form><button class="inpt3butt" type="submit" name="save" value="save" >Speichern</button></form>
                        <form><button class="inpt3butt" type="submit" name="time" value="time"> Stundenübersicht </button></form>
                    </div>
            </form>
            </div>
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
