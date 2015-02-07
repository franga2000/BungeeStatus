<?php
define('LOGOUT_URL', $back);
define('TIMEOUT_MINUTES', 0);
define('TIMEOUT_CHECK_ACTIVITY', true);

$timeout = TIMEOUT_MINUTES == 0 ? 0 : time() + TIMEOUT_MINUTES * 60;

if (isset($_GET['logout'])) {
  setcookie("verify", '', $timeout, '/');
  header('Location: ' . LOGOUT_URL);
  exit();
}

if (!function_exists('showLoginPasswordProtect')) {

    function showLoginPasswordProtect($error_msg) {
?>
        <style>
        .form-signin {
            max-width: 500px;
            padding: 15px 35px 45px;
            margin: 0 auto;
            border: 1px solid rgba(0, 0, 0, 0.1); 
        }
        </style>
        
        <form class="form-signin" method="post" action="./">
            <legend>Enter password</legend>
            <?php 
            if($error_msg) {
                echo '<div class="error">' . $error_msg . '</div>'; 
            }
            ?>
            <input type="password" class="form-control" name="access_password" placeholder="Password">
            <br/><br/>
            <button type="submit" class="btn btn-primary pull-right">Sign in</button>
        </form>
        <?php
        die();
    }
}

if (isset($_POST['access_password'])) {

  $pass = $_POST['access_password'];
  if ($pass != $config['password']) {
        showLoginPasswordProtect("Incorrect password.");
  }
  else {
    setcookie("verify", md5($pass), $timeout, '/');
    
    unset($_POST['access_password']);
    unset($_POST['Submit']);
  }

} else {
    if (!isset($_COOKIE['verify'])) {
        showLoginPasswordProtect("");
    }
    
    $found = false;
        if ($_COOKIE['verify'] == md5($config['password'])) {
            $found = true;
            if (TIMEOUT_CHECK_ACTIVITY) {
                setcookie("verify", md5($config['password']), $timeout, '/');
            }
    }
    if (!$found) {
    showLoginPasswordProtect("");
    }
}
?>