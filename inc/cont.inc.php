<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include_once "../classes/user.class.php";
include_once "../classes/adm.class.php";
include_once "../classes/codes.class.php";
$allCodes = null;

if (isset($_POST['login'])) {
    
    $_SESSION['adm'] = FALSE;

    $eml = $_POST['eml'];
    $sna = $_POST['sna'];
    $adm = new user();
    
    if ($adm->adm($eml, $sna)) {

        $_SESSION['adm'] = TRUE;
        header("Location: ../adm/painel.php");

    } else{

        header("Location: ../login.adm.php?login=0");

    }

}

if (isset($_POST['logout'])) {

    session_destroy();
    header("Location: ../login.adm.php");

}

if (isset($_POST['search'])) {

    $cpf = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['cpf']);
    $codes = new codes();
    $user = new user();
    $allCodes = $codes->listCodes($cpf);
    $userName = $user->getName($allCodes[0]['cpf']);

    if ($allCodes) {

        $_SESSION['allCodes'] = $allCodes;
        $_SESSION['userName'] = $userName;
        header("Location: ../listagem.php?list=1");

    }else{

        header("Location: ../index.php?list=0");

    }

}

if (isset($_POST['newClient'])) {
    
    $newName = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['name']);
    $newCpf = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['cpf']);

    $adm = new adm();

    if (count($adm->selectClient($newCpf)) == 0) {

        $newClient = $adm->newClient($newName, $newCpf);

        if ($newClient) {
            
            $_SESSION['error'] = "Cliente cadastrado com sucesso!";
            header("Location: ../adm/usuario.painel.php?cpf={$newCpf}&newClient=1");

        }else{

            $_SESSION['error'] = $newClient;
            header("Location: ../adm/usuario.painel.php?edited=1");
        
        }
        
    } else {

        var_dump(count($adm->selectClient($newCpf)));

    }

    
}

if (isset($_POST['deleteClient'])) {

    $id = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['id']);
    $cpf = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['cpf']);

    $adm = new adm();
    $deleteClient = $adm->deleteClient($id, $cpf);

    if ($deleteClient) {
        
        $_SESSION['alert'] = "Cliente excluido com sucesso!";
        header("Location: ../adm/painel.php?edited=1");

    }else{

        $_SESSION['error'] = $$deleteClient;
        header("Location: ../adm/painel.php?edited=1");
        
    }
    
}


if (isset($_POST['editClient'])) {
    
    $editedId = $_POST['editedId'];
    $editedName = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['editedName']);
    $editedCpf = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['editedCpf']);

    $adm = new adm();
    $editedUser = $adm->editClient($editedName, $editedCpf, $editedId);

    if ($editedUser) {
        
        $_SESSION['error'] = "Cliente alterado com sucesso!";
        header("Location: ../adm/usuario.painel.php?user={$editedCpf}&edited=1");

    }else{

        $_SESSION['error'] = $editedUser;
        header("Location: ../adm/usuario.painel.php?edited=1");
        
    }

}

if (isset($_POST['newCode'])) {
    
    $cpf = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['cpf']);
    $code = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['code']);
    $local = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['local']);
    $date = $_POST['datetime'];
    $datetime = date("Y-m-d H:i:s", strtotime($date));
    
    $adm = new codes();
    $existCode = $adm->existCode($code);

    if ($existCode == false) {

        $newCode = $adm->newCode($cpf, $code, $local, $datetime);
    
        if ($newCode) {
            
            $_SESSION['alert'] = "Novo código cadastrado com sucesso!";
            header("Location: ../adm/usuario.painel.php?cpf={$cpf}&edited=1");
    
        }else{
    
            $_SESSION['error'] = $editedUser;
            header("Location: ../adm/usuario.painel.php?cpf={$cpf}edited=0");
            
        }
        
    } else {
        
        $_SESSION['alert'] = "Remessa já existe para esse cliente";
        header("Location: ../adm/usuario.painel.php?cpf={$cpf}&edited=0");        

    }
    
}

if (isset($_POST['deleteCode'])) {
    
    $id = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['id']);
    $code = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['code']);
    $cpf = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['cpf']);

    $adm = new codes();
    $deleteCode = $adm->deleteCode($id, $code);

    if ($deleteCode) {
        
        $_SESSION['alert'] = "Histórico excluido com sucesso!";
        header("Location: ../adm/usuario.painel.php?cpf={$cpf}&edited=1");

    }else{

        $_SESSION['error'] = $$deleteLocal;
        header("Location: ../adm/usuario.painel.php?cpf={$cpf}&edited=1");
        
    }

}

if (isset($_POST['newLocal'])) {
    
    $cpf = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['cpf']);
    $code = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['code']);
    $local = preg_replace('/[^\p{L}0-9\s]/u', '', $_POST['local']);
    $date = $_POST['datetime'];
    $datetime = date("Y-m-d H:i:s", strtotime($date));
    
    $adm = new codes();
    $newLocal = $adm->newLocal($code, $local, $datetime);

    if ($newLocal) {
        
        $_SESSION['alert'] = "Novo código cadastrado com sucesso!";
        header("Location: ../adm/codigo.painel.php?cpf={$cpf}&code={$code}&edited=1");

    }else{

        $_SESSION['error'] = $editedUser;
        header("Location: ../adm/usuario.painel.php?cpf={$cpf}edited=0");
        
    }
    
}

if (isset($_POST['deleteLocal'])) {
    
    $id = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['id']);
    $cpf = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['cpf']);
    $code = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['code']);

    $adm = new codes();
    $deleteLocal = $adm->deleteLocal($id);

    if ($deleteLocal) {
        
        $_SESSION['alert'] = "Histórico excluido com sucesso!";
        header("Location: ../adm/codigo.painel.php?code={$code}&cpf={$cpf}&edited=1");

    }else{

        $_SESSION['error'] = $$deleteLocal;
        header("Location: ../adm/codigo.painel.php?code={$code}&cpf={$cpf}&edited=0");
        
    }

}


?>