<?php
session_start();
require "functions.php";
$email = $_POST["email"];
$password = $_POST["password"];
$hashed_password = md5($password);

$user_exist = login($email,$hashed_password);

if(!empty($user_exist)) {
    $_SESSION["email"] = $email;
    $session_id = session_id();
    set_flash_message("success", "Здравствуйте {$_SESSION["email"]}! Вы успешно авторизировались!");
    redirect_to("users.php");
}
else {
    set_flash_message("danger", "Неверный пароль или имя пользователя");
    redirect_to("page_login.php");
}