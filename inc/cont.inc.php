<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include_once "../classes/user.class.php";
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


?>