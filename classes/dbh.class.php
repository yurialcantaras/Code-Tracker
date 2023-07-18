<?php

class dbh{

    private $hst = "localhost";
    private $dbh = "localizador";
    private $usr = "root";
    private $pwd = "12345";

    protected function connection(){

        $dsn = 'mysql:dbname=' . $this->dbh . ';host=' . $this->hst;
        $pdo = new PDO($dsn, $this->usr, $this->pwd);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;

    }

}

?>