<?php
    $connessione = new mysqli("127.0.0.1", "root","","wrc");
    if($connessione->connect_errno) {
        echo "Connessione Fallita";
        exit();
    }
?>
