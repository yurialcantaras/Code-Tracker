<?php

include_once "dbh.class.php";

class codes extends dbh{

    public function newCode($cpf, $code, $local, $datetime){

        $sql = "INSERT INTO codes (`cpf`, `code`) VALUES (?, ?)";
        $stmt = $this->connection()->prepare($sql);

        if ($stmt->execute([$cpf, $code])) {

            if ($this->newLocal($code, $local, $datetime)) {
                
                return TRUE;

            } else {

                return "Acho ao cadastrar localização";

            }

        } else {

            $errorInfo = $stmt->errorInfo();
            return $errorInfo[2];

        }

    }

    public function deleteCode($id, $code){

        $historic = $this->listLocal($code);

        if ($historic){

            $this->deleteAllLocal($code);
            
        }
        
        $sql = "DELETE FROM codes WHERE id = ?";
        $stmt = $this->connection()->prepare($sql);
        
        $deleted = $stmt->execute([$id]);
        
        if ($deleted){

            return $deleted;

        } else {

            $errorInfo = $stmt->errorInfo();
            return $errorInfo[2];

        }

    }

    public function deleteAllCodes($cpf){

        // Deleting historic
        $codes = $this->listCodes($cpf);

        foreach ($codes as $cod) {
            
            $this->deleteAllLocal($cod['code']);

        }

        // Deleting all codes
        
        $sql = "DELETE FROM codes WHERE cpf = ?";
        $stmt = $this->connection()->prepare($sql);
        $deleted = $stmt->execute([$cpf]);
        
        if ($deleted){

            return $deleted;

        } else {

            $errorInfo = $stmt->errorInfo();
            return $errorInfo[2];

        }

    }

    public function listCodes($cpf){

        $sql = "SELECT * FROM codes WHERE cpf = ? ORDER BY ID DESC";
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

    public function newLocal($code, $local, $datetime){

        $sql = "INSERT INTO historic (`code`, `historic`, `record_date`) VALUES (?, ?, ?)";
        $stmt = $this->connection()->prepare($sql);

        if ($stmt->execute([$code, $local, $datetime])) {
            
            return true;

        } else {

            $errorInfo = $stmt->errorInfo();
            return $errorInfo[2];

        }

    }

    public function listLocal($code){

        $sql = "SELECT * FROM historic WHERE code = ? ORDER BY record_date DESC";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute([$code]);
        
        return $stmt->fetchAll();

    }
    
    public function deleteLocal($id){

        $sql = "DELETE FROM historic WHERE id = ?";
        $stmt = $this->connection()->prepare($sql);
        
        $deleted = $stmt->execute([$id]);
        
        if ($deleted){

            return $deleted;

        } else {

            $errorInfo = $stmt->errorInfo();
            return $errorInfo[2];

        }

    }

    public function deleteAllLocal($code){

        $sql = "DELETE FROM historic WHERE code = ?";
        $stmt = $this->connection()->prepare($sql);
        
        $deleted = $stmt->execute([$code]);
        
        if ($deleted){

            return $deleted;

        } else {

            $errorInfo = $stmt->errorInfo();
            return $errorInfo[2];

        }

    }

}

?>