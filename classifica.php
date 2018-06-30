<!DOCTYPE html>
<html lang="it">
<head>
    <!-- meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <title>HomePage</title>
    <meta name="description" content="Descrizione sommaria.">
</head>
<body>
<?php include('common/header.html');
    include('common/menu.html'); 
    include('funzioni.php');
?>
<a href="classifica.php?cosa=piloti">Classifica Piloti</a>
<a href="classifica.php?cosa=costruttori">Classifica Costruttori</a>
<?php
    include "connessione.php";
    if($_GET['cosa'] == "costruttori") {
    
        $q = $connessione->query("SELECT DISTINCT Team.nome AS 'Team', SUM(punti) AS 'Punti'
                                    FROM Team INNER JOIN Pilota ON Pilota.id_team = Team.id INNER JOIN Risultati_Gare ON Risultati_Gare.id_pilota = Pilota.matricola
                                    GROUP BY Pilota.id_team
                                    ORDER BY sum(punti) DESC;");
        if(!$q){
            echo "Errore db";
        }else{
                echo "<table><th colspan='2'>Team</th><th>Punti</th>";
                while($row = $q->fetch_array(MYSQLI_NUM)){
                    echo "<tr>".trovaLogo($row[0])."<td>$row[0]</td><td>$row[1]</td></tr>";
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
        if(!$q){
            echo "Errore db";
        }else{
            echo "<table><th>Pilota</th><th colspan='2'>Auto</th><th>Punti</th>";
            while($row = $q->fetch_array(MYSQLI_NUM)){
                $pilota = substr($row[1],0,1);
                $pilota = "$pilota. $row[0]";
                echo "<tr><td>$pilota</td>".trovaLogo($row[2])."<td>$row[2]</td><td>$row[3]</td></tr>";
            }
        echo "</table>";
        }
    }
    $connessione->close();
?>
<?php include('common/footer.php'); ?>
</body>

</html>
