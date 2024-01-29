<?php
require_once 'DbManager.php';
require_once '../Object/User.php';
require_once '../Object/Carts.php';

class LogicUser
{

    public static function getConnection()
    {
        $dbManager = new DbManager('ecommerce', 'psw:YNvXpnc1[Phk_@hj', 'ecommerce5f');
        $connection = $dbManager->getConnectionPDO();
        return $connection;
    }

    public static function isLogged($usrN, $psw)
    {
        $connection = self::getConnection();

        $currentUser = self::authenticateUser($connection, $usrN, $psw);

        if ($currentUser) {
            session_start();
            $_SESSION['user_id'] = $currentUser->getID();
            $_SESSION['role_id'] = $currentUser->getRole_Id();
            $res = self::insertSession($connection, $_SESSION['user_id'], $_SERVER['REMOTE_ADDR']);
            if ($res != -1) {

                $_SESSION['session_id'] = $res;
                $error = 0;

                if ($currentUser->getRole_Id() == 1) {
                    $cartError = self::loadUserCart($connection, $_SESSION['user_id']);
                    if ($cartError != 0) {
                        $error = $cartError;
                    }
                }
            } else {
                $error = 1;
            }
        } else {
            $error = 1; // Errore nel trovare l'utente
        }

        return $error;
    }

    private static function checkSession($connection, $user_id)
    {
        $checkSessionQuery = "SELECT count(*) as Quantita FROM ecommerce5f.sessions WHERE disabilited = false AND user_id=:user_id";
        $checkSessionStatement = $connection->prepare($checkSessionQuery);
        $checkSessionStatement->bindParam(":user_id", $user_id);
        if ($checkSessionStatement->execute()) {
            $res = $checkSessionStatement->fetch(PDO::FETCH_ASSOC);
            return ($res['Quantita'] == 0);
        }
        return false;
    }

    private static function insertSession($connection, $userId, $ip)
    {
        if (!(self::checkSession($connection, $userId))) {
            if (self::DisableAllSession($userId) != 0) {
                return false;
            }
        }
        $insertSessionQuery = "INSERT INTO ecommerce5f.sessions (user_id, ip, data_login, disabilited, data_logout) VALUES (:user_id, :ip, NOW(), false, '0000-00-00 00:00:00')";
        $insertSessionStatement = $connection->prepare($insertSessionQuery);
        $insertSessionStatement->bindParam(':user_id', $userId);
        $insertSessionStatement->bindParam(':ip', $ip);
        if ($insertSessionStatement->execute()) {
            return self::getSessionId($connection, $userId);
        } else {
            return -1;
        }
    }

    private static function getSessionId($connection, $user_id)
    {
        $checkSessionQuery = "SELECT id FROM ecommerce5f.sessions WHERE disabilited = false AND user_id=:user_id";
        $checkSessionStatement = $connection->prepare($checkSessionQuery);
        $checkSessionStatement->bindParam(":user_id", $user_id);
        if ($checkSessionStatement->execute()) {
            $res = $checkSessionStatement->fetch(PDO::FETCH_ASSOC);
            return $res['id'];
        }
        return -1;
    }

    private static function authenticateUser($connection, $usrN, $psw)
    {
        $queryStr = "SELECT * FROM ecommerce5f.users WHERE email=:email_v AND password=:password_v LIMIT 1";
        $statement = $connection->prepare($queryStr);
        $statement->bindParam(':email_v', $usrN);
        $statement->bindParam(':password_v', $psw);

        if ($statement->execute()) {
            return $statement->fetchObject('user');
        }

        return null;
    }

    private static function loadUserCart($connection, $userId)
    {
        $queryStr = "SELECT * FROM ecommerce5f.carts WHERE user_id=:user_id";
        $statement = $connection->prepare($queryStr);
        $statement->bindParam(':user_id', $userId);

        if ($statement->execute()) {
            $currentCart = $statement->fetchObject('Cart');

            if ($currentCart) {
                session_start();
                $_SESSION['cart_id'] = $currentCart->getId();
                return 0; // Nessun errore
            } else {
                return 1; // Errore nel recupero del carrello
            }
        } else {
            return 2; // Errore durante l'esecuzione della query
        }
    }

