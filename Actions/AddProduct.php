<?php
require_once('../Manage/BusinessLogicProduct.php');

$nome = $_POST['nome'];
$prezzo = $_POST['prezzo'];
$marca = $_POST['marca'];

if(LogicProduct::AddProduct($nome, $prezzo, $marca)==0){
    header("Location: ../Views/ModifyAllProducts.php");
}
else{
    echo "Errore";
}

?>