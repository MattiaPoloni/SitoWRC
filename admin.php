<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="it">
<head>
    <!-- meta tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Pagina Amministrazione" />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="/css/style.css" />
    <title>Amministrazione</title>
</head>
<body>
<?php include('common/header.html'); ?>
<?php include('common/menu.html'); ?>
<?php include ("connessione.php"); ?>
<?php include ("session.php"); ?>
<?php require ("funzioni.php");?>

<?php
//if ($_SESSION['login_user'] != '') :

?>
<h1>Welcome <?php echo $_SESSION['login_user']; ?></h1>
<h2><a href="logout.php">Sign Out</a></h2>
<div class="azioni">
<a href="admin.php?azione=inserimentoRisultati">Inserimento Risultati</a>
<a href="admin.php?azione=modificaGare">Modifica infomazioni gare</a>
<a href="admin.php?azione=inserimentoNews">Inserimento News</a>
</div>
<?php
if($_GET["azione"]=="inserimentoRisultati") :
    ?>
    <div class="risultati">

        <form method="post">



            <?php

            $selectGare = "SELECT Gara.id, Pista.nome, Gara.giorno FROM `Pista` inner join Gara on Pista.id = Gara.id_pista ;";
            //$data = new Open();
            //$mysqli->connect();
            $gara = $connessione->query($selectGare);
            if ($gara->num_rows > 0) :
                // output data of each row
                ?>
                <select name="gara">
                    <?php
                    while ($row = $gara->fetch_assoc()) : ?>

                        <option value="<?php echo $row["id"] ?>"
                     <?php if(isset($_POST['gara']) && $_POST['gara'] == $row["id"])
                         echo ' selected= "selected"';
                        ?>>
                            <?php echo $row["nome"]." ".$row["giorno"] ?></option>
                    <?php endwhile; ?>
                </select>
            <?php else :
                echo "0 results";
            endif;
            ?>
            <?php
            echo '<input type="submit" name="garaSelezionata" value="Posizioni"/>';
            echo "</br>";
            ?>
            <?php

            if(isset($_POST['garaSelezionata']) && !empty($_POST['garaSelezionata'])) {

            $selectPiloti = "SELECT matricola, nome, cognome FROM Pilota;";

            $name = $connessione->query($selectPiloti);
            if ($name->num_rows > 0) :
                // output data of each row
                ?>
                <?php
                $j = 1;
                while ($row = $name->fetch_assoc()) : ?>
                    <?php echo '<label for="pilota">' . $row["nome"] . " " . $row["cognome"] ?>
                    <?php echo "</label>";
                    $selectPosizioni = 'SELECT posizione_arrivo from risultati_gare where id_gara = "' . $_POST["gara"] . '" AND id_pilota = "' . $row["matricola"] . '";';
                    $posizionePilota = mysqli_fetch_array($connessione->query($selectPosizioni), MYSQLI_ASSOC);
                    echo "<select name=p" . $j . ">";
                    for ($i = 1; $i < 17; $i++) {
                        if($i==$posizionePilota["posizione_arrivo"])
                            echo '<option selected = "selected" value=' . $i . '>' . $i . '°</option>';
                        else
                            echo "<option value=" . $i . ">" . $i . "°</option>";
                    }
                    echo "<option ";
                    if($posizionePilota["posizione_arrivo"]==99)
                        echo 'selected = "selected"';

                    echo "value=99>RIT</option>";
                    echo "</select>";
                    echo "</br>";
                    $j++; ?>
                <?php endwhile; ?>
            <?php else :
                echo "0 results";
            endif;
            /*for($i = 0; $i < 16; $i++) {
                echo "<select name='p'".$i.">";
            }*/
            ?>

            <button type="submit" name="save" value="save">Carica</button>
            <input type="reset" value="Cancella"/>
        </form>
        <?php
        }
        ?>

        <?php

        if (isset($_POST['save']) && !empty($_POST['save'])) {
            $check = 'SELECT id_gara from risultati_gare where id_gara = "' . $_POST["gara"] . '";';
            $ris = $connessione->query($check);
            if ($ris->num_rows > 0) {
                $sql2 ="";
                for ($i = 1; $i < 11; $i++) {
                    $sql2 .= 'UPDATE Risultati_Gare SET posizione_arrivo = "' . $_POST["p" . $i] . '",
                     punti = "' . punti($_POST["p" . $i]) . '" WHERE id_gara = "' . $_POST["gara"] . '" 
                     AND id_pilota = "'. (1000+$i) .'";';
                }
                $q2 = $connessione->multi_query($sql2);
                if (!$q2) {
                    echo "Errore db";
                    exit();
                } else {
                    echo "Tutto bene";
                }
            }
            else {
                $sql = "";
                for ($j = 1; $j < 11; $j++) {
                    $sql .= "INSERT INTO Risultati_Gare (id_gara, id_pilota, posizione_arrivo, punti)
        VALUES ('" . $_POST["gara"] . "','" . (1000 + $j) . "','" . $_POST["p" . $j] . "','" . punti($_POST["p" . $j]) . "');";
                }
                $q = $connessione->multi_query($sql);
                if (!$q) {
                    echo "Errore db";
                    exit();
                } else {
                    echo "Tutto bene";
                }
            }
        }

        ?>
    </div>
    </br>
