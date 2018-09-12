<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="it">
<head>
    <!-- meta tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="description" content="Pagina Amministrazione"/>
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <link rel="stylesheet" type="text/css" href="css/print.css" media="print"/>
    <title>Amministrazione</title>

    <script
            src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
    <script src="js/admin.js" type="text/javascript"></script>
</head>
<body id="admin">
<div class="container">
    <?php include('common/header.html') ?>
    <?php include "connessione.php"; ?>
    <?php require "funzioni.php"; ?>
    <?php require "session.php"; ?>

    <h1>Welcome <?php echo $_SESSION['login_user']; ?></h1>
    <div class="azioni">
        <a id="ins" href="admin.php?azione=inserimentoRisultati" tabindex="1">Inserimento Risultati</a>
        <a id="mod" href="admin.php?azione=modificaGare" tabindex="1">Modifica infomazioni gare</a>
        <a id="insN" href="admin.php?azione=inserimentoNews" tabindex="1">Inserimento News</a>
    </div>
    <?php
    if ($_GET["azione"] == "inserimentoRisultati") :
        ?>
        <div class="risultati">
            <form method="post" action="admin.php?azione=inserimentoRisultati" id="insRisultatiForm">
                <fieldset>
                    <legend>Inserimento dei risultati</legend>
                    <?php


                    $selectGare = "SELECT Gara.id, Pista.nome, Gara.giorno FROM `Pista` inner join Gara on Pista.id = Gara.id_pista ;";

                    $gara = $connessione->query($selectGare);
                    if ($gara->num_rows > 0) :

                        echo '<select id="risultati" name="gara" tabindex="1">'; ?>
                        <?php
                        while ($row = $gara->fetch_assoc()) : ?>
                            <?php
                            echo '<option value="' . $row['id'] . '" ';
                            if (isset($_POST['gara']) && $_POST['gara'] == $row["id"])
                                echo ' selected= "selected"';
                            ?>
                            <?php echo ">" . $row["nome"] . " " . $row["giorno"] . "</option>"; ?>
                        <?php endwhile;
                        echo "</select>"; ?>
                    <?php else :
                        echo "0 results";
                    endif;
                    ?>
                    <?php
                    echo '<input class="button" id="visualizzaRisultati" type="submit" name="garaSelezionata" value="Posizioni" tabindex="1"/>';
                    echo "<br />";
                    ?>

                    <?php

                    if (isset($_POST['garaSelezionata']) && !empty($_POST['garaSelezionata'])) {

                        $selectPiloti = "SELECT matricola, nome, cognome FROM Pilota;";

                        $name = $connessione->query($selectPiloti);

                        $garePresenti = 'SELECT id_gara from Risultati_Gare where id_gara = "' . $_POST["gara"] .'";';
                        $garaPresente = mysqli_fetch_array($connessione->query($garePresenti), MYSQLI_ASSOC);
                        if(empty($garaPresente)) {

                            echo '<h3> Gara non ancora disputata </h3>';
                        }

                        if ($name->num_rows > 0) :
                            ?>
                            <?php
                            //$vet = [];
                            $j = 1;
                            while ($row = $name->fetch_assoc()) : ?>
                                <?php echo '<label for="pilota">' . $row["nome"] . " " . $row["cognome"] ?>
                                <?php echo "</label>";
                                $selectPosizioni = 'SELECT posizione_arrivo from Risultati_Gare where id_gara = "' . $_POST["gara"] . '" AND id_pilota = "' . $row["matricola"] . '";';
                                $posizionePilota = mysqli_fetch_array($connessione->query($selectPosizioni), MYSQLI_ASSOC); ?>
                                <?php echo '<select name="p' . $j . '" tabindex="1">'; ?>
                                <?php
                                for ($i = 1; $i < 17; $i++) {
                                    if ($i == $posizionePilota["posizione_arrivo"]) {
                                        echo '<option selected = "selected" value=' . $i . '>' . $i . '°</option>';
                                        //array_push($vet,$i);
                                    }
                                    else
                                        echo "<option value=" . $i . ">" . $i . "°</option>";
                                }
                                echo "<option "; ?>
                                <?php
                                if ($posizionePilota["posizione_arrivo"] == 99)
                                    echo 'selected = "selected"';

                                echo 'value="99">RIT</option>'; ?>
                                <?php echo "</select>"; ?>
                                <br />
                                <?php
                                $j++;

                            endwhile; ?>
                        <?php else :
                            echo "0 results";
                        endif;
                        ?>

                        <button type="submit" name="save" value="save" id="inserisciRisultati" tabindex="1" disabled="disabled">Carica</button>


                        <?php
                    }
                    ?>
                </fieldset>
            </form>
            <?php
            $vet = array();
            if (isset($_POST['save']) && !empty($_POST['save'])) {
                $check = 'SELECT id_gara from Risultati_Gare where id_gara = "' . $_POST["gara"] . '";';
                $ris = $connessione->query($check);
                if ($ris->num_rows > 0) {
                    $sql2 = "";
                    for ($i = 1; $i < 11; $i++) {
                        $sql2 .= 'UPDATE Risultati_Gare SET posizione_arrivo = "' . $_POST["p" . $i] . '",
                     punti = "' . punti($_POST["p" . $i]) . '" WHERE id_gara = "' . $_POST["gara"] . '" 
                     AND id_pilota = "' . (1000 + $i) . '";';
                        if($_POST["p" . $i]!="99")
                            array_push($vet,$_POST["p" . $i]);
                    }
                    if (!duplicatiArray($vet)) {
                        $q2 = $connessione->multi_query($sql2);

                        if (!$q2) {
                            echo "Errore db";
                            exit();
                        }
                    }
                    else
                        echo "<h3> Dati non corretti </h3>";

                }
                else {
                    $sql = "";
                    for ($j = 1; $j < 11; $j++) {
                        $sql .= "INSERT INTO Risultati_Gare (id_gara, id_pilota, posizione_arrivo, punti)
        VALUES ('" . $_POST["gara"] . "','" . (1000 + $j) . "','" . $_POST["p" . $j] . "','" . punti($_POST["p" . $j]) . "');";
                    }
                    if (!duplicatiArray($vet)) {
                        $q = $connessione->multi_query($sql);
                        if (!$q) {
                            echo "Errore db";
                            exit();
                        }
                    }
                    else
                        echo "<h3> Dati non corretti </h3>";
                }
            }



            ?>
        </div>
    <?php
    endif;
    ?>
    <?php
    if ($_GET["azione"] == "modificaGare") :
        ?>
        <div class="modifica">
            <form method="post" action="admin.php?azione=modificaGare">
                <fieldset>
                    <legend>Modifica gare</legend>
                    <?php

                    $select = "SELECT Gara.id, Pista.nome, Gara.giorno FROM `Pista` inner join Gara on Pista.id = Gara.id_pista
            where Gara.id not in (select id_gara from Risultati_Gare);";

                    $pista = mysqli_query($connessione, $select);
                    if (mysqli_num_rows($pista) > 0) :
                        echo '<select name="garaScelta" tabindex="1">'; ?>
                        <?php
                        while ($rower = $pista->fetch_assoc()) : ?>

                            <?php echo '<option value="' . $rower['id'] . '" '; ?>
                            <?php if (isset($_POST['garaScelta']) && $_POST['garaScelta'] == $rower["id"]) {
                                echo ' selected = "selected"';
                            }
                            echo '>'; ?>
                            <?php echo $rower["nome"] . " " . $rower["giorno"] . "</option>" ?>
                        <?php endwhile;
                        echo "</select>"; ?>
                    <?php else :
                        echo "0 results";
                    endif; ?>
                    <input class="button" type="submit" name="modifica" value="Modifica" tabindex="1"/>
                </fieldset>
            </form>

            <?php
            if (isset($_POST["modifica"]) && !empty($_POST["modifica"])) {
                $dati = "SELECT Pista.nome,Pista.citta,Pista.stato,Gara.giorno,Pista.tipo,Pista.id as pistaId,Gara.id as garaId 
                      FROM Gara INNER JOIN Pista on id_pista=Pista.id
                      WHERE Gara.id=" . $_POST["garaScelta"];
                $data = $connessione->query($dati); ?>
                <form method="post" action="admin.php?azione=modificaGare">
                    <fieldset>
                        <?php
                        while ($row3 = $data->fetch_assoc()) {
                            echo '<input class="modG" type="text" size = "40" name="nomePista" tabindex="1" value="' . $row3["nome"] . '">';
                            echo '<input class="modG"type="text" name="cittaPista" tabindex="1" value="' . $row3["citta"] . '">';
                            echo '<input class="modG"type="text" name="statoPista" tabindex="1" value="' . $row3["stato"] . '">';
                            echo '<input class="modG"type="text" name="giornoGara" tabindex="1" value="' . $row3["giorno"] . '">';
                            echo '<input class="modG"type="text" name="tipoPista" tabindex="1" value="' . $row3["tipo"] . '">';
                            echo '<input type="hidden" name="idPista" tabindex="1" value="' . $row3["pistaId"] . '">';
                            echo '<input type="hidden" name="idGara" tabindex="1" value="' . $row3["garaId"] . '">';
                        } ?>
                        <button type="submit" name="applica" value="Applica modifiche" id="applicaModificheGara" tabindex="1">Applica
                            Modifiche
                        </button>
                    </fieldset>
                </form>
                <?php
            }
            ?>

            <?php
            if (isset($_POST["applica"]) && !empty($_POST["applica"])) {
                $updatePista = "UPDATE Pista
                        SET nome = \"" . $_POST["nomePista"] . "\", citta = \"" . $_POST["cittaPista"] . "\",
                        stato = \"" . $_POST["statoPista"] . "\",tipo = \"" . $_POST["tipoPista"] .
                    "\" WHERE id = " . $_POST["idPista"] . ";";

                $updateGara = "UPDATE Gara
                        SET giorno = \"" . $_POST["giornoGara"] .
                    "\" WHERE id = " . $_POST["idGara"] . ";";
                $connessione->query($updatePista);
                $connessione->query($updateGara);
            }
            ?>
        </div>
    <?php
    endif;
    ?>
    <?php
    if ($_GET["azione"] == "inserimentoNews") :
        ?>
        <div class="news">
            <form id="insNews" action="admin.php?azione=inserimentoNews" method="post">
                <fieldset>
                    <legend>Inserimento News</legend>
                    <label for='titolo'>Titolo:</label>
                    <textarea rows='3' cols='30' name='titolo' id='titolo' tabindex="1"></textarea><br/>
                    <label for='descrizione'>Descrizione:</label>
                    <textarea rows='10' cols='30' name='descrizione' id='descrizione' tabindex="1"></textarea><br/>
                    <label for='fonte'>Fonte:</label>
                    <input name='fonte' id='fonte' maxlength='50' tabindex="1"/><br/>
                    <label for='indirizzo'>Link:</label>
                    <input name='indirizzo' id='indirizzo' maxlength='200' tabindex="1"/><br/>
                    <label for='data'>Data:</label>
                    <input name='data' id='data' maxlength='50' tabindex="1"/><br/>
                    <input class="button" type="submit" value="Salva" id="inserisciNews" tabindex="1"/>

                    <input class="button" type="reset" value="Cancella" tabindex="1"/>
                </fieldset>
            </form>

            <?php

            if (isset($_POST["titolo"])) {

                $titolo = $_POST["titolo"];
                $descrizione = $_POST["descrizione"];
                $fonte = $_POST["fonte"];
                $indirizzo = $_POST["indirizzo"];

                $data = $_POST["data"];
                $query321 = "INSERT INTO Notizia(titolo,descrizione,fonte,indirizzo,data) VALUES ('$titolo','$descrizione','$fonte','$indirizzo','$data');";
                //$regFonte =
                if($titolo.length > 0 && $titolo.length < 150 && $descrizione.length > 0 && $descrizione.length < 500)
                    $connessione->query("INSERT INTO Notizia(titolo,descrizione,fonte,indirizzo,data) VALUES ('$titolo','$descrizione','$fonte','$indirizzo','$data');");
            }
            ?>
        </div>

    <?php
    endif;
    $connessione->close();
    ?>

</div>
<div id="tornaSu"><img src="media/tornaSu.png" alt="Torna Su" /></div>
<?php include('common/footer.php') ?>
</body>

</html>