    public static function signUp($psw, $email, $ruolo)
    {
        $connection = self::getConnection();

        $userExists = self::checkUserExistence($connection, $email);

        if ($userExists) {
            return 1; // Utente già registrato
        }

        $registrationError = self::registerUser($connection, $psw, $email, $ruolo);

        if ($registrationError == 0) {
            // Registrazione avvenuta con successo
            return self::isLogged($email, $psw);
        } else {
            return $registrationError;
        }
    }

    private static function checkUserExistence($connection, $email)
    {
        $checkUserQuery = "SELECT count(*) as num FROM ecommerce5f.users WHERE email=:email_v LIMIT 1";
        $checkUserStatement = $connection->prepare($checkUserQuery);
        $checkUserStatement->bindParam(':email_v', $email);
        if ($checkUserStatement->execute()) {
            $res = $checkUserStatement->fetch(PDO::FETCH_ASSOC);
            return ($res['num'] == 1);
        }
        return true;
    }

    private static function registerUser($connection, $psw, $email, $ruolo)
    {
        $insertUserQuery = "INSERT INTO ecommerce5f.users (password, email, role_id) VALUES (:password_v, :email_v, 1)";
        $insertUserStatement = $connection->prepare($insertUserQuery);
        $insertUserStatement->bindParam(':password_v', $psw);
        $insertUserStatement->bindParam(':email_v', $email);

        if ($insertUserStatement->execute()) {
            $userId = self::getUserId($connection, $email);

            if ($userId !== null) {
                if ($ruolo == 1) {
                    return self::createUserCart($connection, $userId);
                } else {
                    return 0; // Nessun errore
                }
            } else {
                return 1; // Errore nel trovare l'utente
            }
        } else {
            return 2; // Errore durante l'esecuzione della query
        }
    }

    private static function getUserId($connection, $email)
    {
        $queryStr = "SELECT * FROM ecommerce5f.users WHERE email=:email_v LIMIT 1";
        $statement = $connection->prepare($queryStr);
        $statement->bindParam(':email_v', $email);

        if ($statement->execute()) {
            $currentUser = $statement->fetchObject('user');
            if ($currentUser) {
                return $currentUser->getID();
            }
        }

        return null;
    }

    private static function createUserCart($connection, $userId)
    {
        $insertUserQuery = "INSERT INTO ecommerce5f.carts (user_id) VALUES (:us_id)";
        $insertUserStatement = $connection->prepare($insertUserQuery);
        $insertUserStatement->bindParam(':us_id', $userId);

        if ($insertUserStatement->execute()) {
            return 0; // Nessun errore
        } else {
            return 2; // Errore durante l'esecuzione della query
        }
    }


    public static function logout()
    {
        session_start();
        $session_id = $_SESSION['session_id'];

        self::DisableSession($session_id);
        session_destroy();
        return 0;
    }

    public static function DisableAllSession($user_id)
    {
        $connection = self::getConnection();

        $querySTR = "UPDATE ecommerce5f.sessions SET disabilited = true, data_logout = NOW() WHERE user_id = :id and disabilited = false";
        $stmt = $connection->prepare($querySTR);
        $stmt->bindParam(":id", $user_id);

        if ($stmt->execute() == true) {
            return 0; // Successo
        }

        return 2; // Errore durante l'esecuzione della query
    }

    public static function DisableSession($id)
    {
        $connection = self::getConnection();

        $querySTR = "UPDATE ecommerce5f.sessions SET disabilited = true, data_logout = NOW() WHERE id = :id";
        $stmt = $connection->prepare($querySTR);
        $stmt->bindParam(":id", $id);

        if ($stmt->execute() == true) {
            return 0; // Successo
        }

        return 2; // Errore durante l'esecuzione della query
    }
}


?>