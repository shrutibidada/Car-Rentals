<?php include 'header.php'; ?>
<?php
 session_start();
 
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
 changerate();
}
function changerate()
{
  
  $rate = $_POST["form-rate"];
  $mfg_model = $_POST["mfg_model"];

  $_SESSION['change_rate_errors']="";
  $conn=connect_to_db();
 
  $sql = "update cr_mfg set mfg_rate=".$rate." where mfg_model='".$mfg_model."'";
		
		if ($conn->query($sql) === TRUE) {
			$_SESSION['change_rate_errors']="";
			echo "<h2>mfg_model : ".$mfg_model." , Rate Changed</h2>";	
		}
		else {
			$_SESSION['change_rate_errors']="Invalid Details";
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

