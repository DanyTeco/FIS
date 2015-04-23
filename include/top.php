<?php
session_start();
ob_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

define("DB_HOST", "localhost");
define("DB_NAME", "tsevenro_fis");
define("DB_USER", "tsevenro_t7");
define("DB_PSWD", "p@@S1314#");

define("DEV_EMAIL", "teco.2008@yahoo.com");


###			DB CONNECTION			###
$db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8', DB_USER, DB_PSWD);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$db->exec("set names utf8");


?>