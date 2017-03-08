<?php

 $src= "http:".$environment."/api/current_locations/";
 $jsn = file_get_contents($src);
 $obj =  json_decode($jsn);

 //Dumb but fast search/replace. Because some location codes are inconsistent, replace this list. Keep it ordered in the same manner because the for loop will only iterate once. Keep the last array item empty to avoid undefined index issues.
 
	 $replaceindex = 0;
 

 foreach ($obj as $key => $value) {
 	
 	 $value->name = stripslashes($value->name);
 	echo "<button type=\"button\" class=\"list-group-item list-group-item-action\" data-location=".$value->location_code."
 		data-lname=".rawUrlEncode($value->name).">";
 	
 	echo $value->name;
 	echo ", ";
 	echo "now&nbsp;<strong>";
 	if ($value->current_amt === null){
 		echo "unknown";
 	} else{
 		echo $value->current_amt;
 	}
 	echo ".</strong> ";	
 	
 }

		?>