<?php
    $connessione = mysqli_connect("127.0.0.1", "root","","wrc");
    mysqli_set_charset($connessione,"utf8");
    if($connessione->connect_errno) {
        echo "Connessione Fallita";
        exit();
    }
?>

