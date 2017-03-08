<?php

include_once(dirname(__FILE__).'/../../cfg/config.php');

function GetCurrentLocations(){

	$db = Connect();
	// header('WWW-Authenticate: Negotiate');
	header('Access-Control-Allow-Methods: GET, POST, PUT', true);
	header('Access-Control-Allow-Origin: *');

	
		// $location_code = $_GET['location_code'];
		$sql = "SELECT * FROM `current_locations` ORDER BY name ASC";
		
		$stmt = $db->prepare($sql);


		//Dumb but fast search/replace. Because some location codes are inconsistent, replace with this list. Keep it ordered in the same manner because the for loop will only iterate once. Keep the last array item empty to avoid undefined index issues.
		$loc = array();
		$cleanup =[["apn001","Alphen aan den Rijn"],
					["asd008","Amsterdam IJzijde"],
					["bv002","Beverwijk"],
					["dt002","Delft"],
					["dv002","Deventer A1 Carpoolplaats"],
					["ed001","Ede-Wageningen Noordzijde"],
					["ed002","Ede-Wageningen Zuidzijde"],
					["Gp001","Geldrop"],
					["gz001","Gilze-Rijen"],
					["gd001","Gouda"],
					["nvd001","Nijverdal"],
					["hor001","Hollandse Rading"],
					["ht001","'s Hertogenbosch Centrumzijde"],
					["Hto001","'s Hertogenbosch Oost"],
					["ledn001","Leiden Centraal, Uitgang Medisch Centrum"],
					["mas001","Maarssen Fietsenstalling"],
					["gerp002","Groningen Europapark"],
					["Rtd003","Rotterdam Wilhelminaplein"],
					["Rtd004","Rotterdam Marconiplein"],
					["ut901","IJsselstein"],
					["ut905","Vianen"],
					["wp001","Weesp"],
					["wp901","Muiden"],
					["zl001","Zwolle Centrumzijde"],
					["zl002","Zwolle Zuidzijde"],
					// ["",""],
					];
		$cleanupindex = 0;
		
		if ($stmt->execute()) {
		    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		         if($row["location_code"] == $cleanup[$cleanupindex][0]){
		         	$row["name"] = $cleanup[$cleanupindex][1];
		         	$cleanupindex++;
		         }
		        $loc[] = $row;

		    }
		}

		function compareByLocation($a, $b) {
		  return strcasecmp($a["name"], $b["name"]);
		}


		
		usort($loc, 'compareByLocation');
		

		print json_encode($loc, JSON_PRETTY_PRINT);
					// pre($loc);

		$db_connection = null;

}

GetCurrentLocations();
