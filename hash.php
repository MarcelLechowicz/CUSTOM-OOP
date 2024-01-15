<?php

if(isset($_POST['haslo'])) {
    $haslo = $_POST['haslo'];

    // Hashing the entered password using the password_hash function
    $hash = password_hash($haslo, PASSWORD_DEFAULT);

    // Displaying the hashed password
    echo 'Zrobione: '.$hash;

    // The form to input the password is below this section
}

?>

<!DOCTYPE HTML>
<html>
        <head>
            <title>HASHOWANIE HASEŁ</title>
        </head>
        <body>
            <form method="post">
                Haslo: <input type="text" name="haslo" /><br/>    
                <input type="submit" value="HASZUJ"/>
            </form>
        </body>
</html>