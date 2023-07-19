<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if ($_SESSION['adm'] === TRUE) {

    include_once '../classes/adm.class.php';

    $adm = new adm();
    $users = $adm->listUsers();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Painel de Administração</title>
    <link rel="stylesheet" href="../css/painel-style.css">
</head>
<body>
    <div class="banner">
        <h1>Painel de Administração</h1>
        <button class="logout">Sair</button>
    </div>
    <div class="panel">
        <div class="insert-button">
            <button onclick="openInsertForm()">Novo Usuário</button>
        </div>
        <div class="table-container">
            <table>
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Códigos Cadastrados</th>
                    <th></th>
                </tr>
                
                <?php
                
                foreach ($users as $user) {
                    
                    echo "
                    <tr>
                        <td>{$user['name']}</td>
                        <td>{$user['cpf']}</td>
                        <td>{$adm->numCodes($user['cpf'])}</td>
                        <td><a href='usuario.painel.php?user=".$user['cpf']."'><button id='view-btn' class='action-button view'>Vizualizar</button></a></td>
                    </tr>
                    ";
                }
                
                ?>
                
            </table>
        </div>
    </div>

    <div id="popup">
        <div id="popup-content">
            <h4 id="editing-user">Você deseja aditar o usuário <b><span id="userName"></span></b></h4>
            <button id="save-btn">Salvar</button>
            <button id="close-btn">fechar</button>
        </div>
    </div>

    <script src="../js/javascript.js"></script>
</body>
</html>

<?php

}else{

    header("Location: adm.php?login=0");

}

?>
