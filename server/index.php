<?php
$back = '../';
include $back . 'include/header.php';
require $back . 'include/MinecraftQuery.php';

use xPaw\MinecraftQuery;
use xPaw\MinecraftQueryException;

if (!isset($_GET['id'])) {
    echo 'Please provide an ID!';
    die();
} elseif (!isset($config['servers'][(int) $_GET['id']])) {
    echo 'Invalid server ID!';
    die();
}
$server = $config['servers'][(int) $_GET['id']];
$players = Array();

$Query = new MinecraftQuery();
try {
	$Query->Connect($server['Adress'], $server['Port']);
    $info = $Query->GetInfo();
    $players = $Query->GetPlayers();
    $online = true;
} catch (MinecraftQueryException $e) {
    $online = false;
}
?>
<body align=center>
<div class="server">
    <h1><?php echo $server['Name'] ?></h1>
    <?php
    if ($online) if (!empty($server['Description'])) echo '<p>' . $server['Description'] . '</p>';
    else if (!empty($server['Offline_reason'])) echo '<div class="alert alert-danger">' . $server['Offline_reason'] . '</div>';
    ?>
    <div class="status alert alert-<?php echo $online ? "success" : "danger" ?>"><?php echo $online ? "ONLINE" : "OFFLINE" ?></div><br/>
    <h3><?php echo $online ? $info['Players'] : "-" ?>/<?php echo $online ? $info['MaxPlayers'] : "-" ?> Players</h3>
    </td></tr>
    <?php
    if (count($players) >= 1) {
        echo '<tr><td><div style="display: inline-block;">
		<ul class="players">';
		
		foreach($players as $key => $player) {
			if ($key == ceil((int) count($players)/$config['player_columns'])) {
			echo '</ul><ul class="players">';
		}
			echo '<li class="player"><img src="http://cravatar.eu/helmavatar/' . $player . '/50.png"> ' . $player . '</li>';
		}
		
		echo '</ul></div></td></tr>';
    }
    ?>
</div>
</body>

<style>
.players {
    list-style-type: none;
    text-align: left;
    display: inline-block;
}

.player {
    margin-bottom: 5px;
    font-size: 20px;
}

.player img {
    border-radius: 5px;
}

.status {
    font-size: 2em;
    display: inline-block;
    padding: 5px 10px;
}
</style>