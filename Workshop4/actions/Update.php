<?php
$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "workshop4";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = isset($_GET['id']) && is_numeric($_GET['id']) ? (int)$_GET['id'] : 0;

$sql = "SELECT id, name, lastname, username, province FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {

    $userData = $result->fetch_assoc();
} else {
    echo "User not found.";
    exit; 
}

$stmt->close();
$conn->close();
?>

<form method="post">
    <label for="first-name">First Name</label>
    <input id="name" class="form-control" type="text" name="firstName"
           value="<?php echo isset($userData['name']) ? htmlspecialchars($userData['name']) : ''; ?>"><br>

    <label for="last-name">Last Name</label>
    <input id="lastname" class="form-control" type="text" name="lastName"
           value="<?php echo isset($userData['lastname']) ? htmlspecialchars($userData['lastname']) : ''; ?>"><br>

    <label for="email">Email Address</label>
    <input id="username" class="form-control" type="text" name="email"
           value="<?php echo isset($userData['username']) ? htmlspecialchars($userData['username']) : ''; ?>"><br>

    <label for="province">Province</label>
    <input type="text" id="province" name="province"
           value="<?php echo isset($userData['province']) ? htmlspecialchars($userData['province']) : ''; ?>"><br>

    <label for="password">Password</label>
    <input id="password" class="form-control" type="password" name="password"><br>

    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
    
    <button type="submit">Update</button>
</form>

<?php
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0; 
    $name = isset($_POST['firstName']) ? mysqli_real_escape_string($conn, $_POST['firstName']) : '';
    $lastname = isset($_POST['lastName']) ? mysqli_real_escape_string($conn, $_POST['lastName']) : '';
    $username = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : '';
    $province = isset($_POST['province']) ? mysqli_real_escape_string($conn, $_POST['province']) : '';
    $password = isset($_POST['password']) ? mysqli_real_escape_string($conn, $_POST['password']) : '';
    $hashedPassword = !empty($password) ? md5($password) : '';

    if ($hashedPassword) {
        $sql = "UPDATE users SET name = ?, lastname = ?, username = ?, province = ?, password = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $name, $lastname, $username, $province, $hashedPassword, $id);
    } else {
        $sql = "UPDATE users SET name = ?, lastname = ?, username = ?, province = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $name, $lastname, $username, $province, $id);
    }

    if ($stmt->execute()) {
        echo "Record updated successfully";
        header("Location: ../users.php");
        exit;
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
