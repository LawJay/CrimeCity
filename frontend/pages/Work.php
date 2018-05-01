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





$query = "SELECT * FROM factories WHERE userid = '$userid';";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$result_select = mysqli_query($conn,$query) or die(mysqli_error());
while($row = mysqli_fetch_array($result_select)) {

    $BusinessName = $row['name'];

    $BusinessIncome = $row['income'];

    $BusinessPrice = $row['price'];

    $fullincome += $BusinessIncome;

}
//user check energy

$query = "SELECT * FROM users WHERE id = '$userid';";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
//USERDATA

$Energy            = $row['Energy'];
$Money            = $row['Money'];
$exp              = $row['exp'];


        if($Energy < 5){

            echo "Energy too low to work.";
        }
        else{
            $Money += $fullincome;
            $sql = "UPDATE users SET money = ' ". ($Money) ." '  WHERE id = '".$userid."'";
            mysqli_query($conn,$sql);

            $Energy -= 5;
            if($Energy < 0){
                $Energy = 0;
            }
            $sql = "UPDATE users SET Energy = ' ". ($Energy) ." '  WHERE id = '".$userid."'";
            mysqli_query($conn,$sql);

            $exp += 5;
            $sql = "UPDATE users SET exp = ' ". ($exp) ." '  WHERE id = '".$userid."'";
            mysqli_query($conn,$sql);
            $newURL = "http://localhost:8080/MMORTS/index.php?page=index";
            header('Location: '.$newURL);


        }











