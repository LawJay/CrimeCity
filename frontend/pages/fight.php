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



$othername = $_POST['othername'];
$otherlevel = $_POST['otherlevel'];
$otherhealth = $_POST['otherhealth'];
$userid = $_COOKIE['userid'];
$otherexp = $_POST['otherexp'];
$otherid = $_POST['otherid'];
$othermoney = $_POST['othermoney'];
$halfcut = $othermoney / 2;
echo "<br>";

$query = "SELECT * FROM users WHERE id = '$userid';";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
//USERDATA
$name = $row['username'];
$Energy            = $row['Energy'];
$Money            = $row['Money'];
$exp              = $row['exp'];
$newmoney = $Money + $halfcut;
$health = $row['Health'];
$dead = 0;
$cutmoney = $othermoney - $halfcut;
echo $name . "Vs" . $othername;
echo "<br>";
if ($exp > $otherexp)
{
    $sql = "UPDATE users SET Health = ' ". ($dead) ." '  WHERE id = '".$otherid."'";
    mysqli_query($conn,$sql);
    $sql = "UPDATE users SET Money = ' ". ($cutmoney) ." '  WHERE id = '".$otherid."'";
    mysqli_query($conn,$sql);
    $sql = "UPDATE users SET Money = ' ". ($newmoney) ." '  WHERE id = '".$userid."'";
    mysqli_query($conn,$sql);
    echo "You have killed " .$othername;
    echo "You Stole $" . $halfcut;
}
elseif ($otherexp > $exp){
    $sql = "UPDATE users SET Health = ' ". ($dead) ." '  WHERE id = '".$userid."'";
    mysqli_query($conn,$sql);
    echo $othername." has killed you!";
}


$newURL = "http://localhost:8080/MMORTS/index.php?page=index";
//header('Location: '.$newURL);