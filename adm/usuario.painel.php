<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if ($_SESSION['adm'] === TRUE) {

    include_once '../classes/adm.class.php';
    include_once '../classes/codes.class.php';

    $adm = new adm();
    $user = $adm->selectClient($_GET['cpf']);

    $code = new codes();
    $codes = $code->listCodes($_GET['cpf']);

    if (!isset($_SESSION['error'])) {
        
        $_SESSION['error'] = " ";

    }

?>
<!DOCTYPE html>
<html>
<head>
    <title>Cliente <?php echo $user[0]['name']; ?></title>
    <link rel="stylesheet" href="../css/painel-style.css">
</head>
<body>
    <div id="message">
        <?php echo $_SESSION['error']; ?>
    </div>
    <form action="../inc/cont.inc.php" method="POST">
        <div class="banner">
            <h1>Cliente <?php echo $user[0]['name']; ?></h1>
            <button name="logout" type="submit" class="logout">Sair</button>
        </div>
    </form>

    <div class="info-container">

        <ul>
            <b><p id="userName"><?php echo $user[0]['name']; ?></p></b>
            <b><p id="userCpf"><?php echo $user[0]['cpf']; ?></p></b>
            <b><p><?php echo "Total Códigos: ".count($codes); ?></p></b>
        </ul>
        
        <div class="icons">
            <img onclick="showEditForm()" id="edit-button" src="../files/edit.png" alt="Ícone de Edição">
            <img id="delete-button" src="../files/delete.png" alt="Ícone de Exclusão">
        </div>

    </div>

    <div class="panel">
        <div class="insert-button">
            <button onclick="showNewCodeForm()">Nova Remessa</button>
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
                
                foreach ($codes as $cod) {

                    $local = $code->listLocal($cod['code']);
                    $local = end($local);

                    if ($local != false) {
                        
                        echo "
                            <tr>
                            <td>{$cod['code']}</td>
                            <td>{$local['historic']}</td>
                            <td>
                            <a href='codigo.painel.php?code=".$cod['code']."&cpf=".$_GET['cpf']."'><button id='view-btn' class='action-button view'>Histórico</button></a>
                            </td>
                            </tr>
                        ";
                    } else if ($local == false) {
                        
                        echo "
                            <tr>
                            <td>{$cod['code']}</td>
                            <td>Sem localização</td>
                            <td>
                            <a href='codigo.painel.php?code=".$cod['code']."&cpf=".$_GET['cpf']."'><button id='view-btn' class='action-button view'>Histórico</button></a>
                            </td>
                            </tr>
                        ";

                    }

                }
                ?>
            </table>
        </div>
    </div>

    <div id="editForm">
        <div class="formContent">
            
            <form method="post" action="../inc/cont.inc.php" onsubmit="return confirmForm();">
                <h4 class="editing-user">Alteração de Cliente</h4>
                <input name="editedId" type="hidden" value="<?php echo $user[0]['id']; ?>">
                <label for="name">Nome:</label>
                <input name="editedName"type="text" value="<?php echo $user[0]['name']; ?>"><br>
                <label for="cpf">CPF:</label>
                <input name="editedCpf"type="text" value="<?php echo $user[0]['cpf']; ?>"><br>
                <input class="edit-button" type="submit" name="editClient" value="Salvar">
                <input class="cancel-button" onclick="hideEditForm()" type="button" id="close-btn" value="fechar">
            </form>

        </div>
    </div>

    <div id="newCodeForm">
        <div class="formContent">
            
            <form method="post" action="../inc/cont.inc.php" onsubmit="return confirmForm();">
                <h4 class="editing-user">Nova Remessa</h4>
                <input type="hidden" name="cpf" value="<?php echo $_GET['cpf']; ?>">
                <label for="code">Código:</label>
                <input name="code" type="text"><br>
                <label for="local">Localização:</label>
                <input name="local" type="text"><br>
                <input class="edit-button" type="submit" name="newCode" value="Salvar">
                <input class="cancel-button" onclick="hideNewCodeForm()" type="button" id="close-btn" value="fechar">
            </form>

        </div>
    </div>

    <!-- NOVA LOCALIZAÇÃO PARA A REMESSA
        
    
    <div id="newLocForm">
        <div class="formContent">
            
            <form method="post" action="../inc/cont.inc.php" onsubmit="return confirmForm();">
                <h4 class="editing-user">Nova <b><span id="userName"></span></b></h4>
                <label for="code">Código:</label>
                <input name="code" type="text"><br>
                <label for="localization">Localização:</label>
                <input name="localization" type="text"><br>
                <input class="edit-button" type="submit" name="newLoc" value="Salvar">
                <input class="cancel-button" onclick="hideNewCodeForm()" type="button" id="close-btn" value="fechar">
            </form>

        </div>
    </div> -->

    <script src="../js/javascript.js"></script>
</body>
</html>

<?php

}else{

    header("Location: ../login.adm.php?login=0");

}

?>
