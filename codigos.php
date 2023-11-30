<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

<<<<<<< HEAD
if ($_SESSION['search'] === TRUE) {
=======
if ($_SESSION['pesquisa'] === TRUE) {
>>>>>>> 85759136dcba576719c15050778e57ee0954a462

    include_once 'classes/codes.class.php';
    $cod = new codes();
    $locals = $cod->listLocal($_GET['code']);

    if (!isset($_SESSION['error'])) {
        
<<<<<<< HEAD
        $_SESSION['error'] = "";
=======
        $_SESSION['error'] = " ";
>>>>>>> 85759136dcba576719c15050778e57ee0954a462

    }

?>
<!DOCTYPE html>
<html>
<head>
    <title>Pedido <?php echo $_GET['code']; ?></title>
    <link rel="stylesheet" href="css/allcodes-client.css">
    <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=10, minimum-scale=1.0">
<<<<<<< HEAD
    <link rel="icon" href="files/favicon.webp" type="image/webp">
=======
>>>>>>> 85759136dcba576719c15050778e57ee0954a462
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
<<<<<<< HEAD

                <?php
                
                foreach ($locals as $local) {
                    
=======
                
                <?php
                
                foreach ($locals as $local) {

>>>>>>> 85759136dcba576719c15050778e57ee0954a462
                    $date = new DateTime($local['record_date']);
                    $dateFormat = $date->format('d/m/Y H:i');
                    $local['record_date'] = $dateFormat;

<<<<<<< HEAD
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
=======
                    echo "
                    <tr>
                        <td></td>
>>>>>>> 85759136dcba576719c15050778e57ee0954a462
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

<<<<<<< HEAD
    $_SESSION['message'] = "Acesso negado";
    header("Location: index.php?alert=1");
=======
    header("Location: ../index.php?login=0");
>>>>>>> 85759136dcba576719c15050778e57ee0954a462

}

?>
