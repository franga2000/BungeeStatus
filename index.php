<?php
$back = './';
include $back . 'header.php';
?>
<body>
<?php if ($config['toolbar'] == "top") echo '<div class="pull-right auto-refresh"></div>'; ?>
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
        if ($config['nojava'] || $_COOKIE['nojava']) {
            $Query = new MinecraftQuery( );
            try {
    			$Query->Connect( $ip, $port, 1);
                $info = $Query->GetInfo();
                $online = true;
            } catch( MinecraftQueryException $e ) {
    			//echo $e->getMessage( );
                $online = false;
            }
            
            echo "\n" . '<td class="server server-' . $key . '">
    <h2><a href="' . $back . 'server?id=' . $key . '">' . $server['Name'] . '</a></h2>'
    . (!$online && isset($server['Offline_reason']) ? '<p class="description offline">' . $server['Offline_reason'] . '</p>' : (isset($server['Description']) ? '<p class="description">' . $server['Description'] . '</p class="description">' : '<p> </p> ')) . '
    <h3 class="status ' . ( $online ? "online" : "offline") . '">' . ( $online ? "ONLINE" : "OFFLINE") . '</h3>
    <p class="players">' . ($online ? $info['Players'] : "-") . '/' . ($online ? $info['MaxPlayers'] : "-") . '</p>
    </td>';
        }
        
		echo "\n" . '<td class="server server-' . $key . '">
    <h2><a href="' . $back . 'server?id=' . $key . '">' . $server['Name'] . '</a></h2>
    <p class="description"><img src="spinner.gif"></img>Loading...</p class="description">
    <h3 class="status">Loading...</h3>
    <p class="players">Loading...</p>
    </td>';
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
var autoRefresh = true;

window.onload = function() {
	$("tr").fadeOut(0);
	$(".auto-refresh").html('<label for="refresh">Auto refresh:</label><input type="checkbox" name="refresh" class="switch" />');
	$(".switch").bootstrapSwitch();
	
	refresh();
	fadeIn();
	
	setInterval(function(){
		if (getCookie("autoRefresh") == "true") {
			refresh();
		}
	}, 60000);
	
	if (getCookie("autoRefresh") == "true") {
		$(".auto-refresh input").bootstrapSwitch("state", true);
	}
	
	$(".auto-refresh input").on('switchChange.bootstrapSwitch', function(event, state) {
		document.cookie="autoRefresh=" + state;
	});
}

function fadeIn() {
    var i = 0;
	function loop () {
	   setTimeout(function () {
	       $("#td_"+i).fadeIn(500);
	     i++;
	     if (i < 10) {
	         loop();
	      }
	   }, 100)
	}
	loop();
}

function refresh() {
    var i = 0;
    $(".server").each(function() {
        loadServer(i);
        i++;
    });
}

function loadServer(id) {
    $.getJSON(
        "API/get.php?server=" + id, 
        function(data) {
            if (data['Online']) {
                $(".server-" + id + " .players").html(data['Players'] + "/" + data['MaxPlayers']);
                $(".server-" + id + " .status").html("ONLINE");
                $(".server-" + id + " .status").removeClass("offline");
                $(".server-" + id + " .status").addClass("online");
                
                $(".server-" + id + " .description").html(data['Description']);
                $(".server-" + id + " .description").removeClass("offline");
            } else {
                $(".server-" + id + " .players").html("-/-");
                $(".server-" + id + " .status").html("OFFLINE");
                $(".server-" + id + " .status").removeClass("online");
                $(".server-" + id + " .status").addClass("offline");
                
                $(".server-" + id + " .description").html((data['Offline_reason'] ? data['Offline_reason'] : data['Description']));
                $(".server-" + id + " .description").addClass((data['Offline_reason'] ? "offline" : ""));
            }
        }
    );
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) != -1) return c.substring(name.length,c.length);
    }
    return "";
}
</script>
<?php if ($config['toolbar'] == "bottom") echo '<div class="pull-right auto-refresh"></div>'; ?>
</body>