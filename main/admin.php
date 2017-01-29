
<!DOCTYPE html>
<?php session_start();?>

<html lang="en">
    <head>
        <title>RentWheels - Admin Page</title>
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
<script>

function delcar(){
	
	window.location='admin_action.php?car_no='+document.getElementById('car_no').value;
		
}
function addcar(){
	
	window.location='add_car.php';
		
}
function changerate(){
	window.location='change_rate.php';
}
function logout(){

	window.location='index.php';
}
</script>
<style>


.button {
    background-color:#F5C042;
    border: none;
    color: black;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}
</style>
    </head>
    <body>
  
        <div class="top-content">
        	<div class="inner-bg">
                <div class="container">
			<button class="button" onClick="logout()" >Logout</button>
                    <div class="row">
						<div class="col-sm-offset-2 text">
							<h1><strong>RENTWheels</strong> Admin Action</h1>
							
						</div>
						</div>
						<div class="row">
							<div class="col-sm-3">
								<div class="form-box">
									<div class="form-top">
										<div class="form-top-left">
											<h3>Delete a car</h3>
										</div>
									</div>
									<div class="form-bottom">					
										<input type="hidden" id="car_number" name="action" value="delcar" />
										<?php if(isset($_SESSION['del_car_error'])):?>
												<div class="error"><?php echo $_SESSION['del_car_error'];?></div>
										<?php endif; ?>
										
										<?php
											$conn=connect_to_db();									
											$sql="select car_no from cr_car where car_availableFl = 'Y'";
											$result = $conn->query($sql);
											if ($result->num_rows)
											{	
												echo "<select id=\"car_no\" name=\"car_no\">";				
												echo "<option value=\"\">--Select a car--</option>";
												while($row = $result->fetch_assoc()) {					
													echo "<option value=\"".$row['car_no']."\">" . $row['car_no'] . "</option>";    				
												}
												echo "</select>";	
											}
											function connect_to_db()
											{$hostname="localhost";						
											 $database="digiashi_CarRental";
                                             $username="digiashi_root";
											 $password="digiashi_root";
											 $conn = new mysqli($hostname, $username, $password, $database);
												// Check connection
											if ($conn->connect_error) {						
												die("Connection failed: " . $conn->connect_error);		
											}
											return $conn;
											}	
										?>
										
										<br>
				                        <button class="button" onClick="delcar()" >delete</button>
				            
									</div>
								</div>
							</div>
                        
                        <div class="col-sm-1 middle-border"></div>
                        
                        	
                        <div class="col-sm-4">
                        	
                        	<div class="form-box">
                        		<div class="form-top">
	                        		<div class="form-top-left">
	                        			<h3>Add a car</h3>
	                            		<p>Add a car to a given location</p>
	                        		</div>
	                        		
	                            </div>
	                            <div class="form-bottom">
				                    <form role="form" action="add_car.php" method="post" class="add_car_form">
									 <input type="hidden" name="action" value="addcar" />
									  <?php if(isset($_SESSION['add_car_errors'])):?>
										<div class="error"><?php echo $_SESSION['add_car_errors'];?></div>
										<?php endif; ?>
				                    	
				                       
										
										
										<?php
											$conn=connect_to_db();									
											$sql2="select location_city from cr_locations";
											$result = $conn->query($sql2);
											if ($result->num_rows)
											{	
												echo "<select id=\"cr_location\" name=\"cr_location\">";				
												echo "<option value=\"\">--Select Location--</option>";
												while($row = $result->fetch_assoc()) {					
													echo "<option value=\"".$row['location_city']."\">" . $row['location_city'] . "</option>";    				
												}
												echo "</select>";	
											}
											
										?>
										
										
										
									
										
										<?php
											$conn=connect_to_db();									
											$sql="select mfg_model from cr_mfg";
											$result = $conn->query($sql);
											if ($result->num_rows)
											{	
												echo "<select id=\"mfg_model\" name=\"mfg_model\">";				
												echo "<option value=\"\">--Select a model--</option>";
												while($row = $result->fetch_assoc()) {					
													echo "<option value=\"".$row['mfg_model']."\">" . $row['mfg_model'] . "</option>";    				
												}
												echo "</select>";	
											}
											
										?>
										
										
										
							
							<div class="form-group">
				                    		<label class="sr-only" for="form-car-no">Car Number</label>
				                        	<input type="text" name="form-car-no" placeholder="Car Number" class="form-car-no form-control" id="form-car-no">
				                        </div>
					
				                        <button class="button" onClick="addcar()" >Add Car</button>
				                    </form>
			                    </div>
                        	</div>
                        	
                        </div>
						<div class="col-sm-1 middle-border"></div>
						
						
						<div class="col-sm-3">
                        	
                        	<div class="form-box">
                        		<div class="form-top">
	                        		<div class="form-top-left">
	                        			<h3>Change Car Rate</h3>
	                            		
	                        		</div>
	                        		
	                            </div>
	                            <div class="form-bottom">
				                    <form role="form" action="change_rate.php" method="post" class="add_car_form">
									 <input type="hidden" name="action" value="changerate" />
									  <?php if(isset($_SESSION['change_rate_errors'])):?>
										<div class="error"><?php echo $_SESSION['change_rate_errors'];?></div>
										<?php endif; ?>
				                        

					                    <?php
											$conn=connect_to_db();									
											$sql="select mfg_model from cr_mfg";
											$result = $conn->query($sql);
											if ($result->num_rows)
											{	
												echo "<select id=\"mfg_model\" name=\"mfg_model\">";				
												echo "<option value=\"\">--Select a model--</option>";
												while($row = $result->fetch_assoc()) {					
													echo "<option value=\"".$row['mfg_model']."\">" . $row['mfg_model'] . "</option>";    				
												}
												echo "</select>";	
											}
											
										?>

						        <div class="form-group">
				                        	<label class="sr-only" for="form-rate">New Rate</label>
				                        	<input type="text" name="form-rate" placeholder="New rate" class="form-rate form-control" id="form-rate">
				                        </div>
					
				                        <button class="button" onClick="changerate()" >Change Rate</button>
				                    </form>
			                    </div>
                        	</div>
                        	
                        </div>
	
                    </div>
                    
                </div>
            </div>
            
        </div>


        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/loginValidation.js"></script>
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>


