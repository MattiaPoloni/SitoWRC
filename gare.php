<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="it">
<head>
    <!-- meta tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="description" content="Risultati Gare Disputate"/>
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <link rel="stylesheet" type="text/css" href="css/print.css" media="print" />
    <title>Gare</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
</head>
<body class="gara">
<div class="content">
    <div class="container gara">
        <?php include('common/header.html');
        include('connessione.php');
        include('funzioni.php');
        if (!session_id())
            session_start();

        if (isset($_POST["gara"])) {
            $gara = explode("-", $_POST["gara"]);
            $num_gara = $gara[0];
            $nome_gara = $gara[1];
        } else {
            $num_gara = 7;
            $nome_gara = "Rally Italia Sardegna";
        }

        ?>

        <form action="gare.php" method="post">
            <fieldset>
                <legend>Selezione Gare</legend>
                <select name="gara">
                    <?php
                    $ris = $connessione->query("SELECT Gara.id, Pista.nome
                        FROM Gara INNER JOIN Pista ON Gara.id_pista = Pista.id
                        ORDER BY Gara.id;");
                    if ($ris) {
                        while ($row = $ris->fetch_array(MYSQLI_NUM)) {
                            echo "<option value='$row[0]-$row[1]'";
                            if ($row[0] == $num_gara) echo " selected='selected'";
                            echo ">$row[0] - $row[1]</option>";
                        }
                    }
                    ?>
                </select>
                <input class="button" type="submit" value="Cerca"/>
            </fieldset>
        </form>
        <?php
        echo "<h2>$nome_gara</h2>";
        $query = "SELECT posizione_arrivo, Pilota.cognome, Pilota.nome, marca, punti
                    FROM Risultati_Gare INNER JOIN Pilota ON Risultati_Gare.id_pilota = Pilota.matricola
                    INNER JOIN Team ON Team.id = Pilota.id_Team
                    INNER JOIN Auto ON Team.id_auto = Auto.id
                    WHERE id_gara = $num_gara
                    ORDER BY posizione_arrivo;";
        $ris = $connessione->query($query);
        if (!$ris) {
            echo "Errore Database";
        } else {
            if (mysqli_num_rows($ris) == 0)
                echo "Gara Non Ancora Disputata";
            else {
                echo "<table summary='Tabella contente i risultati relativi alla gara $nome_gara'><thead>";
                echo "<tr><th scope='col'>Posizione</th><th scope='col'>Pilota</th><th id='imgAuto' colspan='2' scope='colgroup'>Auto</th><th scope='col'>Punti</th></tr>";
                echo "</thead><tbody>";
                while ($row = $ris->fetch_array(MYSQLI_NUM)) {
                    if ($row[0] == 99)
                        $row[0] = "RIT";
                    $pilota = substr($row[2], 0, 1);
                    $pilota = "$pilota. $row[1]";
                    echo "<tr><td>$row[0]</td><td>$pilota</td>" . trovaLogo($row[3]) . "<td>$row[3]</td><td>$row[4]</td></tr>";
                }
            }
            echo "</tbody></table>";
        }
        $connessione->close();


        ?>
    </div>
</div>
<?php include('common/footer.php'); ?>
</body>
<script>
    var tid;
    tid = setTimeout(mycode, 0);
    function mycode() {
        if($( window ).width() > 575) {
            $('#imgAuto').attr('colspan',2);
        }
        else {
            $('#imgAuto').attr('colspan',1);
        }
        tid = setTimeout(mycode, 100);
    }

    window.onbeforeprint = function() {
        clearTimeout(tid);
        $('#imgAuto').attr('colspan',1);
    };

</script>

</html>
