<?php

class dbh{

    private $hst = "127.0.0.1";
    private $dbh = "tracker_db";
    private $usr = "root";
    private $pwd = "";

    protected function connection(){

        $dsn = 'mysql:dbname=' . $this->dbh . ';host=' . $this->hst;
        $pdo = new PDO($dsn, $this->usr, $this->pwd);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;

    }

}

?>
