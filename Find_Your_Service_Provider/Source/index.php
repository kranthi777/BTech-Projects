<?php
// Start the session
// create a customer table... 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<style>
 body {
    background-image: url("background.jpg");
background-repeat: no-repeat;
    background-attachment: fixed;
background-position: center;
}

</style>
</head>
<body>
<p>
<?php
if(isset($_SESSION["lastid"]))
{$result .= $_SESSION["lastid"] . 'people';}
else
{
//////////////////////////////////////////////////////////////////////////IN THIS PART CONNECTION WITH DATABASE IS ESTABLISHED.....
$servername = "localhost";
$username = "aturdoor";
$password = "stAAr@123";
$dbname = "Mcreate";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
/////////////////////////////////////////////////////////////////////
$sql = "INSERT INTO Visitorno ()
VALUES ()";
//IN THIS PART UNIQUE CUSTOMER ID IS CREATED..... 

if (mysqli_query($conn, $sql)) {
   $_SESSION["lastid"] = mysqli_insert_id($conn);
   // echo "New record created successfully. Last inserted ID is: " . $_SESSION["lastid"];
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
/////////////////////////////////////////////////////////////////////////////
$result .= $_SESSION["lastid"] . 'people';
echo $result;
$_SESSION["totalproduct"]=0;
$_SESSION["currenttotal"]=0;
//////////////////////////////////////////////////////////////////////
//FROM THIS PART A SEPARATE TABLE WILL BE CREATED FOR EVERY CUSTOMER.....
$sql = "CREATE TABLE $result (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
ProductName VARCHAR(30),
ProductQuantity INT(6),
ProductConformation INT(6),
reg_date TIMESTAMP
)";
/////////////////////////////////////////////////////////////

if (mysqli_query($conn, $sql)) {
   // echo "Table MyGuests created successfully" . $result;
} else {
    echo "Error creating table: " . mysqli_error($conn);
}
///////////////////////////////////////////////////////////////
}
 
?> 
</p>
<a href="AddToCart.php">Buy sunsilk now....</a> 
<a href="Test.php">Visit our TEST PAGE....</a>
<a href="cart.php">Visit our CART PAGE....</a>
<a href="Maggi.php">Buy Maggi now....</a>

</body>
</html>
