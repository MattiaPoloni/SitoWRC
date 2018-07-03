<?php
$connessione = mysqli_connect("127.0.0.1", "root", "sqladm", "wrc");
if ($connessione->connect_errno) {
    echo "Connessione Fallita";
    exit();
}
mysqli_set_charset($connessione, "utf8");
