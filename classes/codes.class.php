<?php

include_once "dbh.class.php";

class codes extends dbh{

    public function newCode($cpf, $code, $local){

        $sql = "INSERT INTO codes (`cpf`, `code`) VALUES (?, ?)";
        $stmt = $this->connection()->prepare($sql);

        if ($stmt->execute([$cpf, $code])) {

            if ($this->newLocal($code, $local)) {
                
                return TRUE;

            } else {

                return "Acho ao cadastrar localização";

            }

        } else {

            $errorInfo = $stmt->errorInfo();
            return $errorInfo[2];

        }

    }

    public function listCodes($cpf){

        $sql = "SELECT * FROM codes WHERE cpf = ?";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute([$cpf]);
        
        return $stmt->fetchAll();

    }

    public function existCode($code){

        $sql = "SELECT * FROM historic WHERE code = ?";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute([$code]);

        return $stmt->fetch();

    }

    public function totalCodes($cpf){

        $sql = "SELECT * FROM codes WHERE cpf = ?";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute([$cpf]);
        return $stmt->rowCount();
        
    }

    public function newLocal($code, $local){

        $date = date('Y-m-d H:i:s');
        $sql = "INSERT INTO historic (`code`, `historic`, `record_date`) VALUES (?, ?, ?)";
        $stmt = $this->connection()->prepare($sql);

        if ($stmt->execute([$code, $local, $date])) {
            
            return true;

        } else {

            $errorInfo = $stmt->errorInfo();
            return $errorInfo[2];

        }

    }

    public function listLocal($code){

        $sql = "SELECT * FROM historic WHERE code = ?";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute([$code]);
        
        return $stmt->fetchAll();

    }
    
    public function deleteLocal(){

        

    }


    public function editLocal(){

        

    }

}

?>