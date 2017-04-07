<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
date_default_timezone_set('America/New_York');
setlocale(LC_TIME, "fr_FR");

$GLOBALS['month_abbr'] = array('', 'Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc');

$GLOBALS['app_name'] = 'Mission Rh-PATAF Embarquement';
$GLOBALS['app_url'] = 'https://mission-rh.org/inscriptions';
$GLOBALS['app_email'] = 'info@verslesetoiles.org';

$GLOBALS['picture_path_avatars'] = 'avatars/';
$GLOBALS['picture_path_features'] = 'attachments/features/';
$GLOBALS['picture_path_news'] = 'attachments/news/';
$GLOBALS['attachments_path_characters'] = 'attachments/characters/';
$GLOBALS['attachments_path_players'] = 'attachments/players/';
$GLOBALS['planets_textures_path'] = '../constellations/planet-textures/';