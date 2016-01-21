













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

$r = $_SESSION["username"];

if(isset($_SESSION["username"]))
{
// update the location of the user every 10 min.....
//$checking= "INSERT INTO CustomerDatabase (UserName) VALUES ('rohitgggggggggas')";
$checking= "UPDATE CustomerLocation SET Latitude = '$q', Longitude = '$p'  WHERE UserName = '$r' ";
$result = mysqli_query($conn,$checking);
 
//I can use this to get the last known location....

}
?>