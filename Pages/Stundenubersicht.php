<?php
session_start();
if (isset($_SESSION['user'])) {
    if ($_POST['change'] == 'main') {
        header('Location: Mainpage.php');
    }
    if ($_POST['change'] == 'time') {
        header('Location: ../Zeiterfassung/Zeiterfassung.php');
    }
    if ($_POST['change'] == 'timeshow') {
        header('Location: ../Zeiterfassung/Stunden.php');
    }
    ///----- Dateien Holen -----///
    require_once "../Config/config.php";
    require_once "../Zeiterfassung/Class_Zeit.php";
    ///----- Variablen -----///
    $s = new Zeit();
    $userid = $_SESSION['userId'];

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
        <div class="fc">
            <form class="stundenueberform" action="" method="POST" >
                <h2>Stundenübersicht</h2>

                 <div style="display: flex; justify-content: space-evenly">
                <?php
                    $commsel = "SELECT * FROM `projekt`WHERE projekt.archiviert = 'FALSE'";
                    $query1 = $mysqli->query($commsel);
                    echo('<button class="loschen" type="submit" name="was" value="all"> Alle </button>');
                        while ($res = $query1->fetch_array()) {
                            $name = $res['projektname'];
                            $id = $res['projektId'];
                            echo('<button class="loschen" type="submit" name="was" value=' . $res['projektId'] . '> ' . $name . ' </button>');
                        }
                ?>
                 </div>

                <div class="Tablescroll">
                <table class="table">
                    <tr>
                        <th>Zeit ID</th> <th>Datum</th> <th>Stunden</th> <th>Beschreibung</th>
                    </tr>
                    <tr>
                      <?php
                        $order = 'datum';
                        $comm = ('SELECT * FROM `zeit` WHERE userId = ' . $userid . '  AND projektId =' . $_POST['was'] . ' ORDER BY ' . $order . ' ASC ');
                        $commall = ('SELECT * FROM `zeit` WHERE userId = ' . $userid . ' ORDER BY ' . $order . ' ASC ');
                        if (!$_POST['was'] || $_POST['was'] == 'all' || $_POST['num']) {
                            $query1 = $mysqli->query($commall);
                              while ($res1 = $query1->fetch_array()) {
                                  echo('<tr>');
                                  echo('<td>' . $res1['zeitId'] . '</td>');
                                  echo('<td>' . $res1['datum'] . '</td>');
                                  $startzeit = $res1['start'];         ///Rechnen zeit
                                  $endzeit = $res1['stop'];            ///Rechnen zeit
                                  $pause = $res1['pause'];            ///Rechnen zeit
                                  $s->arbeitszeit($startzeit, $endzeit, $pause);
                                  echo('<td>' . $tot_time . ' H</td>');
                                  echo('<td>' . $res1['beschreibung'] . '</td>');
                              }
                        } elseif (!$_POST['was'] || $_POST['was'] = $_POST['was']) {
                            $query = $mysqli->query($comm);
                            while ($res = $query->fetch_array()) {
                                 echo('<tr>');
                                 echo('<td>' . $res['zeitId'] . '</td>');
                                 echo('<td>' . $res['datum'] . '</td>');
                                 $startzeit = $res['start'];         ///Rechnen zeit
                                 $endzeit = $res['stop'];            ///Rechnen zeit
                                 $pause = $res['pause'];            ///Rechnen zeit
                                 $s->arbeitszeit($startzeit, $endzeit, $pause);
                                 echo('<td>' . $tot_time . ' H</td>');
                                 echo('<td>' . $res['beschreibung'] . '</td>');
                            }
                        }
                      ?>
                </table>
                </div>

                    <div style="align-self: center; display: flex;" >
                         <button class ="loschen" type="submit" name="change" value="main"> zur Hauptseite zurück</button>
                         <button class="loschen" type="submit" name="change" value="time"> Stunden erfassen</button>
                         <button class="loschen" type="submit" name="change" value="timeshow"> Stunden Anzeigen</button>
                    </div>

                <div style="align-self: center; display: flex;">
                    <input class="inputr" type="number" name="entf" placeholder="Stunden Nummer">
                    <button class="loschen" type="submit" name="del" value="del">Löschen</button>
                </div>

            </form>
        </div>
    </div>
    <footer>
       <p id="Pfo">Copyright reamis ag</p>
    </footer>
</body>

</html>
<?php
    if (isset ($_POST['entf'])) {
        echo $_POST['entf'];
        $commdel = 'DELETE FROM zeit WHERE zeitId = ' . $_POST['entf'];
        $query = $mysqli->query($commdel);
    }
} else {
    header('Location: ../index.php');
}
