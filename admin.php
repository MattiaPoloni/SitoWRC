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


Inserimento dei risultati:

<form method="post">
    <select name="gara">
        <option value="20">gara1</option>
        <option value="21">gara2</option>
        <option value="3">gara3</option>
    </select>

    <select name="pilota">
        <option value="Tomare">Tomare</option>
        <option value="Olgierd">Olgierd</option>
        <option value="Von everec">Von everec</option>
    </select>

    <select name="posizione">
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
    </select>

    <button type="submit" name="save">Carica</button>
</form>

<?php
include "connessione.php";
//var_dump($connessione);
if (isset($_POST['save'])) {

    /*$sql = "INSERT INTO Gara (id, giorno, id_pista)
    VALUES (?,?,?)";
    $stmt = mysqli_prepare($sql);
    $pilota = "2018-01-25";
    $arrivo = 1;
    $punti = 1;
    $stmt->bind_param("dsd", $_POST['gara'], $pilota, $arrivo);*/

    $sql = "INSERT INTO Gara (id, giorno, id_pista)
    VALUES(20,2018-01-25,1);"; //funziona con gli id giusti
}
$q = $connessione->query($sql);
if (!$q) {
    echo "Errore db";
    exit();
} else {
    echo "Tutto bene";
}
$connessione->close();


?>

</body>

</html>