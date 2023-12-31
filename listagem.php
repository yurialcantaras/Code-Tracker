<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if ($_SESSION['search'] === TRUE) {

    include_once 'classes/adm.class.php';
    include_once 'classes/codes.class.php';

    $adm = new adm();
    $user = $adm->selectClient($_GET['cpf']);

    if ($user != false) {
        
        $code = new codes();
        $codes = $code->listCodes($_GET['cpf']);
    
        if (!isset($_SESSION['error'])) {
            
            $_SESSION['error'] = "";
    
        }

?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $user[0]['name']; ?></title>
        <link rel="stylesheet" href="css/allcodes-client.css">
        <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=10, minimum-scale=1.0">
        <link rel="icon" href="files/favicon.webp" type="image/webp">
    </head>
    <body>
        <div id="message">
            <?php echo $_SESSION['error']; ?>
        </div>
        <div class="banner">
            <div class="logo-container">
                <a id="logodesk" href="index.php"><img src="files/logo-canto.png" alt="Evolua Sports Logo"></a>
            </div>
            <h1 class="mainTittle">Seja bem vindo(a) <?php echo $user[0]['name']; ?>!</h1>
            <a href="index.php" class="logout-button">Voltar</a>
        </div>

        <div class="panel">
            <div class="table-container">
                <table>
                    <tr>
                        <th class="orderTittle">Pedido</th>
                        <th class="locationTittle">Última Localização</th>
                    </tr>
                    <?php
                    
                    foreach ($codes as $cod) {

                        $local = $code->listLocal($cod['code']);
                        $local = reset($local);

                        if ($local != false) {
                            
                            echo "
                                <tr>
                                    <td class='orderTittle code'><a href='codigos.php?code={$cod['code']}&cpf={$_GET['cpf']}'>{$cod['code']}</a></td>
                                    <td class='locationTittle text'><a href='codigos.php?code={$cod['code']}&cpf={$_GET['cpf']}'>{$local['historic']}</a></td>
                                </tr>
                            ";
                        } else if ($local == false) {
                            
                            echo "
                                <tr>
                                    <td class='orderTittle'><a href='codigos.php?code={$cod['code']}&cpf={$_GET['cpf']}'>{$cod['code']}</a></td>
                                    <td class='locationTittle text'><a href='codigos.php?code={$cod['code']}&cpf={$_GET['cpf']}'>Sem Localização</a></td>
                                </tr>
                            ";

                        }

                    }
                    ?>
                </table>
            </div>
        </div>

        <footer>

            <span class="bottom-text"><b>Suporte: (45) 98820-9378 | contato@evoluasports.com.br</b></span>

        </footer>

        <script src="js/javascript.js"></script>
    </body>
</html>

<?php

    }else{

        session_destroy();
        header("Location: index.php");

    }

}else{

    $_SESSION['message'] = "Acesso negado";
    header("Location: index.php?alert=1");

}

?>
