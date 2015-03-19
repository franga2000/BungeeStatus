<?php
$back = "../";
include $back . "include/header.php";
include $back . "include/password_protect.php";

session_start();

if($_POST["token"] != $_SESSION["token"] && php_sapi_name() != "cli") {
    die("Unauthorized source!");
}

$_SESSION["token"] = "";

var_dump($_POST);

$config["servers"] = $_POST["title"];
$config["columns"] = (int) $_POST["columns"];
$config["avatar_type"] = $_POST["avatar_type"];
$config["toolbar"] = $_POST["toolbar"];

unset($config["servers"]);
unset($config["password"]);

file_put_contents($back . "config.json", json_encode($config, JSON_PRETTY_PRINT));

header("Location: ./?refresh");