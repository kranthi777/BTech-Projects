<?php 
////////SESSION STARTS OVER HERE OR RETAINS\\\\\\\\
session_start();    
?>




<?php
//after form is submitted we will come to this section....
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

// Now we should again verify the data....
//This verification is for those who have disabled javascript in their browser...
//Here we check and validate data...


$nameErr = $pwdErr = "";
$name = $pwd = "";
function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;}

   if (empty($_POST["name"])) {
     $nameErr = "Name is required";
   } else {
    $name = test_input($_POST["name"]);}
   
   
     
   if (empty($_POST["pwd"])) {
     $pwdErr = "Password is required";
   } else {
     $pwd = test_input($_POST["pwd"]);
   }

      
// checking if the username already exist 
$check= "select *from CustomerDatabase where UserName=$name and password=$pwd";
$count= mysqli_query($conn, $check);
if(mysqli_num_rows($count)>0)
{
unset($name);
unset($pwd);
$nameErr="Username or Password incorrect";
}
echo $name."</br>";
echo $pwd."</br>";

//setting access for the session....
if(isset($name,$pwd))
{

//entering detail in the database.....


//now take him to homepage.....
$_SESSION["username"]=$name;
$_SESSION["access"]="yes";

echo "<script> window.location.assign('index.php'); </script>";  
}
}
?>






<!DOCTYPE html>
<html>
<head>
<script>
function validateForm() 
{
var x = document.forms["SignUpForm"]["name"].value;
var y = document.forms["SignUpForm"]["pwd"].value;

    if (x == null || x == "") {
        alert("UserName must be filled out");
        return false;
    }

if (y == null || y == "") {
        alert("Password must be filled out");
        return false;
    }


}
</script>
</head>
<body>

<form name="SignUpForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"
onsubmit="return validateForm()" method="post">
UserName: <input id="username" type="text" name="name"><br>
<span class="error">* <?php echo $nameErr;?></span>
   <br><br>
PassWord: <input id="password" type="password" name="pwd"><br>
<span class="error">* <?php echo $pwdErr;?></span>
   <br><br>

<input type="submit" value="Submit">
</form>

</body>
</html>
