<?php

include_once 'dbh.class.php';

class adm extends dbh{

    public function newClient($name, $cpf){

        $sql = "INSERT INTO users (`name`, `cpf`) VALUES (?, ?)";
        $stmt = $this->connection()->prepare($sql);

        if ($stmt->execute([$name, $cpf])) {

            return TRUE;

        } else {

            $errorInfo = $stmt->errorInfo();
            return $errorInfo[2];

        }

    }

    public function selectClient($cpf){

        $sql = "SELECT * FROM users WHERE cpf = ?";
        $login = $this->connection()->prepare($sql);
        $login->execute([$cpf]);
        return $login->fetchAll();

    }
    
    public function listClients(){

        $sql = "SELECT * FROM users ORDER BY name";
        $login = $this->connection()->prepare($sql);
        $login->execute();
        return $login->fetchAll();

    }

    public function editClient($editedName, $editedCpf, $editedId){

        $sql = "UPDATE users SET name = ?, cpf = ? WHERE id = ?";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute([$editedName, $editedCpf, $editedId]);

        if ($stmt->execute()) {

            return $stmt->execute();

        } else {

            $errorInfo = $stmt->errorInfo();
            return $errorInfo[2];

        }

    }
    
    
}


?>