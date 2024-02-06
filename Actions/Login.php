<?php
require_once('../Manage/BusinessLogicUser.php');
$email = $_POST['email'];
$psw = $_POST['password'];
$err = LogicUser::isLogged($email, $psw);
if ($err == 0) {
    session_start();
    if($_SESSION['role_id'] == 1){
        header('Location: ../Views/ViewProducts.php');
    }
    else{
        header('Location: ../Views/ModifyAllProducts.php');
    }
} else if ($err == 1) {
    header('Location: ../Views/signup.php');

} else if ($err == 2) {
    header('Location: ../Views/signup.php');
}
//echo "STAMPO QUANTO VALE SESSIONE: " . $_SESSION['user_id'];
?>