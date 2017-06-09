<?php 
	ini_set('session.cookie_lifetime', 864000);
	ini_set('session.gc_maxlifetime', 864000);
	session_start();
	ob_start(); 
	require_once("config/config.inc.php");
	require_once($config['rootPath']."class/database.class.php");
	require_once($config['rootPath']."class/common.class.php");
	require_once($config['rootPath']."class/functions.php");
	// create the $db ojbect

	$db = new Database($config['server'], $config['user'], $config['pass'], $config['database'], $config['tablePrefix']);  


	// connect to the server


	$db->connect(); 


	$com = new Common;


	error_reporting(0);


	


	//  display_errors(1);


?>