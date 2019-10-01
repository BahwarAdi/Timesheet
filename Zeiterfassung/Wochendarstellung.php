<?php
///----- Dateien Holen -----/////
if(isset($_SESSION['user'])) {
    require_once "../Config/config.php";
    require_once "Class_Zeit.php";
    session_start();
    ///----- Variablen -----///
    $s = new Zeit();
    $userid = 1;  //$_SESSION['userId'];
    ?>

    <html>
    <head>
        <style>table, th, td {
                border: 1px solid rgba(108, 0, 56, 0.74);
                border-collapse: collapse;
                background: gainsboro;
                padding: 2px;
            }</style>
    </head>
    <body>
    <nav>
        <p id="Pul">TimeSheet Benutzer:<?php echo($_SESSION['vorname'] ." ". $_SESSION['nachname']);?></p>
        <a id="logout" href='../../index.php'><button id="logoutb">Logout</button></a>
    </nav>
    <div>
        <Form method="post">
            <td>
                <?php
                $commsel = "SELECT * FROM `projekt`";
                $query1 = $mysqli->query($commsel);

                echo('<button type="submit" name="was" value="all"> Alle </button>');
                while ($res = $query1->fetch_array()) {
                    $name = $res['projektname'];
                    $id = $res['projektId'];
                    echo('<button type="submit" name="was" value=' . $res['projektId'] . '> ' . $name . ' </button>');

                }
                ?>
                <table>
                    <tr>
                        <?php
                        $order = 'datum';
                        $comm = ('SELECT * FROM `zeit` WHERE userId = ' . $userid . '  AND projektId =' . $_POST['was'] . ' ORDER BY ' . $order . ' ASC ');
                        $commall = ('SELECT * FROM `zeit` WHERE userId = ' . $userid . ' ORDER BY ' . $order . ' ASC ');

                        if (!$_POST || $_POST['was'] == 'all' || $_POST['num']) {
                            $query1 = $mysqli->query($commall);
                            while ($res1 = $query1->fetch_array()) {
                                echo('<tr>');
                                echo('<td>' . $res1['zeitId'] . '</td>');
                                echo('<td>' . $res1['datum'] . '</td>');
                                $startzeit = $res1['start'];         ///Rechnen zeit
                                $endzeit = $res1['stop'];            ///Rechnen zeit
                                $pause = $res1['pause'];            ///Rechnen zeit
                                $s->arbeitszeit($startzeit, $endzeit, $pause);
                                echo('<td>' . $tot_time . ' Stunden</td>');
                                echo('<td>' . $res1['beschreibung'] . '</td>');
                            }
                        } elseif ($_POST['was'] = $_POST['was']) {
                            $query = $mysqli->query($comm);
                            while ($res = $query->fetch_array()) {
                                echo('<tr>');
                                echo('<td>' . $res['zeitId'] . '</td>');
                                echo('<td>' . $res['datum'] . '</td>');
                                $startzeit = $res['start'];         ///Rechnen zeit
                                $endzeit = $res['stop'];            ///Rechnen zeit
                                $pause = $res['pause'];            ///Rechnen zeit
                                $s->arbeitszeit($startzeit, $endzeit, $pause);
                                echo('<td>' . $tot_time . ' Stunden</td>');
                                echo('<td>' . $res['beschreibung'] . '</td>');
                            }
                        }

                        ?>
                </table>
        </form>

    </div>

    <div>
        <form method="post">
            <?php
            echo('<input type="number" name="num" required>');
            echo('<button type="submit" name="del" value= >Löschen</button>');
            $id = $_POST['num'];

            if ($_POST['num']) {
                $id = $_POST['num'];
                $comdel = "DELETE FROM zeit WHERE zeitId = $id ";
                $mysqli->query($comdel);
                header('Location:Wochendarstellung.php');
            }
            ?>
        </form>
    </div>
    </body>
    </html>
    <?php
}else{
    header('Location: ../index.php');
}

