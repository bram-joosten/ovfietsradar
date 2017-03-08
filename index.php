<?php include('head.php');?>

<body>



	<div class="container mt-md-2">
		<div class="text-center">
			<h1>How reliable is your OV bike location?</h1>
		</div>
	<hr class="hidden-xs-down">
	&nbsp;
		<div class="row">
			<div class="col-md-12 text-center">
				<div id="result"></div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-5 offset-md-4">

				<form class="form-inline mb-2">
				    <label class="sr-only" for="location">Enter location</label>
					    <div class="input-group mb-10 mr-sm-2 ">
						    <input type="text" id="location" class="form-control" placeholder="Search your location..">
					    </div>
				    <label class="sr-only" for="searchbutton">Confirm search</label>
					<button id="searchbutton" type="button" class="btn btn-primary" value="search">Search</button>
				</form>

								<div id="viewport">
									<div class="list-group">

										<?php include('inc/locationlist.php');?>	
									
									</div>
								</div>


			</div>
		</div>

				
			</div>
		
			<div class="col-md-4">
				
			</div>
		</div>
		
	</div>

</body>

<?php include('footerscripts.php');?>