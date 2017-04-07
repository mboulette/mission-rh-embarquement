<?php
require_once('src/config/global.php');
require_once('autoload.php');
require_once('functions.php');

if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off"){
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: '.$GLOBALS['app_url']);
    exit();
}

if (strtolower(substr($_SERVER['HTTP_HOST'], 0, 3)) == 'www') {
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: '.$GLOBALS['app_url']);
    exit();    
}

$maintenance = new maintenance();
$stop_system = $maintenance->getOne(1);


if ($maintenance->isLock() == 3) {
    echo $maintenance->screenLock(true);
    die();
}


$script_url = strtolower(substr($_SERVER['SCRIPT_URL'], -1) == "/" ? $_SERVER['SCRIPT_URL'] : $_SERVER['SCRIPT_URL'].'/');

/*************************************************************/
/* PAGES NON-SÉCURISÉES */
/*************************************************************/
switch ($script_url) {

    case '/inscriptions/planets/':
        $planets = new planets();
        echo $planets->getJSON();
        die();
    break;

    case '/inscriptions/signout/' :
        session_unset();
        session_destroy();
        header('Location: /inscriptions');
        die();
    break;


    case '/inscriptions/auth/' :
        include('src/auth.php');
        die();
    break;


    case '/inscriptions/reset-password/' :
        echo render(get_template('password'));
        die();
    break;
}


/*************************************************************/
/* SI LA SESSION N'EST PAS OUVERTE, ON REDIRIGE VERS sign-in */
/*************************************************************/
if (!isset($_SESSION['player']) || $_SESSION['player'] == false) {   
    include('src/facebook/login.php');
    echo render(get_template('signin', array('fb_login_url' => $fb_login_url)));
    die();
}


if ($maintenance->isLock() == 1) {
    echo $maintenance->screenLock(false);
    die();
}
/*************************************************************/
/* PAGES SÉCURISÉES */
/*************************************************************/
require_once('src/routing.php');


/*************************************************************/
/* PAGES D'ADMINISTRATION */
/*************************************************************/
require_once('src/admin/routing.php');
