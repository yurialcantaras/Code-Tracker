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
    <h2>Login</h2>
    <form action="inc/cont.inc.php" method="post">
      <label for="email">Email:</label>
      <input type="text" id="email" name="eml" required>

      <label for="password">Senha:</label>
      <input type="password" id="password" name="sna" required>

      <input type="submit" name="login" value="Entrar">
    </form>
  </div>
</body>
</html>
