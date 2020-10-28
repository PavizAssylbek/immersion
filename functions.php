<?php

function get_user_by_email($email) {
    $pdo = new PDO("mysql:host=localhost;dbname=immersion", "root", "root");
    $sql = "SELECT * FROM users WHERE email=:email";
    $statement = $pdo->prepare($sql);
    $statement -> execute(["email" => $email]);
    $user = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $user;
};

function add_user($email, $password) {
    $pdo = new PDO("mysql:host=localhost;dbname=immersion", "root", "root");
    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $statement = $pdo->prepare($sql);
    $statement->execute([
        "email" => $email,
        "password" => password_hash($password, PASSWORD_DEFAULT)
    ]);
};

function set_flash_message($key, $message) {
    $_SESSION[$key] = "$message";
};

function display_flash_message($key) {
    if(isset($_SESSION[$key])):
        echo "<div class=\"alert alert-{$key} text-dark\" role=\"alert\">";
                echo $_SESSION[$key];
                unset($_SESSION[$key]);
       echo "</div>";
    endif;
};

function redirect_to($path) {
    header("Location:$path");
    exit;
};

function login($email, $password) {
    $pdo = new PDO("mysql:host=localhost;dbname=immersion", "root", "root");
    $sql = "SELECT * FROM users WHERE email=:email";
    $statement = $pdo->prepare($sql);
    $statement->execute(["email" => $email,]);
    $user = $statement->fetchAll(PDO::FETCH_ASSOC);
    $user_password = $user[0]['password'];
    $password_verify = password_verify($password, $user_password);
    return $password_verify;
};