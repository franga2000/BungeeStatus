<?php
include $back . 'header.php';
// User will be redirected to this page after logout
define('LOGOUT_URL', $back);

// time out after NN minutes of inactivity. Set to 0 to not timeout
define('TIMEOUT_MINUTES', 0);

// This parameter is only useful when TIMEOUT_MINUTES is not zero
// true - timeout time from last activity, false - timeout time from login
define('TIMEOUT_CHECK_ACTIVITY', true);

// timeout in seconds
$timeout = (TIMEOUT_MINUTES == 0 ? 0 : time() + TIMEOUT_MINUTES * 60);

// logout?
if(isset($_GET['logout'])) {
  setcookie("verify", '', $timeout, '/'); // clear password;
  header('Location: ' . LOGOUT_URL);
  exit();
}

if(!function_exists('showLoginPasswordProtect')) {

    function showLoginPasswordProtect($error_msg) {
        ?>
        <style>
        .form-signin {
            max-width: 500px;
            padding: 15px 35px 45px;
            margin: 0 auto;
            border: 1px solid rgba(0,0,0,0.1); 
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

// user provided password
if (isset($_POST['access_password'])) {

  $pass = $_POST['access_password'];
  if ($pass != $config['password']) {
        showLoginPasswordProtect("Incorrect password.");
  }
  else {
    // set cookie if password was validated
    setcookie("verify", md5($pass), $timeout, '/');
    
    // Some programs (like Form1 Bilder) check $_POST array to see if parameters passed
    // So need to clear password protector variables
    unset($_POST['access_password']);
    unset($_POST['Submit']);
  }

}

else {

    // check if password cookie is set
    if (!isset($_COOKIE['verify'])) {
        showLoginPasswordProtect("");
    }
    
    // check if cookie is good
    $found = false;
        if ($_COOKIE['verify'] == md5($config['password'])) {
            $found = true;
            // prolong timeout
            if (TIMEOUT_CHECK_ACTIVITY) {
                setcookie("verify", md5($config['password']), $timeout, '/');
            }
    }
    if (!$found) {
    showLoginPasswordProtect("");
    }

}

?>