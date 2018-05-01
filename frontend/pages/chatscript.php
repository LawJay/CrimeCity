<?php

include "ajax.php";

$query = "SELECT * FROM chat ORDER BY id ASC";
$result = mysqli_query($con, $query);
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
foreach($rows as $row) {
    echo '<span style="color: green">'  . $row['name'] . '</span>  ';
    echo '<span style="color: brown">'  . $row['message'] . '</span>  ';
    echo '<span style="float: right">'  . formatDate($row['date']) . '</span>  ';
    echo "<br>";
}
?>