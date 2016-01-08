<?php
$back = "../";
include $back . "include/config.php";

if (!isset($_POST["reason"]) && !isset($_POST["hash"]) && !isset($_POST["server"])) {
	if (!isset($_GET["reason"]) && !isset($_GET["hash"]) && !isset($_GET["server"])) {
		echo "Missing parameters";
		die();
	} else {
		$reason = $_GET["reason"];
		$hash = $_GET["hash"];
		$server = $_GET["server"];
	}
} else {
	$reason = $_POST["reason"];
	$hash = $_POST["hash"];
	$server = $_POST["server"];
}

if ($hash !== md5($config["password"])) {
	echo "Invalid hash!";
	die();
}

if (!isset($config["servers"][$server])) {
		echo "Invalid server";
		die();
	}

$config["servers"][$server]["Offline_reason"] = $reason;

file_put_contents($back . "servers.json", json_encode($config["servers"]), JSON_PRETTY_PRINT);
?>