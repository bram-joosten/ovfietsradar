<?php


function Connect(){
	global $servername;
	global $username;
	global $password;
	global $dbname;

	try {
		
	    $dbh = new PDO('mysql:host='.$servername.';dbname='.$dbname.';charset=utf8', $username, $password, array(
	    	PDO::ATTR_EMULATE_PREPARES => true, 
	    	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	    	PDO::MYSQL_ATTR_INIT_COMMAND => 'SET sql_mode="TRADITIONAL"'
	    	));
		// echo "Connected successfully to ".$servername ;		
		
		//close connection
	    // $dbh = null;
	    
	} catch (PDOException $e) {
	    print Debug("Error!: " . $e->getMessage() . "<br/>");
	    die();
	}
	
	return $dbh;

}

function pre($str){
	echo "<pre>";print_r($str); echo"</pre>";
}