<?php
$back = './';
include $back . 'include/header.php';
?>
<body>
<?php if ($config['toolbar'] == "top") echo '<div class="pull-right auto-refresh"></div>'; ?>
<h1 class="pull-left">Network status</h1>
<?php 
echo '<table id="servers"><tr id="row_0">';
$col = 0;
foreach ($config['servers'] as $key => $server) {
    if ($col < $config['columns']) {
		$col ++;
    } else {
		echo '</tr><tr id="row_' . $key . '">';
		$col = 1;
    }
    
    echo "\n" . '<td class="server server-' . $key . '">
    <h2><a href="' . $back . 'server?id=' . $key . '">' . $server['Name'] . '</a></h2>
    <p class="description"><img src="include/spinner.gif"></img> Loading...</p class="description">
    <h3 class="status">Loading...</h3>
    <p class="players">Loading...</p>
    </td>';
}
echo '</tr></table>';

if ($config['toolbar'] == "bottom") echo '<div class="pull-right auto-refresh"></div>'; 
?>
</body>
<script src="include/script.js"></script>