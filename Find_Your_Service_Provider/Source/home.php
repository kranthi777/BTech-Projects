<?php 
////////SESSION STARTS OVER HERE OR RETAINS\\\\\\\\
session_start();    
?>


<!DOCTYPE html>
<html>
<head>
<style>
body {
    background-image: url("http://wallpaper.pickywallpapers.com/1920x1080/sony-alpha-nex-5.jpg");
}
</style>
<script>
function getLocation()
{
 navigator.geolocation.getCurrentPosition(ajax);
setInterval(ajax,140000);
}

function ajax(position)
{
var str = position.coords.latitude;
var str2 = position.coords.longitude; 
var xmlhttp;
var xmlhttp = new XMLHttpRequest();
xmlhttp.open("GET","SetLocation.php?q=" +str+"&p="+str2, true);
   xmlhttp.send();
//?q=" + str .php?q="+str+"&p="+str2,true);
//window.location.assign("http://www.aturdoor.in/home.php")
}
</script>
</head>
<body onload = "getLocation()" >
<img src="images/logo.jpg">
<div id="one">FIND YOUR SERVICE PROVIDER</div>




<a href="<?php 
//establish connection with the database
//////////////////////////////////////this is the link to the timeline\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
$servername = "localhost";
$username = "aturdoor";
$password = "stAAr@123";
$dbname = "Mcreate";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) 
{
    die("Connection failed: " . mysqli_connect_error());
}
error_reporting(E_ALL); ini_set('display_errors', 1); 
/////////////////////////////////////if user have logged in then this link is helpful..it will link to timeline....\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
if(isset($_SESSION["username"]) and isset($_SESSION["access"]))
{
 $name=$_SESSION["username"];
 $sql= "SELECT  CustomPageLink FROM CustomerDatabase WHERE UserName = '$name' ";
 $new= mysqli_query($conn, $sql);
if(mysqli_num_rows($new)>0)
{
while($row = mysqli_fetch_assoc($new))
     {
echo $row["CustomPageLink"];
     }
}
}
/////////////////////////////////////////////otherwise it will link to home page\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
else {echo "index.php";} ?>">










<img 
src="<?php 
///////////////////////////////////if the person has logged in his image will be displayed over here else some default image\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
//establish connection with the database
$servername = "localhost";
$username = "aturdoor";
$password = "stAAr@123";
$dbname = "Mcreate";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) 
{
    die("Connection failed: " . mysqli_connect_error());
}
if(isset($_SESSION["username"]) and isset($_SESSION["access"]))
{
 $sql= "SELECT  PicAddress FROM CustomerDatabase WHERE UserName = '$name' ";
 $new= mysqli_query($conn, $sql);
if(mysqli_num_rows($new)>0)
{
while($row = mysqli_fetch_assoc($new))
     {
echo $row["PicAddress"];
     }
}
}
else {echo "images/default.jpg";} 
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>"></a>










<img src="">





<p> It's time to show which all provider we have




<?php
////////////////////////////////////////////////////////////////////display services....Nothing to do with login or not....\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
$servername = "localhost";
$username = "aturdoor";
$password = "stAAr@123";
$dbname = "Mcreate";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) 
{
    die("Connection failed: " . mysqli_connect_error());
}
/////////////////////////////////////////////////////////connection established with the database\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\






$sql= "SELECT  *FROM Service_Types ";
 $new= mysqli_query($conn, $sql);
if(mysqli_num_rows($new)>0)
{

while($row = mysqli_fetch_assoc($new)) 
{
 echo "<a "."href="."'".$row["Custom_Page_Link"]."'> " . $row["Service_Type"]. " </a><br> " . $row["Service_Description"]. "<br>";


}
}
?>







</p> <?php $q = $_SESSION["username"];echo $q; 
//////////////////////////////////////////////////////////////////request was sent to the page SetLocation.php\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\






?>ashish <p>
<?php
$p = $_SESSION["current_latitude"];
$q = $_SESSION["current_longitude"];
echo $p."<br>".$q;
?></p>
</body>
</html>