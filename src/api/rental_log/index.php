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
	else if (isset($_GET['location_code']))
	{
		$location_code = $_GET['location_code'];
		$esc_location_code = escape($location_code);
		$sql = "SELECT * FROM `rental_log` WHERE location_code='$esc_location_code' ORDER BY src_fetchtime DESC LIMIT 500";
		
		$stmt = $db->prepare($sql);

		$loc = array();
		if ($stmt->execute()) {
		    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		        $loc[] = $row;
		    }
		}
		// echo "location_code: ";
		// echo $location_code;
		// echo "<br>";
		// echo "esc_location_code: ";
		// echo $esc_location_code;
		// echo "<hr>";

		print json_encode(array_map("RemoveNullValues",$loc), JSON_PRETTY_PRINT);
		
		$db_connection = null;
	}
	
	//Fetch AAAAAALLL THE ITEMS
	else
	{
		
	}

}

//I map the array of objects into a more consumable format (null values in the JSON return crash the app and should be handled on the server)
function RemoveNullValues($location_state)
{
	return [
		'id' => (int)$location_state['id'],
		'location_code' => $location_state['location_code'],
		'bike_qty' => $location_state['bike_qty'] == null ? 0 : (int)$location_state['bike_qty'],
		'src_fetchtime' => (int)$location_state['src_fetchtime'],
	];
}

function escape($value) {
    $return = '';
    for($i = 0; $i < strlen($value); ++$i) {
        $char = $value[$i];
        $ord = ord($char);
        if($char !== "'" && $char !== "\"" && $char !== '\\' && $ord >= 32 && $ord <= 126)
            $return .= $char;
        else
            $return .= '\\x' . dechex($ord);
    }
    return $return;
}

GetRentalLog();