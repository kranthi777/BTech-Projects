<?php
session_start();   

$q = $_REQUEST["q"];
$p = $_REQUEST["p"];
$_SESSION["current_latitude"] = $q;
$_SESSION["current_longitude"]= $p;

//establish connection with the database
$servername = "localhost";
$username = "aturdoor";
$password = "stAAr@123";
$dbname = "Mcreate";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . mysqli_connect_error());
}
//$checking= "INSERT INTO CustomerDatabase (UserName) VALUES ('rohitas')";
//$result = mysqli_query($conn,$checking);
$r = $_SESSION["ProviderUsername"];

if(isset($_SESSION["ProviderUsername"]))
{

$checking= "UPDATE Provider_Location SET Latitude = '$q', Longitude = '$p'  WHERE User_Name = '$r' ";
$result = mysqli_query($conn,$checking);
 

}
?>