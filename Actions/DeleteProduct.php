<?php
require_once('../Manage/BusinessLogicProduct.php');

$p_id = $_POST['p_id'];

if(LogicProduct::DeleteProduct($p_id)==0){
    header("Location: ../Views/ModifyAllProducts.php");
}
else{
    echo "Errore";
}

?>