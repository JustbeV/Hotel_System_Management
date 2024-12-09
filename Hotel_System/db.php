<?php
    $servername = "localhost"; // Database host
    $dbusername = "root";        // Database username
    $dbpassword = "mysqlpassword";            // Database password
    $dbname = "hotel_system_management";      // Database name

// Create connection
try{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch(PDOException $e){
    echo "Error ". $e->getMessage();
}
?>



