<?php

class Open extends data\Data
{
    public function connect()
    {
        $connessione = new mysqli($this->getData(), $this->getUser(), $this->getPass(), $this->getDb());
        if($connessione->connect_errno) {
            echo "Connessione Fallita";
            exit();
        }
    }

}
/** Secondo modo */
include ("data.php");
$mysqli = new mysqli(HOST, USER, PASS, DB);


/**
 * Su un altro file
    include "connessione.php"
    // istanza della classe
    $data = new Open();
    // chiamata alla funzione di connessione
    $data->connetti();
 */



/*    $connessione = mysqli_connect("127.0.0.1", "root","sqladm","wrc");
    if($connessione->connect_errno) {
        echo "Connessione Fallita";
        exit();
    }
*/
