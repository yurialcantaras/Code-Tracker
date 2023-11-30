<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

if (!isset($_SESSION['message'])) {

  $_SESSION['message'] = "";
  
}

?>

<!DOCTYPE html>
<html>

<head>
  <title>Formulário de Login</title>
  <link rel="stylesheet" href="css/search.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="files/favicon.webp" type="image/webp">
</head>

<body>

  <div class="alert-container" id="alert">
    <?php echo $_SESSION['message']; ?>
    <span id="closeButton" onclick="closeAlert()"></span>
  </div>

  <div class="logo-container">
    <img src="files/logo-semfundo.png" alt="Evolua Sports Logo">
  </div>

  <div class="container">
    <h2>Localize seu Pedido</h2>
    <form action="inc/cont.inc.php" method="post">
      <input placeholder="Digite seu CPF aqui" type="number" id="cpf" name="cpf" required>
      <input type="submit" name="search" value="Entrar">
    </form>
  </div>
  
  <script src="js/javascript.js"></script>
</body>

<?php

echo "<script>showAlert();</script>";

if (isset($_SESSION['message'])){
    
    unset($_SESSION['message']);
    
}

?>

</html>