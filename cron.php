<?php

include_once(dirname(__FILE__).'/cfg/config.php');

function Cron(){

	global $environment;
	global $db;
	global $json;

	$obj =  json_decode(file_get_contents($json),true);
	$from_db = [];
	$from_src = [];
	$diff = [];

	$db = Connect();
	$station_code = "";
	$location_code = "";
	$current_amt = null;
	$name = "";
	$lat = 0;
	$lon = 0;


	$sql_fetch = 'SELECT location_code,current_amt FROM current_locations ORDER BY location_code ASC';
	$j = 0;
	foreach ($db->query($sql_fetch) as $row) {

	    $from_db[] =[ 'location_code' => $row['location_code'],'current_amt'=> $row['current_amt'] ];
	}
	echo "<br>";
	

	try{
		$stmt = $db->prepare("
			INSERT INTO current_locations (location_code,station_code,current_amt,name,lat,lon)
			VALUES (:location_code, :station_code, :current_amt, :name, :lat, :lon)
			ON DUPLICATE KEY UPDATE current_amt= :current_amt ");
			
		    $stmt->bindParam(':location_code', $location_code);
		    $stmt->bindParam(':station_code', $station_code);
		    $stmt->bindParam(':current_amt', $current_amt);
		    $stmt->bindParam(':name', $name);
		    $stmt->bindParam(':lat', $lat);
		    $stmt->bindParam(':lon', $lon);

		$i=0;
		foreach ($obj['locaties'] as $key) {
				$station_code = $key['stationCode'];
				$location_code = $key['extra']['locationCode'];
				$current_amt = "";
				$name = addslashes($key['description']);
				$lat = $key['lat'];
				$lon = $key['lng'];
				$src_fetchtime = $key['extra']['fetchTime'];

				if (!isset($key['extra']['rentalBikes'])){
					$current_amt = null;
					// pre($key['extra']);
				} else{
					$current_amt = $key['extra']['rentalBikes'];
					
				}

				$from_src[] =[ 'location_code' => $location_code,'current_amt'=> $current_amt, 'src_fetchtime' => $src_fetchtime ];

				
				
				// echo "<br>";
				// echo $i.": ";
				// echo $location_code;echo "; ";
				// echo $station_code;echo "; ";
				// echo $current_amt;echo "; ";
				// echo $name;
				$stmt->execute();
				
				$i++;
		}
	}

	catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
	$conn = null;


	function compareByLocation($a, $b) {
	  return strcasecmp($a['location_code'], $b['location_code']);
	}
	
	usort($from_src, 'compareByLocation');
	$from_src_len = count($from_src);
	$from_db_len = count($from_db);

	

	// echo "<br>From Source: ".$from_src_len." elements<br>";
	// echo "<br>From DB: ".$from_db_len." elements<br>";

	$k = 0; $arrindex = 0;
	for ($j=0; $j < $from_src_len ; $j++) {

		//step 1: ALWAYS test if we're comparing the correct locations with each other
		if
			($from_src[$j]['location_code'] === $from_db[$k]['location_code']){
			// echo $j.": ";
			// echo $from_src[$j]['location_code'].": ".$from_src[$j]['current_amt']." ";
			// echo " = ";
			// echo $k.": ";
			// echo $from_db[$k]['location_code'].": ".$from_db[$k]['current_amt'];;
			
			//where the magic happens
			if ($from_src[$j]['current_amt']!== $from_db[$j]['current_amt']) {
				
				$diff[] = ['location_code' => $from_src[$j]['location_code'],
							'bike_qty' => $from_src[$j]['current_amt'],
							'src_fetchtime' => $from_src[$j]['src_fetchtime']];
							// print_r($diff[$arrindex]); $arrindex++;
			}
			// echo "<br>";
			$k++;
		} else //if there's change in location, start manipulating arrays
			{
				if ($from_src_len > $from_db_len){ //new location in src
				// echo $j.": ";
				// echo $from_src[$j]['location_code'];
				// echo " = ";
				// echo "skip";
				$diff[] = ['location_code' => $from_src[$j]['location_code'],
							'bike_qty' => null,
							'src_fetchtime' => $from_src[$j]['src_fetchtime'] ];
				// print_r($diff);
				// echo "<br>";
			} if ($from_src_len < $from_db_len){ //location removed from src
				
				array_splice( $from_src, $j, 0, array('skip') );
				// echo $j.": ";
				// echo $from_src[$j];
				// echo " = ";
				// echo $k.": ";
				// echo $from_db[$j]['location_code'];
				$diff[] = ['location_code' => $from_db[$j]['location_code'],
							'bike_qty' => null,
							'src_fetchtime' => time() ];//this is a lazy, didn't want to add a new row of fetchtimes to current_locations table.
				// print_r($diff);
				// echo "<br>";
				// $j--;
				$k++;


			} else{};

		}
		
		
	}
try{
	$stmt = $db->prepare("INSERT INTO `rental_log` (`location_code`,`bike_qty`,`src_fetchtime`)
		VALUES (:location_code,:bike_qty,:src_fetchtime)");

	$stmt->bindParam(':location_code', $bind1);
	$stmt->bindParam(':bike_qty', $bind2);
	$stmt->bindParam(':src_fetchtime', $bind3);

	
	
	$diff_len = count($diff);
	for ($n=0; $n < $diff_len; $n++) { 
		$bind1 = $diff[$n]['location_code'];
		$bind2 = $diff[$n]['bike_qty'];
		$bind3 = $diff[$n]['src_fetchtime'];
		$stmt->execute();
	}

	
	}

    catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
	$conn = null;

}

Cron();

//Assumptions
//if rentalbikes does not exist, we assume that the data is empty
//anyway, for now we want to overwrite things happening. We store empty in the db when there is no info available.



//example info msg's in db
//changed from having no bikeAmount key/value pair to having a bikeAmount of X
//changed from having a key/value pair to having none.
//changed from having value 3 to having no key/value pair.
// 

