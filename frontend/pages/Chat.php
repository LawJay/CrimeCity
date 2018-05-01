<?php
include 'ajax.php';
?>
<html>
<head>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="frontend/design/css/bootstrap.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href="../../frontend/design/css/stylesheet.css" rel="stylesheet" type="text/css">
    <link href="../../frontend/design/css/chat.css" rel="stylesheet" type="text/css">
    <script src ="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <title>Crime City Global Chat</title>
    <script>
        function ajax(){
        var req = new XMLHttpRequest();
        req.onreadystatechange = function(){
            if (req.readyState == 4 && req.status == 200){
            document.getElementById('chat').innerHTML = req.responseText;
            }
        }
            req.open('GET','chatscript.php',true);
            req.send();
        }
        setInterval(function () {
            ajax()
        },1000)
    </script>


</head>
<body onload="ajax();">

<div class="wrapper">
    <h1>Crime City Global Chat</h1>
    <div id="container">
        <div id="chat_box">
        <div id="chat">


        </div>

        </div>
    </div>
    <form method="post" action="Chat.php">
        <center>
        <input type="text" name="name" placeholder="Enter Name"style="width: 100px"> <br>
        <textarea style="width: 200px" name="message" placeholder="Enter Message"></textarea> <br>
        <input type="submit" name="submit" value="Send it">
        </center>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $message = $_POST['message'];
        $query = "INSERT INTO chat (name,message) VALUES ('$name','$message') ";
        if (mysqli_query($con, $query)) {

        }
    }
    ?>
</div>


</body>
</html>