<?php
endif;
?>
<?php
if($_GET["azione"]=="modificaGare") :
    ?>
    <div class="modifica">
        <h3> Modifica gare: </h3></br>

        <form method="post">
            <?php
            $select = "SELECT Gara.id, Pista.nome, Gara.giorno FROM `Pista` inner join Gara on Pista.id = Gara.id_pista
                    where gara.id not in (select id_gara from risultati_gare);";
            //$data = new Open();
            //$mysqli->connect();
            $pista = $connessione->query($select);
            if (mysqli_num_rows($pista) > 0) :
                // output data of each row
                ?>
                <select name="garaScelta">
                    <?php
                    while ($rower = $pista->fetch_assoc()) : ?>
                        <option value="<?php echo $rower["id"] ?>
                            <?php if(isset($_POST['garaScelta']) && $_POST['garaScelta'] == $rower["id"]) {
                            echo '" selected = "selected';
                        }
                        ?>" >
                            <?php echo $rower["nome"]." ".$rower["giorno"] ?></option>
                    <?php endwhile; ?>
                </select>
            <?php else :
                echo "0 results";
            endif;
            ?>
            <input type="submit" name="modifica" value="Modifica"/>
            <input type="reset" value="Cancella"/>
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
endif;
?>
<?php
if($_GET["azione"]=="inserimentoNews") :
?>
<div class="news">
    <form action="admin.php" method="post">
        <fieldset>
            <legend>Inserimento Nuova Notizia</legend>
            <label for='titolo'>Titolo:</label>
            <textarea rows='3' cols='50' name='titolo' id='titolo'  maxlenght='150'></textarea><br/>
            <label for='descrizione'>Descrizione:</label>
            <textarea rows='10' cols='50' name='descrizione' id='descrizione'  maxlenght='500'></textarea><br/>
            <label for='fonte'>Fonte:</label>
            <input name='fonte' id='fonte' maxlenght='50' /><br/>
            <label for='indirizzo'>Link:</label>
            <input name='indirizzo' id='indirizzo' maxlenght='200' /><br/>
            <label for='data'>Data:</label>
            <input name='data' id='data' maxlenght='50' /><br/>
            <input type="submit" value="Salva" />
            <input type="reset" value="Cancella"/>
        </fieldset>
    </form>

    <?php
    echo "fuori";
    if(isset($_POST["titolo"])){
        echo "dentro";
        $titolo = $_POST["titolo"];
        $descrizione = $_POST["descrizione"];
        $fonte = $_POST["fonte"];
        $indirizzo = $_POST["indirizzo"];
        $data = $_POST["data"];
        $query321 = "INSERT INTO Notizia(titolo,descrizione,fonte,indirizzo,data) VALUES ('$titolo','$descrizione','$fonte','$indirizzo','$data');";
        echo $query321;
        $connessione->query("INSERT INTO Notizia(titolo,descrizione,fonte,indirizzo,data) VALUES ('$titolo','$descrizione','$fonte','$indirizzo','$data');");
    }
    ?>
</div>

<?php
endif;
$connessione->close();
?>



<?php //endif; ?>
<?php include('common/footer.php') ?>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</html>