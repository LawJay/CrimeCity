<?php
$host = "localhost";
$user = "root";
$pass = "";
$db_name = "mmorts";

$con = new mysqli($host,$user,$pass,$db_name);
if ($con->connect_error)
{
    die("Connection failed: ".$con->connect_error);
}

function formatDate($date){
    return date('g:i a', strtotime($date));
}

                ?>