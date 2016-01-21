<?php
//echo "734892018485789232087437563993243485486435534584548554959456567879789998998909809809809808908908909808545533423244567865632323243554667978976432321313";
////////SESSION STARTS OVER HERE OR RETAINS\\\\\\\\
session_start();  
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
//error_reporting(E_ALL); ini_set('display_errors', 1); 
$provider=$_SESSION["ProviderUsername"];
/////////////////////////////////////////////select provider type\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
$sql1 ="SELECT ServiceType FROM ServiceProviderDatabase WHERE UserName = '$provider' ";
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
$ServiceType =  $row1["ServiceType"];       
}
}
//////////////////////////////////////////////we got provider type\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ ---------------------------------------------------checked--------------------------------------
//\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\now we need provider id/////////////////////////////////////////
 $sql2 ="SELECT Service_Id FROM Service_Types WHERE Service_Type = '$ServiceType' ";
if (mysqli_query($conn, $sql2))
 {
}
 else 
{
    echo "Error: " . $sql2. "<br>" . mysqli_error($conn);
}
$result2 = mysqli_query($conn, $sql2);
if (mysqli_num_rows($result2) > 0)
 {
    // output data of each row
    while($row2 = mysqli_fetch_assoc($result2) )
 {
$Service_Id = $row2["Service_Id"];       
}
}
////////////////////////////////////now we have service id of the service, which provider can provide\\\\\\\\\\\\\\\\\\\\\
////////////////////////////////////now we need to take the current longitude and latitude of the provider\\\\\\\\\\\\\\\\\
 $sql3 ="SELECT Latitude,Longitude FROM Provider_Location WHERE User_Name = '$provider' ";
if (mysqli_query($conn, $sql3))
 {
}
 else 
{
    echo "Error: " . $sql3. "<br>" . mysqli_error($conn);
}
$result3 = mysqli_query($conn, $sql3);
if (mysqli_num_rows($result3) > 0)
 {
    // output data of each row
    while($row3 = mysqli_fetch_assoc($result3) )
 {
$Latitude =  $row3["Latitude"]; 
$Longitude =  $row3["Longitude"]; 
$req_Latitude = $Latitude;
$req_Longitude = $Longitude;    
}
}
/////////////////////////////////now i have location of the provider\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\------------------------------------------------------checked--------------------------------------
/////////////////////////Based on this location we are going to find out orders\\\\\\\\\\\\\\\\\\\\\\\\
//$Service_Id=0;
$sql4 ="SELECT Customer_Id, Order_Id FROM Orders WHERE Order_Assigned IS NULL and Service_Id = '$Service_Id' ";
if (mysqli_query($conn, $sql4))
 {
}


 else 
{
    echo "Error: " . $sql4. "<br>" . mysqli_error($conn);
}
$result4 = mysqli_query($conn, $sql4);
if (mysqli_num_rows($result4) > 0)
 {
    // output data of each row
    while($row4 = mysqli_fetch_assoc($result4) )
 {
$CustomerId = $row4["Customer_Id"];
$OrderId = $row4["Order_Id"];
///////////////////////////////////////////////////////////////////now fetch customer user name and with that username find out user location\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
$sql5 ="SELECT UserName FROM CustomerDatabase WHERE SerialNo = '$CustomerId' ";
if (mysqli_query($conn, $sql5))
 {
 
}
 else 
{
    echo "Error: " . $sql5. "<br>" . mysqli_error($conn);
}
$result5 = mysqli_query($conn, $sql5);
if (mysqli_num_rows($result5) > 0)
 {
    // output data of each row
    while($row5 = mysqli_fetch_assoc($result5) )
 {$CustomerName = $row5["UserName"];}}/////////////////////////////////////SQL5 CLOSED HERE................................................
/////////////////////////////////////////////////for every customer username fetch his location..................
$sql6 ="SELECT Latitude,Longitude FROM CustomerLocation WHERE UserName = '$CustomerName' ";////////////////SQL6 IS INSIDE SQL4 
if (mysqli_query($conn, $sql6))
 {
}
 else 
{
    echo "Error: " . $sql6. "<br>" . mysqli_error($conn);
}
$result6 = mysqli_query($conn, $sql6);
if (mysqli_num_rows($result6) > 0)
 {
    // output data of each row
    while($row6 = mysqli_fetch_assoc($result6) )
 {
$CustomerLatitude =  $row6["Latitude"]; 
$CustomerLongitude =  $row6["Longitude"]; 
$diffLatitude = $CustomerLatitude-$req_Latitude;
$diffLongitude = $CustomerLongitude-$req_Longitude;
$absdiffLatitude=abs($diffLatitude);
$absdiffLongitude=abs($diffLongitude);
}
}//////SQL 6 CLOSES HERE***********************************************************************
/////////////////////////////////////////////////////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
///NOW THAT  WE HAVE LOCATION OF EVERY CUSTOMER WHO ORDERED THIS TYPE OF SERVICE WE WILL SEE IF OUR PROVIDER CAN PROVIDE SERVICE TO THE USER...
//\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\//////////////////////////////////////////////////////////////////////////////
if($absdiffLatitude <= 0.2 and $absdiffLongitude <=0.2)
{
$Distance = ($absdiffLatitude+$absdiffLongitude)*11;
echo "YOU HAVE A CUSTOMER AT ".$Distance."Km (approx) FROM THIS PLACE</br>";
//echo '<form><input type="submit"  name="Submit"  value=" ';
//$_SESSION["Order_Id"]= $OrderId;
//echo ' "> </form><br> ';
$link="Provider_home.php";
echo '<form method="post" class="form" action="';
echo $link;
echo ' "><br>';
echo '<input type="text"  name="Order_Id"  value="';
echo $OrderId;
echo '" readonly>';
echo '<input type="submit"  name="Submit"  value="GO FOR IT"> ';
echo '</form>';
}
}
}


?>
