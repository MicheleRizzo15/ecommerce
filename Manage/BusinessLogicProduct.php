<?php
require_once 'DbManager.php';
require_once '../Object/Product.php';

class LogicProduct
{
    public static function getConnection()
    {
        $dbManager = new DbManager('ecommerce', 'psw:YNvXpnc1[Phk_@hj', 'ecommerce5f');
        $connection = $dbManager->getConnectionPDO();
        return $connection;
    }

    public static function ViewAllProducts()
    {
        $connection = self::getConnection();
        $queryStr = "SELECT * FROM ecommerce5f.products";
        $statement = $connection->prepare($queryStr);
        $statement->execute() == true;
        // Recupero dei prodotti come oggetti della classe Product
        $currentProducts = $statement->fetchAll(PDO::FETCH_CLASS, 'product');
        return $currentProducts;
    }

    public static function AddProducts($cart_id, $qty, $articolo)
    {
        $connection = self::getConnection();

        $queryStr = "SELECT quantita FROM ecommerce5f.cart_products WHERE cart_id = :cart_id and product_id = :product_id";
        $statement = $connection->prepare($queryStr);
        $statement->bindParam(':cart_id', $cart_id);
        $statement->bindParam(':product_id', $articolo);
        // Esecuzione della query e gestione dell'esito
        if ($statement->execute()) {
            if ($statement->rowCount() == 0) {
                //header('Location: ./a.html');
                $queryStr = "INSERT INTO ecommerce5f.cart_products (cart_id, product_id, quantita) VALUES (:cart_id, :product_id, :qty)";
                $statement = $connection->prepare($queryStr);
                $statement->bindParam(':cart_id', $cart_id);
                $statement->bindParam(':product_id', $articolo);
                $statement->bindParam(':qty', $qty);
                // Esecuzione della query e gestione dell'esito
                if ($statement->execute()) {
                    return 0; // Successo
                }
            } else {
                //header('Location: ./b.html');
                $q = $statement->fetch(PDO::FETCH_ASSOC);
                $q = $q['quantita'];
                $q = intval($q) + intval($qty);
                return self::ModifyQTYProducts($cart_id, $q, $articolo);

            }
        } else {
            return 2; // Errore
        }
        return 2; // Errore
    }

    public static function ViewAllProductsCart($cart_id)
    {
        $connection = self::getConnection();
        $queryStr = "SELECT products.nome, products.prezzo, products.marca, SUM(cart_products.quantita) as quantita, cart_products.product_id FROM cart_products INNER JOIN products on cart_products.product_id=products.id WHERE cart_products.cart_id = :cart_id GROUP BY product_id";
        $statement = $connection->prepare($queryStr);
        $statement->bindParam(':cart_id', $cart_id);
        // Esecuzione della query e recupero dei prodotti nel carrello come oggetti della classe Product
        if ($statement->execute() == true) {
            $currentProducts = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $currentProducts;

    }

    public static function ModifyQTYProducts($cart_id, $qty, $articolo)
    {
        // Verifica se la quantità è zero per eliminare il prodotto
        if ($qty == 0) {
            return self::Delete($cart_id, $articolo);
        } else {
            $connection = self::getConnection();

            $queryStr = "UPDATE ecommerce5f.cart_products SET quantita=:qty WHERE cart_id=:cart_id and product_id=:articolo";
            $statement = $connection->prepare($queryStr);
            $statement->bindParam(':cart_id', $cart_id);
            $statement->bindParam(':articolo', $articolo);
            $statement->bindParam(':qty', $qty);
            // Esecuzione della query e gestione dell'esito
            if ($statement->execute() == true) {
                return 0;
            }
            return 2;
        }

    }

    public static function Delete($cart_id, $articolo)
    {
        $connection = self::getConnection();

        $queryStr = "DELETE FROM ecommerce5f.cart_products WHERE product_id=:articolo and cart_id=:cart_id";
        $statement = $connection->prepare($queryStr);
        $statement->bindParam(':cart_id', $cart_id);
        $statement->bindParam(':articolo', $articolo);
        // Esecuzione della query e gestione dell'esito
        if ($statement->execute() == true) {
            return 0;
        }
        return 2;
    }

    public static function UpdateProduct($p_id, $nome, $prezzo, $marca){
        $connection = self::getConnection();

        $queryStr = "UPDATE ecommerce5f.products SET nome=:nome, prezzo=:prezzo, marca=:marca WHERE id=:p_id";
        $statement = $connection->prepare($queryStr);
        $statement->bindParam(':p_id', $p_id);
        $statement->bindParam(':nome', $nome);
        $statement->bindParam(':prezzo', $prezzo);
        $statement->bindParam(':marca', $marca);
        // Esecuzione della query e gestione dell'esito
        if ($statement->execute() == true) {
            return 0;
        }
        return 2;
    }

    public static function DeleteProduct($p_id){

        $connection = self::getConnection();

        $queryStr = "DELETE FROM ecommerce5f.cart_products WHERE product_id=:p_id";
        $statement = $connection->prepare($queryStr);
        $statement->bindParam(':p_id', $p_id);
        // Esecuzione della query e gestione dell'esito
        if ($statement->execute() == true) {
            $queryStr = "DELETE FROM ecommerce5f.products WHERE id=:p_id";
            $statement = $connection->prepare($queryStr);
            $statement->bindParam(':p_id', $p_id);
            // Esecuzione della query e gestione dell'esito
            if ($statement->execute() == true) {
                return 0;
            }
            return 2;
        }
        return 2;
    }

    public static function AddProduct($nome, $prezzo, $marca){
        $connection = self::getConnection();

        $queryStr = "INSERT INTO ecommerce5f.products(nome, prezzo, marca) VALUES(:nome, :prezzo, :marca)";
        $statement = $connection->prepare($queryStr);
        $statement->bindParam(':nome', $nome);
        $statement->bindParam(':prezzo', $prezzo);
        $statement->bindParam(':marca', $marca);
        // Esecuzione della query e gestione dell'esito
        if ($statement->execute() == true) {
            return 0;
        }
        return 2;
    }

}

?>