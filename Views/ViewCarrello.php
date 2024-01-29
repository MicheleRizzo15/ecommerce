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

if ($set = !isset($_SESSION['user_id'])) {
    header("Location: ./login.php");
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

<?php
if (!$set) {
    ?>

    <form action="./ViewProducts.php">
        <input type="submit" value="Torna a tutti gli articoli">
    </form>

    <form action="../Actions/logout.php">
        <input type="submit" value="Logout">
    </form>

    <!-- ipotetico pulsante Acquista
    dopo aver acquistato (e aver creato nel carrello il campo attivo booleano) lo setto a false e creo un nuovo carrello
    la creazione del carrello prevede questo campo a true di default
    il login prevede la ricerca del carrello con l'user_id richiesto e il campo valido a true
    -->

    <?php
}
?>

</body>
</html>
