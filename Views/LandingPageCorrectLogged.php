<?php
session_start();
echo "Benventuo utente con ID: ".$_SESSION['user_id'];
?>

<html>
    <form method="get" name="Form_Principale" action="../Actions/logout.php">
    <input type="submit" value="LogOut">
    </form>
</html>
