<!DOCTYPE html>
<html>
<head>
    <title>Prodotti</title>
    <link rel="stylesheet" type="text/css" href="../CSS/style.css">
</head>
<body>

<?php
require_once('../Manage/BusinessLogicProduct.php');
session_start();
if (!isset($_SESSION['user_id'])) {
    header("./login.php");
}
else if($_SESSION['role_id'] == 2){
    header("./ModifyAllProducts.php");
}
$tmp = LogicProduct::ViewAllProducts();
?>

<h2>Prodotti</h2>
<?php
$i = 0;

foreach ($tmp as $product) {
    ?>
    <form method="post" name="Form<?php echo $i; ?>" action="../Actions/AddToCart.php">

        <label>Nome: <?php echo $product->getNome(); ?></label><br>
        <label>Prezzo: <?php echo $product->getPrezzo(); ?></label><br>
        <label>Marca: <?php echo $product->getMarca(); ?></label><br>
        <label>Quantità: </label>
        <input type="number" name="qty" min="0" value="0"><br>
        <input type="hidden" name="p_id" value="<?php echo $product->getID(); ?>">
        <input type="submit" value="Aggiungi al carrello">

    </form>
    <?php
    $i++;
}
?>
<form method="post" name="Form2" action="./ViewCarrello.php">
    <input type="submit" name="carrello" value="Visualizza Carrello">
</form>


</body>
</html>