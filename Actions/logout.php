<?php
require_once('../Manage/BusinessLogicUser.php');

session_start();

if (isset($_SESSION['user_id'])) {

    LogicUser::logout();
    header('Location: ../Views/login.php');
}
?>