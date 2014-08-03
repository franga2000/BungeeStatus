<?php
$back = '../';
include $back . 'header.php';
include $back . 'password_protect.php';

session_start();
$token = md5(uniqid(mt_rand(), true));
$_SESSION['token'] = $token;
?>
<body style="margin-right: 10px; margin-top: 10px;">
    <a href="?logout"><button type="submit" name="logout" class="btn btn-danger pull-right"><span class="glyphicon glyphicon-log-out"></span> Log out</button></a>
	<div class="tabbable tabs-left">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#new-server" data-toggle="tab"><b><span class="glyphicon glyphicon-plus-sign"></span> New server</b></a></li>
			<?php 
			foreach ($config['servers'] as $key => $server) {
				echo '<li><a href="#server-' . $key . '" data-toggle="tab"><span class="glyphicon glyphicon-hdd"></span> ' . $server['Name'] . '</a></li>' . "\n";
			}
			?>
		</ul>
		
		<div class="tab-content">
			<div class="tab-pane active" id="new-server">
			
				<form role="form" class="col-md-3" method="post" action="manage.php">
				    <br/>
					<div class="form-group">
						<label for="name">Server name:</label>
						<input type="text" class="form-control" name="name" placeholder="My server" autocomplete="off" required/>
					</div>
					
					<div class="form-group">
						<label for="adress">Adress:</label>
						<input type="text" class="form-control" name="adress" placeholder="mc.example.com" autocomplete="off" required/>
					</div>
					<div class="form-group">
						<label for="port">Port:</label>
						<input type="number" class="form-control" name="port" placeholder="25565" autocomplete="off" required/>
					</div>
					
					<div class="form-group">
						<label for="description">Description:</label>
						<input class="form-control" name="description" autocomplete="off"/>
					</div>
					
					<input type="hidden" name="token" value="<?php echo $token; ?>" />
					
					<button type="submit" name="action" value="add" class="btn btn-primary"><span class="glyphicon glyphicon-plus-sign"></span> Add Server</button>
				</form>
			</div>
			
			<?php 
	        foreach ($config['servers'] as $key => $server) {
	            echo '
	        <div class="tab-pane" id="server-' . $key . '">
	            <form role="form" method="post" action="manage.php" class="col-md-5">
	            	<input type="hidden" name="id" value="' . $key . '"/> 
				    <input type="hidden" name="token" value="' . $token . '"/> 
				    
					<legend>Edit server</legend>
					
					<div class="form-group">
						<label for="name">Server name:</label>
						<input type="text" class="form-control" name="name" placeholder="My server" value="' . $server['Name'] . '" autocomplete="off" required/>
					</div>
					
					<div class="form-group">
						<label for="adress">Adress:</label>
						<input type="text" class="form-control" name="adress" placeholder="mc.example.com" value="' . $server['Adress'] . '" autocomplete="off" autocomplete="off" required/>
					</div>
					<div class="form-group">
						<label for="port">Port:</label>
						<input type="number" class="form-control" name="port" placeholder="25565" value="' . $server['Port'] . '" autocomplete="off" required/>
					</div>
					
					<div class="form-group">
						<label for="description">Description:</label>
						<input class="form-control" name="description" value="' . $server['Description'] . '" autocomplete="off" />
					</div>
					
					<div class="form-group">
						<label for="offline-reason">Offline reason:</label>
						<input class="form-control" name="offline-reason" value="' . $server['Offline_reason'] . '" autocomplete="off" />
					</div>
					
					<button type="submit" class="btn btn-primary" name="action" value="edit"><span class="glyphicon glyphicon-save"></span> Save</button>
				    
				    <button type="submit" class="btn btn-danger pull-right" name="action" value="remove"><span class="glyphicon glyphicon-remove-circle"></span> Remove server</button> 
	            </form>
	        </div>' . "\n";
	        }
	        ?>
		</div>
	</div>
</body>

<style>
.tabs-left > .nav-tabs {
	border-bottom: 0;
}

.pill-content > .pill-pane {
	display: none;
}

.tab-content > .active,
.pill-content > .active {
	display: block;
}

.tabs-left > .nav-tabs > li,
.tabs-right > .nav-tabs > li {
	float: none;
}

.tabs-left > .nav-tabs {
	float: left;
	margin-right: 19px;
	border-right: 1px solid #ddd;
}

.tabs-left > .nav-tabs > li > a {
	margin-right: -1px;
	-webkit-border-radius: 4px 0 0 4px;
	-moz-border-radius: 4px 0 0 4px;
	border-radius: 4px 0 0 4px;
}

.tabs-left > .nav-tabs > li > a:hover,
.tabs-left > .nav-tabs > li > a:focus {
	border-color: #eeeeee #dddddd #eeeeee #eeeeee;
}

.tabs-left > .nav-tabs .active > a,
.tabs-left > .nav-tabs .active > a:hover,
.tabs-left > .nav-tabs .active > a:focus {
	border-color: #ddd transparent #ddd #ddd;
	*border-right-color: #ffffff;
}
</style>