// displays the chart view

result.innerHTML=drawChart();

function drawChart(str){
	var width = 1000,
		height = 200,
		styling = "stroke='red' stroke-width='3' fill='none' ",
		arr = JSON.parse(str),
		polypoints = "",
		svg = '<svg style="shape-rendering:geometricPrecision;padding-bottom:0.5px;" id="chartline" x="0px" y="0px" width="'+width+'px" height="'+height+'px" viewBox="0 0 '+width+' '+height+'">',
		
		prep = "",
		arrlen = arr.length,
		yp2 = 0,
		xp2 = 0,
		prev = "",
		maxbike =0,
		minbike = 0;

		//the first point is the one with the youngest fetchtime.
		//the fetchtime 
		// points="120,160 120,120 80,120";

		if(arrlen == 0){
			prep += "No data found!";
		}else{
			
			
			//find max bikes
			for (var i = 0; i < arrlen; i++) {
				if (arr[i]['bike_qty']>maxbike){
					maxbike = arr[i]['bike_qty'];
				}
				if (arr[i]['bike_qty']<minbike){
					minbike = arr[i]['bike_qty'];
				}


			}
			var 
			x2 = 0,
			y2 = 0;
			//find max bikes
			var i = 0;
			var j = 0;
			polyline = "";
	    		prep = "";

	    	result.innerHTML = "<h2>"+location_name+"</h2>";
	    	for (i; i < arrlen-1; i++) {
	    		
	    		if (arr[i]['bike_qty'] !== null) {
		    			
	    		var
	    		//the first x point begins at the end of the graph, and is an x value, somewhere around the value of total width
    			x1h = Math.ceil(parseInt(arr[i]['src_fetchtime']-mindate)/daterange*width)+0.5,

    			//the first y point is the bike amount, corrected by the maximum bike value in that array, so the graph is relative. there is now not yet a line visible, only one point has been drawn

    			y1h = Math.ceil(arr[i]['bike_qty']*(height/maxbike))+0.5,
    			//the second x point moves sideways, bike amount stays the same. and takes the value of the second fetchtime in the array for some reason this doesn't work yet.
    			x2h = Math.ceil(parseInt(arr[i+1]['src_fetchtime']-mindate)/daterange*width)+0.5,
    			
    			//the second y point is the same as the first y point, because we first do a horizontal move. the second portion of the line is differen, then we go up or down in bike amounts.
		    	y2h = y1h,

		    	//now, we start moving up. but the start of the first point that will go upwards, will be the same as the last x point
		    	x1v = x2h,
		    	
		    	// the y point also is the same as the final previous point.
		    	y1v = y2h,

		    	//now, we really start moving up.  the x value is still the same as it's previous point.
		    	x2v = x1v,

		    	//finally, the y2h point will be the same relative bikevalue, but for an incremented array.
		    	y2v = Math.ceil(arr[i+1]['bike_qty']*(height/maxbike))+0.5;

		    	//let's print it.
		    	//index number..
				// prep += i+": ";
				// prep += "<br>";
				
				
				//
				prep += x1h +","+ y1h;
				prep += " ";
				prep += x2h +","+ y2h;
				// prep += "<br>";
				prep += " ";
				prep += x1v +","+ y1v;
				prep += " ";
				prep += x2v +","+ y2v;
				prep += " ";
				// prep += "<br>";
				
				polyline = '<polyline fill="none" stroke="#000000" vector-effect="non-scaling-stroke" stroke-miterlimit="10"  points="'+prep+'"/>'
				}
						
	    	}

	    	result.innerHTML += svg+polyline+"</svg><br>";
	    }
	    

	    

		// result.innerHTML = "<h2>"+location_name+"</h2>"+"</svg> <br>"+prep;


}