<?php
require_once('../Manage/BusinessLogicUser.php');

$email = $_POST['email'];
$password = $_POST['password'];
$ruolo = $_POST['ruolo'];

// Chiamata alla funzione di registrazione
$registrationError = LogicUser::signUp($password, $email, $ruolo);

if ($registrationError == 0) {
    // Registrazione avvenuta con successo
    if($ruolo == 1){
        header('Location: ../Views/ViewProducts.php');
    }
    else{
        header('Location: ../Views/ModifyAllProducts.php');
    }
} else {
    // Gestisci gli errori di registrazione
    if ($registrationError == 2) {
        echo "Errore durante la registrazione. Si prega di riprovare.";
    } elseif ($registrationError == 1) {
        echo "L'utente con questa email esiste già.";
    }
}

?>

