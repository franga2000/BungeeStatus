<?php
$back = '../';
include $back . 'header.php';
require $back . 'MinecraftQuery.class.php';


if (!isset($_GET['id'])) {
    echo 'Please provide an ID!';
    die();
} elseif (!isset($config['servers'][(int) $_GET['id']])) {
    echo 'Invalid server ID!';
    die();
}
$server = $config['servers'][(int) $_GET['id']];

$Query = new MinecraftQuery( );
    try {
			$Query->Connect( $server['Adress'], $server['Port'] );
			$info = $Query->GetInfo();
			$players = $Query->GetPlayers();
			$online = true;
		} catch( MinecraftQueryException $e ) {
			$online = false;
		}
?>
<body>
<table><tr><td>
<h2><?php
echo '<h2><a href="server?id=' . $key . '">' . $server['Name'] . '</a></h2>' . (!$online && isset($server['Offline_reason']) ? '<p style="color:red;">' . $server['Offline_reason'] . '</p>' : (isset($server['Description']) ? '<p>' . $server['Description'] . '</p>' : ' ')) .
'<h3 style="color:' . ( $online ? "green" : "red") . '">' . ( $online ? "ONLINE" : "OFFLINE") . '</h3>' . 
($online ? $info['Players'] : "0") . '/' . ($online ? $info['MaxPlayers'] : "0") . '</td>';
?>
</td></tr><tr><td><ul style="list-style-type: none;">
<?php
foreach($players as $player){
	echo '<li><img src="https://minotar.net/helm/' . $player . '/30.png"> ' . $player . '</li>';
} 
?>
</ul></td></tr></table>
</body>