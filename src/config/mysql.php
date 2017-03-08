<?php

//MySQl
define('mysql_host','91.216.107.164');
define('mysql_base','missi777914');
define('mysql_port','3306');
define('mysql_user','missi777914');
define('mysql_pass','wj9n4momg8');






$GLOBALS['mysql_conn'] = new mysqli(mysql_host, mysql_user, mysql_pass, mysql_base);
$GLOBALS['mysql_conn']->query("SET session character_set_results = UTF8");
$GLOBALS['mysql_conn']->query("SET session character_set_client = UTF8");
$GLOBALS['mysql_conn']->query("SET session character_set_connection = UTF8");
$GLOBALS['mysql_conn']->query("SET session character_set_server = UTF8");