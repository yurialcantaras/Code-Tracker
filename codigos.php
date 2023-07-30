<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if ($_SESSION['pesquisa'] === TRUE) {

    include_once 'classes/codes.class.php';
    $cod = new codes();
    $locals = $cod->listLocal($_GET['code']);

    if (!isset($_SESSION['error'])) {
        
        $_SESSION['error'] = " ";

    }

?>
<!DOCTYPE html>
<html>
<head>
    <title>Pedido <?php echo $_GET['code']; ?></title>
    <link rel="stylesheet" href="css/allcodes-client.css">
    <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=10, minimum-scale=1.0">
</head>
<body>
    <div class="banner">
        <h1 class="historic"><?php echo "Histórico do Pedido ".$_GET['code'];?></h1>
        <a class="logout-button" href="listagem.php?cpf=<?php echo $_GET['cpf'];?>&list=1">Voltar</a>
    </div>
    
    <div class="panel">
        <div class="table-container">
            <table>
                <tr>
                    <th class="locationTittle">Histórico</th>
                </tr>
                
                <?php
                
                foreach ($locals as $local) {

                    echo "
                    <tr>
                        <td class='locationTittle'>{$local['record_date']}<br><b>{$local['historic']}</b></td>
                    </tr>
                    ";
                }
                
                ?>
                
            </table>
        </div>
    </div>

    <footer>
        
        <b>Suporte: (45) 98820-9378 | contato@evoluasports.com.br</b>

    </footer>

    <script src="js/javascript.js"></script>
</body>
</html>

<?php

}else{

    header("Location: ../index.php?login=0");

}

?>
