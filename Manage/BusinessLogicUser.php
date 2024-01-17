<?php
require_once 'DbManager.php';
require_once '../Object/User.php';
require_once '../Object/Carts.php';

class LogicUser
{
    public static function isLogged($usrN, $psw)
    {
        $error = -1;
        $dbManager = new DbManager('ecommerce', 'psw:YNvXpnc1[Phk_@hj', 'ecommerce5f');
        $connection = $dbManager->getConnectionPDO();
        // Query per verificare l'autenticazione dell'utente
        $queryStr = "SELECT * FROM ecommerce5f.users WHERE email=:email_v AND password=:password_v LIMIT 1";
        $statement = $connection->prepare($queryStr);
        $statement->bindParam(':email_v', $usrN);
        $statement->bindParam(':password_v', $psw);
        if ($statement->execute() == true) {
            $currentUser = $statement->fetchObject('user');
            if ($currentUser) {
                session_start();
                $_SESSION['user_id'] = ((object)($currentUser))->getID();
                $error = 0;
                // Query per ottenere il carrello dell'utente
                $queryStr = "SELECT * FROM ecommerce5f.carts WHERE user_id=:user_id";
                $statement = $connection->prepare($queryStr);
                $statement->bindParam(':user_id', $_SESSION['user_id']);
                if ($statement->execute() == true) {
                    $currentCart = $statement->fetchObject('Cart');
                    if ($currentCart) {
                        $_SESSION['cart_id'] = ((object)($currentCart))->getId();
                        $error = 0;
                    } else {
                        $error = 1; // Errore nel recupero del carrello
                    }
                } else {
                    $error = 2; // Errore durante l'esecuzione della query
                }
            } else {
                $error = 1; // Errore nel trovare l'utente
            }
        } else {
            $error = 2; // Errore nel database
        }
        return $error;
    }

    public static function signUp($psw, $email)
    {
        $error = -1;
        $dbManager = new DbManager('ecommerce', 'psw:YNvXpnc1[Phk_@hj', 'ecommerce5f');
        $connection = $dbManager->getConnectionPDO();

        // Controlla se l'utente esiste già
        $checkUserQuery = "SELECT count(*) as num FROM ecommerce5f.users WHERE email=:email_v LIMIT 1";
        $checkUserStatement = $connection->prepare($checkUserQuery);
        $checkUserStatement->bindParam(':email_v', $email);
        $checkUserStatement->execute();

        $res = $checkUserStatement->fetch(PDO::FETCH_ASSOC);
        if ($res['num'] == 1) {
            // Utente già registrato
            $error = 1;
        } else {
            // Inserisci il nuovo utente nel database
            $insertUserQuery = "INSERT INTO ecommerce5f.users (password, email) VALUES (:password_v, :email_v)";
            $insertUserStatement = $connection->prepare($insertUserQuery);
            $insertUserStatement->bindParam(':password_v', $psw);
            $insertUserStatement->bindParam(':email_v', $email);

            if ($insertUserStatement->execute() == true) {
                // Registrazione avvenuta con successo
                $error = 0;

                // Ottieni l'ID dell'utente appena registrato
                $queryStr = "SELECT * FROM ecommerce5f.users WHERE email=:email_v LIMIT 1";
                $statement = $connection->prepare($queryStr);
                $statement->bindParam(':email_v', $email);
                if ($statement->execute() == true) {
                    $currentUser = $statement->fetchObject('user');
                    if ($currentUser) {
                        $id = ((object)($currentUser))->getID();
                        $error = 0;

                        // Inserisci una nuova riga nella tabella "carts" per l'utente
                        $insertUserQuery = "INSERT INTO ecommerce5f.carts (user_id) VALUES (:us_id)";
                        $insertUserStatement = $connection->prepare($insertUserQuery);
                        $insertUserStatement->bindParam(':us_id', $id);

                        if ($insertUserStatement->execute() == true) {
                            return self::isLogged($email, $psw);
                        } else {
                            $error = 2;
                        }
                    } else {
                        $error = 1;
                    }
                } else {
                    $error = 2;
                }
            } else {
                $error = 2;
            }
        }

        return $error;
    }


    public
    static function logout()
    {
        session_start();
        session_destroy();
    }
}


?>