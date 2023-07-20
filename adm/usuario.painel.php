<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if ($_SESSION['adm'] === TRUE) {

    include_once '../classes/adm.class.php';

    $adm = new adm();
    $codes = $adm->listCodes($_GET['user']);
    $user = $adm->selectUser($_GET['user']);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Cliente <?php echo $user[0]['name']; ?></title>
    <link rel="stylesheet" href="../css/painel-style.css">
</head>
<body>
    <div class="banner">
        <h1>Cliente <?php echo $user[0]['name']; ?></h1>
        <button class="logout">Sair</button>
    </div>

    <div class="info-container">

        <ul>
            <b><p id="userName"><?php echo $user[0]['name']; ?></p></b>
            <b><p id="userCpf"><?php echo $user[0]['cpf']; ?></p></b>
            <b><p><?php echo "Total Códigos: ".count($codes); ?></p></b>
        </ul>
        
        <div class="icons">
            <img onclick="showPopup()" id="edit-button" src="../files/edit.png" alt="Ícone de Edição">
            <img id="delete-button" src="../files/delete.png" alt="Ícone de Exclusão">
        </div>

    </div>

    <div class="panel">
        <div class="insert-button">
            <button onclick="openInsertForm()">Nova Remessa</button>
        </div>
        <div class="back-button">
            <a href="painel.php"><button id="back-button">Voltar</button></a>
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
                        <td><a href='codigo.painel.php?codigo=".$code['codigo']."&cpf=".$_GET['user']."'><button id='view-btn' class='action-button view'>Histórico</button></a></td>
                    </tr>
                    ";
                }
                ?>
            </table>
        </div>
    </div>

    <div id="popup">
        <div id="popup-content">
            
            <form method="post" action="../inc/cont.inc.php">
                <h4 id="editing-user">Alteração de Cliente<b><span id="userName"></span></b></h4>
                <input name="editedId" type="hidden" value="<?php echo $user[0]['id']; ?>">
                <label for="name">Nome:</label>
                <input name="editedName"type="text" value="<?php echo $user[0]['name']; ?>"><br>
                <label for="cpf">CPF:</label>
                <input name="editedCpf"type="text" value="<?php echo $user[0]['cpf']; ?>"><br>
                <input class="edit-button" id="save-btn" type="submit" value="Salvar">
                <input class="cancel-button" onclick="hidePopup()" type="button" id="close-btn" value="fechar">
            </form>

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
