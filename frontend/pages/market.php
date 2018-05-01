<?php
//DATABASE CONNECTION
$dbserver 		= "localhost";
$dbusername 	= "root";
$dbpassword 	= "";
$db 			= "mmorts";

//CREATE CONNECTION
$conn = new mysqli($dbserver, $dbusername, $dbpassword, $db);

//CHECK CONNECTION
if ($conn->connect_error)
{
    die("Connection failed: ".$conn->connect_error);
}


$businessid = $_POST['id'];
$name = $_POST['business'];
$income = $_POST['income'];
$price = $_POST['price'];
$userid = $_POST['userid'];


$query = "SELECT * FROM users WHERE id = '$userid';";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
//USERDATA

$Energy            = $row['Energy'];
$Money            = $row['Money'];
$exp              = $row['exp'];
$newMoney = $Money -= $price;
$sql = "UPDATE factories SET userid = ' ". ($userid) ." '  WHERE id = '".$businessid."'";
mysqli_query($conn,$sql);
$sql = "UPDATE users SET Money = ' ". ($newMoney) ." '  WHERE id = '".$userid."'";
mysqli_query($conn,$sql);

$newURL = "http://localhost:8080/MMORTS/index.php?page=index";
header('Location: '.$newURL);