<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if ($_SESSION['adm'] === TRUE) {

    include_once '../classes/adm.class.php';
    include_once '../classes/codes.class.php';

    $cpf = $_GET['cpf'];
    $adm = new adm();
    $cod = new codes();

    $user = $adm->selectClient($_GET['cpf']);
    $locals = $cod->listLocal($_GET['code']);

    if (!isset($_SESSION['error'])) {
        
        $_SESSION['error'] = " ";

    }

?>
<!DOCTYPE html>
<html>
<head>
    <title>Produtos de <?php echo $user[0]['name']; ?></title>
    <link rel="stylesheet" href="../css/painel-style.css">
</head>
<body>
    <form action="../inc/cont.inc.php" method="POST">
        <div class="banner">
            <h1><?php echo "Histórico da Remessa ".$_GET['code'];?></h1>
            <button name="logout" type="submit" class="logout">Sair</button>
        </div>
    </form>
    
    <div class="panel">
        <div class="insert-button">
            <button onclick="showNewCodeForm()">Nova Localização</button>
        </div>
        <div class="back-button">
            <a href="usuario.painel.php?cpf=<?php echo $user[0]['cpf'];?>"><button id="back-button">Voltar</button></a>
        </div>
        <div class="table-container">
            <table>
                <tr>
                    <th>Histórico</th>
                    <th>Data e Hora</th>
                    <th></th>
                </tr>
                
                <?php
                
                foreach ($locals as $local) {

                    echo "
                    <tr>
                        <td>{$local['historic']}</td>
                        <td>{$local['record_date']}</td>
                        <td>
                        <form action='../inc/cont.inc.php' method='post' onsubmit='return confirmForm();'>
                            <input type='hidden' value='{$local['id']}' name='id'>
                            <input type='hidden' value='{$local['code']}' name='code'>
                            <input type='hidden' value='{$_GET['cpf']}' name='cpf'>
                            <input id='delete-local' type='submit' value='Excluir' name='deleteLocal'>
                        </form>
                        </td>
                    </tr>
                    ";
                }
                
                ?>
                
            </table>
        </div>
    </div>

    <div id="newCodeForm">
        <div class="formContent">
            
            <form method="post" action="../inc/cont.inc.php" onsubmit="return confirmForm();">
                <input type="hidden" name="code" value="<?php echo $_GET['code']; ?>">
                <input type="hidden" name="cpf" value="<?php echo $_GET['cpf']; ?>">
                <label for="local">Nova Localização:</label>
                <input name="local" type="text" require><br>
                <label for="local">Data e Hora:</label>
                <input type="datetime-local" id="datetime" name="datetime">
                <input class="edit-button" type="submit" name="newLocal" value="Salvar">
                <input class="cancel-button" onclick="hideNewCodeForm()" type="button" id="close-btn" value="fechar">
            </form>

        </div>
    </div>

    <script src="../js/javascript.js"></script>
</body>
</html>

<?php

}else{

    header("Location: ../login.adm.php?login=0");

}

?>
