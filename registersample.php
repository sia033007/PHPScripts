<?php
//establish connection
$con = mysqli_connect('localhost','root','','unitysample');

//check for error
if(mysqli_connect_errno())
{
    echo "1: Connection failed";
    exit();
}
$username = $_POST["name"];
$password = $_POST["password"];

//check name
$namecheckquery = "SELECT username FROM sample WHERE username = '" . $username . "';";
$namecheck = mysqli_query($con,$namecheckquery) or die ("2: name check query failed");
if(mysqli_num_rows($namecheck)>0)
{
    echo "3: name already exist";
    exit();
}
$salt = "\$5\$rounds=5000\$" . "steamedhams" . $username . "\$";
$hash = crypt($password,$salt);
//insert data to database
$insertdataquery = "INSERT INTO sample (username, salt, hash) VALUES ('" . $username . "' , '" . $salt . "', '" . $hash . "');";
mysqli_query($con , $insertdataquery) or die ("4: Insert query failed");
echo "5: User Created Successfully!";


?>