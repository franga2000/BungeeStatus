<?php
$back = '../';
include $back . 'config.php';
include $back . 'FancyJson.php';

if (!isset($_POST['reason']) && !isset($_POST['hash']) && !isset($_POST['server'])) {
	if (!isset($_GET['reason']) && !isset($_GET['hash']) && !isset($_GET['server'])) {
		echo 'Missing parameters';
		die();
	} else {
		$reason = $_GET['reason'];
		$hash = $_GET['hash'];
		$server = $_GET['server'];
	}
} else {
	$reason = $_POST['reason'];
	$hash = $_POST['hash'];
	$server = $_POST['server'];
}

if ($hash !== md5($config['password'])) {
	echo 'Invalid hash!';
	die();
}

if (!isset($config['servers'][$server])) {
		echo 'Invalid server';
		die();
	}

$config['servers'][$server]['Offline_reason'] = $reason;

unset($config['password']);
unset($config['columns']);
unset($config['player-columns']);
        
file_put_contents($back . 'servers.json', indent(json_encode($config)));
//echo '<pre>' . indent(json_encode($config)) . '</pre>';
?>