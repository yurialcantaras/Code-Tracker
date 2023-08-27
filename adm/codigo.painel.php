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
        <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=10, minimum-scale=1.0">
        <link rel="stylesheet" href="../css/painel-style.css">
    </head>
    <body>
        <form action="../inc/cont.inc.php" method="POST">
            <div class="banner">
                <h1><?php echo "Histórico do Pedido ".$_GET['code'];?></h1>
                <button name="logout" type="submit" class="logout-button">Sair</button>
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
                            <form class='action-button delete' action='../inc/cont.inc.php' method='post' onsubmit='return confirmForm();'>
                                <input type='hidden' value='{$local['id']}' name='id'>
                                <input type='hidden' value='{$local['code']}' name='code'>
                                <input type='hidden' value='{$_GET['cpf']}' name='cpf'>
                                <input class='' type='submit' value='Excluir' name='deleteLocal'>
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
                    
                    <div class="fields">
                        <label for="local">Nova Localização:</label>
                        <input name="local" type="text" require><br>
                    </div>

                    <div class="field">
                        <label for="local">Data e Hora:</label>
                        <input type="datetime-local" id="datetime" name="datetime">
                    </div>

                    <div class="field">
                        <label for="local">Status:</label>
                        <select name="status">
                            <option value="tobrazil">Para o Brasil</option>
                            <option value="inbrazil">No Brasil</option>
                            <option value="delivered">Entregue</option>
                            <option value="notdelivered">Não entregue</option>
                            <option value="police">Fiscalizando</option>
                        </select><br>
                    </div>
                    
                    <input class="edit-button" type="submit" name="newLocal" value="Salvar">
                    <input class="cancel-button" onclick="hideNewCodeForm()" type="button" id="close-btn" value="fechar">
                </form>

            </div>
        </div>

        <script src="../js/javascript.js"></script>
    </body>
</html>

<?php
    if (isset($_SESSION['error'])){
        
        unset($_SESSION['error']);
        
    }
    
}else{

    header("Location: ../login.adm.php?login=0");

}

?>
