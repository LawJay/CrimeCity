<?php
global $userid;
global $BusinessIncome;
global $Energy;
global $fullincome;
$userid = $_COOKIE['userid'];


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
//user check energy

$query = "SELECT * FROM users WHERE id = '$userid';";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
//USERDATA

$Energy            = $row['Energy'];
$Money            = $row['Money'];

    $Money -= 5;
    $sql = "UPDATE users SET money = ' ". ($Money) ." '  WHERE id = '".$userid."'";
    mysqli_query($conn,$sql);
    $Energy += 50;
    if($Energy > 100){
        $Energy = 100;
    }
    $sql = "UPDATE users SET Energy = ' ". ($Energy) ." '  WHERE id = '".$userid."'";
    mysqli_query($conn,$sql);
    $newURL = "http://localhost:8080/MMORTS/index.php?page=index";
    header('Location: '.$newURL);














