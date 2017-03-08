<?php

include_once(dirname(__FILE__).'/../../cfg/config.php');

function GetRentalLog(){

	$db = Connect();
	// header('WWW-Authenticate: Negotiate');
	header('Access-Control-Allow-Methods: GET, POST, PUT', true);
	header('Access-Control-Allow-Origin: *');

	//IF ID is set on url (added to the end as ?id=n / ?location_code=n), fetch only single item
	if(isset($_GET['id']))
	{
		
	}
	// else if (isset($_GET['location_code']))
	// {
	// 	$location_code = $_GET['location_code'];
	// 	$sql = "SELECT * FROM `rental_log` WHERE location_code='$location_code' ORDER BY src_fetchtime DESC";
		
	// 	$stmt = $db->prepare($sql);

	// 	$loc = array();
	// 	if ($stmt->execute()) {
	// 	    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	// 	        $loc[] = $row;
	// 	    }
	// 	}

	// 	print json_encode($loc, JSON_PRETTY_PRINT);
		
	// 	$db_connection = null;
	// }
	else if (isset($_GET['location_code'])&&isset($_GET['max'])&&isset($_GET['min']))
	{	
		$location_code = $_GET['location_code'];
		$max = $_GET['max'];
		$min = $_GET['min'];
		// $max = 1488241071;
		// $min = 1488313913;

		$sql = "
			SELECT * 
			FROM `rental_log` 
			WHERE location_code='$location_code' and src_fetchtime between '$min' and '$max'
			ORDER BY src_fetchtime DESC";

		$stmt = $db->prepare($sql);


		$loc = array();
		if ($stmt->execute()) {
		    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		        $loc[] = $row;
		    }
		}

		print json_encode($loc, JSON_PRETTY_PRINT);
		
		$db_connection = null;

	}
	
	//Fetch AAAAAALLL THE ITEMS
	else
	{
		
	}

}

GetRentalLog();