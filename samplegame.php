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
$newscore = $_POST["score"];

//check name
$namecheckquery = "SELECT username FROM sample WHERE username = '" . $username . "';";
$namecheck = mysqli_query($con,$namecheckquery) or die ("2: name check query failed");
if(mysqli_num_rows($namecheck)!=1)
{
    echo "3: such user doesn't exists or more than one user";
    exit();
}
$updatequery = "UPDATE sample SET score = " . $newscore . " WHERE username = '" . $username . "';";
mysqli_query($con,$updatequery) or die ("Save query failed");
echo "0";

?>