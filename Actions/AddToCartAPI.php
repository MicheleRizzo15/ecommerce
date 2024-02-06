<?php
require_once('../Manage/BusinessLogicProduct.php');

session_start();

// Verifica se la variabile di sessione 'cart_id' è impostata, indicando che l'utente è autenticato
if (isset($_SESSION['cart_id']) == true) {
    $articolo_id = $_GET['p_id'];
    $qty = $_GET['qty'];

    //aggiungo al carrello e reindirizzo
    if (LogicProduct::AddProducts($_SESSION['cart_id'], $qty, $articolo_id) == 0) {
        //header('Location: ../Views/ViewProducts.php');
        echo "ok";
    }
} else {
    //reindirizzo al login
    //header('Location: ../Views/Login.php');
    echo "no";
}


?>