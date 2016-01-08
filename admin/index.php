<?php
if (isset($_GET['refresh'])) {
    header("Location: http://" . $_SERVER['HTTP_HOST'] . str_replace("?refresh", "", $_SERVER['REQUEST_URI']));
}

$back = '../';
$admin = true;
include $back . 'include/header.php';
include $back . 'include/password_protect.php';

session_start();
$token = md5(uniqid(mt_rand(), true));
$_SESSION['token'] = $token;
?>
<div id="notifications">
	<?php if (!is_writable("../servers.json")): ?>
		<div class="alert alert-danger" role="alert">
			<b>Error:</b> <code>servers.json</code> isn't writable
		</div>
	<?php endif ?>
	<?php if (!is_writable("../config.json")): ?>
		<div class="alert alert-danger" role="alert">
			<b>Error:</b> <code>config.json</code> isn't writable
		</div>
	<?php endif ?>
	<?php if ($config["password"] == "CHANGE-THIS"): ?>
		<div class="alert alert-warning" role="alert">
			<b>Warning:</b> Your password is set to the default! Change it ASAP
		</div>
	<?php endif ?>
</div>
<body>
    <div class="row">
        <a href="?logout" class="logout"><button name="logout" class="btn btn-danger pull-right"><span class="glyphicon glyphicon-log-out"></span> Log out</button></a>
        <div class="col-md-8">
        <div class="tabbable tabs-left">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#new-server" data-toggle="tab"><b><span class="glyphicon glyphicon-plus-sign"></span> New server</b></a></li>
                <?php 
                foreach ($config['servers'] as $key => $server) {
                    echo '<li><a href="#server-' . $key . '" data-toggle="tab" class="text-primary"><span class="glyphicon glyphicon-hdd"></span> ' . $server['Name'] . '</a></li>' . "\n";
                }
                ?>
            </ul>
            
            <div class="tab-content col-md-8">
                <div class="tab-pane active" id="new-server">
                    <form role="form" method="post" action="manage_servers.php">
                        <legend>Add server</legend>
                        <div class="form-group">
                            <label for="name">Server name:</label>
                            <input type="text" class="form-control" name="name" placeholder="My server" autocomplete="off" required/>
                        </div>
                        
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <input type="text" class="form-control" name="address" placeholder="mc.example.com" autocomplete="off" required/>
                        </div>
                        <div class="form-group">
                            <label for="port">Port:</label>
                            <input type="number" class="form-control" name="port" placeholder="25565" autocomplete="off" required/>
                        </div>
                        
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <input class="form-control" name="description" autocomplete="off"/>
                        </div>
                        
                        <input type="hidden" name="token" value="<?php echo $token ?>" />
                        
                        <button type="submit" name="action" value="add" class="btn btn-primary"><span class="glyphicon glyphicon-plus-sign"></span> Add Server</button>
                    </form>
                </div>
                
                <?php foreach ($config['servers'] as $key => $server): ?>
                <div class="tab-pane" id="server-<?php echo $key ?>">
                    <form role="form" method="post" action="manage_servers.php">
                        <input type="hidden" name="id" value="<?php echo $key ?>"/> 
                        <input type="hidden" name="token" value="<?php echo $token ?>"/> 
                        
                        <legend>Edit server</legend>
                        
                        <div class="form-group">
                            <label for="name">Server name:</label>
                            <input type="text" class="form-control" name="name" placeholder="My server" value="<?php echo $server['Name'] ?>" autocomplete="off" required/>
                        </div>
                        
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <input type="text" class="form-control" name="address" placeholder="mc.example.com" value="<?php echo $server['Address'] ?>" autocomplete="off" autocomplete="off" required/>
                        </div>
                        <div class="form-group">
                            <label for="port">Port:</label>
                            <input type="number" class="form-control" name="port" placeholder="25565" value="<?php echo $server['Port'] ?>" autocomplete="off" required/>
                        </div>
                        
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <input class="form-control" name="description" value="<?php echo $server['Description'] ?>" autocomplete="off" />
                        </div>
                        
                        <div class="form-group">
                            <label for="offline-reason">Offline reason:</label>
                            <input class="form-control" name="offline-reason" value="<?php echo $server['Offline_reason'] ?>" autocomplete="off" />
                        </div>
                        
                        <button type="submit" class="btn btn-primary" name="action" value="edit"><span class="glyphicon glyphicon-save"></span> Save</button>
                        
                        <button type="submit" class="btn btn-danger pull-right confirm" name="action" value="remove"><span class="glyphicon glyphicon-remove-circle"></span> Remove server</button> 
                    </form>
                </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <form role="form" method="post" action="manage_config.php">
            <legend>Configuration</legend>
            <div class="form-group">
                <label for="title">Site title:</label>
                <input type="text" class="form-control" name="title" placeholder="<?php echo $config["title"] ?>" autocomplete="off" value="<?php echo $config["title"] ?>" required/>
            </div>
            <div class="form-group">
                <label for="cloumns">Columns:</label>
                <input type="number" class="form-control" name="columns" placeholder="<?php echo $config["columns"] ?>" autocomplete="off" value="<?php echo $config["columns"] ?>" required/>
            </div>
            <div class="form-group">
                <label for="avatar_type">Avatar type:</label>
                <select class="form-control" name="avatar_type" required>
					<option value="3d"<?php if ($config["avatar_type"] == "3d") echo " selected" ?>>3D</option>
					<option value="3d_helm"<?php if ($config["avatar_type"] == "3d_helm") echo " selected" ?>>3D with helmet</option>
					<option value="2d"<?php if ($config["avatar_type"] == "2d") echo " selected" ?>>2D</option>
					<option value="2d_helm"<?php if ($config["avatar_type"] == "2d_helm") echo " selected" ?>>2D with helmet</option>
				</select>
            </div>
            <div class="form-group">
                <label for="backend">Backend:</label>
                <select class="form-control" name="backend" required>
					<option value="query"<?php if ($config["backend"] == "query") echo " selected" ?>>Query (requires "query-enabled")</option>
					<option value="ping"<?php if ($config["backend"] == "ping") echo " selected" ?>>Ping (1.8+, no player list)</option>
					<option value="relay"<?php if ($config["backend"] == "relay") echo " selected" ?>>Relay (see wiki)</option>
				</select>
            </div>
            
            <input type="hidden" name="token" value="<?php echo $token ?>" />
            
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Save</button>
        </form>
    </div>
    
    <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="confirm" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Are you sure?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-danger" id="delete">Delete</button>
                    <button type="button" data-dismiss="modal" class="btn">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</body>
