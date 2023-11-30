<?php

include_once 'dbh.class.php';

class adm extends dbh{

    public function newClient($name, $cpf){

        $id = $this->idGenerator();

        $sql = "INSERT INTO users (`id`, `name`, `cpf`) VALUES (?, ?, ?)";
        $stmt = $this->connection()->prepare($sql);

        if ($stmt->execute([$id, $name, $cpf])) {

            return TRUE;

        } else {

            $errorInfo = $stmt->errorInfo();
            return $errorInfo[2];

        }

    }
    
    public function listClients(){

        $sql = "SELECT * FROM users ORDER BY name";
        $login = $this->connection()->prepare($sql);
        $login->execute();
        return $login->fetchAll();

    }

    public function selectClient($cpf){

        $sql = "SELECT * FROM users WHERE cpf = ?";
        $login = $this->connection()->prepare($sql);
        $login->execute([$cpf]);
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

    public function deleteClient($id, $cpf){

        include_once "../classes/codes.class.php";

        $code = new codes();
        $deleteAllCodes = $code->deleteAllCodes($cpf);

        if ($deleteAllCodes) {
            
            $sql = "DELETE FROM users WHERE id = ?";
            $stmt = $this->connection()->prepare($sql);
            $deleted = $stmt->execute([$id]);
            
            if ($deleted){
    
                return $deleted;
    
            } else {
    
                $errorInfo = $stmt->errorInfo();
                return $errorInfo[2];
    
            }

        } else {

            $_SESSION['error'] = "{$deleteAllCodes}";
            header("Location: ../adm/painel.php?edited=1");

        }

    }

    public function idSelector($id){

        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();

    }

    public function idGenerator(){

        $id = rand(1000000, 9999999);

        while ($this->idSelector($id) != false){

            $id = rand(1000000, 9999999);
            
        }

        return $id;

    }

    
}


?>