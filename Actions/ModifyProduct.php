<?php
require_once('../Manage/BusinessLogicProduct.php');

$p_id = $_POST['p_id'];
$nome = $_POST['nome'];
$prezzo = $_POST['prezzo'];
$marca = $_POST['marca'];

if(LogicProduct::UpdateProduct($p_id, $nome, $prezzo, $marca)==0){
    header("Location: ../Views/ModifyAllProducts.php");
}
else{
    echo "Errore";
}

?>