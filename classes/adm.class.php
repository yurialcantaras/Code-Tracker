<?php

include_once 'dbh.class.php';

class adm extends dbh{

    
    public function listUsers(){

        $sql = "SELECT * FROM users";
        $login = $this->connection()->prepare($sql);
        $login->execute();
        return $login->fetchAll();

    }

    public function selectUser($cpf){

        $sql = "SELECT * FROM users WHERE cpf = ?";
        $login = $this->connection()->prepare($sql);
        $login->execute([$cpf]);
        return $login->fetchAll();

    }

    public function listCodes($cpf){

        $sql = "SELECT * FROM codes WHERE cpf = ?";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute([$cpf]);
        return $stmt->fetchAll();

    }

    public function numCodes($cpf){

        $sql = "SELECT * FROM codes WHERE cpf = ?";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute([$cpf]);
        return $stmt->rowCount();

    }
    
    
}


?>