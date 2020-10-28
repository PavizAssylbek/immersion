<?php
session_start();
require "functions.php";
$email = $_POST["email"];
$password = $_POST["password"];

$password_verify = login($email,$password);

if ($password_verify == false) {
    set_flash_message("danger", "Неверный пароль или имя пользователя");
    redirect_to("page_login.php");
}
else {
    $_SESSION["email"] = $email;
    $session_id = session_id();
    set_flash_message("success", "Здравствуйте {$_SESSION["email"]}! Вы успешно авторизировались!");
    redirect_to("users.php");
}