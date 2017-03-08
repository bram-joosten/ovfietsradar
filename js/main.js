
function clickItem($str){
	
	location_name = decodeURIComponent($str.target.dataset.lname);
	location_code = $str.target.dataset.location;
	httpGetAsync(ajaxurl, drawChart)
}

function getLocation($str){
	
	console.log(location.value);
	location_code = location.value;
    httpGetAsync(ajaxurl,drawChart);   
	}



function httpGetAsync(theUrl, callback)
{
    var xmlHttp = new XMLHttpRequest(),
    	url = theUrl+"?"+"location_code="+location_code+
			"&max="+maxdate+
			"&min="+mindate;

    xmlHttp.onreadystatechange = function() { 
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
            callback(xmlHttp.responseText);
    }
    
    xmlHttp.open("GET", url, true); // true for asynchronous 
    xmlHttp.send();
}

//old code, save for reference.

// function drawChart(str){
// 	var arr = JSON.parse(str),
// 		prep = "",
// 		arrlen = arr.length;

// 		if(arrlen == 0){
// 			prep += "No data yet!";
// 		}else{
// 	    	for (var i = 0; i < arrlen; i++) {
// 	    		var fetchtime = arr[i]['src_fetchtime'],
// 		    		conv = parseInt(fetchtime),
// 		    		date = new Date(conv*1000).toLocaleDateString('en-GB',{weekday: 'short', month: 'short', day: 'numeric'}),
// 					time =  new Date(conv*1000).toLocaleTimeString('en-GB',{hour: '2-digit', minute:'2-digit'});
				
// 				if(arr[i]['bike_qty'] == null){
// 					prep += "<tr><td>"+date+" "+time+" "+"</td><td><strong>"+"unknown"+"</strong> bikes</td></tr>";
// 				}else{
// 		    		prep += "<tr><td>"+date+" "+time+" "+"</td><td><strong>"+arr[i]['bike_qty']+"</strong> bikes</td></tr>";
// 		    	}
// 	    	}
// 	    }

// 	result.innerHTML = "<h2>"+location_name+"</h2>"+"<table>"+prep+"</table>";

// }
