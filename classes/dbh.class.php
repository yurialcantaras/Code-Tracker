<?php

class dbh{

<<<<<<< HEAD
    private $hst = "127.0.0.1";
    private $dbh = "tracker_db";
    private $usr = "root";
    private $pwd = "";
=======
    private $hst = "localhost";
    private $dbh = "localizador";
    private $usr = "root";
    private $pwd = "12345";
>>>>>>> 85759136dcba576719c15050778e57ee0954a462

    protected function connection(){

        $dsn = 'mysql:dbname=' . $this->dbh . ';host=' . $this->hst;
        $pdo = new PDO($dsn, $this->usr, $this->pwd);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;

    }

}

<<<<<<< HEAD
?>
=======
?>
>>>>>>> 85759136dcba576719c15050778e57ee0954a462
