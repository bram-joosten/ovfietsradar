//all vars
var btn = document.getElementById("searchbutton"),
     location = document.getElementById("location"),
     environment = document.getElementById("data-environment").dataset.environment,
     ajaxurl=environment+"/api/rental_log/",
     result=document.getElementById("result"),
     searchbutton = document.getElementById("searchbutton"),
     listitems = document.getElementsByClassName("list-group-item"),
     location_code = "empty",
     location_name = "empty",
     graph = document.getElementById("graph"),
     location_code = location.value,
     daterange = 84000,
     maxdate = Math.ceil(Date.now()/1000),
     mindate = maxdate-daterange;

//all eventlisteners
location.addEventListener("keyup", getLocation);
   
for(var i=0; i< listitems.length; i++) {
    listitems[i].addEventListener("click", clickItem);
 }
