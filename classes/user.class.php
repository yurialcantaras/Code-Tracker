<?php

include_once "dbh.class.php";

class user extends dbh{

    public $eml;
    public $sna;
    public $cpf;

    public function adm($eml, $sna){

        $sql = "SELECT email, senha FROM adm WHERE email = ? AND senha = ?";
        $login = $this->connection()->prepare($sql);
        $login->execute([$eml, $sna]);
        return $login->fetchColumn();

    }

    public function getName($cpf){

        $sql = "SELECT name FROM users WHERE cpf = ?";
        $user = $this->connection()->prepare($sql);
        $user->execute([$cpf]);
        return $user->fetchColumn();

    }

    public function cpfExist($cpf){

        $sql = "SELECT * FROM users WHERE cpf = ?";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute([$cpf]);
        return $stmt->fetchColumn();

    }

    public function editUser($editedName, $editedCpf, $editedId){

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