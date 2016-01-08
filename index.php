<?php
$back = '';
include $back . 'include/header.php';
?>
<body>
<header>
	<h1>Network status</h1>
	<div id="toolbar">
		<label for="refresh">Auto refresh: </label>
		<input type="checkbox" name="refresh" class="switch">
		
		<label for="interval">Interval: </label>
		<select name="interval">
			<option value="1">1 sec.</option>
			<option value="10">10 sec.</option>
			<option value="30">30 sec.</option>
			<option value="60">1 min.</option>
		</select>
	</div>
	<div style="clear: both;"></di>
</header>
<main id="servers">
<?php 
	$col = 0;
	foreach ($config['servers'] as $key => $server) {
	    include "include/server.php";
	}
?>
</main>
<script src="include/index_script.js"></script>
</body>
</html>