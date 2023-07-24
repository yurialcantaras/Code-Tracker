<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

if (!isset($_SESSION['error'])) {
        
  $_SESSION['error'] = " ";

}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Formulário de Login</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="container">
    <h2>Localize seu pedido</h2>
    <form action="inc/cont.inc.php" method="post">
      <label for="cpf">CPF:</label>
      <input type="text" id="cpf" name="cpf" required>

      <input type="submit" name="search" value="Entrar">
    </form>
  </div>
</body>
<script>

  // Criar alertas de erros

</script>
</html> 
