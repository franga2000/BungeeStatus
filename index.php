<?php
$back = './';
include $back . 'header.php';
?>
<body onload="animate();">
<h1>Network status</h1>

<?php
require $back . 'MinecraftQuery.class.php';

echo '<table style="width:99%;"><tr id="td_0">';
$col = 1;
foreach ($config['servers'] as $key => $server) {
    $ip = $server['Adress'];
    $port = $server['Port'];
	if ($col <= $config['columns']) {
	    a:
	   $Query = new MinecraftQuery( );
	    try {
			$Query->Connect( $ip, $port, 1);
		    $info = $Query->GetInfo();
		    $online = true;
	    } catch( MinecraftQueryException $e ) {
			//echo $e->getMessage( );
		    $online = false;
	    }
		
	    echo '<td>
	    <h2><a href="' . $back . 'server?id=' . $key . '">' . $server['Name'] . '</a></h2>' . (!$online && isset($server['Offline_reason']) ? '<p style="color:red;">' . $server['Offline_reason'] . '</p>' : (isset($server['Description']) ? '<p>' . $server['Description'] . '</p>' : ' ')) .
	    '<h3 style="color:' . ( $online ? "green" : "red") . '">' . ( $online ? "ONLINE" : "OFFLINE") . '</h3>' . 
        ($online ? $info['Players'] : "0") . '/' . ($online ? $info['MaxPlayers'] : "0") . '</td>';
	    $col ++;
    } else {
		echo '</tr><tr id="td_' . $key . '">';
	    $col = 1;
	    goto a;
    }
}
echo '</tr></table>';
?>
<script>
function animate() {
	$("tr").fadeOut(0);
	
	var i = 0;
	function myLoop () {
	   setTimeout(function () {
	       $("#td_"+i).fadeIn(500);
	     i++;
	     if (i < 10) {
	         myLoop();
	      }
	   }, 100)
	}
	myLoop();
}
</script>
</body>