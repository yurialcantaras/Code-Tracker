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
    
    if ($allCodes != 0) {

        
        $userName = $user->getName($allCodes[0]['cpf']);

        $_SESSION['allCodes'] = $allCodes;
        $_SESSION['userName'] = $userName;
        $_SESSION['pesquisa'] = true;
        header("Location: ../listagem.php?cpf={$cpf}");

    }else{

        $_SESSION['message'] = "Cliente não cadastrado.";
        header("Location: ../index.php?list=0");

    }

}

if (isset($_POST['newClient'])) {
    
    $newName = preg_replace('/[^\p{L}0-9\s]/u', '', $_POST['name']);
    $newCpf = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['cpf']);

    $adm = new adm();

    if (count($adm->selectClient($newCpf)) == 0) {

        $newClient = $adm->newClient($newName, $newCpf);

        if ($newClient) {
            
            $_SESSION['message'] = "Cliente cadastrado com sucesso!";
            header("Location: ../adm/usuario.painel.php?cpf={$newCpf}&alert=1");

        }else{

            $_SESSION['message'] = $newClient;
            header("Location: ../adm/usuario.painel.php?alert=1");
        
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
        
        $_SESSION['message'] = "Cliente excluido com sucesso!";
        header("Location: ../adm/painel.php?alert=1");

    }else{

        $_SESSION['message'] = $$deleteClient;
        header("Location: ../adm/painel.php?alert=1");
        
    }
    
}

if (isset($_POST['editClient'])) {
    
    $editedId = $_POST['editedId'];
    $editedName = preg_replace('/[^\p{L}0-9\s]/u', '', $_POST['editedName']);
    $editedCpf = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['editedCpf']);

    $adm = new adm();
    $editedUser = $adm->editClient($editedName, $editedCpf, $editedId);

    if ($editedUser) {
        
        $_SESSION['message'] = "Cliente alterado com sucesso!";
        header("Location: ../adm/usuario.painel.php?cpf={$editedCpf}&alert=1");

    }else{

        $_SESSION['message'] = $editedUser;
        header("Location: ../adm/usuario.painel.php?alert=1");
        
    }

}

if (isset($_POST['newCode'])) {
    
    $cpf = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['cpf']);
    $code = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['code']);
    $local = preg_replace('/[^\p{L}0-9\s]/u', '', $_POST['local']);
    $date = $_POST['datetime'];
    $datetime = date("Y-m-d H:i:s", strtotime($date));
    $status = $_POST['status'];
    
    $adm = new codes();
    $existCode = $adm->existCode($code);

    if ($existCode == false) {

        $newCode = $adm->newCode($cpf, $code, $local, $datetime, $status);
    
        if ($newCode) {
            
            $_SESSION['message'] = "Novo código cadastrado com sucesso!";
            header("Location: ../adm/usuario.painel.php?cpf={$cpf}&alert=1");
    
        }else{
    
            $_SESSION['message'] = $editedUser;
            header("Location: ../adm/usuario.painel.php?cpf={$cpf}alert=1");
            
        }
        
    } else {
        
        $_SESSION['message'] = "Pedido já existe para algum cliente";
        header("Location: ../adm/usuario.painel.php?cpf={$cpf}&alert=1");        

    }
    
}

if (isset($_POST['deleteCode'])) {
    
    $id = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['id']);
    $code = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['code']);
    $cpf = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['cpf']);

    $adm = new codes();
    $deleteCode = $adm->deleteCode($id, $code);

    if ($deleteCode) {
        
        $_SESSION['message'] = "Histórico excluido com sucesso!";
        header("Location: ../adm/usuario.painel.php?cpf={$cpf}&alert=1");

    }else{

        $_SESSION['message'] = $$deleteLocal;
        header("Location: ../adm/usuario.painel.php?cpf={$cpf}&alert=1");
        
    }

}

if (isset($_POST['newLocal'])) {
    
    $cpf = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['cpf']);
    $code = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['code']);
    $local = preg_replace('/[^\p{L}0-9\s]/u', '', $_POST['local']);
    $date = $_POST['datetime'];
    $datetime = date("Y-m-d H:i:s", strtotime($date));
    
    $adm = new codes();
    $newLocal = $adm->newLocal($code, $local, $datetime, $status);

    if ($newLocal) {
        
        $_SESSION['message'] = "Novo código cadastrado com sucesso!";
        header("Location: ../adm/codigo.painel.php?cpf={$cpf}&code={$code}&alert=1");

    }else{

        $_SESSION['message'] = $editedUser;
        header("Location: ../adm/usuario.painel.php?cpf={$cpf}alert=1");
        
    }
    
}

if (isset($_POST['deleteLocal'])) {
    
    $id = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['id']);
    $cpf = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['cpf']);
    $code = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['code']);

    $adm = new codes();
    $deleteLocal = $adm->deleteLocal($id);

    if ($deleteLocal) {
        
        $_SESSION['message'] = "Histórico excluido com sucesso!";
        header("Location: ../adm/codigo.painel.php?code={$code}&cpf={$cpf}&alert=1");

    }else{

        $_SESSION['message'] = $$deleteLocal;
        header("Location: ../adm/codigo.painel.php?code={$code}&cpf={$cpf}&alert=1");
        
    }

}


?>