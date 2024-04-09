<?php

require_once('../Manage/BusinessLogicProduct.php');
session_start();


// Verifica se l'utente è loggato, altrimenti reindirizza alla pagina di login
if (isset($_SESSION['cart_id'])) {
        // Ottieni l'ID del carrello dell'utente
        $cart_id = $_SESSION['cart_id'];

        // Svuota il carrello
        $result = LogicProduct::EmptyCart($cart_id);

        if ($result == 0) {
            // Svuotamento del carrello riuscito, reindirizza alla pagina dei prodotti
            header("Location: ../Views/ViewProducts.php");
        } else {
            header("Location: ../Views/login.php");
        }

}
?>