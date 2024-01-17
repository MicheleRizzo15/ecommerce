<?php
require_once('../Manage/BusinessLogicUser.php');

$email = $_POST['email'];
$password = $_POST['password'];

// Chiamata alla funzione di registrazione
$registrationError = LogicUser::signUp($password, $email);

if ($registrationError == 0) {
    // Registrazione avvenuta con successo
    header('Location: ../Views/ViewProducts.php');
} else {
    // Gestisci gli errori di registrazione
    if ($registrationError == 2) {
        echo "Errore durante la registrazione. Si prega di riprovare.";
    } elseif ($registrationError == 1) {
        echo "L'utente con questa email esiste già.";
    }
}

?>

