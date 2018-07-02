<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="it">
<head>
    <!-- meta tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="Classifica piloti e costruttori" />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="/css/style.css" />
    <title>Classifica</title>
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
                echo "<h3>Classifica Costruttori</h3>";
                echo "<table summary='Classifica Costruttori'><thead><tr><th colspan='2' scope='colgroup'>Team</th><th scope='col'>Punti</th></tr></thead><tbody>";
                while($row = $q->fetch_array(MYSQLI_NUM)){
                    echo "<tr>".trovaLogo($row[0])."<td>$row[0]</td><td>$row[1]</td></tr>";
                }
                echo "</tbody></table>";
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
            echo "<h3>Classifica Piloti</h3>";
            echo "<table summary='Classifica Piloti'>";
            echo "<thead><tr><th scope='col'>Pilota</th><th colspan='2' scope='colgroup'>Auto</th><th scope='col'>Punti</th></tr></thead><tbody>";
            while($row = $q->fetch_array(MYSQLI_NUM)){
                $pilota = substr($row[1],0,1);
                $pilota = "$pilota. $row[0]";
                echo "<tr><td>$pilota</td>".trovaLogo($row[2])."<td>$row[2]</td><td>$row[3]</td></tr>";
            }
        echo "</tbody></table>";
        }
    }
    $connessione->close();
?>
<?php include('common/footer.php'); ?>
</body>

</html>
