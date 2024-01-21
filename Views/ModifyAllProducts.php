<!DOCTYPE html>
<html>
<head>
    <title>Prodotti</title>
    <script>
        function Action(n, id) {
            if (n == 0) {
                document.getElementById(id).action = "../Actions/ModifyProduct.php";
                document.getElementById(id).submit();
            } else if (n == 1) {
                document.getElementById(id).action = "../Actions/DeleteProduct.php";
                document.getElementById(id).submit();
            }
            else if (n == 2){
                document.getElementById(id).action = "../Actions/AddProduct.php";
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
else if($_SESSION['role_id'] == 1){
    header("./ViewProducts.php");
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
        <input type="button" name="Modifica" onclick="Action(0, <?php echo $i; ?>)" value="Modifica">
        <input type="button" name="Elimina" onclick="Action(1, <?php echo $i; ?>)" value="Elimina">
    </form>
    <?php
    $i++;
}
?>


</body>
</html>