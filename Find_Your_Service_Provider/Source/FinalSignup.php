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
error_reporting(E_ALL); ini_set('display_errors', 1); 
$nameErr = $emailErr = $mobileErr = $pwdErr = "";
$name = $email = $pwd = $mobile = "";
function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;}

   if (empty($_POST["name"])) {
     $nameErr = "Name is required";
   } else {
    $name = test_input($_POST["name"]);
if (!preg_match("/^[a-zA-Z ]*$/",$name)) 
{
unset($name);
  $nameErr = "Only letters and white space allowed"; 
}
   }
   
   if (empty($_POST["email"])) {
     $emailErr = "Email is required";
   } else {
     $email = test_input($_POST["email"]);
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
unset($email);
  $emailErr = "Invalid email "; 
}
   }
     
   if (empty($_POST["pwd"])) {
     $pwdErr = "Password is required";
   } else {
     $pwd = test_input($_POST["pwd"]);
   }

      if (empty($_POST["mobile"])) {
     $mobileErr = "Mobile is required";
   } else {
     $mobile = test_input($_POST["mobile"]);
if (!preg_match("/^[0-9]*$/",$mobile)) {
unset($mobile);
  $mobileErr= "Enter a valid mobile number"; 
   }
}









// checking if the username already exist 
$check= "SELECT *FROM CustomerDatabase WHERE UserName = '$name' ";
$count= mysqli_query($conn, $check);
 

    if(isset($check) )
   {
       echo "i am set";
   }
else
{
echo "i m not set";}
if(mysqli_num_rows($count)>0)
{
echo "checking it is working or not"; 
unset($name);
$nameErr="Username already exist please try other";
}



















echo $name."</br>";
echo $pwd."</br>";
echo $email."</br>";
echo $mobile."</br>";
$ashish="index.php";
///NOW I WILL SEE WETHER ALL VALUES ARE SET OR NOT IF ALL SET THEN I WILL INSERT THEM IN THE DATABASE...
///I WILL ALSO CREATE A CUSTOM PAGE HERE ITSELF....AND I WILL REDIRECT THE USER TO THE SAME PAGE...
if(isset($name,$pwd,$email,$mobile))
{
$_SESSION["username"] = $name;
$_SESSION["access"] = "yes";
//create custom page........
$arr = array('custompage/',$name,'.php');
$custom = join("",$arr);  //this is the link....                                

//after this i will open a customized page...

$file = fopen($custom,"w+") or die("$php_errormsg");
$asp = file_get_contents("newuser.txt");
fwrite($file, $asp);
fclose($file);

//entering detail in the database.....
$sql = "INSERT INTO CustomerDatabase (UserName,PassWord,Mobile,email,PicAddress,CustomPageLink)
VALUES ('$name','$pwd','$mobile','$email','images/default.jpg','$custom')";
if (mysqli_query($conn, $sql)) {
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
//////////////////////now i will insert username in the customer location table.....
$checking= "INSERT INTO CustomerLocation (UserName) VALUES ('$name')";
if (mysqli_query($conn, $checking)) {
} else {
    echo "Error: " . $checking . "<br>" . mysqli_error($conn);
}
//now take him to homepage.....
//$_SESSION["username"] = $name;
//$_SESSION["access"] = "yes";
//Sending a welcome mail....
$to = $email;
$subject = "Find Your Service Provider Welcomes You";
$txt = file_get_contents("newuser.txt");
$headers = "From: kranthi.k13@iiits.in" . "\r\n" .
"CC: ashish.v13@iiits.in";
mail($to,$subject,$txt,$headers);
//redirecting to home page....
echo "<script> window.location.assign('home.php'); </script>";  
}
}
?>






<!DOCTYPE html>
<html>
<head>
<style>
body {
    background-image: url("http://wallpaper.pickywallpapers.com/1920x1080/snow-falling-on-the-laughing-guy.jpg");
}
#one
{
margin-left:32%;
margin-top:2%;
background:#000000;
width:35%;
height:40%;
opacity:0.5;
color:white;
padding-bottom:6%;
padding-top:6%;
text-align: center;
letter-spacing: 3px;
font-weight:bold;
font-size:25px;
}
</style>
<script>
function validateForm() 
{
var x = document.forms["SignUpForm"]["name"].value;
var y = document.forms["SignUpForm"]["pwd"].value;
var z = document.forms["SignUpForm"]["email"].value;
var w = document.forms["SignUpForm"]["mobile"].value;
    if (x == null || x == "") {
        alert("UserName must be filled out");
        return false;
    }
if (x.length < 6)
 {
        alert("UserName must be atleast 6 charcters.");
        return false;
 }
if (y == null || y == "") {
        alert("Password must be filled out");
        return false;
    }
if (y.length <6) {
        alert("Password must be atleast 6 characters");
        return false;
    }
if (z == null || z == "") {
        alert("Email must be filled out");
        return false;
    }
if (w == null || w == "") {
        alert("Mobile No must be filled out");
        return false;
    }


}
</script>
</head>
<body>

<form id="one" name="SignUpForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"
onsubmit="return validateForm()" method="post">
UserName: <input id="username" type="text" name="name"><br>
<span class="error">* <?php echo $nameErr;?></span>
   <br><br>
PassWord: <input id="password" type="password" name="pwd"><br>
<span class="error">* <?php echo $pwdErr;?></span>
   <br><br>
EmailId: <input id="email" type="text" name="email"><br>
<span class="error">* <?php echo $emailErr;?></span>
   <br><br>
Mobile No: <input id="mobile" type="text" name="mobile"><br>
<span class="error">* <?php echo $mobileErr;?></span>
   <br><br>
<input type="submit" value="Submit">
</form>

</body>
</html>