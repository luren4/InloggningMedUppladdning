<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    




<?php
$sql = "SELECT * FROM loginbase";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "loginuppgift5";
$conn = new mysqli($servername, $username, $password, $dbname);

$result = $conn->query($sql);



$login_success = false;
$full_name = "";
if ($result->num_rows > 0) 
    {
        while($row = $result->fetch_assoc()) 
        {
            if($row["username"] == $_POST["username"] && $row["password"] == $_POST["password"]) 
            {
                $login_success = true;
                echo "login success.   ";
                $full_name = $row["firstname"] . " " . $row["lastname"];

                echo $full_name;

                session_start();
            	$_SESSION["username"] = $_POST["username"];

                
            } 
            else
            {
                echo "You couldnt log in";
            }
        }
    }

else 
    {
        echo "There are no users on this webpage";
    }


?>

<?php
     
     if(isset($_POST['button1'])) {
        session_start(); 
        session_destroy(); 

    }
 ?>


    <form method="post">
        <input type="submit" name="button1" value="Button1"/>

    </form>





</body>
</html>