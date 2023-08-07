<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

if ($_SESSION['adm'] === TRUE) {

    include_once '../classes/adm.class.php';
    include_once '../classes/codes.class.php';

    $adm = new adm();
    $code = new codes();
    $users = $adm->listClients();

    if (!isset($_SESSION['message'])) {
        
        $_SESSION['message'] = " ";

    }

?>
<!DOCTYPE html>
<html>
<head>
    <title>Painel de Administração</title>
    <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=10, minimum-scale=1.0">
    <link rel="stylesheet" href="../css/painel-style.css">
</head>
<body>

    <div class="alert-container" id="alert">
        <?php echo $_SESSION['message']; ?>
        <span id="closeButton" onclick="closeAlert()">X</span>
    </div>
    
    <form action="../inc/cont.inc.php" method="POST">
        <div class="banner">
            <h1>Painel de Administração</h1>
            <button name="logout" type="submit" class="logout-button">Sair</button>
        </div>
    </form>
    <div class="panel">
        <div class="insert-button">
            <button onclick="showEditForm()">Novo Cliente</button>
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
                        <td>{$code->totalCodes($user['cpf'])}</td>
                        <td><a href='usuario.painel.php?cpf=".$user['cpf']."'><button id='view-btn' class='action-button view'>Vizualizar</button></a></td>
                    </tr>
                    ";
                }
                
                ?>
            </table>
        </div>
    </div>

    <div id="editForm">
        <div class="formContent">
            
            <form method="post" action="../inc/cont.inc.php" onsubmit="return confirmForm();">
                <h4 id="editing-user">Novo Cliente<b><span id="userName"></span></b></h4>
                <label for="name">Nome:</label>
                <input name="name" type="text"><br>
                <label for="cpf">CPF:</label>
                <input name="cpf" type="text"><br>
                <input class="edit-button" id="save-btn" type="submit" name="newClient" value="Salvar">
                <input class="cancel-button" onclick="hideEditForm()" type="button" id="close-btn" value="fechar">
            </form>

        </div>
    </div>

    <script src="../js/javascript.js"></script>
</body>
</html>

<?php

    echo "<script>showAlert();</script>";

    if (isset($_SESSION['message'])){
        
        unset($_SESSION['message']);
        
    }

}else{

    header("Location: ../login.adm.php?login=0");

}

?>
