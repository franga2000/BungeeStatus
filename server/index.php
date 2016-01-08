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

$Query = new MinecraftQuery();
$players = Array();
try {
	$Query->Connect($server['Address'], $server['Port']);
    $info = $Query->GetInfo();
    $players = $Query->GetPlayers();
    if (!$players) $players = Array();
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
    <?php if (count($players) > 0): 
    switch($config["avatar_type"]) {
        case "3d": $avatar_prefix = "head"; break;
        case "3d_helm": $avatar_prefix = "helmhead"; break;
        case "2d": $avatar_prefix = "avatar"; break;
        case "2d_helm": $avatar_prefix = "helmavatar"; break;
    }
    ?>
		<div id="players">
		<?php foreach ($players as $player): ?>
			<div class="col-md-2 player">
				<img src="<?php echo "https://cravatar.eu/" . $avatar_prefix . "/" . $player . "/96" ?>" class="img-rounded">
				<p><?php echo $player ?></p>
			</div>
		<?php endforeach ?>
		</div>
    <?php endif ?>
</div>
</body>

<style>
#players {
    text-align: center;
}
.player {
    display: inline-block;
    float: none;
    margin-right: -4px;
}
.status {
    font-size: 2em;
    display: inline-block;
    padding: 5px 10px;
}
</style>