<?php
header("Content-Type: application/json");

$back = "../";

require $back . "config.php";
require $back . "include/MinecraftQuery.php";

use xPaw\MinecraftQuery;
use xPaw\MinecraftQueryException;

$server = $config["servers"][$_GET["server"]];
if ($server == null) die("Invalid server");
$Query = new MinecraftQuery();
try {
	$Query->Connect($server["Adress"], $server["Port"]);
    $info = $Query->GetInfo();
    $data = Array(
		"Online" => true,
		"Players" => $info["Players"],
		"MaxPlayers" => $info["MaxPlayers"]
    );
} catch (MinecraftQueryException $e) {
    $data = Array(
        "Online" => false,
    );
}
$return = array_merge($data, Array(
	"Name" => $server["Name"], 
	"Description" => $server["Description"], 
	"Offline_reason" => $server["Offline_reason"]
));
echo json_encode($return, JSON_PRETTY_PRINT);
?>