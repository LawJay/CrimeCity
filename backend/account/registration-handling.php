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

	//ASSIGN VARIABLES FROM FORM
	$username = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	
	//ENCRYPT PASSWORD
	//$password = md5($password);
	
	$password = password_hash($password, PASSWORD_BCRYPT);
	
	//CHECK IF VALUES ARE OKAY
	
	//CHECK IF USER IS UNIQUE
	$sql = "SELECT username FROM users WHERE username = '$username'";
	if($result=mysqli_query($conn,$sql))
	{
		$rowcount = mysqli_num_rows($result);
	}
	
	if($rowcount >= 1)
	{
		echo "There is already an user with this username.";
	}
	else {
        //INSERT DATA INTO DATABASE
        $sql = "INSERT INTO users (username, password, email)
		VALUES ('$username', '$password', '$email')";

        //EXECUTE QUERY
        mysqli_query($conn, $sql);

        //echo "Username : ".$username;
        //create new business
        $sql = "SELECT id FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
        $income = 3;
        $price = 50;
        $name = "Mugging Gang";
        //echo "ID : ".$id;
        //echo "<br>";
        //echo "income : ".$income;
        //echo "<br>";
        //echo "price : ".$price;
        //echo "<br>";
        //echo "name : ".$name;
        //echo "<br>";
        $sql = "INSERT INTO factories (userid, income, price) VALUES ('$id', '$income', '$price')";
        if (mysqli_query($conn, $sql)) {

        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        //-------------------------Factories
        $sql = "INSERT INTO factories (userid, income, price, name) VALUES ('0', '20', '200', 'Drug Farm')";
        if (mysqli_query($conn, $sql)) {

        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        $sql = "INSERT INTO factories (userid, income, price, name) VALUES ('0', '30', '300', 'Hitman')";
        if (mysqli_query($conn, $sql)) {

        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        $sql = "INSERT INTO factories (userid, income, price, name) VALUES ('0', '40', '400', 'Corrupt Bank')";
        if (mysqli_query($conn, $sql)) {

        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        $sql = "INSERT INTO factories (userid, income, price, name) VALUES ('0', '50', '500', 'Biker Gang')";
        if (mysqli_query($conn, $sql)) {

        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        $sql = "INSERT INTO factories (userid, income, price, name) VALUES ('0', '60', '600', 'Drug Factory')";
        if (mysqli_query($conn, $sql)) {

        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        $sql = "INSERT INTO factories (userid, income, price, name) VALUES ('0', '500', '2000', 'Weapons Factory')";
        if (mysqli_query($conn, $sql)) {

        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

       // echo "Username : ".$username;
       header("Location: ../../index.php?msg=registrationsuccess");

    }



?>