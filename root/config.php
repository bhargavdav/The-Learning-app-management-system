<?php
/*
	File = config.php
	Date = 22-2-2018
*/
// session start
session_start();
error_reporting(0);
// website full url
define('SITE_LOCAL_URL', 'http://localhost/webname');
//define('SITE_LIVE_URL','http://localhost/webname');

// site running in live server or locaL
define('SITE_MODE', '0');
define('DB_PREFIX', 'tbl_');
define('SITE_TITLE', 'Learning');
define('SITE_EMAIL', 'example@gmail.com');
define('SITE_PHONE', 'your-phone-number');
define('SITE_ADDRESS', 'your-address');

// live db configuration
$bc_live_host = 'your host';
$bc_live_user = 'your user';
$bc_live_pass = 'your password';
$bc_live_db = 'your db';
// local db configuration
$bc_host = 'yourhost';
$bc_user = 'youruser';
$bc_pass = 'yourpassword';
$bc_db = 'your db';
// other configuration
if (SITE_MODE == 0) {
	define('SITE_URL', SITE_LOCAL_URL);
	define('ADMIN_URL', SITE_LOCAL_URL . 'learning/');
	// db configuration
	define('DB_HOST', $bc_host);
	define('DB_USER', $bc_user);
	define('DB_PASS', $bc_pass);
	define('DB_DATABASE', $bc_db);
} else {
	define('SITE_URL', SITE_LIVE_URL);
	define('ADMIN_URL', SITE_LIVE_URL . 'learning/');
	// db configuration
	define('DB_HOST', $bc_live_host);
	define('DB_USER', $bc_live_user);
	define('DB_PASS', $bc_live_pass);
	define('DB_DATABASE', $bc_live_db);
	//	mysql_connect(DB_HOST,DB_USER,DB_PASS) or die(mysql_error());die; 
}
// Error Message
define('INSERT_MSG', 'Record added successfully!');
define('UPDATE_MSG', 'Record updated sucessfully!');
define('DELETE_MSG', 'Record deleted successfully!');
define('ACTIVE_MSG', 'User activated successfully!');
define('DEACTIVE_MSG', 'User deactivated successfully!');
define('MDELETE_MSG', 'Selected record deleted successfully!');
define('MACTIVE_MSG', 'Selected record activated successfully!');
define('MDEACTIVE_MSG', 'Selected record deactivated successfully!');
// class call function
date_default_timezone_set('Asia/Calcutta');
require_once("ai_core/class.core.php");
require_once('include/class.phpmailer.php');
