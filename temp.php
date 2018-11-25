<?php

# Setup Mysql Connection
$servername = "127.0.0.1";
$username = "temperature";
$password = rtrim(file_get_contents('/var/www/html/temperature/mysql.pw', false));
$db_name = "temperature";

# Connect to MySQL
$db = mysqli_connect("$servername", "$username", "$password", "$db_name");

if($json = json_decode(file_get_contents("php://input"), true)) {
     print_r($json);
     $data = $json;
 } else {
     print_r($_POST);
     $data = $_POST;
 }

$temp = $data["temperature"];
$hum = $data["humidity"];
$ip = $data["ip"];

$sql = "INSERT INTO temperature (temperature, humidity, ip) VALUES ('$temp','$hum','$ip')";

if ($db->query($sql) === TRUE) {
            echo "New record created successfully";
} else {
            echo "Error: " . $sql . "<br>" . $db->error;
}

# Close out the DB connection
$db->close();
?>
