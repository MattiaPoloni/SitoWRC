<!DOCTYPE html>
<html lang="it">
<head>
    <!-- meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>

    <title>HomePage</title>
    <meta name="description" content="Descrizione sommaria.">
</head>
<body class="classifica">
<main class="content">
    <div class="container classifica">
        <?php session_start() ?>
        <?php include('common/header.html');
        include('funzioni.php');
        ?>
        <div class="navigation">
            <a id="piloti" href="classifica.php?cosa=piloti">Classifica Piloti</a>
            <a id="costruttori" href="classifica.php?cosa=costruttori">Classifica Costruttori</a>
        </div>
        <?php
        include "connessione.php";
        if ($_GET['cosa'] == "costruttori") {

            $q = $connessione->query("SELECT DISTINCT Team.nome AS 'Team', SUM(punti) AS 'Punti'
                                    FROM Team INNER JOIN Pilota ON Pilota.id_team = Team.id INNER JOIN Risultati_Gare ON Risultati_Gare.id_pilota = Pilota.matricola
                                    GROUP BY Pilota.id_team
                                    ORDER BY sum(punti) DESC;");
            if (!$q) {
                echo "Errore db";
            } else {
                echo "<table><th colspan='2'>Team</th><th>Punti</th>";
                while ($row = $q->fetch_array(MYSQLI_NUM)) {
                    echo "<tr>" . trovaLogo($row[0]) . "<td>$row[0]</td><td>$row[1]</td></tr>";
                }
                echo "</table>";
            }
        } else {
            $q = $connessione->query("SELECT Pilota.cognome, Pilota.nome, Auto.marca,
        SUM(Risultati_Gare.punti)
        FROM Pilota INNER JOIN Risultati_Gare ON Pilota.matricola = Risultati_Gare.id_pilota
        INNER JOIN Team ON Pilota.id_team = Team.id
        INNER JOIN Auto ON Team.id_auto = Auto.id
        GROUP BY Risultati_Gare.id_pilota
        ORDER BY SUM(Risultati_Gare.punti) DESC;");
            if (!$q) {
                echo "Errore db";
            } else {
                echo "<table><th>Pilota</th><th colspan='2'>Auto</th><th>Punti</th>";
                while ($row = $q->fetch_array(MYSQLI_NUM)) {
                    $pilota = substr($row[1], 0, 1);
                    $pilota = "$pilota. $row[0]";
                    echo "<tr><td>$pilota</td>" . trovaLogo($row[2]) . "<td>$row[2]</td><td>$row[3]</td></tr>";
                }
                echo "</table>";
            }
        }
        $connessione->close();
        ?>
    </div>
</main>
<?php include('common/footer.php'); ?>
</body>
<script>
    $(document).ready(function () {
        var url = window.location.href.split("?");
        if (url[1] == "cosa=default" || url[1] == "cosa=piloti") {
            $('#piloti').addClass("active");
        } else if (url[1] == "cosa=costruttori") {
            $('#costruttori').addClass("active");
        }
    });
</script>
</html>
