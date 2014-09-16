<?php
$back = '../';
include $back . 'config.php';
require $back . 'MinecraftQuery.class.php';

header('Content-Type: application/json');

$Query = new MinecraftQuery();
try {
	$Query->Connect( $config['servers'][$_GET['server']]['Adress'], $config['servers'][$_GET['server']]['Port']);
    $response = $Query->GetInfo();
    $response = array_merge($response, Array("Online" => true));
} catch( MinecraftQueryException $e ) {
    $response = Array(
        "Online" => false,
    );
}
    
$response = array_merge($response, $config['servers'][$_GET['server']]);

array_walk($response, 
    function (&$entry) {
        $entry = iconv('Windows-1250', 'UTF-8', $entry);
    }
);

echo json_encode($response, JSON_PRETTY_PRINT);
?>