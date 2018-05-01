<?php
global $title;
global $seperator;
global $description;
global $logo;
global $totalincome;
?>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <title><?php echo $title.$seperator.$description; ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="frontend/design/css/bootstrap.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Laila" rel="stylesheet">
    <link href="frontend/design/css/stylesheet.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Sigmar+One" rel="stylesheet">
</head>

<body>
<div class="wrapper">
    <?php require_once("frontend/templates/header.php"); ?>
    <div class="layer">
        <div class="content">
            <h2>Profile</h2>

            <?php
            if(isset($_GET['msg']))
            {
                $msg = $_GET['msg'];

                if($msg == "loginsuccess")
                {
                    $msg = "You succesfully logged in, boss!";
                }

                if($msg == "registrationsuccess")
                {
                    $msg = "You succesfully registrated with the NSA, boss!";
                }

                if($msg == "logoutsuccess")
                {
                    $msg = "You succesfully logged out, boss!";
                }

                ?>
                <div class="alert alert-success" role="alert"><?php echo $msg; ?></div>
                <?php
            }
            if(isset($_SESSION['loggedin']))
            {
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

                $username = $_SESSION['loggedin'];

                $query = "SELECT * FROM users WHERE username = '$username'";
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









                //Level Image Assign
                //
                if ($Level == 1){
                    $pp = "level1";
                }
                elseif ($Level == 2){
                    $pp = "level2";
                }
                elseif ($Level == 3){
                    $pp = "level3";
                }
                elseif ($Level == 4){
                    $pp = "level4";
                }
                else{
                    $pp = "level1";
                }


                ?>
                <center>
                    <a href="index.php?page=index">Home</a>
                    <a href="index.php?page=contact"> - My Faction</a>
                    <h3><?php echo $username; ?></h3></center>
                <div class="village-wrapper">
                    <div class="resources">
                        <h4>Info</h4>
                        <?php
                        echo "Level: ".$Level."<br/>";
                        echo '<img src="frontend/images/heart.png" height="15px" width="15px" alt=\"icon\" /> '.$Health."<br/>";
                        echo '<img src="frontend/images/dollar.png" height="15px" width="15px" alt=\"icon\" /> '.$Money."<br/>";
                        echo '<img src="frontend/images/gun.png" height="15px" width="15px" alt=\"icon\" /> '.$Faction."<br/>";
                        ?>

                    </div>
                    <div class="village">
                        <a href="http://google.com"><img src="frontend/images/<?php echo $pp;?>" height="450px" width="450px"/></a>
                    </div>
                    <div class="armies">
                        <h4><?php echo $username?>'s Businesses</h4>
                        <?php
                        //Get all businesses where user = Factories.userid
                        $query = "SELECT * FROM factories WHERE userid = '$userid'";
                        $result = mysqli_query($conn, $query);
                        $row = mysqli_fetch_assoc($result);
                        $result_select = mysqli_query($conn,$query) or die(mysqli_error());
                        while($row = mysqli_fetch_array($result_select)) {
                            $BusinessName = $row['name'];
                            $BusinessIncome = $row['income'];
                            $BusinessPrice = $row['price'];

                            echo "<hr>";
                            echo " Name : " . $BusinessName;
                            echo "<br>";
                            echo " Income : " . $BusinessIncome;
                            echo "<br>";
                            echo " Price : " . $BusinessPrice;
                            echo "<br>";

                            $totalincome = $totalincome + $BusinessIncome;
                        }
                        ?>
                        <!-- echo  new business data -->
                        <h5>Unowned Businesses</h5>
                        <form>
                            <?php
                            //Get all businesses where user = Factories.userid
                            $query = "SELECT * FROM factories WHERE userid != '$userid'";
                            $result = mysqli_query($conn, $query);
                            $row = mysqli_fetch_assoc($result);
                            $result_select = mysqli_query($conn,$query) or die(mysqli_error());
                            while($row = mysqli_fetch_array($result_select)) {
                                $BusinessName = $row['name'];
                                $BusinessIncome = $row['income'];
                                $BusinessPrice = $row['price'];

                                echo "<hr>";
                                echo " Name : " . $BusinessName;
                                echo "<br>";
                                echo " Income : " . $BusinessIncome;
                                echo "<br>";
                                echo " Price : " . $BusinessPrice;
                                echo "<br>";
                                echo "<input type='submit' name='submit' value='Buy'>";
                                echo "<br>";


                            }
                            ?>


                        </form>




                    </div>
                </div>
                <?php
            }
            else{ /// If not logged in
                ///
                ///







            }
            ?>

        </div>
    </div>
    <?php require_once("frontend/templates/footer.php"); ?>
</div>
</body>
</html>