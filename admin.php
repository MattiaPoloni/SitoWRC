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
<?php include('common/header.html') ?>
<?php include('common/menu.html') ?>
<?php include('common/footer.html') ?>
<?php include "connessione.php"; ?>
<div class="risultati">
    Inserimento dei risultati:

    <form method="post">



        <?php
        /**
         * Fatto per esempio un po' a caso.
         */

        $selectGare = "SELECT Gara.id, Pista.nome, Gara.giorno FROM `Pista` inner join Gara on Pista.id = Gara.id_pista 
                    where gara.id not in (select id_gara from risultati_gare);";
        //$data = new Open();
        //$mysqli->connect();
        $gara = $connessione->query($selectGare);
        if ($gara->num_rows > 0) :
            // output data of each row
            ?>
            <select name="gara">
                <?php
                while ($row = $gara->fetch_assoc()) : ?>
                    <option value="<?php echo $row["id"] ?>"><?php echo $row["nome"]." ".$row["giorno"] ?></option>
                <?php endwhile; ?>
            </select>
        <?php else :
            echo "0 results";
        endif;
        ?>
        <?php
        echo "</br>";
        $selectPiloti = "SELECT matricola, nome, cognome FROM Pilota;";
        //$data = new Open();
        //$mysqli->connect();
        $name = $connessione->query($selectPiloti);
        if ($name->num_rows > 0) :
            // output data of each row
            ?>
            <?php
            $j = 1;
            while ($row = $name->fetch_assoc()) : ?>
                <?php echo '<label for="pilota">'.$row["nome"]." ".$row["cognome"]?>
                <?php echo "</label>";?>
                <?php echo "<select name=p".$j.">";
                for($i = 1; $i < 17; $i++) {
                    echo "<option value=" . $i . ">" . $i . "°</option>";
                }
                echo "<option value=99>RIT</option>";
                echo "</select>";
                echo "</br>";
                $j++;?>
            <?php endwhile; ?>
            </label>
        <?php else :
            echo "0 results";
        endif;
        /*for($i = 0; $i < 16; $i++) {
            echo "<select name='p'".$i.">";
        }*/
        ?>

        <?php /** Se le cose sono fisse --> esempio le posizioni ok farle così */ ?>
        <!--<select name="posizione">
            <option value="1">1°</option>
            <option value="2">2°</option>
            <option value="3">3°</option>
            <option value="4">4°</option>
            <option value="5">5°</option>
            <option value="6">6°</option>
            <option value="7">7°</option>
            <option value="8">8°</option>
            <option value="9">9°</option>
            <option value="10">10°</option>
        </select>-->
        <button type="submit" name="save">Carica</button>
    </form>

    <?php

    function punti($posizione) {
        switch($posizione) {
            case 1:
                return 25;
                break;
            case 2:
                return 18;
                break;
            case 3:
                return 15;
                break;
            case 4:
                return 12;
                break;
            case 5:
                return 10;
                break;
            case 6:
                return 8;
                break;
            case 7:
                return 6;
                break;
            case 8:
                return 4;
                break;
            case 9:
                return 2;
                break;
            case 10:
                return 1;
                break;
        }
        return 0;
    }

    //var_dump($connessione);
    if (isset($_POST['save']) && !empty($_POST['save'])) {

        /*$sql = "INSERT INTO Gara (id, giorno, id_pista)
        VALUES (?,?,?)";
        $stmt = mysqli_prepare($sql);
        $pilota = "2018-01-25";
        $arrivo = 1;
        $punti = 1;
        $stmt->bind_param("dsd", $_POST['gara'], $pilota, $arrivo);*/


        //VALUES($_POST["gara"], $_POST["pilota"], $_POST["posizione"], punti($_POST["posizione"])); //funziona con gli id giusti
        //echo $_POST["pilota"];
        //var_dump($_POST["gara"]);
        $sql ="";
        for($i = 1; $i < 11; $i++) {
            $sql .= "INSERT INTO Risultati_Gare (id_gara, id_pilota, posizione_arrivo, punti)
        VALUES ('" . $_POST["gara"] . "','" . (1000+$i) . "','" . $_POST["p".$i] . "','" . punti($_POST["p".$i]) . "');";
        }
        $q = $connessione->multi_query($sql);
        if (!$q) {
            echo "Errore db";
            exit();
        } else {
            echo "Tutto bene";
        }
    }




    ?>
</div>
</br>


<div class="modifica">
    Modifica gare

    <form method="post">
        <?php
        $select = "SELECT Gara.id, Pista.nome, Gara.giorno FROM `Pista` inner join Gara on Pista.id = Gara.id_pista
                    where gara.id not in (select id_gara from risultati_gare);";
        //$data = new Open();
        //$mysqli->connect();
        $pista = $connessione->query($select);
        if ($pista->num_rows > 0) :
            // output data of each row
            ?>
            <select name="garaScelta">
                <?php
                while ($rower = $pista->fetch_assoc()) : ?>
                    <option value="<?php echo $rower["id"] ?>"><?php echo $rower["nome"]." ".$rower["giorno"] ?></option>       //JAVASCRIPT
                <?php endwhile; ?>
            </select>
        <?php else :
            echo "0 results";
        endif;
        ?>
        <button type="submit" name="modifica" value="modifica">Modifica</button>

    </form>
    <?php
    if(isset($_POST["modifica"]) && !empty($_POST["modifica"])) {
        $dati = "SELECT pista.nome,pista.citta,pista.stato,gara.giorno,pista.tipo,pista.id as pistaId,gara.id as garaId FROM gara INNER JOIN pista on id_pista=pista.id
                  where gara.id=" . $_POST["garaScelta"];
        $data = $connessione->query($dati);
        echo "<form method=\"post\">";
        while($row3 = $data->fetch_assoc()) {
            echo '<input type="text" size = "40" name="nomePista" value="'.$row3["nome"].'">';
            echo '<input type="text" name="cittaPista" value="'.$row3["citta"].'">';
            echo '<input type="text" name="statoPista" value="'.$row3["stato"].'">';
            echo '<input type="text" name="giornoGara" value="'.$row3["giorno"].'">';
            echo '<input type="text" name="tipoPista" value="'.$row3["tipo"].'">';
            echo '<input type="hidden" name="idPista" value="'.$row3["pistaId"].'">';
            echo '<input type="hidden" name="idGara" value="'.$row3["garaId"].'">';
        }
        echo "</br>";
        echo "<button type=\"submit\" name=\"applica\" value=\"applica\">Applica modifiche</button>";
        echo "</form>";
    }
    ?>

    <?php
    if(isset($_POST["applica"]) && !empty($_POST["applica"])) {
        $updatePista = "UPDATE Pista
                        SET nome = \"".$_POST["nomePista"]."\", citta = \"".$_POST["cittaPista"]."\",
                        stato = \"".$_POST["statoPista"]."\",tipo = \"".$_POST["tipoPista"].
                        "\" WHERE id = ".$_POST["idPista"].";";

        $updateGara = "UPDATE Gara
                        SET giorno = \"".$_POST["tipoPista"].
                        "\" WHERE id = ".$_POST["idGara"].";";

        $connessione->query($updatePista);
    }
    ?>

</div>

<?php
$connessione->close();
?>





</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</html>