<style>
.row {
    width: 100%;
    padding: 10px;
}

@media (min-width:992px) {
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
	    border-right: 1px solid #DDD;
	}
	
	.tabs-left > .nav-tabs > li > a {
	    margin-right: -1px;
	    -webkit-border-radius: 4px 0 0 4px;
	    -moz-border-radius: 4px 0 0 4px;
	    border-radius: 4px 0 0 4px;
	}
	
	.tabs-left > .nav-tabs > li > a:hover,
	.tabs-left > .nav-tabs > li > a:focus {
	    border-color: #EEE #DDD #EEE #EEE;
	}
	
	.tabs-left > .nav-tabs .active > a,
	.tabs-left > .nav-tabs .active > a:hover,
	.tabs-left > .nav-tabs .active > a:focus {
	    border-color: #DDD transparent #DDD #DDD;
	    border-right-color: #FFF;
	}
}
.alert {
	margin: 0;
	border-radius: 0;
	padding-right: 120px;
}

code {
	color: inherit;
}

.logout {
	position: absolute;
	right: 10px;
	top: 7px;
	z-index: 10;
}
</style>
<script>
var ignore = false;
$('.confirm').on('click', function(e) {
	var target = this;
	if (ignore) {
		ignore = false;
		return;
	}
    var form=$(this).closest('form');
    e.preventDefault();
    $('#confirm').modal({ backdrop: 'static', keyboard: false }).one('click', '#delete', function (e) {
        ignore = true;
        $(target).click();
    });
});

$.getJSON("https://api.github.com/repos/franga2000/BungeeStatus/tags", function(data) {
	if (data[0].name != VERSION) {
		$('<div class="alert alert-info" role="alert"> \
			<b>Info:</b> Version <code>' + data[0].name + '</code> has been released (you are still on <code>' + VERSION + '</code>). You can get it <a href="https://github.com/franga2000/BungeeStatus/releases/tag/' + data[0].name + '"><b>here.</b></a> \
		</div>').hide().appendTo("#notifications").slideDown();
	}
});
</script>
</html>