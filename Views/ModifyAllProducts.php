<!DOCTYPE html>
<html>
<head>
    <title>Prodotti</title>

    <script src="../JAVASCRIPT/Functions.js"></script>
    <link rel="stylesheet" type="text/css" href="../CSS/style.css">

</head>
<body>

<?php
require_once('../Manage/BusinessLogicProduct.php');
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ./login.php");
} else if ($_SESSION['role_id'] == 1) {
    header("Location: ./ViewProducts.php");
}
$tmp = LogicProduct::ViewAllProducts();
?>

<h2>Prodotti</h2>
<form method="post" name="FormAggiungi" action="../Actions/AddProduct.php">

    <input type="text" name="nome" placeholder="nome"><br>
    <input type="number" min="0" step=".01" name="prezzo" placeholder="prezzo"><br>
    <input type="text" name="marca" placeholder="marca"><br>
    <input type="submit" value="Aggiungi">

</form>
<?php
$i = 0;
foreach ($tmp as $product) {
    ?>
    <form method="post" name="Form<?php echo $i; ?>" action="../Actions/ModifyProduct.php" id="<?php echo $i; ?>">

        <input type="text" value="<?php echo $product->getNome(); ?>" name="nome"><br>
        <input type="number" min="0" step=".01" value="<?php echo $product->getPrezzo(); ?>" name="prezzo"><br>
        <input type="text" value="<?php echo $product->getMarca(); ?>" name="marca"><br>
        <input type="hidden" name="p_id" value="<?php echo $product->getID(); ?>">
        <input type="button" name="Modifica" onclick="ActionProduct(0, <?php echo $i; ?>)" value="Modifica">
        <input type="button" name="Elimina" onclick="ActionProduct(1, <?php echo $i; ?>)" value="Elimina">
    </form>
    <?php
    $i++;
}
?>

<a href="../Actions/logout.php">logout</a>
</body>
</html>