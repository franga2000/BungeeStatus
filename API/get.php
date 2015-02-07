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
    $info = array_merge($info, Array("Online" => true));
    $info["HostName"] = iconv("Windows-1250", "UTF-8", $info["HostName"]);
} catch (MinecraftQueryException $e) {
    $info = Array(
        "Online" => false,
    );
}
$return = array_merge($info, Array(
	"Name" => $server["Name"], 
	"Description" => $server["Description"], 
	"Offline_reason" => $server["Offline_reason"]
));
echo json_encode($return, JSON_PRETTY_PRINT);
?>