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

switch($_POST["action"]) {
    case "add":
        array_push($config["servers"], Array(
            "Name" => $_POST["name"], 
            "Address" => $_POST["address"], 
            "Port" => $_POST["port"], 
            "Description" => $_POST["description"], 
            "Offline_reason" => ""
        ));
        
        file_put_contents($back . "servers.json", json_encode($config["servers"], JSON_PRETTY_PRINT));
    break;
    
    case "remove":
        unset($config["servers"][$_POST["id"]]);
        
        file_put_contents($back . "servers.json", json_encode($config["servers"], JSON_PRETTY_PRINT));
    break;
    
    case "edit":
        $config["servers"][$_POST["id"]] = Array(
            "Name" => $_POST["name"], 
            "Address" => $_POST["address"], 
            "Port" => $_POST["port"], 
            "Description" => $_POST["description"], 
            "Offline_reason" => $_POST["offline-reason"]
        );
        
        file_put_contents($back . "servers.json", json_encode($config["servers"], JSON_PRETTY_PRINT));
    break;
}

header("Location: ./?refresh");