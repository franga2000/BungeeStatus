<?php
$back = '../';
include $back . 'password_protect.php';

include $back . 'header.php';

include $back . 'FancyJson.php';

session_start();

if($_POST['token'] != $_SESSION['token'] && php_sapi_name() != 'cli') {
   die("Unauthorized source!");
}

$_SESSION['token'] = "";

var_dump($_POST);

switch($_POST['action']) {
    case 'add':
        array_push($config['servers'], Array(
            'Name' => $_POST['name'], 
            'Adress' => $_POST['adress'], 
            'Port' => $_POST['port'], 
            'Description' => $_POST['description'], 
            'Offline_reason' => ''
        ));
        
        unset($config['password']);
        unset($config['columns']);
        unset($config['player-columns']);
        file_put_contents($back . 'servers.json', indent(json_encode($config)));
    break;
    
    case 'remove':
        unset($config['servers'][$_POST['id']]);
        
        file_put_contents($back . 'servers.json', indent(json_encode($config)));
    break;
    
    case 'edit':
        $config['servers'][$_POST['id']] = Array(
            'Name' => $_POST['name'], 
            'Adress' => $_POST['adress'], 
            'Port' => $_POST['port'], 
            'Description' => $_POST['description'], 
            'Offline_reason' => $_POST['offline-reason']
        );
        
        unset($config['password']);
        unset($config['columns']);
        unset($config['player-columns']);
        file_put_contents($back . 'servers.json', indent(json_encode($config)));
    break;
    
}

header('Location: ../') ;