<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/23/2018
 * Time: 9:35 AM
 */

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


$userid = $_COOKIE['userid'];

$query = "SELECT * FROM users WHERE id = '$userid'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

//USERDATA
$userid            = $row['id'];
$username          = $row['username'];
$Level             = $row['Level'];
$Health            = $row['Health'];
$Money             = $row['Money'];
$Energy            = $row['Energy'];
$Faction           = $row['Faction'];

//ASSIGN VARIABLES FROM FORM
$message = $_POST['message'];


//INSERT DATA INTO DATABASE
$sql = "INSERT INTO chat (poster,Text) VALUES ('$username', '$message')";

//EXECUTE QUERY
mysqli_query($conn, $sql);
header("Location: http://localhost:8080/MMORTS/frontend/pages/Chat.php");
//http://localhost:8080/MMORTS/frontend/pages/Chat.php

