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
$players = Array();
$Query = new MinecraftQuery( );
    try {
			$Query->Connect( $server['Adress'], $server['Port'] );
			$info = $Query->GetInfo();
			$players = (!$Query->GetPlayers() ? Array() : $Query->GetPlayers());
			$online = true;
		} catch( MinecraftQueryException $e ) {
			$online = false;
		}
?>
<body align=center>
<table style="min-width:500px;" align=center><tr><td>
<?php
echo '<h2><a href="' . $back . 'server?id=' . $_GET['id'] . '">' . $server['Name'] . '</a></h2>' . (!$online && isset($server['Offline_reason']) ? '<p style="color:red;">' . $server['Offline_reason'] . '</p>' : (isset($server['Description']) ? '<p>' . $server['Description'] . '</p>' : ' ')) .
'<h3 style="color:' . ( $online ? "green" : "red") . '">' . ( $online ? "ONLINE" : "OFFLINE") . '</h3>' . 
($online ? $info['Players'] : "0") . '/' . ($online ? $info['MaxPlayers'] : "0") . '</td>';
?>
</td></tr>
<?php
if (count($players) >= 1) {
    echo '<tr><td><ul style="list-style-type: none;">';
    
    foreach($players as $player){
    	echo '<li><img src="http://cravatar.eu/helmavatar/' . $player . '/30.png"> ' . $player . '</li>';
    }
    
    echo '</ul></td></tr>';
}
?>
</table>
</body>