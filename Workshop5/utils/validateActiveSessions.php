<?php
$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "workshop3";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT id,last_login_datetime FROM users WHERE `status` = 'active'";
$result = $conn->query($sql);
if($result){
    while($results = $result->fetch_assoc()){
        $id = $results['id'];
        $last = strtotime($results['last_login_datetime']);
        if($last && (time() - $last > $argc)){
            $update = "UPDATE users SET status = 'inactive' WHERE id = ?";
            $stmt = $conn->prepare($update);
            $stmt -> bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
        }
    }
}
$conn->close();
?>