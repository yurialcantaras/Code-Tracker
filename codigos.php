<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if ($_SESSION['search'] === TRUE) {

    include_once 'classes/codes.class.php';
    $cod = new codes();
    $locals = $cod->listLocal($_GET['code']);

    if (!isset($_SESSION['error'])) {
        
        $_SESSION['error'] = "";

    }

?>
<!DOCTYPE html>
<html>
<head>
    <title>Pedido <?php echo $_GET['code']; ?></title>
    <link rel="stylesheet" href="css/allcodes-client.css">
    <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=10, minimum-scale=1.0">
    <link rel="icon" href="files/favicon.webp" type="image/webp">
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
                    <th></th>
                    <th class="locationTittle">Histórico</th>
                </tr>

                <?php
                
                foreach ($locals as $local) {
                    
                    $date = new DateTime($local['record_date']);
                    $dateFormat = $date->format('d/m/Y H:i');
                    $local['record_date'] = $dateFormat;

                    if ($local['icon'] == 1) {

                        $icon = "./files/decolar.png";

                    }else if ($local['icon'] == 2) {

                        $icon = "./files/caminhao-de-entrega.png";

                    }else if ($local['icon'] == 3) {

                        $icon = "./files/entrega-feita.png";

                    }else if ($local['icon'] == 4) {

                        $icon = "./files/entrega-nao-feita.png";
                        
                    }else if ($local['icon'] == 5) {
                        
                        $icon = "./files/lupa.png";

                    }
                    
                    echo "
                    <tr>
                        <td class='historyIcon'><img src='{$icon}' alt=''></td>
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

    $_SESSION['message'] = "Acesso negado";
    header("Location: index.php?alert=1");

}

?>
