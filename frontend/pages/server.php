<?php
//DATABASE CONNECTION
$dbserver 		= "localhost";
$dbusername 	= "root";
$dbpassword 	= "";
$db 			= "mmorts";
$username = "Jambo";

//CREATE CONNECTION
$conn = new mysqli($dbserver, $dbusername, $dbpassword, $db);

//CHECK CONNECTION
if ($conn->connect_error)
{
    die("Connection failed: ".$conn->connect_error);
}
$dbname = 'chat';
mysql_select_db($dbname);

$message = $_POST['message'];

if($message != "")
{
    $sql = "INSERT INTO `chat` VALUES('','$message')";
    mysql_query($sql);
}

$sql = "SELECT `Text` FROM `chat` ORDER BY `Id` DESC";
$result = mysql_query($sql);

while($row = mysql_fetch_array($result))
    echo $username . " says : ".$row['Text']."\n";




?>