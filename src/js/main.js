(function() {
    
    var btn = document.getElementById("searchbutton"),
     	location = document.getElementById("location"),
     	environment = document.getElementById("data-environment").dataset.environment,
     	ajaxurl=environment+"/api/rental_log/",
     	result=document.getElementById("result"),
     	searchbutton = document.getElementById("searchbutton"),
     	listitems = document.getElementsByClassName("list-group-item"),
     	location_code = "empty",
     	location_name = "empty",
     	graph = document.getElementById("graph");
     	// console.log(listitems);
     	
     		
	    // searchbutton.addEventListener('click', getLocation);
	    
	    
	    location.addEventListener("keyup", getLocation);
	    var location_code = location.value;

	   
    for(var i=0; i< listitems.length; i++) {
    	
        listitems[i].addEventListener("click", clickItem);
        
     }


    function clickItem($str){
    	
    	location_name = decodeURIComponent($str.target.dataset.lname);
    	location_code = $str.target.dataset.location;
    	
    	
    	httpGetAsync(ajaxurl, showResult)
    }

    function buildGraph(){

    }

    
    function getLocation($str){
    	
    	console.log(location.value);
    	location_code = location.value;
	    httpGetAsync(ajaxurl,showResult);
	    
    	}
    

    function showResult(str){
    	var arr = JSON.parse(str),
    		prep = "",
    		arrlen = arr.length;

    		if(arrlen == 0){
    			prep += "No data yet!";
    		}else{
		    	for (var i = 0; i < arrlen; i++) {
		    		var fetchtime = arr[i]['src_fetchtime'],
			    		conv = parseInt(fetchtime),
			    		date = new Date(conv*1000).toLocaleDateString('en-GB',{weekday: 'short', month: 'short', day: 'numeric'}),
						time =  new Date(conv*1000).toLocaleTimeString('en-GB',{hour: '2-digit', minute:'2-digit'});
					
					if(arr[i]['bike_qty'] == null){
						prep += "<tr><td>"+date+" "+time+" "+"</td><td><strong>"+"unknown"+"</strong> bikes</td></tr>";
					}else{
			    		prep += "<tr><td>"+date+" "+time+" "+"</td><td><strong>"+arr[i]['bike_qty']+"</strong> bikes</td></tr>";
			    	}
		    	}
		    }

    	result.innerHTML = "<h2>"+location_name+"</h2>"+"<table>"+prep+"</table>";

    }


	function httpGetAsync(theUrl, callback)
	{
	    var xmlHttp = new XMLHttpRequest();
	    xmlHttp.onreadystatechange = function() { 
	        if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
	            callback(xmlHttp.responseText);
	    }
	    
	    xmlHttp.open("GET", theUrl+"?location_code="+location_code, true); // true for asynchronous 
	    xmlHttp.send();
	}

})();