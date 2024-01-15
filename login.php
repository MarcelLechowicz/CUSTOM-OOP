<?php
session_start();


if(isset($_POST['login']) && isset($_POST['pass'])){
  // Check if the login and password are provided and meet the minimum length requirement.
  if(strlen($_POST['login']) < 3 || strlen($_POST['pass']) < 3){
    // If not, set an error message, redirect to the index page, and exit.
    $_SESSION['error'] = "Dane muszą mieć więcej niż 3 znaki!";
    header('Location: index.php');
    exit();
  }
  else{
    // Sanitize the login input and retrieve the password.
    $login = htmlentities($_POST['login'], ENT_QUOTES, "UTF-8");
    $pass = $_POST['pass'];

    try{
      // Establish a database connection.
      $connection = new mysqli("localhost", "root", "", "logowanie");

      // Check for connection errors.
      if($connection->connect_errno != 0){
        throw new Exception(mysqli_connect_errno());
      }
      else{
        // Query the database for the user with the provided login.
        if($reply = mysqli_query($connection, "SELECT * FROM users WHERE login='$login'")){
          // Check if a user with the provided login exists.
          if($reply->num_rows > 0){
            $row = $reply->fetch_assoc();

            // Verify the entered password against the stored hashed password.
            if(password_verify($pass, $row['pass'])){
              // If successful, set session variables and redirect to the panel page.
              $_SESSION['logon'] = True;
              $_SESSION['login'] = $row['login'];

              $connection->close();
              header('Location: panel.php');
              exit();
            }
            else{
              // If the password doesn't match, set an error message and redirect to the indexx page.
              $_SESSION['error'] = "Dane są nieprawidłowe!";
              header('Location: indexx.php');
              exit();
            }
          }
          else{
            // If no user is found with the provided login, set an error message and redirect to the indexx page.
            $_SESSION['error'] = "Dane są nieprawidłowe!";
            header('Location: indexx.php');
            exit();
          }
        }
        else{
          // If there is an error with the database query, set an error message and redirect to the indexx page.
          $_SESSION['error'] = "Błąd zapytania bazy danych!";
          header('Location: indexx.php');
          exit();
        }
      }
    }
    catch(Exception $e){
      // If there is a general database error, set an error message and redirect to the indexx page.
      $_SESSION['error'] = "Błąd bazy danych!";
      header('Location: indexx.php');
      exit();
    }
  }
}
else{
  // If login and password are not provided, set an error message and redirect to the indexx page.
  $_SESSION['error'] = "Proszę wprowadzić dane!";
  header('Location: indexx.php');
  exit();
}