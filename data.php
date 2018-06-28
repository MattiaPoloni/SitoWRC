<?php namespace data;
DEFINE("HOST", "127.0.0.1");
DEFINE("USER","root");
DEFINE("PASS","");
DEFINE("DB","wrc");


class Data {
    private $host = "127.0.0.1";
    private $user = "root";
    private $pass = "aaaaa";
    private $db   = "wrc";

    public function getHost () {
        $host = $this->host;
    }
    public function getUser () {
        $user = $this->user;
    }

    public function getPass () {
        $pass = $this->pass;
    }

    public function getDb () {
        $db   = $this->db;
    }

}