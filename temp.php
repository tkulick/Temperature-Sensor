# Setup Mysql Connection
$servername = "127.0.0.1";
$username = "temperature";
$password = rtrim(file_get_contents('/var/www/html/temperature/mysql.pw', false));
$db_name = "temperature";

# Connect to MySQL
$db = mysqli_connect("$servername", "$username", "$password", "$db_name");

if (!$db) {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit;
}

if($json = json_decode(file_get_contents("php://input"), true)) {
     #print_r($json);
     $data = $json;
 } else {
     #print_r($_POST);
     $data = $_POST;
 }

# Setup query for Dark Sky
$secret = rtrim(file_get_contents('/var/www/html/temperature/api.sc', false));
$location = "40.1612,-74.8821";
$location_friendly = "Home";
$darksky_url = "https://api.darksky.net/forecast/$secret/$location";
$darksky = json_decode(file_get_contents($darksky_url), true);

$out_temp = $darksky['currently']['temperature'];
$out_hum = $darksky['currently']['humidity'];
$out_hum = $out_hum * 100;
$out_pressure = $darksky['currently']['pressure'];

$temp = $data["temperature"];
$hum = $data["humidity"];
$ip = $data["ip"];
$internal = $data["internal"];

$sql = "INSERT INTO temperature (temperature, humidity, ip, `int-ip`, `outside-temp`, `outside-hum`, `outside-pressure`, location) VALUES ('$temp','$hum','$ip','$internal','$out_temp','$out_hum','$out_pressure','$location_friendly')";

if ($db->query($sql) === TRUE) {
            echo "New record created successfully";
} else {
            # echo "Error: " . $sql . "<br>" . $db->error;
}

# Close out the DB connection
$db->close();
?>
