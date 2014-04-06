<?php
$back = './';
include $back . 'header.php';
?>
<body>
<h1>Network status</h1>

<?php
require $back . 'MinecraftQuery.class.php';

	$Query = new MinecraftQuery( );

echo '<table><tr>';
$col = 1;
foreach ($config['servers'] as $key => $server) {
	if ($col <= $config['columns']) {
		a:
		try {
			$Query->Connect( $server['Adress'], $server['Port'] );
			$info = $Query->GetInfo();
			$online = true;
		} catch( MinecraftQueryException $e ) {
			$online = false;
		}
		
		echo '<td>
		<a href="server?id=' . $key . '"><h2>' . $server['Name'] . '</h2></a>' . (!$online && isset($server['Offline_reason']) ? '<p style="color:red;">' . $server['Offline_reason'] . '</p>' : (isset($server['Description']) ? '<p>' . $server['Description'] . '</p>' : ' ')) .
		'<h3 style="color:' . ( $online ? "green" : "red") . '">' . ( $online ? "ONLINE" : "OFFLINE") . '</h3>' . 
	    ($online ? $info['Players'] : "0") . '/' . ($online ? $info['MaxPlayers'] : "0") . '</td>';
		$col ++;
	} else {
		echo '</tr><tr>';
		$col = 1;
		goto a;
	}
}

echo '</tr></table>';
?>
</body>