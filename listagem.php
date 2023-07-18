<?php

if ($_GET['list'] == 1) {

    session_start();
    $userName = $_SESSION['userName'];

?>
<!DOCTYPE html>
<html>
<head>
    <title>Localizador</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
<div class="codeslist">
    
    <h1>Localização do Produto</h1>
    <h3><?php echo $userName; ?></h3>

    <table>
        <tr>
            <th>Código</th>
            <th>Localização</th>
        </tr>

        <?php
                    
        if (isset($_SESSION['allCodes'])) {

            $allCodes = $_SESSION['allCodes'];
            
            foreach ($allCodes as $code) {
                
                echo "<tr><td>{$code['codigo']}</td><td>{$code['localizacao']}</td></tr>";
                
            }
            
        } else {
        
        header("Location: index.php?code=0");
        
        }
    
        ?>
    </table>

    <p><a href="index.php">Voltar</a></p>
</div>

</body>
</html>

<?php

} else {

    header("Location: index.php?code=0");  

}

?>
