<?php include 'header.php'; ?>
<?php
 session_start();
 
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
 addcar();
}
function addcar()
{
  $carno = $_POST["form-car-no"];

  
$_SESSION['add_car_errors']="";
  
  $location1 = $_POST["cr_location"];

  $mfg_model = $_POST["mfg_model"];
 
  $conn=connect_to_db();
 
  $sql0 = "SELECT mfg_id from cr_mfg where mfg_model='".$mfg_model."' limit 1";
  $result1 = $conn->query($sql0);
  if ($result1->num_rows)
 {	
	
	$mfg_sql = $result1->fetch_assoc();					
	$mfgid = $mfg_sql[mfg_id];	
 }

  $sql2 = "SELECT location_zip from cr_locations where location_city='".$location1."' limit 1";

  $result2 = $conn->query($sql2);
  if ($result2->num_rows)
 {	
	
	$location_sql = $result2->fetch_assoc();					
	$location = $location_sql[location_zip];	
 }

				
		


  $sql = "INSERT INTO cr_car( `car_no`, `mfg_id`, `color_id`, `year`, `car_availableFL`) VALUES ('".$carno."','".$mfgid."','1','2016','Y')";
  
		if ($conn->query($sql) === TRUE) {
			$_SESSION['add_car_errors']="";
			echo "<h2>".$carno." : Car Inserted</h2>";
			$sql1 = "INSERT INTO cr_car_location( `location_zip`, `car_no`) VALUES ('".$location."','".$carno."')";
			if ($conn->query($sql1) === TRUE) {
					$_SESSION['add_car_errors']="";
					echo "<h2> in Location ".$location."</h2>";
			}
			else
			{
				$_SESSION['add_car_errors']="Invalid Details";
			echo "<h2>Error: " . $sql1 . "</h2>" . $conn->error;
			}	
		}
		else {
			$_SESSION['add_car_errors']="Invalid Details";
			echo "<h2>Error: " . $sql . "</h2>" . $conn->error;
		}
	    
		$conn->close();
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
<a href="admin.php" class="button">Go Back</a>
<?php include 'footer.php'; ?>