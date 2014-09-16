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
$Query = new MinecraftQuery();
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
<div class="server">
    <?php
    echo '
    <h1>' . $server['Name'] . '</h1>' . 
    (!$online && isset($server['Offline_reason']) ? '<div class="alert alert-danger">' . $server['Offline_reason'] . '</div>' : (isset($server['Description']) ? '<p>' . $server['Description'] . '</p>' : ' ')) .
    '<div class="status alert alert-' . ( $online ? "success" : "danger") . '">' . ( $online ? "ONLINE" : "OFFLINE") . '</div><br/>
    <h3>' . ($online ? $info['Players'] : "0") . '/' . ($online ? $info['MaxPlayers'] : "0") . ' Players</h3>';
    ?>
    </td></tr>
    <?php
    if (count($players) >= 1) {
        echo '<tr><td><div style="display: inline-block;">
            <ul class="players">';
        
        foreach($players as $key => $player) {
            if ($key == round((int) count($players)/$config['player-columns'])) {
        	    echo '</ul><ul class="players">';
        	}
        	
        	echo '<li class="player"><img src="http://cravatar.eu/helmavatar/' . $player . '/50.png"> ' . $player . '</li>';
        }
        
        echo '</ul></div></td></tr>';
    }
    ?>
</server>
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