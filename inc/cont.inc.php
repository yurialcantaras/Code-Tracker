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

    if (count($adm->selectUser($newCpf)) == 0) {

        $newClient = $adm->newClient($newName, $newCpf);

        if ($newClient) {
            
            $_SESSION['error'] = "Cliente cadastrado com sucesso!";
            header("Location: ../adm/usuario.painel.php?cpf={$newCpf}&newClient=1");

        }else{

            $_SESSION['error'] = $newClient;
            header("Location: ../adm/usuario.painel.php?edited=1");
        
        }
        
    } else {

        var_dump(count($adm->selectUser($newCpf)));

    }

    
}


if (isset($_POST['editClient'])) {
    
    $editedId = $_POST['editedId'];
    $editedName = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['editedName']);
    $editedCpf = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['editedCpf']);

    $adm = new adm();
    $editedUser = $adm->editUser($editedName, $editedCpf, $editedId);

    if ($editedUser) {
        
        $_SESSION['error'] = "Cliente alterado com sucesso!";
        header("Location: ../adm/usuario.painel.php?user={$editedCpf}&edited=1");

    }else{

        $_SESSION['error'] = $editedUser;
        header("Location: ../adm/usuario.painel.php?edited=1");
        
    }

}

if (isset($_POST['newCode'])) {
    
    $editedId = $_POST['editedId'];
    $editedName = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['editedName']);
    $editedCpf = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['editedCpf']);

    $adm = new adm();
    $editedUser = $adm->editUser($editedName, $editedCpf, $editedId);

    if ($editedUser) {
        
        $_SESSION['error'] = "Cliente alterado com sucesso!";
        header("Location: ../adm/usuario.painel.php?user={$editedCpf}&edited=1");

    }else{

        $_SESSION['error'] = $editedUser;
        header("Location: ../adm/usuario.painel.php?edited=1");
        
    }
}


?>