<?php

include_once "dbh.class.php";

class codes extends dbh{

    public function listCodes($cpf){

        $sql = "SELECT * FROM codes WHERE cpf = ?";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute([$cpf]);
        
        return $stmt->fetchAll();

    }

}

?>