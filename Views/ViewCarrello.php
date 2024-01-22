<!DOCTYPE html>
<html>
<head>
    <title>Carrello</title>
    <script src="../JAVASCRIPT/Functions.js"></script>

    <link rel="stylesheet" type="text/css" href="../CSS/style.css">

</head>
<body>

<?php
require_once('../Manage/BusinessLogicProduct.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("./login.php");
}
$tmp = LogicProduct::ViewAllProductsCart($_SESSION['cart_id']);
?>

<h2>Carrello</h2>
<?php
$i = 0;
$f = 0;
foreach ($tmp as $cartProduct) {
    $tt = $cartProduct['prezzo'] * $cartProduct['quantita'];
    ?>
    <form action="../Actions/AddToCart.php" method="post" id="<?php echo $f; ?>">
        <label>Nome: <?php echo $cartProduct['nome']; ?></label><br>
        <label>Prezzo Unitario: <?php echo $cartProduct['prezzo']; ?></label><br>
        <label>Prezzo Complessivo: <?php echo $tt; ?></label><br>

        <label>Quantità nel carrello: </label>
        <input type="number" name="qty" min="0" value="<?php echo $cartProduct['quantita']; ?>"><br>
        <br>
        <input type="hidden" name="p_id" value="<?php echo $cartProduct['product_id']; ?>">
        <input type="button" name="Modifica" onclick="ActionCart(0, <?php echo $f; ?>)" value="Modifica">
        <input type="button" name="Elimina" onclick="ActionCart(1, <?php echo $f; ?>)" value="Elimina">
    </form>

    <?php
    $i += $tt;
    $f++;
}

?>
<span>Prezzo Totale: <?php echo $i; ?></span>
<form action="./ViewProducts.php">
    <input type="submit" value="Torna a tutti gli articoli">
</form>


</body>
</html>
