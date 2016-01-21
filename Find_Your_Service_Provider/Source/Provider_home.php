<?php 
////////SESSION STARTS OVER HERE OR RETAINS\\\\\\\\
session_start();    
?>


<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="Pstyle.css">
<style>
body {
    background-image: url("http://wallpaper.pickywallpapers.com/1920x1080/dryness-tree.jpg");
}
</style>
<script>
function getLocation()
{
 navigator.geolocation.getCurrentPosition(ajax);
ajax2();
setInterval(ajax,10000);
setInterval(ajax2,10000);
}


function ajax(position)
{
var str = position.coords.latitude;
var str2 = position.coords.longitude; 
var xmlhttp;
var xmlhttp = new XMLHttpRequest();
xmlhttp.open("GET","Provider_Location.php?q=" +str+"&p="+str2, true);
   xmlhttp.send();
//?q=" + str .php?q="+str+"&p="+str2,true);
//window.location.assign("http://www.aturdoor.in/Provider_home.php")
}
function ajax2()
{
var xmlhttp;
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("orders").innerHTML = xmlhttp.responseText;
            }
        }
xmlhttp.open("GET","orders.php", true);
   xmlhttp.send();
}
</script>
</head>
<body onload = "getLocation()" >
<img src="images/logo.jpg">
<div id="one">FIND YOUR SERVICE PROVIDER</div>
<div id="orders"></div>
</body>
</html>




<?php
$name=$_SESSION["ProviderUsername"];
echo $name;
echo $_SESSION["current_latitude"]."***************************************************";
echo $_SESSION["current_longitude"]."<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>";
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
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
 error_reporting(E_ALL); ini_set('display_errors', 1); 

$name=$_SESSION["ProviderUsername"];
$sql1 ="SELECT SerialNo FROM ServiceProviderDatabase WHERE UserName = '$name' ";////---------------------------------checked--------------------------------
if (mysqli_query($conn, $sql1))
 {
}
 else 
{
    echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
}
$result1 = mysqli_query($conn, $sql1);
if (mysqli_num_rows($result1) > 0)
 {
    // output data of each row
    while($row1 = mysqli_fetch_assoc($result1) )
 {
$SerialNo =  $row1["SerialNo"];       
}
}
$Order_Id=$_POST["Order_Id"];
$sql2 ="SELECT Order_Assigned FROM Orders WHERE Order_Id = '$Order_Id'";
if (mysqli_query($conn, $sql2))
 {
}
 else 
{
    echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
}
$result2 = mysqli_query($conn, $sql2);
if (mysqli_num_rows($result2) > 0)
 {
    // output data of each row
    while($row2 = mysqli_fetch_assoc($result2) )
 {
$Assigned =  $row2["Order_Assigned"]; 
if($Assigned == NULL)
{
$sql3 ="UPDATE Orders SET Order_Assigned = '$SerialNo'   WHERE Order_Id = '$Order_Id' ";////////////need to put here provider id.................
if (mysqli_query($conn, $sql3))
 {
}
 else 
{
    echo "Error: " . $sql3 . "<br>" . mysqli_error($conn);
}
$result3 = mysqli_query($conn, $sql3);
}
else
{
echo "<script>alert(Order Already Assigned to the provider....better luck next time....);</script>";
}      
}
}
}
?>



