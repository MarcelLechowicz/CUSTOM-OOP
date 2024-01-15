<!DOCTYPE html>
<html lang="en">
<?php
session_start();
?>
<head>
    <meta charset="UTF-8">
    <title>Milionerzy</title>
    <link rel="stylesheet" type="text/css" href="styl.css">
    <title>Milionerzy</title>
</head>
<body>
    <header>
        Witaj graczu! 
        <br>
        Podaj dane logowania
        <br><br>
    </header>
    <main> 
    <form method="post" action="login.php">
    Podaj login: <input type="text" name="login" placeholder="Login" />
    <br/><br>
    Podaj haslo: <input type="password" name="pass" placeholder="Hasło" />
    <br/><br><br>
    <input type="submit" value="Zaloguj się" />
  </form>
  
  <?php
    if(isset($_SESSION['error'])){
      echo '<span style="color: red; font-weight: bold;">'.$_SESSION['error'].'</span>';
      unset($_SESSION['error']);
    }
  ?>


    </main>
    
</body>
</html>