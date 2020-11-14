<?php
$con = mysqli_connect('localhost','root','','unityaccess');

//check that connection happened
if(mysqli_connect_errno())
{
    echo "1: Connection failed"; //error code #1 = connection failed
    exit();
}
$username = $_POST["name"];
$password = $_POST["password"];

//check if name exists
$namecheckquery = "SELECT username FROM players WHERE username = '" . $username . "';";
$namecheck = mysqli_query($con,$namecheckquery) or die ("2: Name check querry failed"); //error code #2 = name check querry failed
if(mysqli_num_rows($namecheck)>0)
{
    echo "3: name already exists"; //name exists, can't register
    exit();
}
//add user to the table
$salt = "\$5\$rounds=5000\$" . "steamedhams" . $username . "\$";
$hash = crypt($password,$salt);
//put information into database
$insertuserquery = "INSERT INTO players (username, hash, salt) VALUES('" . $username . "', '" . $hash . "', '" . $salt . "');";
mysqli_query ($con,$insertuserquery) or die("4: Insert player query failed"); //error code #4 = insert query failed

echo("0: User created successfully!");


?>