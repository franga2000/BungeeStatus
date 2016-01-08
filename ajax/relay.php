<?php
header("Content-Type: application/json");

$back = "../";

require $back . "config.php";

$server = $config["servers"][$_GET["server"]];
if ($server == null) die("Invalid server");

echo file_get_contents("http://" . $server["Address"])
?>