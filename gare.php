<!DOCTYPE html>
<html lang="it">
<head>
    <!-- meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS -->
    <link rel="stylesheet" href="/css/style.css">
    <title>HomePage</title>
    <meta name="description" content="Descrizione sommaria.">
</head>
<body>

<?php include('common/header.html');
include('common/menu.html');
include('connessione.php');
include('funzioni.php');
if ( ! session_id() )
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
<main class="row">
    <div class="container gara">
        <form action="gare.php" method="post">
            <fieldset>
                <legend>Selezione Gare</legend>
                <label for="gara">Gara:</label>
                <select name="gara">
                    <?php
                    $ris = $connessione->query("SELECT Gara.id, Pista.nome
                        FROM Gara INNER JOIN Pista ON Gara.id_pista = Pista.id
                        ORDER BY Gara.id;");
                    if ($ris) {
                        while($row = $ris->fetch_array(MYSQLI_NUM)) {
                            echo "<option value='$row[0]-$row[1]'";
                            if($row[0] == $num_gara) echo " selected='selected'";
                            echo ">$row[0] - $row[1]</option>";
                        }
                    }
                    ?>
                </select>

                <input class="button" type="submit" value="Cerca">
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
                echo "<table summary='Tabella contente i risultati relativi alla gara $nome_gara'>";
                echo "<th>Posizione</th><th>Pilota</th><th colspan='2'>Auto</th><th>Punti</th></tr>";
                while ($row = $ris->fetch_array(MYSQLI_NUM)) {
                    if ($row[0] == 99)
                        $row[0] = "RIT";
                    $pilota = substr($row[2], 0, 1);
                    $pilota = "$pilota. $row[1]";
                    echo "<tr><td>$row[0]</td><td>$pilota</td>" . trovaLogo($row[3]) . "<td>$row[3]</td><td>$row[4]</td></tr>";
                }
            }
            echo "</table>";
        }
        $connessione->close();


        ?>
    </div>
</main>
<?php include('common/footer.php') ?>
</body>


</html>



