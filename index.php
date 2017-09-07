<?php include('head.php');?>

<body>



	<div class="container mt-md-2">
		<div class="text-center">
			<h1>How reliable is your OV bike location?</h1>
		</div>
	<hr class="hidden-xs-down">
	&nbsp;
		<div class="row" style="display: none;">
			<div class="col-md-5 offset-md-1">

				<form class="form-inline mb-2">
				  
				    <label class="sr-only" for="location">Enter location</label>
					    <div class="input-group mb-10 mr-sm-2 ">
						    <input type="text" id="location" class="form-control" placeholder="Search your location..">
					    </div>
				    <label class="sr-only" for="searchbutton">Confirm search</label>
					<button id="searchbutton" type="button" class="btn btn-primary" value="search">Search</button>
				</form>
			</div>
		</div>

		<div class="row">
			<div class="col-md-4 offset-md-2">
				<div id="viewport">
					<div id="graph"></div>
					<div id="result"></div>
				</div>
			</div>
		
			<div class="col-md-4">
				<div id="viewport">
					<div class="list-group">

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
					
					</div>
				</div>
			</div>
		</div>
		
	</div>

</body>

<?php include('footerscripts.php');?>