<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if ($_SESSION['adm'] === TRUE) {

    include_once '../classes/adm.class.php';

    $cpf = $_GET['cpf'];
    $adm = new adm();
    $codes = $adm->listCodes($_GET['codigo']);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Produtos de <?php $user['name'] ?></title>
    <link rel="stylesheet" href="../css/painel-style.css">
</head>
<body>
    <div class="banner">
        <h1>Painel de Administração</h1>
        <button class="logout">Sair</button>
    </div>
    <div class="back-button">
            <a href="usuario.painel.php"><button id="back-button">Voltar</button></a>
        </div>
    <div class="panel">
        <div class="insert-button">
            <button onclick="openInsertForm()">Novo Código</button>
        </div>
        <div class="table-container">
            <table>
                <tr>
                    <th>Código</th>
                    <th>Localização</th>
                    <th></th>
                </tr>
                
                <?php
                
                foreach ($codes as $code) {
                    
                    echo "
                    <tr>
                        <td>{$code['codigo']}</td>
                        <td>{$code['localizacao']}</td>
                        <td><a href='codigo.painel.php?codigo=".$code['codigo']."'><button id='view-btn' class='action-button view'>Histórico</button></a></td>
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
