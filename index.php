<?php
session_start();
error_reporting(E_ALL - E_NOTICE);
ini_set('display_errors','On');
	require_once("../conf/config.php");
	require_once("application/base.php");
	
	require_once("helpers/functions.php");
	require_once("helpers/myorder.class.php");
	
	//викаме контролера 
	$application = new Application();
	$application->loadController();
?>