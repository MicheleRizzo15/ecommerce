<?php
require_once('../Manage/BusinessLogicUser.php');
$email = $_POST['email'];
$psw = $_POST['password'];
$err = LogicUser::isLogged($email, $psw);
if ($err == 0) {
    //echo "CORRETTO\n";
    header('Location: ../Views/ViewProducts.php');
} else if ($err == 1) {
    header('Location: ../Views/signup.php');

} else if ($err == 2) {
    header('Location: ../Views/signup.php');
}
echo "STAMPO QUANTO VALE SESSIONE: " . $_SESSION['user_id'];
?>