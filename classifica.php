<html>
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
            exit();
        }else{
                echo "<table><tr><td>Team</td><td>Punti</td></tr>";
                while($row = $q->fetch_array(MYSQLI_NUM)){
                echo "<tr><td>$row[0]</td><td>$row[1]</td></tr>";
            }
                echo "</table>";
                exit();}
    } else {
        $q = $connessione->query("SELECT Pilota.cognome, Pilota.nome, Auto.modello,
        SUM(Risultati_Gare.punti)
        FROM Pilota INNER JOIN Risultati_Gare ON Pilota.matricola = Risultati_Gare.id_pilota
        INNER JOIN Team ON Pilota.id_team = Team.id
        INNER JOIN Auto ON Team.id_auto = Auto.id
        GROUP BY Risultati_Gare.id_pilota
        ORDER BY SUM(Risultati_Gare.punti) DESC;");
        if(!$q){
            echo "Errore db";
            exit();
        }else{
            echo "<table><tr><th>Pilota</th><th>Auto</th><th>Punti</th></tr>";
            while($row = $q->fetch_array(MYSQLI_NUM)){
                $pilota = substr($row[1],0,1);
                $pilota = "$pilota.$row[0]";
                echo "<tr><td>$pilota</td><td>$row[2]</td><td>$row[3]</td></tr>";
            }
        echo "</table>";
        exit();
        }
    }
    $connessione->close();
?>
</html>