<!DOCTYPE html>
<html>
<head>
    <title>Prodotti</title>
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