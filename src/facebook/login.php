<?php

$fb = new Facebook\Facebook([
	'app_id' => facebook_app_id,
	'app_secret' => facebook_app_secret,
	'default_graph_version' => facebook_default_graph_version,
]);

$fb_helper = $fb->getRedirectLoginHelper();
$fb_login_url = htmlspecialchars($fb_helper->getLoginUrl($GLOBALS['app_url'].'/auth?action=facebook', ['email']));