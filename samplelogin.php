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
$namecheckquery = "SELECT username, salt, hash, score FROM sample WHERE username = '" . $username . "';";
$namecheck = mysqli_query($con,$namecheckquery) or die ("2: name check query failed");
if(mysqli_num_rows($namecheck)!=1)
{
    echo "3: such user doesn't exists or more than one user";
    exit();
}
$existinginfo = mysqli_fetch_assoc($namecheck);
$salt = $existinginfo["salt"];
$hash = $existinginfo["hash"];

$logihash = crypt($password , $salt);
if($hash != $logihash)
{
    echo "4: Incorrect password";
    exit();
}
echo "0\t" . $existinginfo["score"];

?>