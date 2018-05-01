<?php
global $title;
global $seperator;
global $description;
global $logo;
?>
<html>
<head>
    <title><?php echo $title.$seperator.$description; ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="frontend/design/css/bootstrap.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href="frontend/design/css/stylesheet.css" rel="stylesheet" type="text/css">
    <script src ="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript">

        function update()
        {
            $.post("frontend/pages/server.php", {}, function(data){ $("#screen").val(data);});

            setTimeout('update()', 1000);
        }

        $(document).ready(

            function()
            {
                update();

                $("#button").click(
                    function()
                    {
                        $.post("frontend/pages/server.php",
                            { message: $("#message").val()},
                            function(data){
                                $("#screen").val(data);
                                $("#message").val("");
                            }
                        );
                    }
                );
            });


    </script>
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
                <a href="index.php?page=index">Portfolio  |</a>
                <a href="index.php?page=contact">  Faction  |</a>
                <a href="index.php?page=leaderboard">  Leaderboard</a>

                <br>
                <h3>Faction : <?php echo $Faction ?></h3></center>
            <div class="content-wrapper">
                <div class="stats">
                    <h4>Info</h4>
                    <?php
                    echo "Level: ".$Level."<br/>";
                    echo '<img src="frontend/images/heart.png" height="15px" width="15px" alt=\"icon\" /> '.$Health."<br/>";
                    echo '<img src="frontend/images/dollar.png" height="15px" width="15px" alt=\"icon\" /> '.$Money."<br/>";
                    echo '<img src="frontend/images/gun.png" height="15px" width="15px" alt=\"icon\" /> '.$Faction."<br/>";
                    echo '<img src="frontend/images/energy.png" height="15px" width="15px" alt=\"icon\" /> '.$Energy."<br/>";
                    if($Energy >=5){
                        ?>
                        <form action="frontend/pages/Work.php" method="post">
                            <input type="submit" value="Work">
                        </form>
                        <?php
                    }
                    else {
                    }
                    ?>
                    <?php
                    if ($Energy <= 90 AND $Money >= 5){
                    ?>
                    <form action="frontend/pages/Heal.php" method="post">
                        <input type="submit" value="Drink Coffee ($5)">
                        <?php
                        }
                        else{

                        }
                        ?>





                </div>

                <?php
                //Get Faction Data
                $sql = "SELECT id FROM users WHERE username = '$username'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);



                ?>
            </div>
            <div class="avatar">
                <?php
                $query = "SELECT * FROM `users` ORDER by `Money` DESC LIMIT 10";
                $result = mysqli_query($conn,$query) or die('Query failed: ' . mysqli_error($conn));

                $num_results = mysqli_num_rows($result);
echo "<br>";
                echo '<div class="container marketing">
        <div class="">
          <table  class="gradienttable" border="1">
  <tr>
    <th>Position</th>
    <th>UserName</th>  
    <th>Level</th>    
    <th>Money($)</th>

  </tr>';

                for($i = 1; $i <= $num_results; $i++)
                {
                    $row = mysqli_fetch_array($result);

                    echo "<tr>
    <td>".$i."</td>
    <td>".$row['username']."</td>       
    <td>".$row['Level']."</td>
    <td>".$row['Money']."</td>

  </tr>";
                }

                echo "</table>
        </div>
            </div>";

                ?>
            </div>
            <div class="sidebar" style="overflow: scroll">
                <h5><a href="frontend/pages/Chat.php">Go to Chat Room</a></h5>

                <h2>Fight</h2>
                <form action="frontend/pages/fight.php" method="post">
                    <?php
                    $userid = $_COOKIE['userid'];
                    $query = "SELECT * FROM users WHERE id != '$userid'";
                    $result = mysqli_query($conn, $query);
                    $row = mysqli_fetch_assoc($result);
                    $result_select = mysqli_query($conn,$query) or die(mysqli_error());
                    while($row = mysqli_fetch_array($result_select)) {
                        //USERDATA
                        $otheruserid            = $row['id'];
                        $otherusername          = $row['username'];
                        $otherLevel             = $row['Level'];
                        $otherHealth            = $row['Health'];
                        $otherMoney             = $row['Money'];
                        $otherEnergy            = $row['Energy'];
                        $otherFaction           = $row['Faction'];
                        $otherexp               = $row['exp'];


                        echo "<hr>";
                        echo " Name : " . $otherusername;
                        echo "<br>";
                        echo " Level : " . $otherLevel;
                        echo "<br>";
                        echo " Faction : " . $otherFaction;
                        echo "<br>";
                        echo "<input type='hidden' name='othername'  value='$otherusername'>";
                        echo "<input type='hidden' name='userid'  value='$userid'>";
                        echo "<input type='hidden' name='otherlevel'  value='$otherLevel'>";
                        echo "<input type='hidden' name='otherexp'  value='$otherexp'>";
                        echo "<input type='hidden' name='otherhealth'  value='$otherHealth'>";
                        echo "<input type='hidden' name='othermoney'  value='$otherMoney'>";
                        echo "<input type='hidden' name='otherid'  value='$otheruserid'>";
                        echo "<input type='submit' name='submit' onclick='' value='Fight'>";
                    }
                    ?>
                </form>
            </div>

        </div>

    </div>

<?php
}
?>
    <a href="index.php?page=index">Profile</a>
    <a href="index.php?page=contact">Faction</a>
</div>
</div>
<?php require_once("frontend/templates/footer.php"); ?>
</div>
</body>
</html>