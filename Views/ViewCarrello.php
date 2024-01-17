<!DOCTYPE html>
<html>
<head>
    <title>Carrello</title>
    <script>
        function Action(n, id) {
            if (n == 0) {
                document.getElementById(id).action = "../Actions/ModifyQTY.php";
                document.getElementById(id).submit();
            } else if (n == 1) {
                document.getElementById(id).action = "../Actions/Delete.php";
                document.getElementById(id).submit();
            }

        }
    </script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #222;
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
            padding: 20px;
        }

        h2 {
            color: #fff;
            margin-bottom: 20px;
        }

        form {
            background-color: #333;
            padding: 20px;
            border-radius: 10px;
            width: calc(33.33% - 20px);
            margin-bottom: 20px;
            text-align: left;
            box-sizing: border-box;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #fff;
        }

        input[type="number"],
        input[type="submit"],
        input[type="button"] {
            padding: 10px;
            margin: 5px 0;
            width: 100%;
            box-sizing: border-box;
        }

        input[type="submit"],
        input[type="button"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover,
        input[type="button"]:hover {
            background-color: #45a049;
        }
    </style>
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
        <input type="button" name="Modifica" onclick="Action(0, <?php echo $f; ?>)" value="Modifica">
        <input type="button" name="Elimina" onclick="Action(1, <?php echo $f; ?>)" value="Elimina">
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
