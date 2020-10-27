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
        "password" => md5($password)
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

function login($email, $hashed_password) {
    $pdo = new PDO("mysql:host=localhost;dbname=immersion", "root", "root");
    $sql = "SELECT * FROM users WHERE email=:email AND password=:password";
    $statement = $pdo->prepare($sql);
    $statement->execute([
        "email" => $email,
        "password" => $hashed_password
    ]);
    $user_exist = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $user_exist;
};