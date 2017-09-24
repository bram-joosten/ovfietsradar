<?php


//debug
ini_set('display_errors',1);
error_reporting(E_ALL);

//local environments
define("LOCAL", "//localhost/~bramjoosten/ovfietsradar");
define("WEB", "//ovfietsradar.nl");

//set default environment
$environment = WEB;
$localfile = dirname(__FILE__).'/../local/local.php';

//if this file exists, it is the local environment. Shouldn't exist on the server.
if (file_exists($localfile)) {
  include_once($localfile);
}

//credentials

if ($environment == WEB){
		$servername = "10.3.0.81";
		$username = "bramjrd21_ovfr";
		$password = "lHTwH7rI";
		$dbname = "bramjrd21_ovfr";
		$json = "http://fiets.openov.nl/locaties.json";
	} else if($environment == LOCAL){
		$servername = "127.0.0.1";
		$username = "root";
		$password = "iopjkliop]";
		$dbname = "ovfiets";
		$json = dirname(__FILE__)."/../local/locaties3.json";
	} else{
		echo "$environment variable error";
	}
//includes

include_once(dirname(__FILE__).'/connect.php');