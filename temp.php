<?php

# Setup Mysql Connection
$servername = "localhost";
$username = "temperature";
$password = file_get_contents('/home/tory/Workspace/temperature/mysql.pw', false);

# Connect to MySQL
$db = mysql_connect('$servername', '$username', '$password');
if (!$db) {
	die('Could not connect: ' . mysql_error());
}

if($json = json_decode(file_get_contents("php://input"), true)) {
     print_r($json);
     $data = $json;
 } else {
     print_r($_POST);
     $data = $_POST;
 }

 echo "Saving data ...\n";
 $url = "http://localhost:5984/incoming";

 $meta = &#91;"received" => time(),
     "status" => "new",
     "agent" => $_SERVER['HTTP_USER_AGENT']];
 $options = ["http" => [
     "method" => "POST",
     "header" => ["Content-Type: application/json"],
     "content" => json_encode(["data" => $data, "meta" => $meta])]
     ];

 $context = stream_context_create($options);
 $response = file_get_contents($url, false, $context);

# Close out the DB connection
mysql_close($db);

?>
